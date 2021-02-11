<!-- eslint-disable -->
<template>
  <b-nav-item-dropdown right toggle-class="d-flex align-items-center dropdown-user-link" class="dropdown-user" >
    
    <!-- right menu -->
    <template #button-content>
      <div class="d-sm-flex d-none user-nav">
        <p class="user-name font-weight-bolder mb-0">
          {{ userdata.fullname }}
        </p>
        <span class="user-status">{{ userdata.role }}</span>
      </div>
      <b-avatar size="40" variant="light-primary" badge class="badge-minimal" badge-variant="success" >
        <img v-if="userdata.photo !== ''" :src="require('@/assets/images/photo/'+userdata.photo)" width="40" height="40" >
        <feather-icon icon="UserIcon" size="22" />
      </b-avatar>
    </template>

    <!-- right menu dropw down -->
    <b-dropdown-item :to="{ name: 'account-setting' }" link-class="d-flex align-items-center" >
      <feather-icon size="16" icon="SettingsIcon" class="mr-50" />
      <span>Settings</span>
    </b-dropdown-item>
    <b-dropdown-item link-class="d-flex align-items-center" @click="logout" >
      <feather-icon size="16" icon="LogOutIcon" class="mr-50" />
      <span>Logout</span>
    </b-dropdown-item>

  </b-nav-item-dropdown>
</template>

<script>
// load bootstrap vue
import {
  BNavItemDropdown, BDropdownItem, BAvatar,
} from 'bootstrap-vue'

export default {
  components: {
    BNavItemDropdown,
    BDropdownItem,
    BAvatar,
  },
  data() {
    return {
      // user session storage
      userdata: JSON.parse(sessionStorage.getItem('user_data')),
    }
  },
  methods: {
    // logout action method
    logout() {
      // remove all session storage
      sessionStorage.removeItem('login')
      sessionStorage.removeItem('user_data')
      sessionStorage.removeItem('theme')
      // reaload page
      window.location.reload()
    },
  },
}
</script>
