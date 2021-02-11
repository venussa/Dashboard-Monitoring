<!-- eslint-disable -->
<template>
<div>

  <!-- breadcrumb -->
  <h1 class="page-heading">Project Management</h1>
  <p class="page-nav">
    <feather-icon size="16" icon="HomeIcon" color="#0d80ce" />
    <span class="page-delimiter">
      <feather-icon size="1x" icon="ChevronRightIcon" />
    </span>
    <span class="page-title">Project</span>
  </p>
  <!-- /breadcrumb -->


    <b-card class="col-lg-10">
      <p v-if="api.result === false" style="padding:10px;text-align: center">Data Not Found</p>
      <div v-for="data in items.project" :key="data.title"
      >
      <div style="margin-bottom:15px">
        <!-- toggle button 1 -->
        <span style="font-weight: 600; font-size:16px;">
          <div class="b-avatar rounded-square badge-light-secondary" style="width: 15px;height:15px;">
            <feather-icon icon="PlusIcon" v-b-toggle="`collapse-${data.id}`" />
          </div>
          <b-link class="btn-flat-secondary" :to="{ name: 'project-detail', params: { id: data.id }}" style="margin-left:20px">
            <feather-icon size="16" icon="MonitorIcon" />
            {{ data.title }}
          </b-link>
        </span>
        <!-- /toggle button 1 -->
        
        <!-- toggle button 1 trigger -->
        <b-collapse :id="`collapse-${data.id}`" class="mt-2" style="margin-left:20px;margin-top: 10px !important">
          <div v-for="data1 in data.group" :key="data1.title">
          <div style="margin-bottom:15px">
          <!-- toggle button 2 -->
          <span style="font-weight: 600; font-size:16px;">
           <div class="b-avatar rounded-square badge-light-secondary" style="width: 15px;height:15px;">
             <feather-icon icon="PlusIcon"  v-b-toggle="`collapse-${data1.id}-inner`" />
           </div>
           <b-link class="btn-flat-secondary" :to="{ name: 'project-group', params: { id: data1.id }}" style="margin-left:20px">
             <feather-icon size="16" icon="ArchiveIcon" />
             {{ data1.title }}
           </b-link>
          </span>
          <!-- /toggle button 2 -->

          <!-- toggle button 2 trigger -->
          <b-collapse :id="`collapse-${data1.id}-inner`" class="mt-2" style="margin-left:20px; margin-top: 10px !important" >
            <div v-for="data2 in data1.node" :key="data2.title">
            <div style="margin-bottom:15px">
            <!-- toggle button 3 -->
            <span style="font-weight: 600; font-size:16px;">
              <div class="b-avatar rounded-square badge-light-secondary" style="width: 15px;height:15px;">
                <feather-icon icon="PlusIcon" v-b-toggle="`collapse-${data2.id}-inner-inner`" />
              </div>
              <b-link class="btn-flat-secondary" :to="{ name: 'project-group', params: { id: data1.id }}" style="margin-left:20px">
                <feather-icon size="16" icon="CloudIcon" />
                  {{ data2.title }}
              </b-link>
            </span>
            <!-- /toggle button 3 -->

            <!-- toggle button 3 trigger -->
            <b-collapse :id="`collapse-${data2.id}-inner-inner`" class="mt-2" >

              <span v-for="data3 in data2.sensor" :key="data3.title">
              <b-button
                :to="{ name: 'project-sensor', params: { id: data3.id }}"
                :variant="data3.status === true ? 'outline-info' : 'outline-danger'"
                style="position: relative;margin-right: 10px;"
              >
                <span
                  :class="data3.status === true ? 'alert alert-info' : 'alert alert-danger'"
                  style="padding:11px;position: absolute; left:0px;top:0px;border-radius:0px"
                >
                  <feather-icon icon="CheckCircleIcon" />
                </span>
                <span style="margin-left:20px;position: relative; top:-7px">{{ data3.title }}</span>
                <span style="margin-left:20px;position:absolute; right:5px;bottom:2px;font-size:10px;">{{ data3.value }}</span>
              </b-button>
              </span>

              <b-button variant="outline-primary" v-b-modal.modal-1 @click="switchModal(2, 'New Sensor', 'Sensor', data2.id)">
                <feather-icon icon="PlusIcon" />
                Add Sensor
              </b-button>
            </b-collapse>
            <!-- /toggle button 3 trigger -->
            </div>
            </div>

            <!-- add project -->
            <div style="margin-top:20px;font-weight:600">
              <b-link variant="falt-info" v-b-modal.modal-1 @click="switchModal(1, 'New Node', 'Node', data1.id)">
              <feather-icon icon="PlusIcon" />
                Add New Node
              </b-link>
            </div>
            <!-- /add project -->

          </b-collapse>
          <!-- /toggle button 2 trigger -->
          </div>
          </div>

          <!-- add group -->
          <div style="margin-top:20px;font-weight:600">
            <b-link variant="falt-info" v-b-modal.modal-1 @click="switchModal(1, 'New Group', 'Group', data.id)">
              <feather-icon icon="PlusIcon" />
              Add New Group
            </b-link>
          </div>
          <!-- /add group -->

        </b-collapse>
        <!-- /toggle button 1 trigger -->
      </div>
      </div>
      <!-- add project -->
      <div style="margin-top:20px;font-weight:600">
        <b-link variant="falt-info" v-b-modal.modal-1 @click="switchModal(1, 'New Project', 'Project', 'None')">
        <feather-icon icon="PlusIcon" />
          Add New Project
        </b-link>
      </div>
      <!-- /add project -->
    </b-card>

    <!-- modal -->
    <b-modal id="modal-1" ref="modal" :title="modalTitle" :hide-footer="true" >
      <!-- input field -->
      <b-card-text>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
        <p style="font-weight:600;margin-top:10px;">Title</p>
        <b-form-input v-model="title" placeholder="Name ..." />

        <span v-if="modaltype === 1">
          <p style="font-weight:600;margin-top:10px;">Description</p>
          <b-form-textarea v-model="desc" id="textarea-rows" placeholder="Detail ..." rows="4" />
        </span>

        <span v-if="modaltype === 2">
          <p style="font-weight:600;margin-top:10px;">Sensor Type</p>
            <v-select v-model="desc" :options="option_perpage" :components="{ Deselect, OpenIndicator }" >
              <slot name="no-options">Sorry, no matching options.</slot>
            </v-select>
        </span>

        <!-- alert box -->
        <b-alert v-if="alert_type > 0" :variant="alert_type > 1 ? 'info' : 'warning'" show style="margin-top:10px" >
          <h4 class="alert-heading">{{ alertmsg }}</h4>
        </b-alert>
        <!-- /alert box -->
      </b-card-text>
      <!-- /input field -->

      <!-- modal footer -->
      <div style="padding-top:30px;text-align:right;">
        <b-button variant="outline-secondary" @click="hideModal" >Cancel</b-button>
        <b-button variant="primary" style="margin-left:10px" @click="saveData" > Save </b-button>
      </div>
      <!-- /modal footer -->

    </b-modal>
    <!-- /modal -->

