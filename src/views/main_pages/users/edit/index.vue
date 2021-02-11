<!-- eslint-disable -->
<template>
  <b-col>

    <!-- breadcrumb -->
    <b-col class="heading-cont">
      <h1 class="page-heading">User Management</h1>
      <p class="page-nav">
        <feather-icon size="1.5x" icon="UsersIcon" color="#0d80ce" />
        <span class="page-delimiter">
          <feather-icon size="1x" icon="ChevronRightIcon" />
        </span>
        <b-link class="page-title" :to="{name: 'user'}" >
          User Management
        </b-link>
        <span class="page-delimiter">
          <feather-icon size="1x" icon="ChevronRightIcon" />
        </span>
        <span class="page-title">{{ userData.fullname }}</span>
      </p>
    </b-col>
    <!-- breadcrumb -->
    
    <!-- load edit form -->
    <b-row>
      <b-card class="col-lg-7">
        <h2 class="bold-title" >Edit User Data</h2>
        <user-edit-tab-account
          :user-data="userData"
          class="mt-2 pt-75"
        />
      </b-card>
    </b-row>
    <!-- /load edit form -->

  </b-col>
</template>

<script>
// load bootstrap vue
import {
  BCard, BCol, BLink, BRow,
} from 'bootstrap-vue'

// load axios
import axios from 'axios'
import httpApi from '@/main'

// load form edit
import UserEditTabAccount from './form.vue'

export default {
  components: {
    BCard,
    BCol,
    BLink,
    BRow,
    UserEditTabAccount,
  },
  data() {
    return {
      // api storage
      api: [],

      // user data storage
      userData: {
        type: Object,
        required: true,
      },
    }
  },
  created() {
    // axios http api request
    const formData = new FormData()

    // set parmater data
    formData.append('id', this.$route.params.id)

    const http = axios.post(`${httpApi}${this.$route.meta.http_url[0]}`, formData, {
      headers: {
        'Content-Type': 'multipart/form-data',
      },
    })

    // set axios result to session storage
    http.then(response => {
      this.api = response.data
    })

    // complete axios http api request
    http.finally(() => {
      // if api give true response
      if (this.api.result === true) {
        // set axios result to user data storage
        this.userData = this.api.object
      }

      // if api give false response
      if (this.api.result === false) {
        // will redirect to 404 page
        this.$router.push(this.$route.query.redirect || { name: 'page-404' })
      }
    })

    // set document title
    document.title = this.$route.meta.title
  },
}
</script>

<style>

</style>
