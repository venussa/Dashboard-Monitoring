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
        <b-link class="page-title" :to="{name: 'user'}" >User Management</b-link>
        <span class="page-delimiter">
          <feather-icon size="1x" icon="ChevronRightIcon" />
        </span>
        <span class="page-title">Add User</span>
      </p>
    </b-col>
    <!-- breadcrumb -->

    <!-- load insert form -->
    <b-row>
      <b-card class="col-lg-7">
        <h2 class="bold-title" >Register User Form</h2>
        <user-add-tab-account class="mt-2 pt-75" />
      </b-card>
    </b-row>
    <!-- /load insert form -->

  </b-col>
</template>

<script>
// load bootstrap vue
import {
  BCard, BCol, BLink, BRow,
} from 'bootstrap-vue'

// load insert form
import UserAddTabAccount from './form.vue'

export default {
  components: {
    BCard,
    BCol,
    BLink,
    BRow,
    UserAddTabAccount,
  },
  created() {
    // set document title
    document.title = this.$route.meta.title
  },
}
</script>
