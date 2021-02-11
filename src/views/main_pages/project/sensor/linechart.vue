<!-- eslint-disable -->
<template>
    <app-echart-line :option-data="chart" />
</template>

<script>
// load axios
import axios from 'axios'
import httpApi from '@/main'

// load chart template
import AppEchartLine from '@core/components/charts/echart/AppEchartLine.vue'

export default {
  components: {
    AppEchartLine,
  },
  data() {
    return {
      // api storage
      api: [],

      // chart data storage
      chart: {
        xAxisData: [],
        series: [],
      },
    }
  },
  created() {
    // axios http api request
    const formData = new FormData()

    // set paramter
    // formData.append('paramater_name', 'value')

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
        const { series, xAxisData } = this.api.object
        for (let x = 0; x < series.length; x += 1) {
          this.chart.xAxisData.push(xAxisData[x])
          this.chart.series.push(series[x])
        }
      }
    })
  },
}
</script>
