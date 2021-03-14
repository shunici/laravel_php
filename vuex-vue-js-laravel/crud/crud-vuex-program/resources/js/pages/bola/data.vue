<template>
    <div>
  <router-link :to="{name : 'tambah.bola' }">Tambah</router-link>
        <table class="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Klub</th>
                    <th>No</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(item, index) in pemains" :key="index">
                    <td scope="row">{{item.nama}}</td>
                    <td>{{item.klub}}</td>
                    <td>{{item.nomor_punggung}}</td>
                      <td>{{item.status}}</td>
                      <td>{{item.created_at}}</td>
                      <td>
                          <!-- ini kode yang kita tambahkan -->
                          <router-link :to="{ name: 'edit.bola', params: {id: item.id} }">Edit</router-link>
                          <button @click.prevent="hapus(item.id)">Delete</button>
                      </td>
                </tr>               
            </tbody>
        </table>   
    
        <h2></h2>
    </div>
</template>



<script>
import {mapActions, mapState} from 'vuex'
    export default {
        created () {
                this.ambil_data();
        },
        computed : {
            ...mapState('bola_stores', {
                pemains : function(state) {
                    return state.pemains
                }
            })
        },
        methods : {
            //daftarkan semua fungsi action yang sudah dibuat di stores/bola.js dengan ...mapAction
            ...mapActions('bola_stores', ['ambil_data', 'hapus_data']),
            hapus(data_id) {
                this.hapus_data(data_id);
            }
        }
    }
</script>