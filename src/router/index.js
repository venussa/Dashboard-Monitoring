import Vue from 'vue'
import VueRouter from 'vue-router'
import pages from './pages'

Vue.use(VueRouter)

const router = new VueRouter({
  mode: 'history',
  base: process.env.BASE_URL,
  scrollBehavior() {
    return { x: 0, y: 0 }
  },
  routes: [
    // redirect if access blank page
    { path: '/', redirect: { name: 'dashboard' } },

    // load route page data
    ...pages,

    // redirect if url who want to access is not found
    {
      path: '*',
      redirect: 'page-404',
    },
  ],
})

// Session Management
router.beforeEach((to, from, next) => {
  // if user not login
  if (to.matched.some(record => record.meta.requiresAuth)) {
    if (sessionStorage.getItem('login') !== 'true') {
      next({ name: 'auth-login' })
    }
  } else {
    next()
  }

  // if user already login
  if (to.matched.some(record => record.meta.hideAuth)) {
    if (sessionStorage.getItem('login') === 'true') {
      next({ name: 'dashboard' })
    }
  } else {
    next()
  }
})

export default router
