<template>
  <div>
    <div class="field is-grouped">    
      <div class="control" v-for="row in kategori" :key="row">
        <label class="checkbox">
          <input type="checkbox" :value="row" v-model="selectedKategori">
              {{row}}
        </label>
      </div>     
  

      <select v-model="chart_terpilih">
            <option disabled value="">Pilih Grafis</option>
            <option>bar</option>
            <option>line</option>            
      </select>                                 
    </div>    
    <h3>{{chart_terpilih}}</h3>

    <div class="container">
      <div class="row">
        <div class="col-md-6">
              <line-chart
      :width="30"
      :height="30"
      :labels="bulan"
      :datasets="displayedDatasets"
      :options="$options.options"
      :tipe_chart="chart_terpilih"
    ></line-chart>
        </div>
  {{selectedKategori}}
      </div>
    </div>

  </div>
</template>

<script>
import LineChart from './LineChart';

const options = {
 
};
export default {
  name: 'bulanan cetakan ',  
  options,
  components: {
    LineChart
  },
  data() {
    return {     
      chart_terpilih : 'bar',   
      kategori : [], // ini untuk select looping
      selectedKategori: [],
      bulan : ['Jan', 'Feb', 'Mar', 'Apr', 'May'],
      datasets : {}    
    }
  },
  computed: {
    displayedDatasets() {     
      return this.selectedKategori.map(ktgri => this.datasets[ktgri]);
    }
  },
  methods : {
    ambil_data(){   
              axios.get('/api/ambil').then( (response) =>{
              const {data} = response;
               const {
              label, borderColor, backgroundColor, total
               } = data.data;
                let panjang = data.data; 
              panjang.map(a => {                            
                this.kategori.push(a.kategori);
                this.selectedKategori.push(a.kategori);
                //buat objeck
                this.datasets[ a.kategori ] = {}; //buat objek
                  this.datasets[ a.kategori ]['label'] = a.kategori;  //buat kategori dari objek yang dibuat
                  this.datasets[ a.kategori ]['borderColor'] = a.borderColor;
                    this.datasets[ a.kategori ]['backgroundColor'] = a.backgroundColor;
                this.datasets[ a.kategori ]['data'] =JSON.parse(a.total);          
              }) 


          } )   //axios         
     
    } //tutup ambil data()
  },
  created() {
    //ini akan diload  pertama
    this.ambil_data()
}

}
</script>

