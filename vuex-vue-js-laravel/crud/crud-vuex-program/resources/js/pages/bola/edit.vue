<template>
    <div>
          <router-link :to="{name : 'data.bola' }">Kembali</router-link>
     <form action="#">
         <input type="text" placeholder="masukkan nama" v-model="pemain.nama" > <br>
         <input type="text" placeholder="masukkan klub" v-model="pemain.klub"><br>
         <input type="text" placeholder="masukkan no. punggung" v-model="pemain.nomor_punggung"> <br>
         <button class="btn btn-info" @click.prevent="update">Proses</button>                  
         
     </form>     
     {{pemain}}
    </div>
</template>

<script>
//mendaftar kan vuex map
import {mapActions, mapState, mapMutations} from 'vuex'
    export default {
        //kode ini langsung mengambil data id pada route date.vue kemudian mengirim fungsi ke stores/bola js pada metode edit data
        created () {
                  this.edit_data(this.$route.params.id);
        },
        methods : {
        ...mapMutations('bola_stores', ['BERSIHKAN_FORM']),
        ...mapActions('bola_stores', ['edit_data', 'update_data']),
            update () {
                let id = this.$route.params.id;
                this.update_data(id).then( () => {
                    this.$router.push({ name : 'data.bola'})
                } )
            }
          
        },
        //mengambil data dari state
         computed: {      
            ...mapState('bola_stores', {
                pemain: state => state.pemain
            }),      
        },
          //ketika page ini ditinggalkan bersihkan form dengan siklus hidup vue js methode
        destroyed() {   
            //this bersihkan form bisa ditaruh di store actionnya kemudian commit      
        this.BERSIHKAN_FORM();
         }
    }
</script>