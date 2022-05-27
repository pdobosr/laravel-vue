<template>
  <div>
    <div>
      <h1 class="text-center text-info">
        <fa icon="ship" />
        {{ $t('page.shippers') }}
      </h1>
      <div class="d-flex justify-content-end">
        <v-button
          type="danger"
          native-type="button"
          class="mr-3"
          :title="$t('label.add_contact')"
          @click="openCreateContactModal"
        >
          <fa icon="plus" class="icon" />
          <fa icon="user" class="icon" />
        </v-button>

        <v-button
          type="warning"
          native-type="button"
          class="text-white"
          :title="$t('label.add_shipper')"
          @click="openShipperFormModal"
        >
          <fa icon="plus" class="icon" />
          <fa icon="ship" class="icon" />
        </v-button>
      </div>
    </div>
    <table class="table table-bordered text-center mt-4">
      <thead>
        <tr>
          <th>{{ $t('page.no') }}</th>
          <th>{{ $t('page.shipper_company_name') }}</th>
          <th>{{ $t('page.address') }}</th>
          <th>{{ $t('page.primary_contact_name') }}</th>
          <th>{{ $t('page.primary_contact_number') }}</th>
          <th />
        </tr>
      </thead>
      <tbody>
        <tr v-for="(shipper, key) in shippers" :key="shipper.id">
          <td>{{ key + 1 }}</td>
          <td>{{ shipper.company_name }}</td>
          <td>{{ shipper.address }}</td>
          <td>{{ shipper.primary_contact.name }}</td>
          <td>{{ shipper.primary_contact.number }}</td>
          <td>
            <v-button
              :disabled="!shipper.contacts.length"
              :title="$t('label.view_contacts')"
              @click="openContactsModal(shipper)"
            >
              <fa icon="users" />
            </v-button>
            <v-button
              type="info"
              native-type="button"
              :title="$t('label.edit_shipper')"
              @click="openEditShipperForm(shipper)"
            >
              <fa icon="edit" class="icon" />
            </v-button>
          </td>
        </tr>
      </tbody>
    </table>

    <create-contact-form
      :opened="contactFormVisible"
      @onclose="closeCreateContactModal"
    />

    <shipper-form
      :opened="shipperFormVisible"
      :selected-shipper="selectedShipper"
      @onclose="closeShipperFormModal"
    />

    <contacts-modal
      :opened="contactsModalVisible"
      :contacts="selectedShipper && selectedShipper.contacts"
      :primary-contact-id="selectedShipper && selectedShipper.primary_contact_id"
      @onclose="closeContactsModal"
    />
  </div>
</template>

<script>
import { mapGetters } from 'vuex'
import store from '~/store'
import VButton from '~/components/Button'
import CreateContactForm from './CreateContactForm'
import ShipperForm from './ShipperForm'
import ContactsModal from './ContactsModal'

export default {
  components: { CreateContactForm, ShipperForm, ContactsModal, VButton },

  layout: 'default',

  metaInfo () {
    return { title: this.$t('dashboard') }
  },

  data: () => ({
    title: window.config.appName,
    contactFormVisible: false,
    shipperFormVisible: false,
    contactsModalVisible: false,
    selectedShipper: null
  }),

  computed: mapGetters({
    shippers: 'shipper/shippers'
  }),

  async mounted () {
    await store.dispatch('shipper/getShippers')
    await store.dispatch('contact/getContacts')
  },

  methods: {
    openCreateContactModal () {
      this.contactFormVisible = true
    },
    closeCreateContactModal () {
      this.contactFormVisible = false
    },
    openShipperFormModal () {
      this.shipperFormVisible = true
    },
    closeShipperFormModal () {
      this.shipperFormVisible = false
      this.selectedShipper = null
    },
    openContactsModal (shipper) {
      this.selectedShipper = shipper
      this.contactsModalVisible = true
    },
    closeContactsModal () {
      this.contactsModalVisible = false
      this.selectedShipper = null
    },
    openEditShipperForm (shipper) {
      this.selectedShipper = shipper
      this.openShipperFormModal()
    }
  }
}
</script>
