import Vue from 'vue'
import Vuex from 'vuex'
Vue.use(Vuex)
import bola_stores from './stores/bola'

const store = new Vuex.Store({  
    modules : {
        bola_stores
    }
})


export default store