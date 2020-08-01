require('./bootstrap');

Vue.component('pagination', require('laravel-vue-pagination'));
Vue.component('match-table', require ('./admin/match/Table.vue'));

const app = new Vue({
    el: '#match',
})