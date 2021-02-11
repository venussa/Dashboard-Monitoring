<!-- eslint-disable -->
<template>
  <li v-if="$t(item.auth) === userData.role | $t(item.auth) === 'All'" class="nav-item" :class="{'active': isActive, 'disabled': item.disabled}">
    <b-link v-bind="linkProps" class="d-flex align-items-center" >
      <feather-icon :icon="item.icon || 'CircleIcon'" />
      <span class="menu-title text-truncate">{{ $t(item.title) }}</span>
      <b-badge v-if="item.tag" pill :variant="item.tagVariant || 'primary'" class="mr-1 ml-auto" >
        {{ item.tag }}
      </b-badge>
    </b-link>
  </li>
</template>

<script>
// load bootstrap vue
import { BLink, BBadge } from 'bootstrap-vue'

// load module
import useVerticalNavMenuLink from './module/useVerticalNavMenuLink'
import mixinVerticalNavMenuLink from './module/mixinVerticalNavMenuLink'

export default {
  components: {
    BLink,
    BBadge,
  },
  mixins: [mixinVerticalNavMenuLink],
  props: {
    // catch menu from item storage
    item: {
      type: Object,
      required: true,
    },
  },
  data() {
    return {
      // user session storage
      userData: JSON.parse(sessionStorage.getItem('user_data')),
    }
  },
  setup(props) {
    const { isActive, linkProps, updateIsActive } = useVerticalNavMenuLink(props.item)

    return {
      isActive,
      linkProps,
      updateIsActive,
    }
  },

}
</script>
