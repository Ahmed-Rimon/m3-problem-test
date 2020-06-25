/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */



require('./bootstrap');
// require('admin-lte');

window.Vue = require('vue');
import { Form, HasError, AlertError } from 'vform';
import moment from 'moment';
import { values } from 'lodash';


window.form = Form;
Vue.component(HasError.name, HasError)
Vue.component(AlertError.name, AlertError)


import VueRouter from 'vue-router'
Vue.use(VueRouter)

import VueProgressBar from 'vue-progressbar'
Vue.use(VueProgressBar, {
    color: 'rgb(143,255,199)',
    failedColor: 'red',
    height: '2px'
});

let routes = [
    { path: '/dashboard', component: require('./components/dashboard.vue').default },
    { path: '/profile', component: require('./components/profile.vue').default },
    { path: '/users', component: require('./components/users.vue').default },
    { path: '/sellers', component: require('./components/Sellers.vue').default },
    { path: '/products', component: require('./components/products.vue').default },
    { path: '/history', component: require('./components/history.vue').default }




]


const router = new VueRouter({
    mode: 'history',
    routes,
    linkActiveClass: 'active'
})


// filter for design and make my work easy

Vue.filter('newDate', function(dates) {
    return moment(dates).format('MMMM Do YYYY');
})

Vue.filter('upText', function(text) {
    return text.charAt(0).toUpperCase() + text.slice(1);
});

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    router
});