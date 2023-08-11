<template>
  <div class="card_1">
    <h3 class="card-title">Heatmap</h3>
    <div id="chart-div" :data-filter="filterString"></div>
  </div>
</template>

<script>
function drawChart(obj) {
  // A DataTable is required, but it can be empty.
  const dataTable = new google.visualization.DataTable()
  let filterString = document.getElementById('chart-div').dataset.filter
  const options = {
    vega: {
      $schema: 'https://vega.github.io/schema/vega/v5.json',
      width: '1100',
      height: 500,
      margin: 0,
      data: [
        {
          name: 'heatmap',
          url: `http://127.0.0.1:8000/api/get-chart-data${filterString}`,
          transform: [
            { type: 'formula', as: 'gene_ids', expr: 'datum.gene_ids' },
            {
              type: 'formula',
              as: 'sra',
              expr: 'datum.sra'
            }
          ]
        }
      ],
      signals: [
        {
          name: 'palette',
          value: 'Turbo'
        }
      ],
      scales: [
        {
          name: 'x',
          type: 'band',
          domain: { data: 'heatmap', field: 'sra' },
          range: 'width'
        },
        {
          name: 'y',
          type: 'band',
          domain: { data: 'heatmap', field: 'gene_ids' },
          range: 'height'
        },
        {
          name: 'color',
          type: 'linear',
          range: ['#440154', '#2a768e', '#27ac81', '#fbe624'],
          domain: { data: 'heatmap', field: 'value' },
          reverse: false,
          zero: true,
          nice: true
        },
        {
          name: 'x2',
          type: 'band',
          domain: { data: 'heatmap', field: 'abbreviation' },
          range: 'width'
        }
      ],

      axes: [
        {
          orient: 'bottom',
          scale: 'x',
          domain: false,
          title: 'SRA',
          labelAngle: 75,
          labelAlign: 'left',
          labelBaseline: 'right',
          encode: {
            labels: {
              update: {
                angle: { value: 45 },
                y: { value: 10 }
              }
            }
          }
        },
        {
          orient: 'left',
          scale: 'y',
          domain: false,
          title: 'Gene ids'
        },
        {
          orient: 'top',
          scale: 'x2'
        }
      ],

      legends: [
        {
          fill: 'color',
          type: 'gradient',
          title: 'Value',
          titleFontSize: 12,
          titlePadding: 4,
          gradientLength: { signal: 'height - 16' }
        }
      ],

      marks: [
        {
          type: 'rect',
          from: { data: 'heatmap' },
          encode: {
            enter: {
              x: { scale: 'x', field: 'sra' },
              y: { scale: 'y', field: 'gene_ids' },
              width: { scale: 'x', band: 1 },
              height: { scale: 'y', band: 1 },
              strokeWidth: { signal: 3 }
            },
            update: {
              opacity: { value: 1 },
              strokeWidth: { value: 1 },
              stroke: { value: '#ffffff' },
              fill: { scale: 'color', field: 'value' }
            },
            hover: {
              opacity: { value: 0.5 }
            }
          }
        }
      ]
    }
  }

  const chart = new google.visualization.VegaChart(document.getElementById('chart-div'))
  chart.draw(dataTable, options)
}
export default {
  props: ['filterObj'],
  data: function () {
    return {
      filterString: ''
    }
  },
  watch: {
    filterObj(value) {
      this.filterString = `?gene_ids=${value.gene_ids}&disease=${value.disease}&expriment=${value.expriment}&sra=${value.sra}`
      google.charts.load('upcoming', { packages: ['vegachart'] }).then(drawChart)
    }
  },
  mounted() {
    google.charts.load('upcoming', { packages: ['vegachart'] }).then(drawChart)
  },
  methods: {}
}
</script>

<style>
.card-title {
  color: #262626;
  font-size: 1.5em;
  line-height: normal;
  font-weight: 700;
  margin-bottom: 3em;
  justify-content: center;
  display: flex;
}

.card_1 {
  display: block;
  position: relative;
  height: auto;
  background-color: #ffffff;
  border-radius: 10px;
  padding: 2em 1.2em;
  margin: 12px;
  text-decoration: none;
  z-index: 0;
  overflow: hidden;
  font-family: Arial, Helvetica, sans-serif;
  box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;
  margin-left: 38px;
  margin-right: 38px;
}
#chart-div {
  display: flex;
  justify-content: center;
}
</style>
