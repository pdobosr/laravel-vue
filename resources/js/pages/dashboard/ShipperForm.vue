<template>
  <Modal v-if="opened" size="large" @onclose="closeModal">
    <h1 class="text-center text-primary mb-3">
      <fa icon="ship" />
      {{ $t(selectedShipper ? 'page.update_shipper' : 'page.create_shipper') }}
    </h1>
    <form @submit.prevent="onSubmit" @keydown="form.onKeydown($event)">
      <div class="form-group row">
        <label class="col-md-3 col-form-label text-md-right">{{ $t('form.company_name') }}</label>
        <div class="col-md-8">
          <input v-model="form.company_name" :class="{ 'is-invalid': form.errors.has('company_name') }" class="form-control" type="text" name="company_name">
          <has-error :form="form" field="company_name" />
        </div>
      </div>

      <div class="form-group row">
        <label class="col-md-3 col-form-label text-md-right">{{ $t('form.address') }}</label>
        <div class="col-md-8">
          <input v-model="form.address" :class="{ 'is-invalid': form.errors.has('address') }" class="form-control" type="text" name="address">
          <has-error :form="form" field="address" />
        </div>
      </div>

      <div class="form-group row">
        <label class="col-md-3 col-form-label text-md-right">{{ $t('form.contacts') }}</label>
        <div class="col-md-8">
          <div class="table-container">
            <table class="table table-bordered text-center">
              <thead>
                <tr>
                  <th>{{ $t('page.no') }}</th>
                  <th>{{ $t('page.company_name') }}</th>
                  <th>{{ $t('page.number') }}</th>
                  <th>{{ $t('page.add_to_contact_list') }}</th>
                  <th>{{ $t('page.set_primary_contact') }}</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="(contact, key) in contacts" :key="contact.id">
                  <td>{{ key + 1 }}</td>
                  <td>{{ contact.name }}</td>
                  <td>{{ contact.number }}</td>
                  <td>
                    <input
                      type="checkbox"
                      :checked="isSelectedContact(contact)"
                      @change="(e) => selectContact(contact, e.target.checked)"
                    >
                  </td>
                  <td>
                    <input
                      type="checkbox"
                      :checked="primaryContact && primaryContact.id === contact.id"
                      :disabled="!isSelectedContact(contact)"
                      @change="(e) => selectPrimaryContact(contact, e.target.checked)"
                    >
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>

      <div class="form-group row">
        <div class="col-md-9 ml-md-auto">
          <v-button :loading="form.busy" type="success">
            {{ $t(selectedShipper ? 'label.update_shipper' : 'label.create_shipper') }}
          </v-button>
        </div>
      </div>
    </form>
  </Modal>
</template>

<script>
import Form from 'vform'
import { mapGetters } from 'vuex'
import Swal from 'sweetalert2'
import * as shipperService from '~/services/shipper.service'
import store from '~/store'
import VButton from '~/components/Button'
import Modal from '~/components/Modal'

export default {
  name: 'ShipperForm',

  components: { Modal, VButton },

  props: {
    opened: {
      type: Boolean,
      default: false
    },
    selectedShipper: {
      type: Object,
      default: null
    }
  },

  data: () => ({
    form: new Form({
      company_name: '',
      address: ''
    }),
    selectedContacts: [],
    primaryContact: null
  }),

  computed: mapGetters({
    contacts: 'contact/contacts'
  }),

  watch: {
    opened () {
      if (this.selectedShipper) {
        this.form.keys().forEach(key => {
          this.form[key] = this.selectedShipper[key]
        })

        this.selectedContacts = this.selectedShipper.contacts
        this.primaryContact = this.selectedShipper.contacts.find((c) => c.id === this.selectedShipper.primary_contact_id)
      } else {
        this.form.reset()
        this.selectedContacts = []
        this.primaryContact = null
      }
    }
  },

  methods: {
    closeModal () {
      this.$emit('onclose')
    },

    selectContact (contact, checked) {
      if (checked) {
        this.selectedContacts = [...this.selectedContacts, contact]
      } else {
        this.selectedContacts = this.selectedContacts && this.selectedContacts.filter((c) => c.id !== contact.id)
      }
    },

    selectPrimaryContact (contact, checked) {
      this.primaryContact = checked ? contact : null
    },

    isSelectedContact (contact) {
      return this.selectedContacts.filter((c) => c.id === contact.id).length > 0
    },

    async onSubmit () {
      if (this.selectedShipper) {
        await this.updateShipper()
      } else {
        await this.createShipper()
      }
      await store.dispatch('shipper/getShippers')
    },

    async createShipper () {
      this.form.contact_ids = this.selectedContacts.length > 0 && this.selectedContacts.map((contact) => contact.id)
      this.form.primary_contact_id = this.primaryContact && this.primaryContact.id

      const shipper = await shipperService.createShipper(this.form)

      if (shipper) {
        this.closeModal()
        Swal.fire({
          type: 'success',
          title: this.$t('alert.success_title'),
          text: this.$t('alert.info.shipper_created')
        })
      }
    },

    async updateShipper () {
      this.form.id = this.selectedShipper.id
      this.form.contact_ids = this.selectedContacts.length > 0 && this.selectedContacts.map((contact) => contact.id)
      this.form.primary_contact_id = this.primaryContact && this.primaryContact.id

      const shipper = await shipperService.updateShipper(this.form, this.selectedShipper.id)

      if (shipper) {
        this.closeModal()
        Swal.fire({
          type: 'success',
          title: this.$t('alert.success_title'),
          text: this.$t('alert.info.shipper_updated')
        })
      }
    }
  }
}
</script>
