/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import './styles/app.css';
import 'mdb-vue-ui-kit/css/mdb.dark.min.css';

// start the Stimulus application
// import './bootstrap';

import {createApp} from 'vue';
import * as VueRouter from 'vue-router';
import DashboardScreen from "../templates/pages/DashboardScreen.vue";
import BeastsScreen from "../templates/pages/BeastsScreen.vue";
import BeastScreen from "../templates/pages/BeastScreen.vue";

const routes = [
  { path: '/', component: DashboardScreen },
  { path: '/beasts', component: BeastsScreen },
  { path: '/beasts/:id', component: BeastScreen },
]

const router = VueRouter.createRouter({
  history: VueRouter.createWebHashHistory(),
  routes,
})

const app = createApp({
  delimiters: ['${', '}'],
});
app.use(router);
app.mount('#app');