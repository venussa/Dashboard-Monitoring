<!-- eslint-disable -->
<template>
  <div>
    <!-- load admin layout -->
    <layout-admin v-if="getUserData.role === 'Admin'" :userdata="getUserData" />

    <!-- load user layout -->
    <layout-user v-if="getUserData.role === 'User'" :userdata="getUserData" />
  </div>
</template>

<script>
// load sub content
import LayoutAdmin from './layout-admin/index.vue'
import LayoutUser from './layout-user/index.vue'

export default {
  components: {
    LayoutAdmin,
    LayoutUser,
  },
  data() {
    return {
      // user session storage
      getUserData: {
        type: Object,
        required: true,
      },
    }
  },
  created() {
    // set user session storage
    this.getUserData = JSON.parse(sessionStorage.getItem('user_data'))
    // redirect to page setting if user profile is not complete
    if (this.getUserData.fullname === '') {
      // redirect to account setting
      this.$router.push(this.$route.query.redirect || { name: 'account-setting' })
    }
  },
}
</script>
