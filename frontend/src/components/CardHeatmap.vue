<template>
  <div class="card_1">
    <h3 class="card-title">Heatmap</h3>
    <div id="chart-div" style="width: 500px; margin: auto; height: 500px"></div>
  </div>
</template>

<!-- <script>
export default {
  data() {
    return {}
  },
  mounted() {
    google.charts.load('upcoming', { packages: ['vegachart'] }).then(drawChart)

    function drawChart() {
      // A DataTable is required, but it can be empty.
      const dataTable = new google.visualization.DataTable()
      console.log(dataTable)
      const options = {
        vega: {
          $schema: 'https://vega.github.io/schema/vega/v5.json',
          width: 500,
          height: 500,
          padding: 5,

          data: [
            {
              name: 'heartmap',
              url: 'C:\Users\Youcode\Desktop\Mentalome_um6p\backend\data\test_data.csv',
              format: { type: 'csv', parse: { gene_ids: 'string', sra: 'string', value:'number' } },
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
              domain: { data: 'heartmap', field: 'gene_ids' },
              range: 'width'
            },
            {
              name: 'y',
              type: 'band',
              domain: [
                6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 0, 1, 2, 3, 4, 5
              ],
              range: 'height'
            },
            {
              name: 'color',
              type: 'linear',
              range: { scheme: 'redyellowblue' },
              domain: { data: 'heartmap', field: 'value' },
              reverse: true,
              zero: false,
              nice: true
            }
          ],

          axes: [
            { orient: 'bottom', scale: 'x', domain: false, title: 'Month', format: '%b' },
            {
              orient: 'left',
              scale: 'y',
              domain: false,
              title: 'Hour',
              encode: {
                labels: {
                  update: {
                    text: {
                      signal:
                        "datum.value === 0 ? 'Midnight' : datum.value === 12 ? 'Noon' : datum.value < 12 ? datum.value + ':00 am' : (datum.value - 12) + ':00 pm'"
                    }
                  }
                }
              }
            }
          ],

          legends: [
            {
              fill: 'color',
              type: 'gradient',
              title: 'Avg. Temp (°F)',
              titleFontSize: 12,
              titlePadding: 4,
              gradientLength: { signal: 'height - 16' }
            }
          ],

          // marks: [
          //   {
          //     type: 'rect',
          //     from: { data: 'temperature' },
          //     encode: {
          //       enter: {
          //         x: { scale: 'x', field: 'day' },
          //         y: { scale: 'y', field: 'hour' },
          //         width: { value: 5 },
          //         height: { scale: 'y', band: 1 },
          //         tooltip: {
          //           signal:
          //             "timeFormat(datum.date, '%b %d %I:00 %p') + ': ' + datum.temperature + '°'"
          //         }
          //       },
          //       update: {
          //         fill: { scale: 'color', field: 'temperature' }
          //       }
          //     }
          //   }
          // ]
        }
      }

      const chart = new google.visualization.VegaChart(document.getElementById('chart-div'))
      chart.draw(dataTable, options)
    }
  }
}
</script> -->

<script>
google.charts.load('upcoming', { packages: ['vegachart'] }).then(drawChart)

function drawChart() {
  const dataTable = new google.visualization.DataTable()

  const options = {
    vega: {
      $schema: 'https://vega.github.io/schema/vega/v5.json',
      width: 500,
      height: 500,
      padding: 5,

      data: [
        {
          name: 'temperature',
          url: 'C:\Users\Youcode\Desktop\Mentalome_um6p\backend\data\test_data.csv',
          format: { type: 'csv', parse: { gene_ids: 'string', sra: 'string', value: 'number' } },
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
          type: 'time',
          domain: { data: 'temperature', field: 'gene_ids' },
          range: 'width'
        },
        {
          name: 'y',
          type: 'band',
          domain: [
            6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 0, 1, 2, 3, 4, 5
          ],
          range: 'height'
        },
        {
          name: 'color',
          type: 'linear',
          range: { scheme: 'redyellowblue' },
          domain: { data: 'temperature', field: 'value' },
          reverse: true,
          zero: false,
          nice: true
        }
      ],

      axes: [
        { orient: 'bottom', scale: 'x', domain: false, title: 'SRA', format: '%b' },
        {
          orient: 'left',
          scale: 'y',
          domain: false,
          title: 'Gene Id',
          encode: {
            labels: {
              update: {
                text: {
                  signal:
                    "datum.value === 0 ? 'Midnight' : datum.value === 12 ? 'Noon' : datum.value < 12 ? datum.value + ':00 am' : (datum.value - 12) + ':00 pm'"
                }
              }
            }
          }
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
          from: { data: 'temperature' },
          encode: {
            enter: {
              x: { scale: 'x', field: 'gene_ids' },
              y: { scale: 'y', field: 'value' },
              width: { value: 5 },
              height: { scale: 'y', band: 1 },
              tooltip: {
                signal:
                  "datum.gene_ids + ' - ' + timeFormat(datum.date, '%b %d %I:00 %p') + ': ' + datum.value + '°'"
              }
            },
            update: {
              fill: { scale: 'color', field: 'value' }
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
  max-width: auto;
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
  align-items: center;
}
</style>
