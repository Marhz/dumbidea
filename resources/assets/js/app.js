
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

Vue.component('multi-select', require('./components/MultiSelect.vue'));
Vue.component('v-award', require('./components/Award.vue'));
Vue.component('v-comments', require('./components/Comments.vue'));
Vue.component('v-comment', require('./components/Comment.vue'));
Vue.component('async-img', require('./components/AsyncImg.vue'));
Vue.component('v-tabs', require('./components/Tabs.vue'));
Vue.component('v-tab', require('./components/Tab.vue'));

const app = new Vue({
    el: '#app'
});
