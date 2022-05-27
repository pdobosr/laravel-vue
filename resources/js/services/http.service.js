import axios from 'axios'
import Swal from 'sweetalert2'
import i18n from '~/plugins/i18n'

const baseURL = '/api'

const http = axios.create({ baseURL })

const httpResponseHandler = (response) => {
  return response.data
}

const httpErrorHandler = (err) => {
  const { status, data } = err.response
  const { message } = data

  if (status === 422) {
    Swal.fire({
      type: 'error',
      title: i18n.t('alert.error.title'),
      text: message,
      reverseButtons: true,
      confirmButtonText: i18n.t('label.ok'),
      cancelButtonText: i18n.t('label.cancel')
    })
  }

  if (status >= 500) {
    Swal.fire({
      type: 'error',
      title: i18n.t('alert.error.title'),
      text: i18n.t('alert.error.text'),
      reverseButtons: true,
      confirmButtonText: i18n.t('label.ok'),
      cancelButtonText: i18n.t('label.cancel')
    })
  }

  throw err
}

export const get = (url, params = {}, headers = {}, hasSpinner = true) => {
  return request('GET', url, { params, headers }, hasSpinner)
}

export const post = (url, body = {}, headers = {}, hasSpinner = true) => {
  return request('POST', url, { data: body, headers }, hasSpinner)
}

export const put = (url, body = {}, headers = {}, hasSpinner = true) => {
  return request('PUT', url, { data: body, headers }, hasSpinner)
}

export const patch = (url, body = {}, headers = {}, hasSpinner = true) => {
  return request('PATCH', url, { data: body, headers }, hasSpinner)
}

export const remove = (url, body = {}, headers = {}, hasSpinner = true) => {
  return request('DELETE', url, { data: body, headers }, hasSpinner)
}

const request = (method, url, options, hasSpinner = true) => {
  // if (hasSpinner) {
  //   store.dispatch('shipper/getShippers')
  // }

  return http
    .request({
      ...options,
      method,
      url
    })
    .then(httpResponseHandler)
    .catch(httpErrorHandler)
    .finally(() => {
      // store.dispatch(finishLoading())
    })
}
