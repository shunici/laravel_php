<script>
import { Line } from "vue-chartjs";
export default {
  extends: Line,
  props: ['data', 'option', 'labels'],
  mounted() {
            this.lineRenderChart()
        },
  watch : {
    data : {
      handler () {
        this._data._chart.destroy()
        this.lineRenderChart()
      },
      deep : true
    }
  },
  methods: {
            lineRenderChart() {
                this.renderChart({
                    labels: this.labels,
                    datasets: [{
                        label: 'Data Cetakan',
                        data: this.data,
                         backgroundColor: '#f87979',
                      pointBorderColor : 'red',
                      borderColor : 'yellow',
                    }]
                }, this.options)
            }
        }
  
};
</script>

