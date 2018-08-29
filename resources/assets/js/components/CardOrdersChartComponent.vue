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
        self.chartOptions.series.push(buyOrders);
        self.chartOptions.series.push(sellOrders);
        self.chartOptions.series.push(orderMatches);
      });
    },
  },
}
</script>
