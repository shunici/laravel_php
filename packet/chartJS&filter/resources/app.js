
require('./bootstrap');

window.Vue = require('vue');
import Vue from 'vue'




Vue.component('data-cetakan', require('./components/dataCetakan').default);


const app = new Vue({
    el: '#app',
});
