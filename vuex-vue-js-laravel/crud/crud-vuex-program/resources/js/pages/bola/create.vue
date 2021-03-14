<template>
    <div>
          <router-link :to="{name : 'data.bola' }">Kembali</router-link>
     <form action="#">
         <input type="text" placeholder="masukkan nama" v-model="pemain.nama" > <br>
         <input type="text" placeholder="masukkan klub" v-model="pemain.klub"><br>
         <input type="text" placeholder="masukkan no. punggung" v-model="pemain.nomor_punggung"> <br>
         <button class="btn btn-info" @click.prevent="proses">Proses</button>                  
         
     </form>
    </div>
</template>

<script>
import {mapActions, mapState} from 'vuex'
    export default {
        methods : {
        ...mapActions('bola_stores', ['tambah_data']),
            proses () {
                this.tambah_data().then( () => {
                    this.$router.push({ name : 'data.bola'})
                } )
            }
          
        },
         computed: {      
        ...mapState('bola_stores', {
            pemain: state => state.pemain
        })
    },
    }
</script>