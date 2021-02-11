<!-- eslint-disable -->
<template>
  <b-col cols="12">

    <!-- breadcrumb -->
    <h1 class="page-heading">Account Setting</h1>
    <p class="page-nav">
      <feather-icon size="16" icon="HomeIcon" color="#0d80ce" />
      <span class="page-delimiter">
        <feather-icon size="1x" icon="ChevronRightIcon" />
      </span> 
      <span class="page-title">Account</span>
      <span class="page-delimiter">
        <feather-icon size="1x" icon="ChevronRightIcon" />
      </span>
      <span class="page-title">Edit</span>
    </p>
    <!-- /breadcrumb -->

    <!-- tab content -->
    <b-tabs vertical content-class="col-12 col-md-9 mt-1 mt-md-0" pills nav-wrapper-class="col-md-3 col-12" nav-class="nav-left">

      <!-- general tab -->
      <b-tab @click="general">
        <template #title>
          <feather-icon icon="UserIcon" size="18" class="mr-50" />
          <span class="font-weight-bold" >General</span>
        </template>
        <account-setting-general v-if="general_page === true" />
      </b-tab>
      <!--/ general tab -->

      <!-- change password tab -->
      <b-tab @click="password">
        <template #title>
          <feather-icon icon="LockIcon" size="18" class="mr-50" />
          <span class="font-weight-bold" >Change Password</span>
        </template>
        <account-setting-password v-if="password_page === true" />
      </b-tab>
      <!--/ change password tab -->
    </b-tabs>
    <!-- /tab content -->

  </b-col>
</template>

<script>
// load bootstrap vue
import { BTabs, BTab, BCol } from 'bootstrap-vue'
// load general setting
import AccountSettingGeneral from './AccountSettingGeneral.vue'
// load password reset
import AccountSettingPassword from './AccountSettingPassword.vue'

export default {
  components: {
    BTabs,
    BTab,
    BCol,

    // load setting page
    AccountSettingGeneral,
    AccountSettingPassword,
  },
  data() {
    return {
      // set content display status
      general_page: true,
      password_page: false,
    }
  },
  created() {
    // set document title
    document.title = this.$route.meta.title
  },
  methods: {
    // show general setting
    general() {
      this.general_page = true
      this.password_page = false
    },
    // show password setting
    password() {
      this.general_page = false
      this.password_page = true
    },
  },
}
</script>
