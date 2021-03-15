import Axios from "axios"


const state = () => ({
       pemains : [], 
       pemain : {
           nama : '',
           klub : '',
           nomor_punggung : null,
           status : 0           
       }  
})

const mutations = {
    SET_AMBIL( state, payload) {
        state.pemains = payload
    },
    SET_EDIT(state, payload) {
        state.pemain = {
            nama : payload.nama,
            klub : payload.klub,
            nomor_punggung : payload.nomor_punggung,
            status : payload.status
        }
    },
    BERSIHKAN_FORM (state) {
        state.pemain = {
            nama : '',
            klub : '',
            nomor_punggung : '',
            status : 0
        }
    }
}


const actions = {
    ambil_data({ commit }) {
        return new Promise( (resolve, reject) => {
            Axios.get(`/api/football`)
            .then( (response) => {             
                commit('SET_AMBIL', response.data.data)           
                resolve(response.data)
            })
        })
    },
    tambah_data({commit, state, dispatch}) {
        return new Promise ( (resolve, reject) => {
            Axios.post('/api/football/create', state.pemain)
            .then( (response) => {          
                dispatch('ambil_data').then( () => {
                    resolve(response.data)
                })                 
            }) //menangkap error dari controller
            .catch((error) => {               
                if (error.response.status == 422) {
                    commit('SET_ERRORS', error.response.data.errors, { root: true })
                }
            })
        })
    },
    edit_data({commit}, payload){       
        return new Promise( (resolve, reject) => {
            Axios.get(`/api/football/edit/${payload}`)
            .then( (response) => {            
                commit('SET_EDIT', response.data.data)
                resolve(response.data)
            } )
        } )
    },
    update_data ({commit, state}, payload) {
        return new Promise( (resolve, reject) => {
            Axios.put(`/api/football/update/${payload}`, state.pemain)
            .then( (response) => {
                console.log(response.data)
                resolve(response.data)
            }) //menangkap sebuah error
            .catch((error) => {               
                if (error.response.status == 422) {
                    commit('SET_ERRORS', error.response.data.errors, { root: true })
                }
            })
        } )
    },
    hapus_data({ dispatch }, payload) {
        return new Promise ( (resolve, reject) => {
            Axios.delete(`/api/football/delete/${payload}`)
            .then( (response) => {
                dispatch('ambil_data').then( () => resolve() )
            } )
        } )
    }
}





export default {
    namespaced : true,
    state,
    mutations,
    actions
}

