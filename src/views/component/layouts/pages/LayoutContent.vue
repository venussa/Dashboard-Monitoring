<!-- eslint-disable -->
<template>
  <div
    :class="[
      {'show-overlay': $store.state.app.shallShowOverlay},
      $route.meta.contentClass,
      this.$route.meta.requiresAuth === true ? 'content app-content' : null,
    ]"
  >
    <div
      v-if="this.$route.meta.requiresAuth === true"
      class="content-overlay"
    />
    <div
      v-if="this.$route.meta.requiresAuth === true"
      class="header-navbar-shadow"
    />
    <div
      class="content-wrapper"
      :class="contentWidth === 'boxed' ? 'container p-0' : null"
    >
      <div class="content-body">
        <transition
          :name="routerTransition"
          mode="out-in"
        >
          <slot />
        </transition>
      </div>
    </div>
  </div>
</template>

<script>
import useAppConfig from '@core/app-config/useAppConfig'

export default {
  components: {},
  setup() {
    const { routerTransition, contentWidth } = useAppConfig()

    return {
      routerTransition, contentWidth,
    }
  },
}
</script>

<style>

</style>
