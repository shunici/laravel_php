<template>
    <div>
          <router-link :to="{name : 'data.bola' }">Kembali</router-link>
     <form action="#">
         <input type="text" placeholder="masukkan nama" v-model="pemain.nama" >
             <p class="text-danger" v-if="errors.nama">{{ errors.nama[0] }}</p><br>
         <input type="text" placeholder="masukkan klub" v-model="pemain.klub">
          <p class="text-danger" v-if="errors.klub">{{ errors.klub[0] }}</p><br>
         <input type="text" placeholder="masukkan no. punggung" v-model="pemain.nomor_punggung">
          <p class="text-danger" v-if="errors.nomor_punggung">{{ errors.nomor_punggung[0] }}</p><br>
         <button class="btn btn-info" @click.prevent="proses">Proses</button>                  
         
     </form>
     {{errors}}
    </div>
</template>

<script>
import {mapActions, mapState, mapMutations} from 'vuex'
    export default {
        methods : {
            //clear error mutation ini diambil dari store.js
        ...mapMutations(['CLEAR_ERRORS']),
        ...mapMutations('bola_stores', ['BERSIHKAN_FORM']),
        ...mapActions('bola_stores', ['tambah_data']),
            proses () {
                this.tambah_data().then( () => {
                     this.BERSIHKAN_FORM();
                    this.$router.push({ name : 'data.bola'})
                } )
            }
          
        },
         computed: {     
             //error ini diambil dari store.js 
        ...mapState(['errors']),
        ...mapState('bola_stores', {
            pemain: state => state.pemain            
        })
    },
    destroyed : function(){
        this.CLEAR_ERRORS()
    }
    }
</script>