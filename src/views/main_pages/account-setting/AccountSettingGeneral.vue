<!-- eslint-disable -->
<template>
  <b-card>

    <!-- upload photo -->
    <b-media no-body>

      <!-- photo preview -->
      <b-media-aside>
        <b-link>
          <b-img
            v-if="photo !== false | userdata.photo.length > 1"
            :src="photo === false ? (userdata.photo.length > 1 ? require(`@/assets/images/photo/${userdata.photo}`) : null) : photo"
            height="80" width="80" style="border-radius:100%"
          />
          <span
            v-if="photo === false & userdata.photo.length < 1"
            class="b-avatar badge-minimal badge-light-primary rounded-circle"
            style="width:80px;height:80px;"
          >
            <feather-icon icon="UserIcon" size="50" />
          </span>
        </b-link>
      </b-media-aside>
      <!-- /photo preview -->

      <!-- button -->
      <b-media-body class="mt-75 ml-75">

        <!-- upload -->
        <b-button variant="primary" size="sm" class="mb-75 mr-75" @click="$refs.refInputEl.$el.click()" >
          Upload
        </b-button>
        <b-form-file ref="refInputEl" accept=".jpg, .png, .gif" :hidden="true" plain @change="onFileChange" />
        <!-- /upload -->

        <!-- reset -->
        <b-button variant="outline-secondary" size="sm" class="mb-75 mr-75" @click="resetPhoto" >
          Reset
        </b-button>
        <!-- /reset -->
        <b-card-text>Allowed JPG, GIF or PNG. Max size of 800kB</b-card-text>
      </b-media-body>
      <!-- /button -->

    </b-media>
    <!-- /upload photo -->

    <!-- form -->
    <b-form lass="mt-2" >
      <b-row>
        <!-- input username -->
        <b-col sm="6">
          <b-form-group label="Username" label-for="account-username" >
            <b-form-input v-model="username" placeholder="Username" name="username" />
          </b-form-group>
        </b-col>
        <!-- input name -->
        <b-col sm="6">
          <b-form-group label="Name" label-for="account-name" >
            <b-form-input v-model="fullname" name="name" placeholder="Name" />
          </b-form-group>
        </b-col>
        <!-- input email -->
        <b-col sm="6">
          <b-form-group label="E-mail" label-for="account-e-mail" >
            <b-form-input v-model="email" name="email" placeholder="Email" />
          </b-form-group>
        </b-col>
        <!-- input mobile number -->
        <b-col sm="6">
          <b-form-group label="Mobile" label-for="account-mobile" >
            <b-form-input v-model="mobile" name="mobile" placeholder="Number" />
          </b-form-group>
        </b-col>

        <!-- button -->
        <b-col cols="12">
          <!-- alert box -->
          <b-alert v-if="alert_type > 0" :variant="alert_type > 1 ? 'info' : 'warning'" show >
            <h4 class="alert-heading"> {{ alertmsg }} </h4>
          </b-alert>
          <!-- /alert box -->

          <!-- save change button -->
          <b-button variant="primary" class="mt-2 mr-1" @click="saveChanges" >
            Save changes
          </b-button>
          <!-- reset form button -->
          <b-button variant="outline-secondary" type="reset" class="mt-2" @click.prevent="resetForm" >
            Reset
          </b-button>
        </b-col>
        <!-- /button -->

      </b-row>
    </b-form>
    <!-- form -->

  </b-card>
</template>

<script>
// load bootstrap vue
import {
  BFormFile,
  BButton,
  BForm,
  BFormGroup,
  BFormInput,
  BRow,
  BCol,
  BCard,
  BCardText,
  BMedia,
  BMediaAside,
  BMediaBody,
  BLink,
  BImg,
  BAlert,
} from 'bootstrap-vue'

import Ripple from 'vue-ripple-directive'

// import axios
import axios from 'axios'
import httpApi from '@/main'

export default {
  components: {
    BButton,
    BForm,
    BImg,
    BFormFile,
    BFormGroup,
    BFormInput,
    BRow,
    BCol,
    BCard,
    BCardText,
    BMedia,
    BMediaAside,
    BMediaBody,
    BLink,
    BAlert,
  },
  directives: {
    Ripple,
  },
  data() {
    return {
      // user session storage
      userdata: JSON.parse(sessionStorage.getItem('user_data')),

      // alert configuration storage
      alertmsg: '',
      alert_type: 0,

      // api storage
      api: [],

      // input field storage
      photo: false,
      file: null,
      profileFile: '',
      mobile: '',
      email: '',
      username: '',
      fullname: '',
    }
  },
  created() {
    // set default data from user session storage to field storage
    this.username = this.userdata.username
    this.mobile = this.userdata.mobile
    this.fullname = this.userdata.fullname
    this.email = this.userdata.email
  },
  methods: {
    // reset input field storage to default value
    resetForm() {
      this.username = this.userdata.username
      this.mobile = this.userdata.mobile
      this.fullname = this.userdata.fullname
      this.email = this.userdata.email
    },
    // read image upload action
    onFileChange(e) {
      const file = e.target.files[0]
      const { files } = e.target
      this.file = files
      this.photo = URL.createObjectURL(file)
    },
    // reset photo preview
    resetPhoto() {
      this.photo = false
    },
    // Axios Http Api Request
    // save account setting
    saveChanges() {
      const formData = new FormData()

      // set tmp data upload
      if (this.file !== null) {
        formData.append('photo', this.file[0])
      }

      // set paramater data
      formData.append('email', this.email)
      formData.append('user', this.username)
      formData.append('name', this.fullname)
      formData.append('mobile', this.mobile)
      formData.append('id', this.userdata.id)

      const http = axios.post(`${httpApi}${this.$route.meta.http_url[0]}`, formData, {
        headers: {
          'Content-Type': 'multipart/form-data',
        },
      })

      // set Axios Response to Api storage
      http.then(response => {
        this.api = response.data
      })

      // complete Axios Http Api Request
      http.finally(() => {
        // if api give true response
        if (this.api.result === true) {
          // renew session storage
          sessionStorage.setItem('user_data', JSON.stringify(this.api.object))
          // reload page
          window.location.reload()
          // set alert type
          this.alert_type = 2
        }

        // if api give false response
        if (this.api.result === false) {
          // set alert type
          this.alert_type = 1
        }

        // set alert text
        this.alertmsg = this.api.msg
      })
    },
  },
}
</script>
