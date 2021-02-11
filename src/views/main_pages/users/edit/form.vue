<!-- eslint-disable -->
<template>
  <div>

    <!-- User Info: Input Fields -->
    <b-form>
      <b-row>

        <!-- Field: Name -->
        <b-col cols="12" md="12" class="field-data" >
          <b-row>
            <b-col md="3" lg="3" >Name</b-col>
            <b-col md="9" lg="9" >
              <b-form-input id="fullname" v-model="userData.fullname" placeholder="full name" />
            </b-col>
          </b-row>
        </b-col>

        <!-- Field: Username -->
        <b-col cols="12" md="12" class="field-data" >
          <b-row>
            <b-col md="3" lg="3" >Username</b-col>
            <b-col md="9" lg="9" >
              <b-form-input id="username" v-model="userData.username" placeholder="Username" />
            </b-col>
          </b-row>
        </b-col>

        <!-- Field: Email -->
        <b-col cols="12" md="12" class="field-data" >
          <b-row>
            <b-col md="3" lg="3" >Email</b-col>
            <b-col md="9" lg="9" >
              <b-form-input id="email" v-model="userData.email" placeholder="Email" />
            </b-col>
          </b-row>
        </b-col>

        <!-- Field: Mobile -->
        <b-col cols="12" md="12" class="field-data" >
          <b-row>
            <b-col md="3" lg="3" >Mobile</b-col>
            <b-col md="9" lg="9" >
              <b-form-input id="mobile" v-model="userData.mobile" placeholder="Number" />
            </b-col>
          </b-row>
        </b-col>

        <!-- Field: Password -->
        <b-col cols="12" md="12" class="field-data" >
          <b-row>
            <b-col md="3" lg="3" >Password</b-col>
            <b-col md="9" lg="9"  >
              <b-form-input id="password" v-model="password" type="password" placeholder="Password" />
            </b-col>
          </b-row>
        </b-col>

        <!-- Field: Role User -->
        <b-col cols="12" md="12" class="field-data" >
          <b-row>
            <b-col md="3" lg="3" >Role</b-col>
            <b-col md="9" lg="9" >
              <b-form-checkbox v-model="userData.role" value="User" :style="{display:'inline-block', marginRight:'20px'}" >
                User
              </b-form-checkbox>
              <b-form-checkbox v-model="userData.role" value="Admin" :style="{display:'inline-block', marginRight:'20px'}" >
                Admin
              </b-form-checkbox>
            </b-col>
          </b-row>
        </b-col>

        <!-- Field: Upload Photo -->
        <b-col cols="12" md="12" class="field-data" >
          <b-row>
            <b-col md="3" lg="3" >Photo Profile</b-col>
            <b-col md="9" lg="9" >
              <b-form-file placeholder="Choose a file or drop it here..." drop-placeholder="Drop file here..." @change="onFileChange" />
            </b-col>
          </b-row>
        </b-col>

      </b-row>
    </b-form>

    <!-- alert box -->
    <b-alert v-if="alert_type > 0" :variant="alert_type > 1 ? 'info' : 'warning'" show >
      <h4 class="alert-heading">{{ alertmsg }}</h4>
    </b-alert>
    <!-- /alert box -->

    <!-- Action Buttons -->
    <b-button variant="primary" class="mb-1 mb-sm-0 mr-0 mr-sm-1" :block="$store.getters['app/currentBreakPoint'] === 'xs'" @click="editUser" >
      Save Changes
    </b-button>
    <b-link class="btn btn-outline-secondary" variant="outline-secondary" :to="{name: 'user'}" :block="$store.getters['app/currentBreakPoint'] === 'xs'" >
      Cancel
    </b-link>
    <!-- /Action Buttons -->

  </div>
</template>

<script>
// load bootstrap vue
import {
  BLink,
  BButton,
  BRow,
  BCol,
  BFormInput,
  BForm,
  BFormFile,
  BFormCheckbox,
  BAlert,
} from 'bootstrap-vue'

// load axios
import axios from 'axios'
import httpApi from '@/main'

export default {
  components: {
    BLink,
    BButton,
    BRow,
    BCol,
    BFormInput,
    BForm,
    BFormFile,
    BFormCheckbox,
    BAlert,
  },
  // catch data from user session storage
  props: {
    userData: {
      type: Object,
      required: true,
    },
  },
  data() {
    return {
      // password storage
      password: '',
      photo: null,

      // alert configuration storage
      alertmsg: '',
      alert_type: 0,

      // api storage
      api: [],
    }
  },
  methods: {
    // upload trigger
    onFileChange(e) {
      const { files } = e.target
      this.photo = files
    },
    // axios http api request
    // edit user action methods
    editUser() {
      const formData = new FormData()

      // set parmaater data
      formData.append('fullname', this.userData.fullname)
      formData.append('username', this.userData.username)
      formData.append('email', this.userData.email)
      formData.append('mobile', this.userData.mobile)
      formData.append('password', this.password)
      formData.append('role', this.userData.role)
      formData.append('id', this.userData.id)

      if (this.photo !== null) {
        formData.append('photo', this.photo[0])
      }

      const http = axios.post(`${httpApi}${this.$route.meta.http_url[1]}`, formData, {
        headers: {
          'Content-Type': 'multipart/form-data',
        },
      })

      // set axios response to api storage
      http.then(response => {
        this.api = response.data
      })

      // complete axios http request
      http.finally(() => {
        // if api give true response
        if (this.api.result === true) {
          // set alert type
          this.alert_type = 2
          // renew user session storage if edit self data
          const myData = JSON.parse(sessionStorage.getItem('user_data'))
          if (myData.id === this.userData.id) {
            sessionStorage.setItem('user_data', JSON.stringify(this.api.object))
          }
          // reload page
          setTimeout(() => this.$router.push(this.$route.query.redirect || { name: 'user' }), 1000)
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
