<!-- eslint-disable -->
<template>
  <div>

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

    <!-- load card data -->
    <card-data :showProject="listProject" :userData="userdata" />
    <!-- /load card data -->

  </div>
</template>

<script>
// load axios
import axios from 'axios'
import httpApi from '@/main'

// load card dara content
import CardData from './CardData.vue'

export default {
  components: {
    CardData,
  },
  props: {
    // catch data from userdata storage
    userdata: {
      type: Object,
      required: true,
    },
  },
  data() {
    return {
      // api storage
      api: [],

      // list project storage
      listProject: {
        type: Object,
        required: true,
      },
    }
  },
  created() {
    // Axios Http Api Request
    const formData = new FormData()
    // set paramater data
    // formData.append('paramater', 'value')

    const http = axios.post(`${httpApi}${this.$route.meta.http_url[1]}`, formData, {
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
        // set api response to list project storage
        this.listProject = this.api.object
      }

      // if api give false response
      if (this.api.result === false) {
        // reset list project storage
        this.listProject = []
      }
    })

    // set document title
    document.title = this.$route.meta.title
  },
}
</script>
