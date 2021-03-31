<template>
    <div class="container">
        <div class="row">


                <div class="col-lg-6 ">
                    <h2>Read data</h2>

                    <div class="card" v-for="(row, index) in pemains" :key="index">
                        <div class="card-body">
                                nama : {{row.nama}}<br>
                                Klub : {{row.klub}}<br>
                                <img id="preview" :src=" '/storage/foto/' + row.foto"
                                :width="150" :height="150">
                                <button @click="hapus(row.id)" class="btn btn-danger">Hapus</button>
                        </div>
                    </div>                
                </div>



            <div class="col-lg-6 ">
                <h2>Upload Foto</h2>
                  <form action="#" @submit.prevent="proses">
                    <input type="text" v-model="pemain.nama"> <br>
                    <input type="text" v-model="pemain.klub"><br>
                    <input type="file"  @change="uploadImage($event)">
                     <div id="preview">
                         <img v-if="tampil_foto" :src="tampil_foto" />
                    </div>
                    <button type="submit">Proses</button>
                </form>
            </div>


        </div>      
    </div>
</template>

<script>

    export default{
        data(){
            return {
                //ini untuk upload foto
                tampil_foto : '',
                pemain : {
                    nama : '',
                    klub : '',
                    foto : '',
                },
                // ini untuk ambil foto
               pemains : []
                
            }
        },
        methods: {
            uploadImage(event){     
                        this.pemain.foto = event.target.files[0];                     
                        this.tampil_foto = URL.createObjectURL(this.pemain.foto);
            },
            proses(){
                let form = new FormData();
                form.append('nama', this.pemain.nama);
                form.append('klub', this.pemain.klub);
                form.append('foto', this.pemain.foto);
                axios.post('/api/upload', form,                
                {
                    headers: {'Content-Type': 'multipart/form-data'}
                })
                .then( (response) => { console.log(response)
                  this.ambil_data();
                } )

            },
            ambil_data(){
                axios.get('/api/ambil_data')
                .then( response =>{
                        this.pemains = response.data.data

                })
            },
            hapus(id){
                axios.delete(`/api/hapus/${id}`)
                .then( response =>{
                    console.log(response.data);
                    this.ambil_data()
                })
            }   
        },
        created() {
            this.ambil_data()
        }
    }
</script>

<style scoped>
body {
  background-color: #e2e2e2;
}
#preview { 
  justify-content: center;
  align-items: center;
}

#preview img {
  max-width: 260px;
  max-height: 500px;
}
</style>
    
