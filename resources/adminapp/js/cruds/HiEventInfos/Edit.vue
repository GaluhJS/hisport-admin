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
                <strong>{{ $t('cruds.hiEventInfo.title_singular') }}</strong>
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
                      'has-items': entry.event_id !== null,
                      'is-focused': activeField == 'event'
                    }"
                  >
                    <label class="bmd-label-floating required">{{
                      $t('cruds.hiEventInfo.fields.event')
                    }}</label>
                    <v-select
                      name="event"
                      label="name"
                      :key="'event-field'"
                      :value="entry.event_id"
                      :options="lists.event"
                      :reduce="entry => entry.id"
                      @input="updateEvent"
                      @search.focus="focusField('event')"
                      @search.blur="clearFocus"
                    />
                  </div>
                  <div class="form-group">
                    <label>{{ $t('cruds.hiEventInfo.fields.overview') }}</label>
                    <ckeditor
                      :editor="editor"
                      :value="entry.overview"
                      @input="updateOverview"
                    >
                    </ckeditor>
                  </div>
                  <div class="form-group">
                    <label>{{ $t('cruds.hiEventInfo.fields.rules') }}</label>
                    <ckeditor
                      :editor="editor"
                      :value="entry.rules"
                      @input="updateRules"
                    >
                    </ckeditor>
                  </div>
                  <div class="form-group">
                    <label>{{ $t('cruds.hiEventInfo.fields.price') }}</label>
                    <ckeditor
                      :editor="editor"
                      :value="entry.price"
                      @input="updatePrice"
                    >
                    </ckeditor>
                  </div>
                  <div class="form-group">
                    <label>{{ $t('cruds.hiEventInfo.fields.location') }}</label>
                    <ckeditor
                      :editor="editor"
                      :value="entry.location"
                      @input="updateLocation"
                    >
                    </ckeditor>
                  </div>
                  <div class="form-group">
                    <label>{{ $t('cruds.hiEventInfo.fields.contact') }}</label>
                    <ckeditor
                      :editor="editor"
                      :value="entry.contact"
                      @input="updateContact"
                    >
                    </ckeditor>
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
import ClassicEditor from '@ckeditor/ckeditor5-build-classic'

export default {
  components: {
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
    ...mapGetters('HiEventInfosSingle', ['entry', 'loading', 'lists'])
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
    ...mapActions('HiEventInfosSingle', [
      'fetchEditData',
      'updateData',
      'resetState',
      'setEvent',
      'setOverview',
      'setRules',
      'setPrice',
      'setLocation',
      'setContact'
    ]),
    updateEvent(value) {
      this.setEvent(value)
    },
    updateOverview(value) {
      this.setOverview(value)
    },
    updateRules(value) {
      this.setRules(value)
    },
    updatePrice(value) {
      this.setPrice(value)
    },
    updateLocation(value) {
      this.setLocation(value)
    },
    updateContact(value) {
      this.setContact(value)
    },
    submitForm() {
      this.updateData()
        .then(() => {
          this.$router.push({ name: 'hi_event_infos.index' })
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
