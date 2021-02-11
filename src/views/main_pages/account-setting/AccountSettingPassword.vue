<!-- eslint-disable -->
<template>
  <b-card>

    <!-- form -->
    <b-form>

      <!-- old password -->
      <b-row>
        <b-col md="6">
          <b-form-group label="Old Password" label-for="account-old-password" >
            <b-input-group class="input-group-merge">
              <b-form-input id="account-old-password" v-model="old_password" name="old-password" :type="passwordFieldTypeOld" placeholder="Old Password" />
              <b-input-group-append is-text>
                <feather-icon :icon="passwordToggleIconOld" class="cursor-pointer" @click="togglePasswordOld" />
              </b-input-group-append>
            </b-input-group>
          </b-form-group>
        </b-col>
      </b-row>
      <!--/ old password -->

      <b-row>
        <!-- new password -->
        <b-col md="6">
          <b-form-group label-for="account-new-password" label="New Password" >
            <b-input-group class="input-group-merge">
              <b-form-input id="account-new-password" v-model="new_password" :type="passwordFieldTypeNew" name="new-password" placeholder="New Password" />
              <b-input-group-append is-text>
                <feather-icon :icon="passwordToggleIconNew" class="cursor-pointer" @click="togglePasswordNew" />
              </b-input-group-append>
            </b-input-group>
          </b-form-group>
        </b-col>
        <!--/ new password -->

        <!-- retype password -->
        <b-col md="6">
          <b-form-group label-for="account-retype-new-password" label="Retype New Password" >
            <b-input-group class="input-group-merge">
              <b-form-input id="account-retype-new-password" v-model="retype_new_password" :type="passwordFieldTypeRetype" name="retype-password" placeholder="New Password" />
              <b-input-group-append is-text>
                <feather-icon :icon="passwordToggleIconRetype" class="cursor-pointer" @click="togglePasswordRetype" />
              </b-input-group-append>
            </b-input-group>
          </b-form-group>
        </b-col>
        <!--/ retype password -->

        <!-- buttons -->
        <b-col cols="12">

          <!-- alert box -->
          <b-alert v-if="alert_type > 0" :variant="alert_type > 1 ? 'info' : 'warning'" show >
            <h4 class="alert-heading"> {{ alertmsg }} </h4>
          </b-alert>
          <!-- /alert box -->

          <!-- save changes button -->
          <b-button variant="primary" class="mt-1 mr-1" @click="resetPassword" >
            Save changes
          </b-button>
          <!-- reset button -->
          <b-button type="reset" variant="outline-secondary" class="mt-1" >
            Cancel
          </b-button>
        </b-col>
        <!--/ buttons -->

      </b-row>
    </b-form>
    <!-- /form -->

  </b-card>
</template>

<script>
// load bootstrap vue
import {
  BButton,
  BForm,
  BFormGroup,
  BFormInput,
  BRow, BCol,
  BCard,
  BInputGroup,
  BInputGroupAppend,
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
    BFormGroup,
    BFormInput,
    BRow,
    BCol,
    BCard,
    BInputGroup,
    BInputGroupAppend,
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
      alert_type: 0,
      alertmsg: '',

      // api storage
      api: [],

      // input field storage
      old_password: '',
      new_password: '',
      retype_new_password: '',

      // default input field type
      passwordFieldTypeOld: 'password',
      passwordFieldTypeNew: 'password',
      passwordFieldTypeRetype: 'password',
    }
  },
  // calculated password string
  computed: {
    passwordToggleIconOld() {
      return this.passwordFieldTypeOld === 'password' ? 'EyeIcon' : 'EyeOffIcon'
    },
    passwordToggleIconNew() {
      return this.passwordFieldTypeNew === 'password' ? 'EyeIcon' : 'EyeOffIcon'
    },
    passwordToggleIconRetype() {
      return this.passwordFieldTypeRetype === 'password' ? 'EyeIcon' : 'EyeOffIcon'
    },
  },
  methods: {
    // change type attribute betwen text or password
    togglePasswordOld() {
      this.passwordFieldTypeOld = this.passwordFieldTypeOld === 'password' ? 'text' : 'password'
    },
    togglePasswordNew() {
      this.passwordFieldTypeNew = this.passwordFieldTypeNew === 'password' ? 'text' : 'password'
    },
    togglePasswordRetype() {
      this.passwordFieldTypeRetype = this.passwordFieldTypeRetype === 'password' ? 'text' : 'password'
    },

    // Axios Http Api Request
    // Save password changes
    resetPassword() {
      const formData = new FormData()

      // set paramater data
      formData.append('old-password', this.old_password)
      formData.append('new-password', this.new_password)
      formData.append('retype-new-password', this.retype_new_password)
      formData.append('id', this.userdata.id)

      const http = axios.post(`${httpApi}${this.$route.meta.http_url[0]}`, formData, {
        headers: {
          'Content-Type': 'multipart/form-data',
        },
      })

      // set axios response to api storage
      http.then(response => {
        this.api = response.data
      })

      // complete Axios http api request
      http.finally(() => {
        // if api give true response
        if (this.api.result === true) {
          // reaload page
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
