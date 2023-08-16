<template>
  <div>
    <section class="canvas" id="filter" role="filter">
      <div class="container">
        <div class="card mb-5 p-3">
          <div class="title mb-5 my-3">
            <h2 class="fw-bold text-center">Heatmap</h2>
          </div>
          <div class="w-100" style="overflow: auto">
            <div class="div-3">
              <div class="color-div"></div>
              <div class="color-div2"></div>
            </div>
            <div id="chart-div" :data-filter="filterString"></div>
            <div class="divider"></div>
            <div>
              <h6>Abbreviation:</h6>
              <div class="main_ct">
                <div class="square_ct"></div>
                <span>CT</span>
              </div>
              <div class="main_pt">
                <div class="square_pt"></div>
                PT
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
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
          type: 'threshold',
          domain: ['0', '1', '2'],
          range: ['#56bd89', '#56bd89', '#6e85b7', '#6e85b7']
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
        }
        // {
        //   orient: 'top',
        //   scale: 'x2'
        // }
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
        // {
        //   orient: 'top',
        //   fill: 'x2',
        //   direction: 'horizontal',
        //   titleFontSize: 12,
        //   titlePadding: 4,
        //   gradientLength: { signal: 'width - 16' }
        // }
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
<style scoped>
.canvas .title {
  color: #33cc75;
}

.div-3 {
  display: flex;
  flex-direction: row;
  margin-left: 5%;
  margin-right: 8%;
}
.color-div {
  width: 100%;
  height: 10px;
  background-color: #56bd89;
  float: left;
}

.color-div2 {
  width: 100%;
  height: 10px;
  background-color: #6e85b7;
  float: left;
}
.divider {
  clear: both;
  width: 100%;
  height: 0.5px;
  background-color: rgb(209, 209, 209);
  margin-top: 2%;
  margin-bottom: 2%;
}

.main_ct {
  display: flex;
  flex-direction: row;
  gap: 6px;
  margin-left: 20px;
}
.square_ct {
  width: 20px;
  height: 20px;
  background-color: #56bd89;
}
.main_pt {
  display: flex;
  flex-direction: row;
  gap: 6px;
  margin-left: 20px;
}
.square_pt {
  width: 20px;
  height: 20px;
  background-color: #6e85b7;
}
</style>
