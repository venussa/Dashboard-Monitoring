<!-- eslint-disable -->
<template>
  <b-row>
    <!-- loop cath list project -->
    <b-col :v-if="showProject.length > 0" v-for="item in showProject" v-bind:key="item.title" lg="12" >

      <!-- add sensor button -->
      <p style="font-size:22px;padding:10px;padding-left:2px;margin-top:30px;">
        {{ item.title }}
        <b-button v-b-modal.modal-1 variant="outline-primary" text-variant="white" size="sm" style="padding-left:5px;padding-right:5px;margin-left:10px;" @click="modal_type(1, 'Sensor', item.id)" >
        <feather-icon icon="PlusIcon" />
          <span>Add Sensor</span>
        </b-button>

        <b-dropdown id="dropdown-1" variant="link-secondary" class="more-icon" >
          <template #button-content>
            <feather-icon icon="MoreHorizontalIcon" size="20" />
          </template>
          <b-dropdown-item v-b-modal.modal-1 @click="modal_type(2, 'Node', item.id, item.title, item.description)" >
            Edit
          </b-dropdown-item>
          <b-dropdown-item v-b-modal.modal-1 @click="modal_type(3, 'Node', item.id, item.title)">
            Delete
          </b-dropdown-item>
        </b-dropdown>
      </p>
      <!-- /add sensor button -->

      <!-- loop sensor list -->
      <b-row>
        <b-col v-for="sensor in item.sensor" v-bind:key="sensor.title" lg="3" xs="" >
          <b-card class="node-project" >
            <b-button :to="{ name: 'project-sensor', params: { id: sensor.id }}" variant="flat-secondary card-link">
              <p class="card-title" style="padding:0px;height: auto;" >{{ sensor.title }}</p>
              <div style="position: relative;">
                <div class="b-avatar rounded-square" :class="sensor.status === true ? 'badge-light-success' : 'badge-light-danger'" >
                  <feather-icon :icon="sensor.status === true ? 'CheckCircleIcon' : 'AlertTriangleIcon'" />
                </div>
                <p style="position:absolute; right: 0px;top: 5px;font-size:22px;">{{ sensor.value }}</p>
              </div>
              <b-dropdown id="dropdown-1" variant="link-secondary" class="more-icon" >
                <template #button-content>
                  <feather-icon icon="MoreHorizontalIcon" size="20" />
                </template>
                <b-dropdown-item v-b-modal.modal-1 @click="modal_type(2, 'Sensor', sensor.id, sensor.title, sensor.type)" >
                  Edit
                </b-dropdown-item>
                <b-dropdown-item v-b-modal.modal-1 @click="modal_type(3, 'Sensor', sensor.id, sensor.title)">
                  Delete
                </b-dropdown-item>
              </b-dropdown>
            </b-button>
          </b-card>
        </b-col>
      </b-row>
      <!-- /loop sensor list -->
    </b-col>

    <b-button v-b-modal.modal-1 variant="flat-primary" text-variant="white" style="padding-left:5px;padding-right:5px;margin-left:10px;" @click="modal_type(1, 'Node', 'none')" >
      <feather-icon icon="PlusIcon" />
      <span>Add Node</span>
    </b-button>
    
    <p style="margin-top:50px;" />
    <!-- /loop cath list project -->

      <!-- modal -->
      <b-modal id="modal-1" ref="modal" :title="modalTitle" :hide-footer="true" >
        <!-- input field -->
        <b-card-text v-if="modaltype === 1 | modaltype === 2">
          <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
          <p style="font-weight:600;margin-top:10px;">Title</p>
          <b-form-input v-model="title" placeholder="Name ..." />

          <span v-if="fieldType === 'Sensor'">
            <p style="font-weight:600;margin-top:10px;">Sensor Type</p>
            <v-select v-model="desc" :options="option_perpage" :components="{ Deselect, OpenIndicator }" >
                <slot name="no-options">Sorry, no matching options.</slot>
            </v-select>
          </span>

          <span v-if="fieldType === 'Node'">
            <p style="font-weight:600;margin-top:10px;">Description</p>
            <b-form-textarea v-model="desc" id="textarea-rows" placeholder="Type ..." />
          </span>

          <!-- alert box -->
          <b-alert v-if="alert_type > 0" :variant="alert_type > 1 ? 'info' : 'warning'" show style="margin-top:10px" >
            <h4 class="alert-heading">{{ alertmsg }}</h4>
          </b-alert>
          <!-- /alert box -->
        </b-card-text>
        <!-- /input field -->

        <!-- prop delete -->
        <b-card-text v-if="modaltype === 3">
            Apakah anda yakin ingin menghapus projek <b>{{ title }}</b>
        </b-card-text>
        <!-- /prop delete -->

        <!-- modal footer -->
        <div style="padding-top:30px;text-align:right;">
          <b-button variant="outline-secondary" @click="hideModal" >
            Cancel
          </b-button>
          <b-button variant="primary" style="margin-left:10px" @click="addProject" >
            {{ modalbutton }}
          </b-button>
        </div>
        <!-- /modal footer -->

      </b-modal>
      <!-- modal -->
  </b-row>
