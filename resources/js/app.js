
require('./bootstrap');

import Vue from "vue";
import VueRouter from 'vue-router'

Vue.use(VueRouter);


import routes from './route'
const router = new VueRouter({
    history: true,
    mode: 'history',
    routes
})
Vue.component('app-header', require('./components/Header.vue').default);
new Vue({
    el: '#app',
    router,
});
