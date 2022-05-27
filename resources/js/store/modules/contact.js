import * as contactService from '~/services/contact.service'
import * as types from '../mutation-types'

// state
export const state = {
  contacts: []
}

// getters
export const getters = {
  contacts: state => state.contacts
}

// mutations
export const mutations = {
  [types.GET_CONTACTS] (state, { contacts }) {
    state.contacts = contacts
  }
}

// actions
export const actions = {
  async getContacts ({ commit }) {
    try {
      const contacts = await contactService.getContacts(true)

      commit(types.GET_CONTACTS, { contacts })
    } catch (e) {}
  }

}
