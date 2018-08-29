<template>
  <div>
    <highcharts :options="chartOptions"></highcharts>
  </div>
</template>

<script>
import {Chart} from 'highcharts-vue'

export default {
  props: ['card', 'source'],
  components: {
    highcharts: Chart
  },
  data() {
    return {
      chartOptions: {
        chart: {
            type: 'column'
        },
        title: {
          text: 'Dex Order Activity'
        },
        subtitle: {
          text: 'Source: DIGIRARE.com'
        },
        xAxis: {
          type: 'category'
        },
        yAxis: {
          title: {
            text: 'Count (#)'
          }
        },
        tooltip: {
          shared: true
        },
        credits: {
          enabled: false
        },
        series: []
      }
    }
  },
  mounted() {
    this.$_chart_update()
  },
  methods: {
    $_chart_update() {
      var api = this.source
      var self = this
      $.get(api, function(data) {
        var buys = {
          name: 'Buys',
          data: data.buys,
        };
        var sells = {
          name: 'Sells',
          data: data.sells,
        };
        self.chartOptions.series.push(buys);
        self.chartOptions.series.push(sells);
      });
    },
  },
}
</script>
