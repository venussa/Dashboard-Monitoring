<!-- eslint-disable -->
<template>
  <div class="navbar-container d-flex content align-items-center">
    <!-- Nav Menu Toggler -->
    <ul class="nav navbar-nav d-xl-none">
      <li class="nav-item">
        <b-link class="nav-link" @click="toggleVerticalMenuActive" >
          <feather-icon icon="MenuIcon" size="21" />
        </b-link>
      </li>
    </ul>

    <!-- theme mode -->
    <p class="toggle-theme" @click="switchLayout" >
      <!-- light mode -->
      <feather-icon v-if="layoutSet >= 1" icon="SunIcon" size="23" color="#d1ca00" />
      <!-- dark mode -->
      <feather-icon v-if="layoutSet < 1" icon="MoonIcon" size="23" color="#2b9bcc" />
    </p>

    <!-- load navbar dropdown -->
    <b-navbar-nav class="nav align-items-center ml-auto">
      <user-dropdown />
    </b-navbar-nav>

  </div>
</template>

<script>
// load bootstrap vue
import {
  BLink, BNavbarNav,
} from 'bootstrap-vue'

// load navbar drop down
import UserDropdown from './NavDropdown.vue'

export default {
  components: {
    BLink,
    BNavbarNav,
    UserDropdown,
  },
  props: {
    // catch data from vertical menu configuration
    toggleVerticalMenuActive: {
      type: Function,
      default: () => {},
    },
  },
  data() {
    return {
      // theme mode storage
      layoutSet: 0,
    }
  },
  created() {
    // load switch theme mode
    const tmpData = sessionStorage.getItem('theme')
    if (tmpData >= 1) {
      this.layoutSet = 1 // dark mode
    } else {
      this.layoutSet = 0 // light mode
    }
  },
  methods: {
    // set new config for theme mode
    switchLayout() {
      const tmpData = sessionStorage.getItem('theme')
      const element = document.getElementsByTagName('body')[0]
      if (tmpData >= 1) {
        // light mode
        sessionStorage.setItem('theme', 0)
        element.classList.remove('dark-layout')
        this.layoutSet = 0
      } else {
        // dark mode
        sessionStorage.setItem('theme', 1)
        element.classList.add('dark-layout')
        this.layoutSet = 1
      }
    },
  },
}
</script>
