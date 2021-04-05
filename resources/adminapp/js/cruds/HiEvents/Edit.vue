<template>
  <div class="container-fluid">
    <form @submit.prevent="submitForm">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header card-header-primary card-header-icon">
              <div class="card-icon">
                <i class="material-icons">edit</i>
              </div>
              <h4 class="card-title">
                {{ $t('global.edit') }}
                <strong>{{ $t('cruds.hiEvent.title_singular') }}</strong>
              </h4>
            </div>
            <div class="card-body">
              <back-button></back-button>
            </div>
            <div class="card-body">
              <bootstrap-alert />
              <div class="row">
                <div class="col-md-12">
                  <div
                    class="form-group bmd-form-group"
                    :class="{
                      'has-items': entry.game_id !== null,
                      'is-focused': activeField == 'game'
                    }"
                  >
                    <label class="bmd-label-floating required">{{
                      $t('cruds.hiEvent.fields.game')
                    }}</label>
                    <v-select
                      name="game"
                      label="name"
                      :key="'game-field'"
                      :value="entry.game_id"
                      :options="lists.game"
                      :reduce="entry => entry.id"
                      @input="updateGame"
                      @search.focus="focusField('game')"
                      @search.blur="clearFocus"
                    />
                  </div>
                  <div
                    class="form-group bmd-form-group"
                    :class="{
                      'has-items': entry.name,
                      'is-focused': activeField == 'name'
                    }"
                  >
                    <label class="bmd-label-floating required">{{
                      $t('cruds.hiEvent.fields.name')
                    }}</label>
                    <input
                      class="form-control"
                      type="text"
                      :value="entry.name"
                      @input="updateName"
                      @focus="focusField('name')"
                      @blur="clearFocus"
                      required
                    />
                  </div>
                  <div class="form-group">
                    <label class="required">{{
                      $t('cruds.hiEvent.fields.event_banner')
                    }}</label>
                    <attachment
                      :route="getRoute('hi-events')"
                      :collection-name="'hi_event_event_banner'"
                      :media="entry.event_banner"
                      :model-id="$route.params.id"
                      :max-file-size="2"
                      :component="'pictures'"
                      :accept="'image/*'"
                      @file-uploaded="insertEventBannerFile"
                      @file-removed="removeEventBannerFile"
                      :max-files="1"
                    />
                  </div>
                  <div class="form-group">
                    <label class="required">{{
                      $t('cruds.hiEvent.fields.game_type')
                    }}</label>
                    <v-radio
                      :value="entry.game_type"
                      :options="lists.game_type"
                      @change="updateGameType"
                    >
                    </v-radio>
                  </div>
                  <div class="form-group">
                    <label>{{ $t('cruds.hiEvent.fields.game_level') }}</label>
                    <v-radio
                      :value="entry.game_level"
                      :options="lists.game_level"
                      @change="updateGameLevel"
                    >
                    </v-radio>
                  </div>
                  <div
                    class="form-group bmd-form-group"
                    :class="{
                      'has-items': entry.price,
                      'is-focused': activeField == 'price'
                    }"
                  >
                    <label class="bmd-label-floating">{{
                      $t('cruds.hiEvent.fields.price')
                    }}</label>
                    <input
                      class="form-control"
                      type="number"
                      step="1"
                      :value="entry.price"
                      @input="updatePrice"
                      @focus="focusField('price')"
                      @blur="clearFocus"
                    />
                  </div>
                  <div class="form-group">
                    <label class="required">{{
                      $t('cruds.hiEvent.fields.player_type')
                    }}</label>
                    <v-radio
                      :value="entry.player_type"
                      :options="lists.player_type"
                      @change="updatePlayerType"
                    >
                    </v-radio>
                  </div>
                  <div
                    class="form-group bmd-form-group"
                    :class="{
                      'has-items': entry.start_date,
                      'is-focused': activeField == 'start_date'
                    }"
                  >
                    <label class="bmd-label-floating required">{{
                      $t('cruds.hiEvent.fields.start_date')
                    }}</label>
                    <datetime-picker
                      class="form-control"
                      type="text"
                      :value="entry.start_date"
                      @input="updateStartDate"
                      @focus="focusField('start_date')"
                      @blur="clearFocus"
                      required
                    >
                    </datetime-picker>
                  </div>
                  <div
                    class="form-group bmd-form-group"
                    :class="{
                      'has-items': entry.finish_date,
                      'is-focused': activeField == 'finish_date'
                    }"
                  >
                    <label class="bmd-label-floating">{{
                      $t('cruds.hiEvent.fields.finish_date')
                    }}</label>
                    <datetime-picker
                      class="form-control"
                      type="text"
                      :value="entry.finish_date"
                      @input="updateFinishDate"
                      @focus="focusField('finish_date')"
                      @blur="clearFocus"
                    >
                    </datetime-picker>
                  </div>
                  <div
                    class="form-group bmd-form-group"
                    :class="{
                      'has-items': entry.format,
                      'is-focused': activeField == 'format'
                    }"
                  >
                    <label class="bmd-label-floating">{{
                      $t('cruds.hiEvent.fields.format')
                    }}</label>
                    <input
                      class="form-control"
                      type="text"
                      :value="entry.format"
                      @input="updateFormat"
                      @focus="focusField('format')"
                      @blur="clearFocus"
                    />
                  </div>
                  <div class="form-group">
                    <label>{{ $t('cruds.hiEvent.fields.information') }}</label>
                    <ckeditor
                      :editor="editor"
                      :value="entry.information"
                      @input="updateInformation"
                    >
                    </ckeditor>
                  </div>
                  <div
                    class="form-group bmd-form-group"
                    :class="{
                      'has-items': entry.venue,
                      'is-focused': activeField == 'venue'
                    }"
                  >
                    <label class="bmd-label-floating">{{
                      $t('cruds.hiEvent.fields.venue')
                    }}</label>
                    <input
                      class="form-control"
                      type="text"
                      :value="entry.venue"
                      @input="updateVenue"
                      @focus="focusField('venue')"
                      @blur="clearFocus"
                    />
                  </div>
                  <div
                    class="form-group bmd-form-group"
                    :class="{
                      'has-items': entry.fee,
                      'is-focused': activeField == 'fee'
                    }"
                  >
                    <label class="bmd-label-floating">{{
                      $t('cruds.hiEvent.fields.fee')
                    }}</label>
                    <input
                      class="form-control"
                      type="number"
                      step="0.01"
                      :value="entry.fee"
                      @input="updateFee"
                      @focus="focusField('fee')"
                      @blur="clearFocus"
                    />
                  </div>
                </div>
              </div>
            </div>
            <div class="card-footer">
              <vue-button-spinner
                class="btn-primary"
                :status="status"
                :isLoading="loading"
                :disabled="loading"
              >
                {{ $t('global.save') }}
              </vue-button-spinner>
            </div>
          </div>
        </div>
      </div>
    </form>
  </div>
