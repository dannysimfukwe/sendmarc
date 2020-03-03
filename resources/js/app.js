require('./bootstrap');
window.Vue = require('vue');
window.axios = require('axios');
Vue.prototype.$http = window.axios;
import { BootstrapVue, IconsPlugin } from 'bootstrap-vue'
import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'
import store from './store/index'
Vue.use(BootstrapVue)
Vue.component(
  'task',
  require('./components/Task.vue').default
);

const app = new Vue({
    el: '#app',
    store
});