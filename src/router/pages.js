export default [
  {
    path: '/dashboard',
    name: 'dashboard',
    meta: {
      title: 'Dashboard',
      requiresAuth: true,
      http_url: [
        'dashboard',
        'project',
        'project_add',
        'project_edit',
        'project_delete',
      ],
    },
    component: () => import('@/views/main_pages/dashboard/index.vue'),
  },
  {
    path: '/project',
    name: 'project',
    meta: {
      title: 'Project Management',
      requiresAuth: true,
      http_url: [
        'project_menu',
        'project_add',
        'project_group_add',
        'project_node_add',
        'project_node_add',
      ],
    },
    component: () => import('@/views/main_pages/project/index.vue'),
  },
  {
    path: '/project-detail/:id',
    name: 'project-detail',
    meta: {
      title: 'Project Detail',
      requiresAuth: true,
      http_url: [
        'project_group',
        'project_group_add',
        'project_group_edit',
        'project_group_delete',
      ],
    },
    component: () => import('@/views/main_pages/project/detail/index.vue'),
  },
  {
    path: '/project-group/:id',
    name: 'project-group',
    meta: {
      title: 'Project Detail > Group',
      requiresAuth: true,
      http_url: [
        'project_node',
        'project_node_add',
        'project_node_edit',
        'project_node_delete',
      ],
    },
    component: () => import('@/views/main_pages/project/group/index.vue'),
  },
  {
    path: '/project-sensor/:id',
    name: 'project-sensor',
    meta: {
      title: 'Project Detail > Group > Sensor',
      requiresAuth: true,
      http_url: [
        'project_sensor',
        'project_sensor_chart',
        'project_sensor_datatable',
      ],
    },
    component: () => import('@/views/main_pages/project/sensor/index.vue'),
  },
  {
    path: '/user',
    name: 'user',
    meta: {
      title: 'User Management',
      requiresAuth: true,
      http_url: [
        'req_userlist',
        'req_deleteuser',
      ],
    },
    component: () => import('@/views/main_pages/users/index.vue'),
  },
  {
    path: '/user/edit/:id',
    name: 'user-edit',
    meta: {
      title: 'User Management > Edit User',
      requiresAuth: true,
      http_url: [
        'req_userlist',
        'req_edituser',
      ],
    },
    component: () => import('@/views/main_pages/users/edit/index.vue'),
  },
  {
    path: '/user/add',
    name: 'user-add',
    meta: {
      title: 'User Management > Add User',
      requiresAuth: true,
      http_url: [
        'req_adduser',
      ],
    },
    component: () => import('@/views/main_pages/users/add/index.vue'),
  },
  {
    path: '/login',
    name: 'auth-login',
    meta: {
      title: 'Synapsi.id - Project Management Platform',
      hideAuth: true,
      http_url: [
        'req_login',
      ],
    },
    component: () => import('@/views/main_pages/authentication/Login.vue'),
  },
  {
    path: '/register',
    name: 'auth-register',
    meta: {
      title: 'Synapsi.id - Register New Account',
      hideAuth: true,
      http_url: [
        'req_register',
      ],
    },
    component: () => import('@/views/main_pages/authentication/Register.vue'),
  },
  {
    path: '/forgot-password',
    name: 'auth-forgot',
    meta: {
      title: 'Synapsi.id - Forgot Password',
      hideAuth: true,
      http_url: [
        'req_forgot',
      ],
    },
    component: () => import('@/views/main_pages/authentication/Forgot.vue'),
  },
  {
    path: '/account-setting',
    name: 'account-setting',
    meta: {
      title: 'Account Setting',
      requiresAuth: true,
      http_url: [
        'req_editaccount',
      ],
    },
    component: () => import('@/views/main_pages/account-setting/index.vue'),
  },
  {
    path: '/page-404',
    name: 'page-404',
    meta: {
      title: 'Oop\'s, 404 Page not found.',
    },
    component: () => import('@/views/main_pages/notfound/index.vue'),
  },
]
