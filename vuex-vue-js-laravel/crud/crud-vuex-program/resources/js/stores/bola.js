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
    //data yang ditambil dari cons action edit_data otomatis ditambahkan disini
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
            })
        })
    },
    //kodingan mengambil data dari controller kemudian meng commitnya dengan
    //membawa data ke SET_EDIT
    edit_data({commit}, payload){       
        return new Promise( (resolve, reject) => {
            Axios.get(`/api/football/edit/${payload}`)
            .then( (response) => {            
                commit('SET_EDIT', response.data.data)
                resolve(response.data)
            } )
        } )
    },
    update_data ({state}, payload) {
        return new Promise( (resolve, reject) => {
            Axios.put(`/api/football/update/${payload}`, state.pemain)
            .then( (response) => {
                console.log(response.data)
                resolve(response.data)
            }  )
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

