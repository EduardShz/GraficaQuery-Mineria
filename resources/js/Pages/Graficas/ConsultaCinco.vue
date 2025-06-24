<script setup>
import GraficaAvanzada from '@/Components/GraficaAvanzada.vue'
import { computed } from 'vue'
import { calcularEstadisticas } from '@/Utils/medidasTendenciaCentral';

const props = defineProps({
  data: Array // ← este será tu resultado del controlador
})

// labels: meses en orden
const labels = computed(() => [
  'Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio',
  'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'
])

// datasets por año
const datasets = computed(() => {
  const agrupado = {}

  props.data.forEach(({ anio, mes_id, cantidad }) => {
    if (!agrupado[anio]) agrupado[anio] = Array(12).fill(0)
    agrupado[anio][mes_id - 1] = cantidad
  })

  return Object.keys(agrupado).map(anio => ({
    label: `Año ${anio}`,
    data: agrupado[anio],
    backgroundColor: getRandomColor(),
    borderWidth: 1,
    fill: false
  }))
})

function getRandomColor() {
  const r = Math.floor(Math.random() * 200)
  const g = Math.floor(Math.random() * 200)
  const b = Math.floor(Math.random() * 200)
  return `rgba(${r}, ${g}, ${b}, 0.6)`
}

const stats = computed(() => calcularEstadisticas(props.data.map(d => d.cantidad)))
</script>

<template>
  <div class="p-6">
    <h1 class="mt-8 text-2xl font-medium text-gray-900">
      Consulta Número Cinco
    </h1>

    <div class="mt-4 p-4 bg-gray-100 rounded">
      <h2 class="font-bold text-lg mb-2">Estadísticas</h2>
      <p>Media: {{ stats.media.toFixed(2) }}</p>
      <p>Mediana: {{ stats.mediana }}</p>
      <p v-if="stats.moda.length">Moda: {{ stats.moda.join(', ') }}</p>
      <p v-else>Moda: No hay moda</p>
    </div>

    <GraficaAvanzada :labels="labels" :datasets="datasets" />
  </div>
</template>
