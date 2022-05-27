import Vue from 'vue'
import { library } from '@fortawesome/fontawesome-svg-core'
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'

import {
  faUser, faUsers, faShip, faLock, faSignOutAlt, faCog, faPlus, faTimes, faEye, faEdit
} from '@fortawesome/free-solid-svg-icons'

import {
  faGithub
} from '@fortawesome/free-brands-svg-icons'

library.add(
  faUser, faUsers, faShip, faLock, faSignOutAlt, faCog, faGithub, faPlus, faTimes, faEye, faEdit
)

Vue.component('fa', FontAwesomeIcon)
