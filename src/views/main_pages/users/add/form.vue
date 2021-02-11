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
              <b-form-input id="fullname" v-model="fullname" placeholder="full name" />
            </b-col>
          </b-row>
        </b-col>

        <!-- Field: Username -->
        <b-col cols="12" md="12" class="field-data" >
          <b-row>
            <b-col md="3" lg="3" >Username</b-col>
            <b-col md="9" lg="9" >
              <b-form-input id="username" v-model="username" placeholder="Username" />
            </b-col>
          </b-row>
        </b-col>

        <!-- Field: Email -->
        <b-col cols="12" md="12" class="field-data" >
          <b-row>
            <b-col md="3" lg="3" >Email</b-col>
            <b-col md="9" lg="9" >
              <b-form-input id="email" v-model="email" placeholder="Email" />
            </b-col>
          </b-row>
        </b-col>

        <!-- Field: Mobile -->
        <b-col cols="12" md="12" class="field-data" >
          <b-row>
            <b-col md="3" lg="3" >Mobile</b-col>
            <b-col md="9" lg="9" >
              <b-form-input id="mobile" v-model="mobile" placeholder="Number" />
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
              <b-form-checkbox v-model="role" value="User" :style="{display:'inline-block', marginRight:'20px'}" >
                User
              </b-form-checkbox>
              <b-form-checkbox v-model="role" value="Admin" :style="{display:'inline-block', marginRight:'20px'}" >
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
    <b-button variant="primary" class="mb-1 mb-sm-0 mr-0 mr-sm-1" type="submit" :block="$store.getters['app/currentBreakPoint'] === 'xs'" @click="addUser" >
      Add User
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
  data() {
    return {
      // input field storage
      fullname: '',
      username: '',
      email: '',
      mobile: '',
      password: '',
      role: '',
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
    // Axios http api request
    // add userr action methods
    addUser() {
      const formData = new FormData()

      // set paramater data
      formData.append('fullname', this.fullname)
      formData.append('username', this.username)
      formData.append('email', this.email)
      formData.append('mobile', this.mobile)
      formData.append('password', this.password)
      formData.append('role', this.role)

      if (this.photo !== null) {
        formData.append('photo', this.photo[0])
      }

      const http = axios.post(`${httpApi}${this.$route.meta.http_url[0]}`, formData, {
        headers: {
          'Content-Type': 'multipart/form-data',
        },
      })

      // set api response to api variable
      http.then(response => {
        this.api = response.data
      })

      // complete axios http request
      http.finally(() => {
        // if api give true result
        if (this.api.result === true) {
          // set alert type
          this.alert_type = 2
          // redirect to user management page
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
