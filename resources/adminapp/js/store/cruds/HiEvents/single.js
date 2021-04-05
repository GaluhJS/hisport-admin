function initialState() {
  return {
    entry: {
      id: null,
      game_id: null,
      name: '',
      event_banner: [],
      game_type: '1',
      game_level: null,
      price: '0',
      player_type: null,
      start_date: '',
      finish_date: '',
      format: '',
      information: '',
      venue: '',
      fee: '',
      created_at: '',
      updated_at: '',
      deleted_at: ''
    },
    lists: {
      game: [],
      game_type: [],
      game_level: [],
      player_type: []
    },
    loading: false
  }
}

const route = 'hi-events'

const getters = {
  entry: state => state.entry,
  lists: state => state.lists,
  loading: state => state.loading
}

const actions = {
  storeData({ commit, state, dispatch }) {
    commit('setLoading', true)
    dispatch('Alert/resetState', null, { root: true })

    return new Promise((resolve, reject) => {
      let params = objectToFormData(state.entry, {
        indices: true,
        booleansAsIntegers: true
      })
      axios
        .post(route, params)
        .then(response => {
          resolve(response)
        })
        .catch(error => {
          let message = error.response.data.message || error.message
          let errors = error.response.data.errors

          dispatch(
            'Alert/setAlert',
            { message: message, errors: errors, color: 'danger' },
            { root: true }
          )

          reject(error)
        })
        .finally(() => {
          commit('setLoading', false)
        })
    })
  },
  updateData({ commit, state, dispatch }) {
    commit('setLoading', true)
    dispatch('Alert/resetState', null, { root: true })

    return new Promise((resolve, reject) => {
      let params = objectToFormData(state.entry, {
        indices: true,
        booleansAsIntegers: true
      })
      params.set('_method', 'PUT')
      axios
        .post(`${route}/${state.entry.id}`, params)
        .then(response => {
          resolve(response)
        })
        .catch(error => {
          let message = error.response.data.message || error.message
          let errors = error.response.data.errors

          dispatch(
            'Alert/setAlert',
            { message: message, errors: errors, color: 'danger' },
            { root: true }
          )

          reject(error)
        })
        .finally(() => {
          commit('setLoading', false)
        })
    })
  },
  setGame({ commit }, value) {
    commit('setGame', value)
  },
  setName({ commit }, value) {
    commit('setName', value)
  },
  insertEventBannerFile({ commit }, file) {
    commit('insertEventBannerFile', file)
  },
  removeEventBannerFile({ commit }, file) {
    commit('removeEventBannerFile', file)
  },
  setGameType({ commit }, value) {
    commit('setGameType', value)
  },
  setGameLevel({ commit }, value) {
    commit('setGameLevel', value)
  },
  setPrice({ commit }, value) {
    commit('setPrice', value)
  },
  setPlayerType({ commit }, value) {
    commit('setPlayerType', value)
  },
  setStartDate({ commit }, value) {
    commit('setStartDate', value)
  },
  setFinishDate({ commit }, value) {
    commit('setFinishDate', value)
  },
  setFormat({ commit }, value) {
    commit('setFormat', value)
  },
  setInformation({ commit }, value) {
    commit('setInformation', value)
  },
  setVenue({ commit }, value) {
    commit('setVenue', value)
  },
  setFee({ commit }, value) {
    commit('setFee', value)
  },
  setCreatedAt({ commit }, value) {
    commit('setCreatedAt', value)
  },
  setUpdatedAt({ commit }, value) {
    commit('setUpdatedAt', value)
  },
  setDeletedAt({ commit }, value) {
    commit('setDeletedAt', value)
  },
  fetchCreateData({ commit }) {
    axios.get(`${route}/create`).then(response => {
      commit('setLists', response.data.meta)
    })
  },
  fetchEditData({ commit, dispatch }, id) {
    axios.get(`${route}/${id}/edit`).then(response => {
      commit('setEntry', response.data.data)
      commit('setLists', response.data.meta)
    })
  },
  fetchShowData({ commit, dispatch }, id) {
    axios.get(`${route}/${id}`).then(response => {
      commit('setEntry', response.data.data)
    })
  },
  resetState({ commit }) {
    commit('resetState')
  }
}

const mutations = {
  setEntry(state, entry) {
    state.entry = entry
  },
  setGame(state, value) {
    state.entry.game_id = value
  },
  setName(state, value) {
    state.entry.name = value
  },
  insertEventBannerFile(state, file) {
    state.entry.event_banner.push(file)
  },
  removeEventBannerFile(state, file) {
    state.entry.event_banner = state.entry.event_banner.filter(item => {
      return item.id !== file.id
    })
  },
  setGameType(state, value) {
    state.entry.game_type = value
  },
  setGameLevel(state, value) {
    state.entry.game_level = value
  },
  setPrice(state, value) {
    state.entry.price = value
  },
  setPlayerType(state, value) {
    state.entry.player_type = value
  },
  setStartDate(state, value) {
    state.entry.start_date = value
  },
  setFinishDate(state, value) {
    state.entry.finish_date = value
  },
  setFormat(state, value) {
    state.entry.format = value
  },
  setInformation(state, value) {
    state.entry.information = value
  },
  setVenue(state, value) {
    state.entry.venue = value
  },
  setFee(state, value) {
    state.entry.fee = value
  },
  setCreatedAt(state, value) {
    state.entry.created_at = value
  },
  setUpdatedAt(state, value) {
    state.entry.updated_at = value
  },
  setDeletedAt(state, value) {
    state.entry.deleted_at = value
  },
  setLists(state, lists) {
    state.lists = lists
  },
  setLoading(state, loading) {
    state.loading = loading
  },
  resetState(state) {
    state = Object.assign(state, initialState())
  }
}

export default {
  namespaced: true,
  state: initialState,
  getters,
  actions,
  mutations
}
