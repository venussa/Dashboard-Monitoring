<!-- eslint-disable -->
<template>
  <div style="text-align:center;padding-top:100px;">
    <h1 style="font-size:30px;font-weight:600;">
      404 Not Found
    </h1>
    <p>Oops, it looks like the page you are referring to cannot be found.</p>
    <p>
      <b-link :to="{name: 'dashboard'}" style="color:#09f" >
        Back To Home
      </b-link>
    </p>
  </div>
</template>

<script>
import { BLink } from 'bootstrap-vue'

export default {
  components: {
    BLink,
  },
  created() {
    // set document title
    document.title = this.$route.meta.title
  },
}
</script>
