<!-- eslint-disable -->
<template>
  <div v-if="userdata.role === 'Admin'">

    <!-- breadcrumb -->
    <h1 class="page-heading">User Management</h1>
    <p class="page-nav">
      <feather-icon size="16" icon="UsersIcon" color="#0d80ce" />
      <span class="page-delimiter">
        <feather-icon size="1x" icon="ChevronRightIcon" />
      </span>
      <span class="page-title">User Management</span>
    </p>
    <b-link class="btn btn-primary right-btn d-none d-sm-block" :to="{ name: 'user-add', params: { id: 1} }">
      <span class="text-nowrap">Add User</span>
    </b-link>
    <!-- /breadcrumb -->

    <!-- modal -->
    <b-modal id="modal-1" ref="modal" title="Peringatan" :hide-footer="true" >
      <b-card-text>
        Apakah anda sudah yakin akan menghapus data dari user bernama <b>{{ del_user }}</b>
      </b-card-text>
      <div style="padding-top:10px;text-align:right;">
        <b-button variant="outline-secondary" @click="hideModal" >Cancel</b-button>
        <b-button variant="primary" style="margin-left:10px" @click="deleteUser(del_id)" >
          Delete
        </b-button>
      </div>
    </b-modal>
    <!-- modal -->

    <!-- Table Container Card -->
    <b-card class="table-space">
      <b-row>

        <!-- table heading -->
        <b-col lg="12">
          <b-row>

            <!-- select perpage -->
            <b-col lg="4" style="position:relative" >
              Show
              <v-select v-model="perPage" :options="option_perpage" :components="{ Deselect, OpenIndicator }" style="display:inline-block;min-width:90px;max-width:auto" @input="loadPerpage" >
                <slot name="no-options">Sorry, no matching options.</slot>
              </v-select>
              entries
              <div class="d-block d-sm-none">
                <b-link class="btn btn-primary right-btn1" :to="{ name: 'user-add', params: { id: 1} }" >
                  <span class="text-nowrap">Add User</span>
                </b-link>
              </div>
            </b-col>
            <!-- /select perpage -->

            <b-col lg="3"><br></b-col>

            <!-- search field -->
            <b-col lg="5">
              <b-form-group>
                <b-form-input placeholder="Search" @keyup="searchData($event)" />
              </b-form-group>
            </b-col>
            <!-- /search field -->

          </b-row>
        </b-col>
        <!-- /table heading -->

        <!-- table body -->
        <b-col lg="12">
          <b-row>
            <b-table responsive :items="items" :fields="fields" :per-page="perPage" >

              <!-- NAME FIELD -->
              <template #cell(fullname)="data" aria-colspan="6" >
                <span class="text-nowrap">
                  <img
                    v-if="data.item.photo.length > 1"
                    :src="data.item.photo.length < 1 ? null : require('@/assets/images/photo/'+data.item.photo)"
                    width="40" height="40" style="border-radius:100%">
                  <span v-if="data.item.photo.length < 1" class="b-avatar badge-minimal badge-light-primary rounded-circle" style="width:40px;height:40px;" >
                    <feather-icon icon="UserIcon" size="30" />
                  </span>
                  <span style="margin-left:10px">{{ data.value }}</span>
                </span>
              </template>
              <!-- /NAME FIELD -->

              <!-- ACTION FIELD -->
              <template #cell(action)="data">
                <b-dropdown id="dropdown-1" variant="link" >
                  <template #button-content>
                    <feather-icon icon="MoreVerticalIcon" size="16" class="align-middle text-body" />
                  </template>
                  <b-dropdown-item :to="{ name: 'user-edit', params: { id: data.item.id }}" >
                    Edit
                  </b-dropdown-item>
                  <b-dropdown-item v-b-modal.modal-1 @click="delete_name(data.item.fullname, data.item.id)" >
                    Delete
                  </b-dropdown-item>
                </b-dropdown>
              </template>
              <!-- /ACTION FIELD -->

              <!-- DEFAULT FIELD -->
              <template #cell()="data">{{ data.value }}</template>
              <!-- /DEFAULT FIELD -->

            </b-table>

            <!-- DATA NOT FOUND -->
            <p v-if="totalData < 1" style="text-align:center;padding:20px;width:100%;" >
              No matching records found
            </p>
            <!-- /DATA NOT FOUND -->

          </b-row>
        </b-col>
        <!-- /table body -->

        <!-- table footer -->
        <b-col lg="12">
          <b-col lg="12"><br></b-col>
          <b-row>
            <b-col lg="4">
              Show {{ info_list_1 }} to {{ info_list_2 }} of {{ totalData }} Entries
            </b-col>
            <b-col lg="8" style="text-align:right" >
              <div style="display:inline-block">
                <b-pagination
                  v-model="currentPage"
                  :total-rows="totalData"
                  :per-page="perPage"
                  first-number
                  last-number
                  prev-class="prev-item"
                  next-class="next-item"
                  @change="loadPage"
                >
                  <template v-slot:prev-text>
                    <feather-icon icon="ChevronLeftIcon" size="18" />
                  </template>
                  <template v-slot:next-text>
                    <feather-icon icon="ChevronRightIcon" size="18" />
                  </template>
                </b-pagination>
              </div>
            </b-col>
          </b-row>
        </b-col>
        <!-- /table footer -->

      </b-row>
    </b-card>
  </div>
