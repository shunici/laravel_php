import Vue from 'vue'
import Vuex from 'vuex'
Vue.use(Vuex)
import bola_stores from './stores/bola'

const store = new Vuex.Store({  
    modules : {
        bola_stores
    },
    //untuk menampung error 
    state: {
       errors: []
    },
    
    mutations: {       
        SET_ERRORS(state, payload) {
            state.errors = payload
        },
        CLEAR_ERRORS(state) {
            state.errors = []
        }
    }
})


export default store