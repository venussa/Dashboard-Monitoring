<!-- eslint-disable -->
<template>
  <section id="dashboard-ecommerce">

    <!-- breadcrumb -->
    <h1 class="page-heading">Dashboard</h1>
    <p class="page-nav">
      <feather-icon size="16" icon="HomeIcon" color="#0d80ce" />
      <span class="page-delimiter">
        <feather-icon size="1x" icon="ChevronRightIcon" />
      </span>
      <span class="page-title">Dashboard</span>
    </p>
    <!-- /breadcrumb -->

    <b-row class="match-height">
      <!-- Total User -->
      <b-col lg="5" sm="12" md="12">
        <b-row class="match-height">
          <b-col lg="12" md="6">
            <total-user-box :dashboard="dashboard" />
          </b-col>
        </b-row>
      </b-col>
      <!-- /Total User -->

      <!-- Total Project -->
      <b-col lg="5" sm="12" md="12">
        <b-row class="match-height">
          <b-col lg="12" md="6">
            <total-project-box :dashboard="dashboard" />
          </b-col>
        </b-row>
      </b-col>
      <!-- /Total Project -->
    </b-row>

    <!-- Detail -->
    <b-row class="match-height">
      <b-col lg="10">
        <b-row class="match-height">
          <b-col xl="12" md="12">
            <detail-box :dashboard="dashboard" />
          </b-col>
        </b-row>
      </b-col>
    </b-row>
    <!-- /Detail -->

  </section>
</template>
<script>
// load bootstrap vue
import { BRow, BCol } from 'bootstrap-vue'

// load axios
import axios from 'axios'
import httpApi from '@/main'

// load part of content
import DetailBox from './DetailBox.vue'
import TotalUserBox from './TotalUserBox.vue'
import TotalProjectBox from './TotalProjectBox.vue'

export default {
  components: {
    BRow,
    BCol,
    DetailBox,
    TotalUserBox,
    TotalProjectBox,
  },
  data() {
    return {
      // api storage
      api: [],

      // user session strorage
      userData: JSON.parse(sessionStorage.getItem('user_data')),

      // dashboard data storage
      dashboard: {
        type: Object,
        required: true,
      },
    }
  },
  created() {
    // Axios Http APi Request
    const formData = new FormData()
    // formData.append('name', 'value')

    const http = axios.post(`${httpApi}${this.$route.meta.http_url[0]}`, formData, {
      headers: {
        'Content-Type': 'multipart/form-data',
      },
    })

    // set axios response to api storage
    http.then(response => {
      this.api = response.data
    })

    // complete Axios Http APi Request
    http.finally(() => {
      if (this.api.result === true) {
        // if api give true response
        // set axios result to dashboard storage
        this.dashboard = this.api.object
      }
    })

    // set document title
    document.title = this.$route.meta.title
  },
}
</script>
