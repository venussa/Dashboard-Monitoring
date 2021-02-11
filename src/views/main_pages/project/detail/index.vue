<!-- eslint-disable -->
<template>
  <div>
    <!-- breadcrumb -->
    <h1 class="page-heading">{{ api.p_title }}</h1>
    <p class="page-nav">
      <feather-icon size="16" icon="HomeIcon" color="#0d80ce" />
      <span class="page-delimiter">
        <feather-icon size="1x" icon="ChevronRightIcon" />
      </span>
      <b-link :to="{ name: 'project' }" class="page-title" >Project</b-link>
      <span class="page-delimiter">
        <feather-icon size="1x" icon="ChevronRightIcon" />
      </span>
      <span class="page-title">{{ api.p_title }}</span>
    </p>
    <b-col cols="12">
      <p style="padding:10px;padding-left:0px;margin-left:-10px;margin-top:-10px;">
        {{ api.description }}
      </p>
      <p style="font-size:22px;padding:10px;padding-left:0px;margin-left:-10px;margin-top:30px;">Groups</p>
    </b-col>
    <!-- /breadcrumb -->

    <!-- show card data -->
    <card-data
      :showProject="listProject"
    />
    <!-- /show card data -->

  </div>
</template>

<script>
// load bootstrap vue
import {
  BCol,
  BLink,
} from 'bootstrap-vue'

// load axios
import axios from 'axios'
import httpApi from '@/main'

// laod card data content
import CardData from './CardData.vue'

export default {
  components: {
    CardData,
    BCol,
    BLink,
  },
  data() {
    return {
      // api storeage
      api: [],

      // list project data storage
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
    formData.append('p_id', this.$route.params.id)

    const http = axios.post(`${httpApi}${this.$route.meta.http_url[0]}`, formData, {
      headers: {
        'Content-Type': 'multipart/form-data',
      },
    })

    // set axios response to api storage
    http.then(response => {
      this.api = response.data
    })

    // complete axios http request
    http.finally(() => {
      // if api give true response
      if (this.api.result === true) {
        // set axios response to list project storage
        this.listProject = this.api.object
      }

      // if api give false response
      if (this.api.result === false) {
        // this.$router.push(this.$route.query.redirect || { name: 'page-404' })
        // reset list project storage
        this.listProject = []
      }
    })

    // set document title
    document.title = this.$route.meta.title
  },
}
</script>
