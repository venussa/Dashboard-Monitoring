<!-- eslint-disable -->
<template>
  <div class="auth-wrapper auth-v2">
    <div class="row auth-inner m-0">

      <!-- Login-->
      <div class="col-lg-12" />
      <div class="px-2 p-lg-5 offset-lg-4 col-lg-4 log-box">
        <span class="top-bg-decoration d-none d-lg-block" />
        <div class="px-xl-2 mx-auto auth-bg col-sm-8 col-md-6 col-lg-12">

          <div class="synapsis-logo col-lg-12">
            <img :src="require('@/assets/images/logo/logo.png')">
          </div>

          <p class="mb-2 font-weight-bold welcome-msg">
           Forgot Password
          </p>

          <p class="note">
            Please enter the email registered to our system.
          </p>

          <!-- alert box -->
          <b-alert v-if="alert_type > 0" :variant="alert_type > 1 ? 'info' : 'warning'" show >
            <h4 class="alert-heading"> {{ alertmsg }} </h4>
          </b-alert>
          <!-- /alert box -->

          <!-- form -->
          <validation-observer ref="loginForm" #default="{invalid}" >
            <b-form class="auth-login-form mt-2" @submit.prevent="login" >

              <!-- email -->
              <b-form-group label="Email" label-for="login-email" >
                <validation-provider #default="{ errors }" name="Email" vid="email" rules="required|email" >
                  <b-form-input id="login-email" v-model="email" :state="errors.length > 0 ? false:null" name="login-email" placeholder="username@example.com" />
                  <small class="text-danger">{{ errors[0] }}</small>
                </validation-provider>
              </b-form-group>
              <!-- /email -->

              <!-- sign in buttons -->
              <b-button type="submit" variant="primary" block :disabled="invalid" >
                Submit Request
              </b-button>
              <!-- /sign in buttons -->

            </b-form>
            <!-- /form -->
          </validation-observer>

          <!-- login footer -->
          <p class="text-center mt-2">
            <span>Remember your password? </span>
            <b-link :to="{name:'auth-login'}">
              <span>&nbsp;Sign in instead</span>
            </b-link>
            <br>
            <br>
            <br>
          </p>
          <!-- /login footer -->

        </div>
        <span class="bottom-bg-decoration d-none d-lg-block" />
      </div>
      <div class="col-lg-12" />
    <!-- /Login-->
    </div>
  </div>
</template>

<script>
// load vue validation
import { ValidationProvider, ValidationObserver } from 'vee-validate'

// load bootstrap vue
import {
  BLink,
  BFormGroup,
  BFormInput,
  BForm,
  BButton,
  BAlert,
} from 'bootstrap-vue'

// set validation rules
import { required, email, password } from '@validations'
import { togglePasswordVisibility } from '@core/mixins/ui/forms'

// load axios
import axios from 'axios'
import httpApi from '@/main'

export default {
  components: {
    BLink,
    BFormGroup,
    BFormInput,
    BForm,
    BButton,
    ValidationProvider,
    ValidationObserver,
    BAlert,
  },
  mixins: [togglePasswordVisibility],
  data() {
    return {
      // alert configuration storage
      alertmsg: '',
      alert_type: 0,

      // api storage
      api: [],

      // input field storage
      required,
      email,
      password,
    }
  },
  // show / hide password icon
  computed: {
    passwordToggleIcon() {
      return this.passwordFieldType === 'password' ? 'EyeIcon' : 'EyeOffIcon'
    },
  },
  created() {
    // set document title
    document.title = this.$route.meta.title
  },
  methods: {
    // Axios http API Request
    // Login action methods
    login() {
      this.$refs.loginForm.validate().then(success => {
        if (success) {
          const formData = new FormData()
          // set paramater data
          formData.append('email', this.email)

          const http = axios.post(`${httpApi}${this.$route.meta.http_url[0]}`, formData, {
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
              // set session strorage
              sessionStorage.setItem('login', true)
              sessionStorage.setItem('user_data', JSON.stringify(this.api.object))
              // set alert type
              this.alert_type = 2
              // redirect to dashboard page
              window.location.reload()
            }

            // if api give false response
            if (this.api.result === false) {
              // set alert type
              this.alert_type = 1
            }

            // set alert text
            this.alertmsg = this.api.msg
          })
        }
      })
    },
  },
}
</script>

<style lang="scss">
@import '@/assets/scss/authpages.scss';
</style>
