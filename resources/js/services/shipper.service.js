import * as HttpService from './http.service'

const url = '/shippers'

export const getShippers = (showSpinner = true) => {
  return HttpService.get(url, {}, {}, showSpinner)
}

export const createShipper = (form, showSpinner = true) => {
  return HttpService.post(url, form, {}, showSpinner)
}

export const updateShipper = (form, id, showSpinner = true) => {
  return HttpService.put(`${url}/${id}`, form, {}, showSpinner)
}
