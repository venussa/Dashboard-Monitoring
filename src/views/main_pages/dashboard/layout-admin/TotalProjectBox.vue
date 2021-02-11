<!-- eslint-disable -->
<template>
  <b-card class="box-total-user">
    <b-row>
      <b-col cols="12">
        <p style="text-align:center;padding-bottom:10px;margin-top:-20px;">
          <feather-icon icon="MoreHorizontalIcon" size="20" />
        </p>
      </b-col>
      <b-col cols="7">
        <b-card-title class="mb-1 font-number">
          <span>{{ dashboard.total_project }}</span>
        </b-card-title>
        <div class="font-title">
          Total Project
        </div>
      </b-col>
      <b-col cols="5" style="text-align: right">
        <div class="box-icon b-avatar badge-light-success rounded-circle">
          <feather-icon size="4x" icon="FolderIcon" />
        </div>
      </b-col>
    </b-row>
  </b-card>
</template>

<script>
// load bootstrap vue
import {
  BCard, BRow, BCol, BCardTitle,
} from 'bootstrap-vue'

export default {
  components: {
    BRow,
    BCard,
    BCol,
    BCardTitle,
  },
  props: {
    // catch data from dashboard storage
    dashboard: {
      type: Object,
      required: true,
    },
  },
}
</script>
