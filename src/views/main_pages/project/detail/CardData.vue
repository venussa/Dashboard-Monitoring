<!-- eslint-disable -->
<template>
  <b-row>
    <!-- loop cath list project -->
    <b-col :v-if="showProject.length > 0" v-for="item in showProject" v-bind:key="item.title" lg="3" >
      <b-card class="node-project">
        <b-button :to="{ name: 'project-group', params: { id: item.id }}" variant="flat-secondary card-link">
          <!-- card heading -->
          <p class="card-title">{{ item.title }}</p>
          <p class="card-desc">{{ item.description }}</p>
          <b-dropdown id="dropdown-1" variant="link-secondary" class="more-icon" >
            <template #button-content>
              <feather-icon icon="MoreHorizontalIcon" size="20" />
            </template>
            <b-dropdown-item v-b-modal.modal-1 @click="modal_type(2, item.id, item.title, item.description)" >
              Edit
            </b-dropdown-item>
            <b-dropdown-item v-b-modal.modal-1 @click="modal_type(3, item.id, item.title)" >
              Delete
            </b-dropdown-item>
          </b-dropdown>
          <!-- /card heading -->

          <!-- group -->
          <b-col cols="12" style="position: relative;padding-bottom:10px;" >
            <b-row>
              <div class="icon">
                <div class="b-avatar badge-light-info rounded-square">
                  <feather-icon icon="CloudIcon" />
                </div>
              </div>
              <div class="title">Nodes</div>
              <div class="value">
                <b-button variant="flat-info" >{{ item.node }}</b-button>
              </div>
            </b-row>
          </b-col>

          <!-- group -->
          <b-col cols="12" style="position: relative;padding-bottom:10px;" >
            <b-row>
              <div class="icon">
                <div class="b-avatar badge-light-danger rounded-square">
                  <feather-icon icon="CpuIcon" />
                </div>
              </div>
              <div class="title">Sensor</div>
              <div class="value">
                <b-button variant="flat-danger" >{{ item.sensor }}</b-button>
              </div>
            </b-row>
          </b-col>
        </b-button>
      </b-card>
    </b-col>
    <!-- /loop cath list project -->

    <!-- add new group button -->
    <b-col lg="3">
      <b-card v-b-modal.modal-1 bg-variant="primary" text-variant="white" class="text-center node-project" @click="modal_type(1, 'None')">
        <p style="font-weight:600; font-size:25px;margin-bottom:45px;">New Group</p>
        <feather-icon icon="PlusIcon" size="100" />
        <p style="margin-top:55px"/>
      </b-card>
    </b-col>
    <!-- /add new group button -->

    <!-- modal -->
    <b-modal id="modal-1" ref="modal" :title="modalTitle" :hide-footer="true" >
      <!-- input field -->
      <b-card-text v-if="modaltype === 1 | modaltype === 2">
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
        <p style="font-weight:600;margin-top:10px;">Title</p>
        <b-form-input v-model="title" placeholder="Name ..." />
        <p style="font-weight:600;margin-top:10px;">Description</p>
        <b-form-textarea v-model="desc" id="textarea-rows" placeholder="Detail ..." rows="4" />

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
        <b-button variant="outline-secondary" @click="hideModal" >Cancel</b-button>
        <b-button variant="primary" style="margin-left:10px" @click="addProject" >{{ modalbutton }}</b-button>
      </div>
      <!-- /modal footer -->

    </b-modal>
    <!-- /modal -->

  </b-row>
</template>

<script>
// load bootstrap vue
import {
  BRow,
  BCol,
  BCard,
  BButton,
  VBModal,
  BFormInput,
  BFormTextarea,
  BCardText,
  BAlert,
  BDropdown,
  BDropdownItem,
} from 'bootstrap-vue'

// load axios
import axios from 'axios'
import httpApi from '@/main'

import Ripple from 'vue-ripple-directive'

export default {
  components: {
    BRow,
    BCol,
    BCard,
    BButton,
    BFormInput,
    BFormTextarea,
    BCardText,
    BAlert,
    BDropdown,
    BDropdownItem,
  },
  directives: {
    'b-modal': VBModal,
    Ripple,
  },
  props: {
    // catch project list data from project storage
    showProject: {
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
      http_index: 0,

      // input field storage
      title: '',
      desc: '',
      g_id: '',
    }
  },
  methods: {
    // switch modal
    modal_type(postType, id, title = '', description = '') {
      this.modaltype = postType
      this.alert_type = 0
      this.title = title
      this.desc = description
      this.g_id = id

      if (postType === 1) {
        this.modalTitle = 'Add Group'
        this.modalbutton = 'Save'
        this.http_index = 1
      } else if (postType === 2) {
        this.modalTitle = 'Edit Group'
        this.modalbutton = 'Save Changes'
        this.http_index = 2
      } else if (postType === 3) {
        this.modalTitle = 'Delete Group'
        this.modalbutton = 'Delete'
        this.http_index = 3
      }
    },
    // hide modal
    hideModal() {
      this.$refs.modal.hide()
    },
    addProject() {
      // Axios Http Api Request
      const formData = new FormData()

      // set parmaater data
      formData.append('p_id', this.$route.params.id)
      formData.append('g_id', this.g_id)
      formData.append('title', this.title)
      formData.append('description', this.desc)

      const http = axios.post(`${httpApi}${this.$route.meta.http_url[this.http_index]}`, formData, {
        headers: {
          'Content-Type': 'multipart/form-data',
        },
      })

      // set axios response to api storage
      http.then(response => {
        this.api = response.data
      })

      // complete axios http api request
      http.finally(() => {
        // if api give true response
        if (this.api.result === true) {
          // set alert type
          this.alert_type = 0
          // hide modal
          window.location.reload()
        }

        // if api five false response
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
