<!-- eslint-disable -->
<template>
    <div style="margin-bottom: 30px">
        <div class="pie-text text-center">
        <h2 class="font-weight-bolder">
            {{ api.total_data}}
        </h2>
        <span class="font-weight-bold">Total</span>
        </div>
        <app-echart-doughnut :series="series" />
    </div>
</template>

<script>
// load axios
import axios from 'axios'
import httpApi from '@/main'

import AppEchartDoughnut from '@core/components/charts/echart/AppEchartDoughnut.vue'

export default {
  components: {
    AppEchartDoughnut,
  },
  data() {
    return {
      // api storage
      api: [],

      // pie char storage
      series: [
        {
          name: '',
          type: 'pie',
          radius: ['50%', '70%'],
          avoidLabelOverlap: false,
          label: {
            show: false,
          },
          labelLine: {
            show: false,
          },
          data: [],
        },
      ],
    }
  },
  created() {
    // axios http api request
    const formData = new FormData()

    // set paramter
    formData.append('chart_type', 'pie')

    const http = axios.post(`${httpApi}${this.$route.meta.http_url[1]}`, formData, {
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
        // Set chart data to chart storage
        const { object } = this.api
        this.series[0].data = object
      }
    })
  },
}
</script>

<style lang="scss">
.card-body{
  position: relative;
  .pie-text{
    width: 105px;
    position:absolute;
    margin: auto;
    left: 0;
    right: 0;
    top: 44%;
    bottom: 0;
  }
  }
</style>