</div>
</template>

<script>
// load vue select
import vSelect from 'vue-select'

// load bootstrap vue
import {
  BCard,
  VBToggle,
  BCollapse,
  BButton,
  BLink,
  VBModal,
  BFormInput,
  BFormTextarea,
  BCardText,
} from 'bootstrap-vue'

import Ripple from 'vue-ripple-directive'

// load axios
import axios from 'axios'
import httpApi from '@/main'

export default {
  components: {
    BCard,
    BCollapse,
    BButton,
    BLink,
    BFormInput,
    BFormTextarea,
    BCardText,
    vSelect,
  },
  directives: {
    'b-toggle': VBToggle,
    'b-modal': VBModal,
    Ripple,
  },
  data() {
    return {
      // set api storage
      api: [],
      items: [],

      // modal configuration storage
      modaltype: 0,
      modalTitle: '',
      title: '',
      desc: '',
      fieldType: '',
      http_index: '',
      id: '',

      // sensor type option
      option_perpage: ['Float', 'Integer', 'Boolean', 'String'],
      Deselect: {
        render: createElement => createElement('span', ''),
      },
      OpenIndicator: {
        render: createElement => createElement('span', { class: 'dropdown-icon' }),
      },

      // alert configuration storage
      alert_type: 0,
      alertmsg: '',
    }
  },
  created() {
    this.loadPage()
    // set document title
    document.title = this.$route.meta.title
  },
  methods: {
    // hide modal
    hideModal() {
      this.$refs.modal.hide()
    },
    // switch modal
    switchModal(postType, modalTitle, fieldType, id) {
      this.modaltype = postType
      this.modalTitle = modalTitle
      this.fieldType = fieldType
      this.id = id

      if (fieldType === 'Project') {
        this.http_index = 1
      } else if (fieldType === 'Group') {
        this.http_index = 2
      } else if (fieldType === 'Node') {
        this.http_index = 3
      } else if (fieldType === 'Sensor') {
        this.http_index = 4
      }
    },
    // axios http api request
    // load page action methods
    loadPage() {
      const formData = new FormData()

      // set parmater data
      // formData.append('name', 'value')

      const http = axios.post(`${httpApi}${this.$route.meta.http_url[0]}`, formData, {
        headers: {
          'Content-Type': 'multipart/form-data',
        },
      })

      // set axios result to session storage
      http.then(response => {
        this.api = response.data
      })

      // complete axios http api request
      http.finally(() => {
        // if api give true response
        if (this.api.result === true) {
          // set axios result to user data storage
          this.items = this.api.object
        }

        // if api give false response
        if (this.api.result === false) {
          this.items = []
        }
      })
    },
    // axios http api request
    // save data action methods
    saveData() {
      const formData = new FormData()

      // set parmater data
      formData.append('id', this.id)
      formData.append('docs', this.fieldType)
      formData.append('title', this.title)

      if (this.fieldType === 'Sensor') {
        formData.append('sensor_type', this.desc)
      } else {
        formData.append('description', this.desc)
      }

      const http = axios.post(`${httpApi}${this.$route.meta.http_url[this.http_index]}`, formData, {
        headers: {
          'Content-Type': 'multipart/form-data',
        },
      })

      // set axios result to session storage
      http.then(response => {
        this.api = response.data
      })

      // complete axios http api request
      http.finally(() => {
        // if api give true response
        if (this.api.result === true) {
          // reload page
          window.location.reload()
        }

        // if api give false response
        if (this.api.result === false) {
          this.items = []
        }
      })
    },
  },
}
</script>

<style lang="scss">
@import '@core/scss/vue/libs/vue-select.scss';
</style>
