<template>
  <div>
    <select v-model="tipo" class="mb-4 border p-1 rounded">
      <option value="bar">Barras</option>
      <option value="line">Líneas</option>
      <option value="radar">Radar</option>
    </select>

    <div style="position: relative; height: 500px; width: 100%;">
      <canvas ref="canvasRef"></canvas>
    </div>
  </div>
</template>

<script setup>
import {
  Chart,
  BarController,
  LineController,
  RadarController,
  CategoryScale,
  LinearScale,
  BarElement,
  LineElement,
  PointElement,
  RadialLinearScale,
  Tooltip,
  Legend
} from 'chart.js'
import { ref, onMounted, watch } from 'vue'

Chart.register(
  BarController,
  LineController,
  RadarController,
  CategoryScale,
  LinearScale,
  RadialLinearScale,
  BarElement,
  LineElement,
  PointElement,
  Tooltip,
  Legend
)

const props = defineProps({
  labels: Array,
  datasets: Array
})

const tipo = ref('bar')
const canvasRef = ref(null)
let chartInstance = null

const renderChart = () => {
  if (!canvasRef.value || !props.labels.length || !props.datasets.length) return

  if (chartInstance) chartInstance.destroy()

  chartInstance = new Chart(canvasRef.value, {
    type: tipo.value,
    data: {
      labels: props.labels,
      datasets: props.datasets
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,
      scales: {
        x: { stacked: false },
        y: {
          beginAtZero: true,
          ticks: {
            precision: 0
          }
        }
      },
      plugins: {
        legend: {
          position: 'top'
        },
        tooltip: {
          mode: 'nearest',
          intersect: true
        }
      }
    }
  })
}

onMounted(renderChart)
watch(tipo, renderChart)
</script>

<style scoped>
canvas {
  max-width: 100%;
}
</style>