import Vue from 'vue'
import { ToastPlugin, ModalPlugin } from 'bootstrap-vue'

import i18n from '@/libs/i18n'
import router from './router'
import store from './store'
import App from './index.vue'

// Global Components
import './components'
// BSV Plugin Registration
Vue.use(ToastPlugin)
Vue.use(ModalPlugin)

// Feather font icon - For form-wizard
require('@core/assets/fonts/feather/iconfont.css')

// import core styles
require('@core/scss/core.scss')

// import assets styles
require('@/assets/scss/dashboard.scss')

// set default http access api
const httpApi = 'http://localhost/PROJEK/DASHBOARD-MONITORING/api/'

Vue.prototype.$api = httpApi

export default httpApi

// set router
Vue.config.productionTip = false

new Vue({
  router,
  store,
  i18n,
  render: h => h(App),
}).$mount('#app')
