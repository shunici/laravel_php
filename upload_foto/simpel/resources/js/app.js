
require('./bootstrap');

window.Vue = require('vue');

Vue.component('upload-foto', require('./components/uploadFoto.vue').default)

const app = new Vue({
    el: '#app',   
});
