<template>
  <Modal v-if="opened" @onclose="closeModal">
    <h1 class="text-center text-primary mb-3">
      <fa icon="user" />
      {{ $t('page.create_contact') }}
    </h1>
    <form @submit.prevent="createContact" @keydown="form.onKeydown($event)">
      <div class="form-group row">
        <label class="col-md-3 col-form-label text-md-right">{{ $t('form.contact_name') }}</label>
        <div class="col-md-7">
          <input v-model="form.name" :class="{ 'is-invalid': form.errors.has('name') }" class="form-control" type="text" name="name">
          <has-error :form="form" field="name" />
        </div>
      </div>

      <div class="form-group row">
        <label class="col-md-3 col-form-label text-md-right">{{ $t('form.contact_number') }}</label>
        <div class="col-md-7">
          <input v-model="form.number" :class="{ 'is-invalid': form.errors.has('number') }" class="form-control" type="text" name="number">
          <has-error :form="form" field="number" />
        </div>
      </div>

      <div class="form-group row">
        <div class="col-md-9 ml-md-auto">
          <v-button :loading="form.busy" type="success">
            {{ $t('label.create_contact') }}
          </v-button>
        </div>
      </div>
    </form>
  </Modal>
</template>

<script>
import Form from 'vform'
import Swal from 'sweetalert2'
import * as contactService from '~/services/contact.service'
import store from '~/store'
import VButton from '~/components/Button'
import Modal from '~/components/Modal'

export default {
  name: 'CreateContactForm',

  components: { Modal, VButton },

  props: {
    opened: {
      type: Boolean,
      default: false
    }
  },

  data: () => ({
    form: new Form({
      name: '',
      number: ''
    })
  }),

  methods: {
    closeModal () {
      this.$emit('onclose')
    },

    async createContact () {
      const contact = await contactService.createContact(this.form.name, this.form.number)
      if (contact) {
        this.closeModal()
        store.dispatch('shipper/getShippers')
        Swal.fire({
          type: 'success',
          title: this.$t('alert.success_title'),
          text: this.$t('alert.info.contact_created')
        })
      }
    }
  }
}
</script>
