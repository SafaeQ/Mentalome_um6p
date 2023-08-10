<template>
  <div class="card_1">
    <h3 class="card-title">Heatmap</h3>
    <div id="chart-div"></div>
  </div>
</template>

<script>
function convertToNumber(input) {
  // Remove any non-alphanumeric characters from the input
  const cleanedInput = input.replace(/[^a-zA-Z0-9]/g, '')

  // Convert the cleaned input to a numeric representation
  let numericValue = 0
  for (let i = 0; i < cleanedInput.length; i++) {
    const charCode = cleanedInput.charCodeAt(i)
    numericValue += charCode
  }

  return numericValue
}

google.charts.load('upcoming', { packages: ['vegachart'] }).then(drawChart)

function drawChart() {
  // A DataTable is required, but it can be empty.
  const dataTable = new google.visualization.DataTable()

  const options = {
    vega: {
      $schema: 'https://vega.github.io/schema/vega/v5.json',
      width: "1100",
      height: 500,
      margin:0,
      data: [
        {
          name: 'heatmap',
          url: 'http://127.0.0.1:8000/api/get-chart-data?gene_ids=&disease=Autism&expriment=PRJNA143369',
          transform: [
            {
              type: 'formula',
              as: 'hour',
              expr: 'hours(datum.date)'
            },
            {
              type: 'formula',
              as: 'day',
              expr: 'datetime(year(datum.date), month(datum.date), date(datum.date))'
            }
          ]
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
          range: { scheme: 'redyellowblue' },
          domain: { data: 'heatmap', field: 'value' },
          reverse: true,
          zero: false,
          nice: true
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
              width: { value: 5 },
              height: { scale: 'y', band: 1 }
            },
            update: {
              width: { signal: 20 },
              height: { signal: 35 },
              opacity: { value: 1 },
              strokeWidth: { signal: 0 }
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
