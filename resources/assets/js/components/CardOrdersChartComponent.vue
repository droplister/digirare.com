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
        var buyOrders = {
          name: 'Buy Orders',
          data: data.buy_orders,
          xAxis: this.$children[0].chart.xAxis.length - 1,
          yAxis: this.$children[0].chart.yAxis.length - 1
        };
        this.chartOptions.series.push(buyOrders);
        var sellOrders = {
          name: 'Sell Orders',
          data: data.sell_orders,
          xAxis: this.$children[0].chart.xAxis.length - 1,
          yAxis: this.$children[0].chart.yAxis.length - 1
        };
        this.chartOptions.series.push(sellOrders);
        var orderMatches = {
          name: 'Order Matches',
          data: data.order_matches,
          xAxis: this.$children[0].chart.xAxis.length - 1,
          yAxis: this.$children[0].chart.yAxis.length - 1
        };
        this.chartOptions.series.push(orderMatches);
      });
    },
  },
}
</script>
