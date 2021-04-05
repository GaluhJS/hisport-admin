import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter)

const View = { template: '<router-view></router-view>' }

const routes = [
  {
    path: '/',
    component: () => import('@pages/Layout/DashboardLayout.vue'),
    redirect: 'dashboard',
    children: [
      {
        path: 'dashboard',
        name: 'dashboard',
        component: () => import('@pages/Dashboard.vue'),
        meta: { title: 'global.dashboard' }
      },
      {
        path: 'user-management',
        name: 'user_management',
        component: View,
        redirect: { name: 'permissions.index' },
        children: [
          {
            path: 'permissions',
            name: 'permissions.index',
            component: () => import('@cruds/Permissions/Index.vue'),
            meta: { title: 'cruds.permission.title' }
          },
          {
            path: 'permissions/create',
            name: 'permissions.create',
            component: () => import('@cruds/Permissions/Create.vue'),
            meta: { title: 'cruds.permission.title' }
          },
          {
            path: 'permissions/:id',
            name: 'permissions.show',
            component: () => import('@cruds/Permissions/Show.vue'),
            meta: { title: 'cruds.permission.title' }
          },
          {
            path: 'permissions/:id/edit',
            name: 'permissions.edit',
            component: () => import('@cruds/Permissions/Edit.vue'),
            meta: { title: 'cruds.permission.title' }
          },
          {
            path: 'roles',
            name: 'roles.index',
            component: () => import('@cruds/Roles/Index.vue'),
            meta: { title: 'cruds.role.title' }
          },
          {
            path: 'roles/create',
            name: 'roles.create',
            component: () => import('@cruds/Roles/Create.vue'),
            meta: { title: 'cruds.role.title' }
          },
          {
            path: 'roles/:id',
            name: 'roles.show',
            component: () => import('@cruds/Roles/Show.vue'),
            meta: { title: 'cruds.role.title' }
          },
          {
            path: 'roles/:id/edit',
            name: 'roles.edit',
            component: () => import('@cruds/Roles/Edit.vue'),
            meta: { title: 'cruds.role.title' }
          },
          {
            path: 'users',
            name: 'users.index',
            component: () => import('@cruds/Users/Index.vue'),
            meta: { title: 'cruds.user.title' }
          },
          {
            path: 'users/create',
            name: 'users.create',
            component: () => import('@cruds/Users/Create.vue'),
            meta: { title: 'cruds.user.title' }
          },
          {
            path: 'users/:id',
            name: 'users.show',
            component: () => import('@cruds/Users/Show.vue'),
            meta: { title: 'cruds.user.title' }
          },
          {
            path: 'users/:id/edit',
            name: 'users.edit',
            component: () => import('@cruds/Users/Edit.vue'),
            meta: { title: 'cruds.user.title' }
          }
        ]
      },
      {
        path: 'hi-games',
        name: 'hi_games.index',
        component: () => import('@cruds/HiGames/Index.vue'),
        meta: { title: 'cruds.hiGame.title' }
      },
      {
        path: 'hi-games/create',
        name: 'hi_games.create',
        component: () => import('@cruds/HiGames/Create.vue'),
        meta: { title: 'cruds.hiGame.title' }
      },
      {
        path: 'hi-games/:id',
        name: 'hi_games.show',
        component: () => import('@cruds/HiGames/Show.vue'),
        meta: { title: 'cruds.hiGame.title' }
      },
      {
        path: 'hi-games/:id/edit',
        name: 'hi_games.edit',
        component: () => import('@cruds/HiGames/Edit.vue'),
        meta: { title: 'cruds.hiGame.title' }
      },
      {
        path: 'event',
        name: 'event',
        component: View,
        redirect: { name: 'hi_events.index' },
        children: [
          {
            path: 'hi-events',
            name: 'hi_events.index',
            component: () => import('@cruds/HiEvents/Index.vue'),
            meta: { title: 'cruds.hiEvent.title' }
          },
          {
            path: 'hi-events/create',
            name: 'hi_events.create',
            component: () => import('@cruds/HiEvents/Create.vue'),
            meta: { title: 'cruds.hiEvent.title' }
          },
          {
            path: 'hi-events/:id',
            name: 'hi_events.show',
            component: () => import('@cruds/HiEvents/Show.vue'),
            meta: { title: 'cruds.hiEvent.title' }
          },
          {
            path: 'hi-events/:id/edit',
            name: 'hi_events.edit',
            component: () => import('@cruds/HiEvents/Edit.vue'),
            meta: { title: 'cruds.hiEvent.title' }
          },
          {
            path: 'hi-event-infos',
            name: 'hi_event_infos.index',
            component: () => import('@cruds/HiEventInfos/Index.vue'),
            meta: { title: 'cruds.hiEventInfo.title' }
          },
          {
            path: 'hi-event-infos/create',
            name: 'hi_event_infos.create',
            component: () => import('@cruds/HiEventInfos/Create.vue'),
            meta: { title: 'cruds.hiEventInfo.title' }
          },
          {
            path: 'hi-event-infos/:id',
            name: 'hi_event_infos.show',
            component: () => import('@cruds/HiEventInfos/Show.vue'),
            meta: { title: 'cruds.hiEventInfo.title' }
          },
          {
            path: 'hi-event-infos/:id/edit',
            name: 'hi_event_infos.edit',
            component: () => import('@cruds/HiEventInfos/Edit.vue'),
            meta: { title: 'cruds.hiEventInfo.title' }
          }
        ]
      },
      {
        path: 'hi-venues',
        name: 'hi_venues.index',
        component: () => import('@cruds/HiVenues/Index.vue'),
        meta: { title: 'cruds.hiVenue.title' }
      },
      {
        path: 'hi-venues/create',
        name: 'hi_venues.create',
        component: () => import('@cruds/HiVenues/Create.vue'),
        meta: { title: 'cruds.hiVenue.title' }
      },
      {
        path: 'hi-venues/:id',
        name: 'hi_venues.show',
        component: () => import('@cruds/HiVenues/Show.vue'),
        meta: { title: 'cruds.hiVenue.title' }
      },
      {
        path: 'hi-venues/:id/edit',
        name: 'hi_venues.edit',
        component: () => import('@cruds/HiVenues/Edit.vue'),
        meta: { title: 'cruds.hiVenue.title' }
      }
    ]
  }
]

export default new VueRouter({
  mode: 'history',
  base: '/admin',
  routes
})
