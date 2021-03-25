<template>
  <div class="container">
 
     <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label for="">Bulan</label>
                                        <select v-model="month" class="form-control">
                                            <option value="01">Januari</option>
                                            <option value="02">Februari</option>
                                            <option value="03">Maret</option>
                                            <option value="04">April</option>
                                            <option value="05">Mei</option>
                                            <option value="06">Juni</option>
                                            <option value="07">Juli</option>
                                            <option value="08">Agustus</option>
                                            <option value="09">September</option>
                                            <option value="10">Oktober</option>
                                            <option value="11">November</option>
                                            <option value="12">Desember</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label for="">Tahun</label>
                                        <select v-model="year" class="form-control">
                                            <option v-for="(y, i) in years" :key="i" :value="y">{{ y }}</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <button class="btn btn-primary btn-sm pull-right" @click="exportData">Export</button>
                                </div>
                            </div>
                        </div>
                        <div class="panel-body">
                            <line-chart v-if="dataCetakan.length > 0" :data="tampilkan_data" :option="chartOptions"  :labels="waktu" />
                        </div>
                    </div>
                </div>
            </div>
        </section>    

  </div>
</template> 

<script>
//lodash library js utk menghandel array dll yang kodingannya diawali dengan _.

   import _ from 'lodash'
import axios from "axios";
import moment from "moment";
  import lineChart from './lineChart.vue'
  export default {
    components: {
      lineChart
    },
  
  data() {
    return {
      dataCetakan: [],       
      chartOptions: {
        responsive: true,
        maintainAspectRatio: false
      },
        //DEFAULT bulan  dan tahun YG AKTIF BERDASARKAN BULAN SAAT INI
       month: moment().format('MM'),
       year: moment().format('Y')

    };
  },

// methode create ini akan jalan langsung ketika halaman menuju kesini
// akan menjalankan fungsi ambil_data dengan membawa parameter bulan dan tahun yang diambil dari data diatas berdasarkan hari ini
//
  created () {
    this.ambil_data({
      month : this.month,
      year : this.year
    });
  },
  //ketika ada perubhan request lagi databaru
     watch: {
            month() {
                this.ambil_data({
                    month: this.month,
                    year: this.year
                })
            },          
            year() {
                this.ambil_data({
                    month: this.month, 
                    year: this.year
                })
            }
        },

    methods : {
      //method ambil data sambil membawa parameter bulan dan tahun
        ambil_data(param){            
        axios.get(`/api/ambil?month=${param.month}&year=${param.year}`).then( (response) => {    
                    console.log(response);
               const dataDB  = response.data.data;   
               this.dataCetakan = dataDB;                                        
            }) // tutup axios   
        
        }, //tutup ambil_data
         exportData() {
             window.open(`/api/export?month=${this.month}&year=${this.year}`)
            }

    },  
    computed : {
            //data dari this.cetakan mempunyai beberapa field, kita filter dengan hanya perlu created_at saja
           waktu() {
                return _.map(this.dataCetakan, function(o) {
                    return moment(o.date).format('DD')
                });
            },
            tampilkan_data() {
                return _.map(this.dataCetakan, function(o) {
                    return o.total
                });
            },
              years() {
                return _.range(2015, moment().add(1, 'years').format('Y'))
            },
    } 
    
  
  }
</script>

<style>
  .small {
    max-width: 600px;
    margin:  150px auto;
  }
</style>
