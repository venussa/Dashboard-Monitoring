<template>
  <ul class="list-menu">
    <component
      :is="resolveNavItemComponent(item)"
      v-for="item in items"
      :key="item.header || item.title"
      :item="item"
    />
  </ul>
</template>

<script>
import { provide, ref } from '@vue/composition-api'
import { resolveVerticalNavMenuItemComponent as resolveNavItemComponent } from '../utils'
import VerticalNavMenuLink from './LayoutVerticalSubMenuList.vue'

export default {
  components: {
    VerticalNavMenuLink,
  },
  props: {
    items: {
      type: Array,
      required: true,
    },
  },
  setup() {
    provide('openGroups', ref([]))

    return {
      resolveNavItemComponent,
    }
  },
}
</script>
