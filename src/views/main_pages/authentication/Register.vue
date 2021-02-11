<!-- eslint-disable -->
<template>
  <div class="auth-wrapper auth-v2">
    <div class="row auth-inner m-0">

      <!-- register form -->
      <div class="col-lg-12" />
      <div class="px-2 p-lg-5 offset-lg-4 col-lg-4 log-box">
        <span class="top-bg-decoration d-none d-lg-block" />
        <div class="px-xl-2 mx-auto auth-bg col-sm-8 col-md-6 col-lg-12">

          <div class="synapsis-logo col-lg-12">
            <img :src="require('@/assets/images/logo/logo.png')">
          </div>

          <p class="mb-2 font-weight-bold welcome-msg">Sign-up</p>

          <p class="note">Create your account </p>

          <!-- alert box -->
          <b-alert v-if="alert_type > 0" class="alert" :class="alert_type > 1 ? 'alert-success' : 'alert-warning'" show >
            <h4 class="alert-heading"> {{ alertmsg }} </h4>
          </b-alert>
          <!-- /alert box -->

          <!-- form -->
          <validation-observer ref="registerForm" #default="{invalid}" >
            <b-form class="auth-register-form mt-2" @submit.prevent="register" >

              <!-- username -->
              <b-form-group label="Username" label-for="register-username" >
                <validation-provider #default="{ errors }" name="Username" vid="username" rules="required" >
                  <b-form-input id="register-username" v-model="username" name="register-username" :state="errors.length > 0 ? false:null" placeholder="username" />
                  <small class="text-danger">{{ errors[0] }}</small>
                </validation-provider>
              </b-form-group>
              <!-- /username -->

              <!-- email -->
              <b-form-group label="Email" label-for="register-email" >
                <validation-provider #default="{ errors }" name="Email" vid="email" rules="required|email" >
                  <b-form-input id="register-email" v-model="email" name="register-email" :state="errors.length > 0 ? false:null" placeholder="username@example.com" />
                  <small class="text-danger">{{ errors[0] }}</small>
                </validation-provider>
              </b-form-group>
              <!-- /email -->

              <!-- password -->
              <b-form-group label-for="register-password" label="Password" >
                <validation-provider #default="{ errors }" name="Password" vid="password" rules="required" >
                  <b-input-group class="input-group-merge" :class="errors.length > 0 ? 'is-invalid':null" >
                    <b-form-input id="register-password"
                      v-model="password" class="form-control-merge" :type="passwordFieldType" :state="errors.length > 0 ? false:null" name="register-password" placeholder="············" />
                    <b-input-group-append is-text>
                      <feather-icon :icon="passwordToggleIcon" class="cursor-pointer" @click="togglePasswordVisibility" />
                    </b-input-group-append>
                  </b-input-group>
                  <small class="text-danger">{{ errors[0] }}</small>
                </validation-provider>
              </b-form-group>
              <!-- /password -->

              <!-- checbox -->
              <b-form-group>
                <b-form-checkbox
                  id="register-privacy-policy" v-model="privacy" name="privacy" vid="privacy" :value="true" class="custom-control-primary" >
                  I agree to
                  <b-link>privacy policy & terms</b-link>
                </b-form-checkbox>
              </b-form-group>
              <!-- /checbox -->

              <!-- sign up button -->
              <b-button variant="primary" block type="submit" :disabled="invalid" >
                Sign up
              </b-button>
              <!-- /sign up button -->
            </b-form>
          </validation-observer>
          <!-- /form -->

          <!-- register footer -->
          <p class="text-center mt-2">
            <span>Already have an account? </span>
            <b-link :to="{name:'auth-login'}">
              <span>&nbsp;Sign in instead</span>
            </b-link>
            <br>
          </p>
          <div class="divider my-2">
            <div class="divider-text">
              <b-link>
                Resend Verification
              </b-link>
            </div>
          </div>
          <br>
          <!-- /register footer -->

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
  BButton,
  BForm,
  BFormCheckbox,
  BFormGroup,
  BFormInput,
  BInputGroup,
  BInputGroupAppend,
  BAlert,
} from 'bootstrap-vue'

// load validation rules
import {
  required,
  email,
  password,
} from '@validations'
import { togglePasswordVisibility } from '@core/mixins/ui/forms'

// load axios
import axios from 'axios'
import httpApi from '@/main'

export default {
  components: {
    BLink,
    BButton,
    BForm,
    BFormCheckbox,
    BFormGroup,
    BFormInput,
    BInputGroup,
    BInputGroupAppend,
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
      username: '',
      email,
      password,
      privacy: false,
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
    // register action methods
    register() {
      this.$refs.registerForm.validate().then(success => {
        if (success) {
          const formData = new FormData()

          // set paramater data
          formData.append('email', this.email)
          formData.append('user', this.username)
          formData.append('pass', this.password)
          formData.append('privacy', this.privacy)

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
              // set alert type
              this.alert_type = 2
              // redirect to login page
              setTimeout(() => this.$router.push(this.$route.query.redirect || { name: 'auth-login' }), 1000)
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
/* eslint-disable global-require */
</script>

<style lang="scss">
@import '@/assets/scss/authpages.scss';
</style>
