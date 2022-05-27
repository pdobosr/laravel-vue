import * as HttpService from './http.service'

const url = '/contacts'

export const getContacts = (showSpinner = true) => {
  return HttpService.get(url, {}, {}, showSpinner)
}

export const createContact = (name, number, showSpinner = true) => {
  return HttpService.post(url, { name, number }, {}, showSpinner)
}