</template>

<script>
import { mapGetters, mapActions } from 'vuex'
import Attachment from '@components/Attachments/Attachment'
import ClassicEditor from '@ckeditor/ckeditor5-build-classic'

export default {
  components: {
    Attachment,
    ClassicEditor
  },
  data() {
    return {
      status: '',
      activeField: '',
      editor: ClassicEditor
    }
  },
  computed: {
    ...mapGetters('HiEventsSingle', ['entry', 'loading', 'lists'])
  },
  beforeDestroy() {
    this.resetState()
  },
  watch: {
    '$route.params.id': {
      immediate: true,
      handler() {
        this.resetState()
        this.fetchEditData(this.$route.params.id)
      }
    }
  },
  methods: {
    ...mapActions('HiEventsSingle', [
      'fetchEditData',
      'updateData',
      'resetState',
      'setGame',
      'setName',
      'insertEventBannerFile',
      'removeEventBannerFile',
      'setGameType',
      'setGameLevel',
      'setPrice',
      'setPlayerType',
      'setStartDate',
      'setFinishDate',
      'setFormat',
      'setInformation',
      'setVenue',
      'setFee'
    ]),
    updateGame(value) {
      this.setGame(value)
    },
    updateName(e) {
      this.setName(e.target.value)
    },
    updateGameType(value) {
      this.setGameType(value)
    },
    updateGameLevel(value) {
      this.setGameLevel(value)
    },
    updatePrice(e) {
      this.setPrice(e.target.value)
    },
    updatePlayerType(value) {
      this.setPlayerType(value)
    },
    updateStartDate(e) {
      this.setStartDate(e.target.value)
    },
    updateFinishDate(e) {
      this.setFinishDate(e.target.value)
    },
    updateFormat(e) {
      this.setFormat(e.target.value)
    },
    updateInformation(value) {
      this.setInformation(value)
    },
    updateVenue(e) {
      this.setVenue(e.target.value)
    },
    updateFee(e) {
      this.setFee(e.target.value)
    },
    getRoute(name) {
      return `${axios.defaults.baseURL}${name}/media`
    },
    submitForm() {
      this.updateData()
        .then(() => {
          this.$router.push({ name: 'hi_events.index' })
          this.$eventHub.$emit('update-success')
        })
        .catch(error => {
          this.status = 'failed'
          _.delay(() => {
            this.status = ''
          }, 3000)
        })
    },
    focusField(name) {
      this.activeField = name
    },
    clearFocus() {
      this.activeField = ''
    }
  }
}
</script>