</template>

<script>
// load vue select
import vSelect from 'vue-select'

// load bootstrap vue
import {
  BRow,
  BCol,
  BButton,
  VBModal,
  BFormInput,
  BCardText,
  BFormTextarea,
  BAlert,
  BDropdown,
  BDropdownItem,
  BCard,
} from 'bootstrap-vue'

// load axios
import axios from 'axios'
import httpApi from '@/main'

import Ripple from 'vue-ripple-directive'

export default {
  components: {
    BRow,
    BCol,
    BButton,
    BFormInput,
    BCardText,
    BFormTextarea,
    BAlert,
    BDropdown,
    BDropdownItem,
    vSelect,
    BCard,
  },
  directives: {
    'b-modal': VBModal,
    Ripple,
  },
  props: {
    // catch data from show project storage
    showProject: {
      type: null,
      required: true,
    },
    // catch data from user session storage
    userData: {
      type: null,
      required: true,
    },
  },
  data() {
    return {
      // api storage
      api: [],

      // alert configuration storage
      alertmsg: '',
      alert_type: 0,

      // modal configuration storage
      modaltype: 0,
      modalTitle: '',
      modalbutton: '',
      postType: '',
      fieldType: '',
      http_index: 0,
      n_id: '',
      s_id: '',

      // sensor type option
      option_perpage: ['Float', 'Integer', 'Boolean', 'String'],
      Deselect: {
        render: createElement => createElement('span', ''),
      },
      OpenIndicator: {
        render: createElement => createElement('span', { class: 'dropdown-icon' }),
      },

      // input field
      title: '',
      desc: '',
    }
  },
  methods: {
    // switch modal
    modal_type(postType, fieldType, id, title = '', description = '') {
      this.modaltype = postType
      this.alert_type = 0
      this.title = title
      this.desc = description
      this.fieldType = fieldType
      this.n_id = id
      this.s_id = id

      if (postType === 1) {
        this.modalTitle = `Add ${fieldType}`
        this.modalbutton = 'Save'
        this.postType = 'New'
        this.http_index = 1
      } else if (postType === 2) {
        this.modalTitle = `Edit ${fieldType}`
        this.modalbutton = 'Save Changes'
        this.postType = 'Edit'
        this.http_index = 2
      } else if (postType === 3) {
        this.modalTitle = `Delete ${fieldType}`
        this.modalbutton = 'Delete'
        this.postType = 'Delete'
        this.http_index = 3
      }
    },
    // hide modal
    hideModal() {
      this.$refs.modal.hide()
    },
    addProject() {
      // axios http api request
      const formData = new FormData()

      // set paramater data
      formData.append('docs', this.fieldType)
      formData.append('g_id', this.$route.params.id)
      formData.append('n_id', this.n_id)
      formData.append('s_id', this.s_id)
      formData.append('title', this.title)

      if (this.fieldType === 'Sensor') {
        formData.append('sensor_type', this.desc)
      }

      if (this.fieldType === 'Node') {
        formData.append('description', this.desc)
      }

      const http = axios.post(`${httpApi}${this.$route.meta.http_url[this.http_index]}`, formData, {
        headers: {
          'Content-Type': 'multipart/form-data',
        },
      })

      // set axios response to api storage
      http.then(response => {
        this.api = response.data
      })

      // complete http request action
      http.finally(() => {
        // if api  give true response
        if (this.api.result === true) {
          // set alert type
          this.alert_type = 0
          // reload page
          window.location.reload()
        }

        // if apigive false result
        if (this.api.result === false) {
          // set alert type
          this.alert_type = 1
        }

        // set alert message
        this.alertmsg = this.api.msg
      })
    },
  },
}
</script>

<style lang="scss">
@import '@core/scss/vue/libs/vue-select.scss';
</style>
