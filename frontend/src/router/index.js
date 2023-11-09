import { createRouter, createWebHistory } from 'vue-router'
import home from '../views/Home.vue'
import polls from '../views/Polls.vue' 
import poll from '../views/Poll.vue' 
import login from '../views/Login.vue'
import dashboard from '../views/Dashboard.vue'
import pollEdit from '../views/PollEdit.vue'


const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'home',
      component: home
    },
    {
      path: '/polls',
      name: 'polls',
      component: polls
    },
    {
      path: '/login',
      name: 'login',
      component: login
    },
    {
      path: '/poll/:id',
      name: 'poll',
      component: poll
    },
    {
      path: '/dashboard',
      name: 'dashboard',
      component: dashboard
    },
    {
      path: '/poll/:id/edit',
      name: 'pollEdit',
      component: pollEdit
    },
  ]
})

export default router
