<!-- eslint-disable -->
<template>
  <b-card class="box-detail">

    <!-- Boax Header -->
    <b-card-header>
      <div class="box-heading">
        <h1>Detail</h1>
        <b-row>
          <p class="col-lg-10">
            Lorem Ipsum is simply dummy text of the printing and typesetting industry
          </p>
        </b-row>
        <b-card-text class="font-small-2 text-right">
          Last update {{ dashboard.update_time }} ago
        </b-card-text>
      </div>
    </b-card-header>
    <!-- / box header -->

    <!-- box body -->
    <div>
      <b-row>

        <!-- Group -->
        <b-col lg="4" sm="12" md="4" class="box">
          <b-row>
            <b-col cols="6">
              <div class="box-icon-detail b-avatar badge-light-primary rounded-square">
                <feather-icon size="4x" icon="ArchiveIcon" />
              </div>
            </b-col>
            <b-col cols="6">
              <div class="card-detail">
                <b-card-title class="mb-1 font-number">
                  <span>{{ dashboard.group }}</span>
                </b-card-title>
                <div class="font-title">
                  Groups
                </div>
              </div>
            </b-col>
          </b-row>
        </b-col>
        <!-- /Group -->

        <!-- node -->
        <b-col lg="4" sm="12" md="4" class="box">
          <b-row>
            <b-col cols="6">
              <div class="box-icon-detail b-avatar badge-light-info rounded-square">
                <feather-icon size="4x" icon="CloudIcon" />
              </div>
            </b-col>
            <b-col cols="6">
              <div class="card-detail">
                <b-card-title class="mb-1 font-number">
                  <span>{{ dashboard.node }}</span>
                </b-card-title>
                <div class="font-title">
                  Nodes
                </div>
              </div>
            </b-col>
          </b-row>
        </b-col>
        <!-- /node -->

        <!-- sensor -->
        <b-col lg="4" sm="12" md="4" class="box" >
          <b-row>
            <b-col cols="6" >
              <div class="box-icon-detail b-avatar badge-light-danger rounded-square">
                <feather-icon size="4x" icon="CpuIcon" />
              </div>
            </b-col>
            <b-col cols="6" >
              <div class="card-detail">
                <b-card-title class="mb-1 font-number">
                  <span>{{ dashboard.sensor }}</span>
                </b-card-title>
                <div class="font-title">
                  Sensors
                </div>
              </div>
            </b-col>
          </b-row>
        </b-col>
        <!-- /sensor -->

      </b-row>
    </div>
  </b-card>
</template>

<script>
// load bootstrap vue
import {
  BCard, BCardHeader, BCardText, BRow, BCol, BCardTitle,
} from 'bootstrap-vue'

export default {
  components: {
    BRow,
    BCard,
    BCardHeader,
    BCardText,
    BCol,
    BCardTitle,
  },
  props: {
    // catch data prom dashboard storage
    dashboard: {
      type: Object,
      required: true,
    },
  },
}
</script>
