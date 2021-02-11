<!-- eslint-disable -->
<template>
  <div>

    <!-- breadcrumb -->
    <h1 class="page-heading">{{ api.n_title }}</h1>
    <p class="page-nav">
      <feather-icon size="16" icon="HomeIcon" color="#0d80ce" />
      <span class="page-delimiter">
        <feather-icon size="1x" icon="ChevronRightIcon" />
      </span>
      <b-link :to="{ name: 'project' }" class="page-title" >
        Project
      </b-link>
      <span class="page-delimiter">
        <feather-icon size="1x" icon="ChevronRightIcon" />
      </span>
      <b-link :to="{ name: 'project-detail', params: { id: api.p_id }}" class="page-title" >
        {{ api.p_title}}
      </b-link>
      <span class="page-delimiter">
        <feather-icon size="1x" icon="ChevronRightIcon" />
      </span>
      <b-link :to="{ name: 'project-group', params: { id: api.g_id }}" class="page-title" >
        {{ api.g_title}}
      </b-link>
      <span class="page-delimiter">
        <feather-icon size="1x" icon="ChevronRightIcon" />
      </span>
      <b-link :to="{ name: 'project-group', params: { id: api.g_id }}" class="page-title" >
        {{ api.n_title}}
      </b-link>
      <span class="page-delimiter">
        <feather-icon size="1x" icon="ChevronRightIcon" />
      </span>
      <span class="page-title" >{{ api.s_title}}</span>
    </p>

    <b-col cols="12">
      <p style="padding:10px;padding-left:0px;margin-left:-10px;margin-top:-10px;">
      {{ api.description }}
      </p>
      <p style="padding-left:0px;padding-bottom: 10px;margin-left:-10px;margin-top:30px;font-size:23px;">
      {{ api.s_title }}
      </p>
    </b-col>
    <!-- /breadcrumb -->

    <!-- proccess time -->
    <b-card class="col-lg-10">
        <b-row>
            <b-col lg="4" xs="4" md="4" sm="4">
                <p style="text-align: center">Last Data</p>
                <p style="text-align: center; font-weight: 600;font-size:22px;">{{ api.last_data }}</p>
            </b-col>
            <b-col lg="4" xs="4" md="4" sm="4">
                <p style="text-align: center">Up Time</p>
                <p style="text-align: center; font-weight: 600;font-size:22px;">{{ api.up_time }}</p>
            </b-col>
            <b-col lg="4" xs="4" md="4" sm="4">
                <p style="text-align: center">Down Time</p>
                <p style="text-align: center; font-weight: 600;font-size:22px;">{{ api.down_time }}</p>
            </b-col>
        </b-row>
    </b-card>
    <!-- proccess time -->
    
    <!-- chart -->
    <b-card class="col-lg-10">
      <div class="d-flex justify-content-between flex-wrap" style="margin-bottom: 40px;position:relative" >
        <div class="mb-1 mb-sm-0">
          <span class="text-muted">Last Update {{ api.update_time }} Ago</span>

          <b-dropdown id="dropdown-1" variant="link-secondary" class="more-icon" style="position: absolute; right: -50px; top: -10px">
            <template #button-content>
              <feather-icon icon="MoreHorizontalIcon" size="20" />
            </template>
            <b-dropdown-item @click="chartSwitch(1)" >
              Line Chart
            </b-dropdown-item>
            <b-dropdown-item @click="chartSwitch(2)" >
              Pie Chart
            </b-dropdown-item>
          </b-dropdown>
        </div>
      </div>
      
      <line-chart v-if="chart_type === 1" />
      <pie-chart v-if="chart_type === 2" />
      
      <div style="position: relative;">
        <div class="b-avatar rounded-square" :class="api.status === true ? 'badge-light-success' : 'badge-light-danger'" style="border-radius:10px;width:40px;height:40px;" >
          <feather-icon :icon="api.status === true ? 'CheckCircleIcon' : 'AlertTriangleIcon'" size="20" />
        </div>
        <p style="position: absolute; right:0px;font-weight: 600; bottom:-5px;font-size:20px;">
          {{ api.sensor_value }}
        </p>
      </div>
    </b-card>
    <!-- chart -->

    <!-- datatable -->
    <data-table />
    <!-- /datatable -->

  </div>
</template>

<script>
// load bootstrat vue
import {
  BCard,
  BCol,
  BLink,
  BRow,
  BDropdown,
  BDropdownItem,
} from 'bootstrap-vue'

// load axios
import axios from 'axios'
import httpApi from '@/main'

// load chart
import LineChart from './linechart.vue'
import PieChart from './pieschart.vue'

// import data table
import DataTable from './datatable.vue'

export default {
  components: {
    BCard,
    BCol,
    BLink,
    BRow,
    BDropdown,
    BDropdownItem,
    DataTable,
    LineChart,
    PieChart,
  },
  data() {
    return {
      // api storage
      api: [],

      // chart type storage
      chart_type: 1,
    }
  },
  created() {
    // axios http api request
    const formData = new FormData()

    // set paramter
    formData.append('s_id', this.$route.params.id)

    const http = axios.post(`${httpApi}${this.$route.meta.http_url[0]}`, formData, {
      headers: {
        'Content-Type': 'multipart/form-data',
      },
    })

    // set axios response to pai storage
    http.then(response => {
      this.api = response.data
    })

    // complete http api request
    http.finally(() => {
      // if api give true response
      if (this.api.result === true) {
        // statement
      }
    })
    // set document title ( History Pushstate )
    document.title = this.$route.meta.title
  },
  methods: {
    chartSwitch(type) {
      this.chart_type = type
    },
  },
}
</script>
