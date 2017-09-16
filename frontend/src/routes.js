import DashView from './components/Dash.vue'
import LoginView from './components/Login.vue'
import NotFoundView from './components/404.vue'

// Import Views - Dash
import DashboardView from './components/views/Dashboard.vue'
import UsersView from './components/views/User.vue'
// import TablesView from './components/views/Tables.vue'
// import TasksView from './components/views/Tasks.vue'
// import SettingView from './components/views/Setting.vue'
// import AccessView from './components/views/Access.vue'
// import ServerView from './components/views/Server.vue'
// import ReposView from './components/views/Repos.vue'

// Routes
const routes = [
  {
    path: '/login',
    component: LoginView
  },
  {
    path: '/',
    component: DashView,
    children: [
      {
        path: 'dashboard',
        alias: '',
        component: DashboardView,
        name: 'Dashboard',
        meta: {
          description: 'Overview of environment',
          auth: true
        }
      }, {
        path: 'users',
        component: UsersView,
        name: 'Users',
        meta: {
          description: 'Users management',
          auth: true
        }
      }
      // ,
      // {
      //   path: 'tasks',
      //   component: TasksView,
      //   name: 'Tasks',
      //   meta: {
      //     description: 'Tasks page in the form of a timeline',
      //     auth: true
      //   }
      // }, {
      //   path: 'setting',
      //   component: SettingView,
      //   name: 'Settings',
      //   meta: {
      //     description: 'User settings page',
      //     auth: true
      //   }
      // }, {
      //   path: 'access',
      //   component: AccessView,
      //   name: 'Access',
      //   meta: {
      //     description: 'Example of using maps',
      //     auth: true
      //   }
      // }, {
      //   path: 'server',
      //   component: ServerView,
      //   name: 'Servers',
      //   meta: {
      //     description: 'List of our servers',
      //     auth: true
      //   }
      // }, {
      //   path: 'repos',
      //   component: ReposView,
      //   name: 'Repository',
      //   meta: {
      //     description: 'List of popular javascript repos',
      //     auth: true
      //   }
      // }
    ]
  }, {
    // not found handler
    path: '*',
    component: NotFoundView
  }
]

export default routes