</template>

<script>
// load vue select
import vSelect from 'vue-select'
import Ripple from 'vue-ripple-directive'

// load bootstrap vue
import {
  BLink,
  BCol,
  BCard,
  BPagination,
  BRow,
  BFormGroup,
  BFormInput,
  BTable,
  BDropdown,
  BDropdownItem,
  VBModal,
  BButton,
  BCardText,
} from 'bootstrap-vue'

// load axios
import axios from 'axios'
import httpApi from '@/main'
import FeatherIcon from '@/@core/components/feather-icon/FeatherIcon.vue'

export default {
  components: {
    BLink,
    BCol,
    BCard,
    BPagination,
    BRow,
    vSelect,
    BFormGroup,
    BFormInput,
    BTable,
    FeatherIcon,
    BDropdown,
    BDropdownItem,
    BButton,
    BCardText,
  },
  directives: {
    'b-modal': VBModal,
    Ripple,
  },
  data() {
    return {
      // api storage
      api: [],

      // user session storage
      userdata: JSON.parse(sessionStorage.getItem('user_data')),

      // table setting storage
      perPage: 0,
      totalData: 0,
      currentPage: 1,

      // keyword storage
      keyword: '',

      // delete user modal fullname
      del_user: '',
      del_id: '',

      // set table sorting select data
      option_perpage: [10, 25, 50, 100],
      Deselect: {
        render: createElement => createElement('span', ''),
      },
      OpenIndicator: {
        render: createElement => createElement('span', { class: 'dropdown-icon' }),
      },
      // set table field name
      fields: [
        { key: 'fullname', label: 'Name', sortable: true },
        { key: 'email', label: 'Email', sortable: true },
        { key: 'role', label: 'Role', sortable: true },
        { key: 'action', label: 'Action' },
      ],
      // set list data
      items: null,

      // set star & end data entries
      info_list_1: 0,
      info_list_2: 0,
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
    document.title = this.$route.meta.title
  },
  methods: {
    // Axios Http Api Request
    // access user list action method
    accessPage() {
      const formData = new FormData()

      // set parmater data
      formData.append('page', this.currentPage)
      formData.append('per_page', this.perPage)
      formData.append('keyword', this.keyword)
      formData.append('my_id', this.userdata.id)

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
          // set axios reponse to set list data storage
          const showdata = this.api.object
          this.items = showdata
          // set total data
          this.totalData = this.api.total_data
          this.info_list_1 = ((this.currentPage - 1) * this.perPage) + 1
          this.info_list_2 = (this.info_list_1 - 1) + showdata.length
        }

        // if api give false response
        if (this.api.result === false) {
          // reset list data storage
          this.items = null

          // reset totaldata
          this.totalData = 0
          this.info_list_1 = 0
          this.info_list_2 = 0
        }
      })
    },
    // pagination click trigger
    loadPage(page) {
      this.currentPage = page
      this.accessPage()
    },
    // search data trigger
    searchData(keyword) {
      this.keyword = keyword.target.value
      this.accessPage()
    },
    // data perpage trigger
    loadPerpage(perpage) {
      this.perPage = perpage
      this.accessPage()
    },
    // get delete user name
    delete_name(name, id) {
      this.del_user = name
      this.del_id = id
    },
    // hide modal
    hideModal() {
      this.$refs.modal.hide()
    },
    // axios http api request
    // delete user action method
    deleteUser(id) {
      const formData = new FormData()

      // set parmater data
      formData.append('id', id)

      const http = axios.post(`${httpApi}${this.$route.meta.http_url[1]}`, formData, {
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
        // if api response give true result
        if (this.api.result === true) {
          this.accessPage()
          this.hideModal()
        }
      })
    },
  },
}
</script>

<style lang="scss" scoped>
.per-page-selector {
  width: 90px;
}
</style>

<style lang="scss">
@import '@core/scss/vue/libs/vue-select.scss';
</style>
