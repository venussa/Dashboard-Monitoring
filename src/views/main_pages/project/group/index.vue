<!-- eslint-disable -->
<template>
  <div>

    <!-- breadcrumb -->
    <h1 class="page-heading">{{ api.g_title }}</h1>
    <p class="page-nav">
      <feather-icon size="16" icon="HomeIcon" color="#0d80ce" />
      <span class="page-delimiter">
        <feather-icon size="1x" icon="ChevronRightIcon" />
      </span>
      <b-link :to="{ name: 'project' }" class="page-title" >Project</b-link>
      <span class="page-delimiter">
        <feather-icon size="1x" icon="ChevronRightIcon" />
      </span>
      <b-link :to="{ name: 'project-detail', params: {id: api.p_id }}" class="page-title" >
        {{ api.p_title }} 
      </b-link>
      <span class="page-delimiter">
        <feather-icon size="1x" icon="ChevronRightIcon" />
      </span>
      <span class="page-title">{{ api.g_title }}</span>
    </p>
    <b-col cols="12">
      <p style="padding:10px;padding-left:0px;margin-left:-10px;margin-top:-10px;">
        {{ api.description }}
      </p>
    </b-col>
    <!-- /breadcrumb -->

    <!-- show card data -->
    <card-data
      :showProject="listProject"
      :userData="userdata"
    />
    <!-- show card data -->

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

// load card data
import CardData from './CardData.vue'

export default {
  components: {
    CardData,
    BCol,
    BLink,
  },
  data() {
    return {
      // api storage
      api: [],

      // user session storage
      userdata: JSON.parse(sessionStorage.getItem('user_data')),

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

    // set parmaater
    formData.append('g_id', this.$route.params.id)

    const http = axios.post(`${httpApi}${this.$route.meta.http_url[0]}`, formData, {
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
        // set axios response to listproject storage
        this.listProject = this.api.object
      }

      // if api give false reponse
      if (this.api.result === false) {
        // this.$router.push(this.$route.query.redirect || { name: 'page-404' })
        // reset listproject storage
        this.listProject = []
      }
    })

    // set document title
    document.title = this.$route.meta.title
  },
}
</script>
