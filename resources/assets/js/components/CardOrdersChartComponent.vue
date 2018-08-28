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
        };
        var sellOrders = {
          name: 'Sell Orders',
          data: data.sell_orders,
        };
        var orderMatches = {
          name: 'Order Matches',
          data: data.order_matches,
        };
        this.chartOptions.series.push(buyOrders);
        this.chartOptions.series.push(sellOrders);
        this.chartOptions.series.push(orderMatches);
      });
    },
  },
}
</script>
