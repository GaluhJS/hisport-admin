import Vue from 'vue'
import Vuex from 'vuex'

import Alert from './modules/alert'
import I18NStore from './modules/i18n'

import PermissionsIndex from './cruds/Permissions'
import PermissionsSingle from './cruds/Permissions/single'
import RolesIndex from './cruds/Roles'
import RolesSingle from './cruds/Roles/single'
import UsersIndex from './cruds/Users'
import UsersSingle from './cruds/Users/single'
import HiGamesIndex from './cruds/HiGames'
import HiGamesSingle from './cruds/HiGames/single'
import HiVenuesIndex from './cruds/HiVenues'
import HiVenuesSingle from './cruds/HiVenues/single'
import HiEventsIndex from './cruds/HiEvents'
import HiEventsSingle from './cruds/HiEvents/single'
import HiEventInfosIndex from './cruds/HiEventInfos'
import HiEventInfosSingle from './cruds/HiEventInfos/single'

Vue.use(Vuex)

const debug = process.env.NODE_ENV !== 'production'

export default new Vuex.Store({
  modules: {
    Alert,
    I18NStore,
    PermissionsIndex,
    PermissionsSingle,
    RolesIndex,
    RolesSingle,
    UsersIndex,
    UsersSingle,
    HiGamesIndex,
    HiGamesSingle,
    HiVenuesIndex,
    HiVenuesSingle,
    HiEventsIndex,
    HiEventsSingle,
    HiEventInfosIndex,
    HiEventInfosSingle
  },
  strict: debug
})
