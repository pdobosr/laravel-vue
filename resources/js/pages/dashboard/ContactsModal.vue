<template>
  <Modal v-if="opened" @onclose="closeModal">
    <h1 class="text-center text-primary mb-3">
      <fa icon="users" />
      {{ $t('contacts') }}
    </h1>
    <div class="table-container">
      <table class="table table-bordered text-center">
        <thead>
          <tr>
            <th>{{ $t('no') }}</th>
            <th>{{ $t('company_name') }}</th>
            <th>{{ $t('number') }}</th>
          </tr>
        </thead>
        <tbody>
          <tr v-if="primaryContact" :title="$t('primary_contact')" class="text-primary">
            <td>1</td>
            <td>{{ primaryContact.name }}</td>
            <td>{{ primaryContact.number }}</td>
          </tr>
          <tr v-for="(contact, key) in otherContacts" :key="contact.id">
            <td>{{ key + 2 }}</td>
            <td>{{ contact.name }}</td>
            <td>{{ contact.number }}</td>
          </tr>
        </tbody>
      </table>
    </div>
  </Modal>
</template>

<script>
import Modal from '~/components/Modal'

export default {
  name: 'ContactsModal',

  components: { Modal },

  props: {
    opened: {
      type: Boolean,
      default: false
    },
    contacts: {
      type: Array,
      default: () => ([])
    },
    primaryContactId: {
      type: Number,
      default: 0
    }
  },

  data: () => ({
    primaryContact: null,
    otherContacts: []
  }),

  watch: {
    opened () {
      if (this.contacts) {
        this.getPrimaryContact()
        this.getOtherContacts()
      }
    }
  },

  methods: {
    closeModal () {
      this.$emit('onclose')
    },
    getPrimaryContact () {
      this.primaryContact = this.contacts.find((contact) => contact.id === this.primaryContactId)
    },
    getOtherContacts () {
      this.otherContacts = this.contacts.filter((contact) => contact.id !== this.primaryContactId)
    }
  }
}
</script>
