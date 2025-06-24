<script setup>
import {
    Chart,
    BarController,
    BarElement,
    CategoryScale,
    LinearScale,
    PieController,
    ArcElement,
} from 'chart.js'

import { onMounted, ref, watch } from 'vue'

Chart.register(
    BarController,
    BarElement,
    CategoryScale,
    LinearScale,
    PieController,
    ArcElement
)

const props = defineProps({
    labels: Array,
    data: Array
})

const tipo = ref('bar')
const canvasRef = ref(null)
let chartInstance = null

const renderChart = () => {
    if (chartInstance) chartInstance.destroy()

    const config = {
        type: tipo.value === 'horizontalBar' ? 'bar' : tipo.value,
        data: {
            labels: props.labels,
            datasets: [{
                label: 'Resultados',
                data: props.data,
                backgroundColor: 'rgba(54, 162, 235, 0.6)',
            }]
        },
        options: {
            indexAxis: tipo.value === 'horizontalBar' ? 'y' : 'x',
            responsive: true,
        }
    }

    chartInstance = new Chart(canvasRef.value, config)
}

onMounted(() => renderChart())
watch(tipo, () => renderChart())
</script>

<template>
    <div>
        <select v-model="tipo" class="mb-4 p-1 border">
            <option value="bar">Barras Verticales</option>
            <option value="horizontalBar">Barras Horizontales</option>
            <option value="pie">Pastel</option>
        </select>

        <canvas ref="canvasRef"></canvas>
    </div>
</template>
