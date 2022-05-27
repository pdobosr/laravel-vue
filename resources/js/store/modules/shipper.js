import * as shipperService from '~/services/shipper.service'
import * as types from '../mutation-types'

// state
export const state = {
  shippers: []
}

// getters
export const getters = {
  shippers: state => state.shippers
}

// mutations
export const mutations = {
  [types.GET_SHIPPERS] (state, { shippers }) {
    state.shippers = shippers
  }
}

// actions
export const actions = {
  async getShippers ({ commit }) {
    try {
      const shippers = await shipperService.getShippers(true)

      commit(types.GET_SHIPPERS, { shippers })
    } catch (e) {}
  }
}
