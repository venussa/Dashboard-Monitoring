<!-- eslint-disable -->
<template>
    <!-- datatable -->
    <b-card class="table-space col-lg-10">
        <b-row>
        <!-- table heading-->
        <!-- perpage field -->
        <b-col lg="4" style="position:relative" >
            Show
            <v-select
                v-model="perPage"
                :options="option_perpage"
                :components="{ Deselect, OpenIndicator }"
                style="display:inline-block;min-width:90px;max-width:auto"
                @input="loadPerpage"
            >
                <slot name="no-options">Sorry, no matching options.</slot>
            </v-select>
            entries
        </b-col>

        <b-col lg="2"><br></b-col>

        <!-- search field -->
        <b-col lg="6">
            <b-form-group>
            <div class="form-control" style="background: transparent;width:80%;display: inline-block;">
                <feather-icon icon="CalendarIcon" size="20" style="margin-left: -10px;position:relative; top:-2px;" />
                <flat-pickr
                    v-model="dateNtim0"
                    class="datepicker"
                    :config="{ enableTime: true,dateFormat: 'Y-m-d H:i'}"
                    placeholder="From"
                />
                -
                <flat-pickr
                    v-model="dateNtim1"
                    class="datepicker"
                    :config="{ enableTime: true,dateFormat: 'Y-m-d H:i'}"
                    placeholder="To"
                />
            </div>
            <b-button
                variant="primary"
                style="padding-left:10px;padding-right:10px;margin-left:10px;"
                @click="accessPage"
            >
                Filter
            </b-button>
            </b-form-group>
        </b-col>
        <!-- /table heading-->

        <!-- table body -->
        <b-table
            responsive
            :items="items"
            :fields="fields"
            :per-page="perPage"
            class="mb-0"
        >
            <template #cell()="data">
            {{ data.value }}
            </template>
        </b-table>
        <!-- /table body -->

         <!-- DATA NOT FOUND -->
        <p v-if="api.total_data < 1" style="text-align:center;padding:20px;width:100%;" >
            No matching records found
        </p>
        <!-- /DATA NOT FOUND -->

        <!-- table footer -->
        <b-col lg="12">
            <b-row>
            <b-col lg="12"><br></b-col>
            <b-col lg="4">
                Show {{ info_list_1 }} to {{ info_list_2 }} of {{ info_list_3 }} Entries
            </b-col>
            <b-col lg="8" style="text-align:right">
                <div style="display:inline-block">
                <b-pagination
                    v-model="currentPage"
                    hide-goto-end-buttons
                    :total-rows="rows"
                    :per-page="perPage"
                    first-number
                    last-number
                    prev-class="prev-item"
                    next-class="next-item"
                    @change="entriesInfo"
                />
                </div>
            </b-col>
            </b-row>
        </b-col>
        <!-- /table footer -->

        </b-row>
    </b-card>
    <!-- datatable -->
</template>

<script>
// load vue select
import vSelect from 'vue-select'

// date picker
import flatPickr from 'vue-flatpickr-component'

// load bootstrat vue
import {
  BCard,
  BCol,
  BRow,
  BTable,
  BFormGroup,
  BPagination,
  BButton,
} from 'bootstrap-vue'

// load axios
import axios from 'axios'
import httpApi from '@/main'

export default {
  components: {
    BCard,
    BCol,
    BRow,
    BTable,
    flatPickr,
    BFormGroup,
    vSelect,
    BPagination,
    BButton,
  },
  data() {
    return {
      // date time picker
      dateNtim0: '',
      dateNtim1: '',

      // api storage
      api: [],

      // table data
      items: [],

      // Set table list data
      fields: [
        { key: 'id', label: 'No', sortable: true },
        { key: 'datetime', label: 'Datetime', sortable: true },
        { key: 'value', label: 'Value', sortable: true },
        { key: 'status', label: 'Status', sortable: true },
      ],

      // pagination data
      currentPage: 1,
      perPage: 1,
      rows: 1,

      // set star & end data entries
      info_list_1: 0,
      info_list_2: 0,
      info_list_3: 0,

      // set table sorting select data
      keyword: '',
      option_perpage: [10, 25, 50, 100],
      Deselect: {
        render: createElement => createElement('span', ''),
      },
      OpenIndicator: {
        render: createElement => createElement('span', { class: 'dropdown-icon' }),
      },
    }
  },
  created() {
    // destruktur data
    const [data] = this.option_perpage
    // set perpage data
    this.perPage = data
    // axios http request
    this.accessPage()
    // set document title
  },
  methods: {
    // axios http api request
    // load table data
    accessPage() {
      const formData = new FormData()

      // set paramter
      formData.append('page', this.currentPage)
      formData.append('limit', this.perPage)
      formData.append('from', this.dateNtim0)
      formData.append('to', this.dateNtim1)

      const http = axios.post(`${httpApi}${this.$route.meta.http_url[2]}`, formData, {
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
          // set data table data to item storage
          this.items = this.api.object
          this.rows = this.api.total_data
          this.info_list_1 = ((this.currentPage - 1) * this.perPage) + 1
          this.info_list_2 = (this.info_list_1 - 1) + this.api.total_data_per_page
          this.info_list_3 = this.api.total_data
        }

        if (this.api.result === false) {
          // set data table data to item storage
          this.items = []
          this.rows = 0
          this.info_list_1 = 0
          this.info_list_2 = 0
          this.info_list_3 = 0
        }
      })
    },
    // update entries info
    entriesInfo(page) {
      this.currentPage = page
      this.accessPage()
    },
    // search data trigger
    searchData(keyword) {
      this.keyword = keyword.target.value
    },
    // data perpage trigger
    loadPerpage(perpage) {
      this.perPage = perpage
      this.accessPage()
    },
  },
}
</script>

<style lang="scss">
@import '@core/scss/vue/libs/vue-select.scss';
@import '@core/scss/vue/libs/vue-flatpicker.scss';

.datepicker{
  border: transparent;
  background: transparent;
  margin-left:10px;
  width: 130px;
}
.datepicker:focus{
  outline: transparent;
}
.dark-layout .datepicker{
  color: #b4b7bd !important;
}
</style>
