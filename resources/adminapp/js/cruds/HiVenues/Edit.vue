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
                <strong>{{ $t('cruds.hiVenue.title_singular') }}</strong>
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
                      'has-items': entry.name,
                      'is-focused': activeField == 'name'
                    }"
                  >
                    <label class="bmd-label-floating">{{
                      $t('cruds.hiVenue.fields.name')
                    }}</label>
                    <input
                      class="form-control"
                      type="text"
                      :value="entry.name"
                      @input="updateName"
                      @focus="focusField('name')"
                      @blur="clearFocus"
                    />
                  </div>
                  <div class="form-group">
                    <label>{{ $t('cruds.hiVenue.fields.image') }}</label>
                    <attachment
                      :route="getRoute('hi-venues')"
                      :collection-name="'hi_venue_image'"
                      :media="entry.image"
                      :model-id="$route.params.id"
                      :max-file-size="2"
                      :component="'pictures'"
                      :accept="'image/*'"
                      @file-uploaded="insertImageFile"
                      @file-removed="removeImageFile"
                      :max-files="1"
                    />
                  </div>
                  <div
                    class="form-group bmd-form-group"
                    :class="{
                      'has-items': entry.iframe,
                      'is-focused': activeField == 'iframe'
                    }"
                  >
                    <label class="bmd-label-floating">{{
                      $t('cruds.hiVenue.fields.iframe')
                    }}</label>
                    <textarea
                      class="form-control"
                      rows="5"
                      :value="entry.iframe"
                      @input="updateIframe"
                      @focus="focusField('iframe')"
                      @blur="clearFocus"
                    ></textarea>
                  </div>
                  <div
                    class="form-group bmd-form-group"
                    :class="{
                      'has-items': entry.address,
                      'is-focused': activeField == 'address'
                    }"
                  >
                    <label class="bmd-label-floating">{{
                      $t('cruds.hiVenue.fields.address')
                    }}</label>
                    <textarea
                      class="form-control"
                      rows="5"
                      :value="entry.address"
                      @input="updateAddress"
                      @focus="focusField('address')"
                      @blur="clearFocus"
                    ></textarea>
                  </div>
                  <div
                    class="form-group bmd-form-group"
                    :class="{
                      'has-items': entry.long,
                      'is-focused': activeField == 'long'
                    }"
                  >
                    <label class="bmd-label-floating">{{
                      $t('cruds.hiVenue.fields.long')
                    }}</label>
                    <input
                      class="form-control"
                      type="text"
                      :value="entry.long"
                      @input="updateLong"
                      @focus="focusField('long')"
                      @blur="clearFocus"
                    />
                  </div>
                  <div
                    class="form-group bmd-form-group"
                    :class="{
                      'has-items': entry.lat,
                      'is-focused': activeField == 'lat'
                    }"
                  >
                    <label class="bmd-label-floating">{{
                      $t('cruds.hiVenue.fields.lat')
                    }}</label>
                    <input
                      class="form-control"
                      type="text"
                      :value="entry.lat"
                      @input="updateLat"
                      @focus="focusField('lat')"
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

export default {
  components: {
    Attachment
  },
  data() {
    return {
      status: '',
      activeField: ''
    }
  },
  computed: {
    ...mapGetters('HiVenuesSingle', ['entry', 'loading'])
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
    ...mapActions('HiVenuesSingle', [
      'fetchEditData',
      'updateData',
      'resetState',
      'setName',
      'insertImageFile',
      'removeImageFile',
      'setIframe',
      'setAddress',
      'setLong',
      'setLat'
    ]),
    updateName(e) {
      this.setName(e.target.value)
    },
    updateIframe(e) {
      this.setIframe(e.target.value)
    },
    updateAddress(e) {
      this.setAddress(e.target.value)
    },
    updateLong(e) {
      this.setLong(e.target.value)
    },
    updateLat(e) {
      this.setLat(e.target.value)
    },
    getRoute(name) {
      return `${axios.defaults.baseURL}${name}/media`
    },
    submitForm() {
      this.updateData()
        .then(() => {
          this.$router.push({ name: 'hi_venues.index' })
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
