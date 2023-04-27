const routes = [
  { path: '/', component: Dashboard },
  { path: '/beasts', component: Beasts },
]

const router = VueRouter.createRouter({
  history: VueRouter.createWebHashHistory(),
  routes,
})

const app = Vue.createApp({})
app.use(router)
app.mount('#app')