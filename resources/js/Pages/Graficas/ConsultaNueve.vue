<script setup>
import GraficaAvanzada from '@/Components/GraficaAvanzada.vue'
import { computed } from 'vue'

const props = defineProps({
  data: Array
})

// Obtener todos los anios distintos y ordenarlos
const labels = computed(() => {
  return [...new Set(props.data.map(d => d.anio))].sort()
})

// Agrupar por aeropuerto
const datasets = computed(() => {
  const agrupado = {}

  props.data.forEach(({ anio, aerolinea, cantidad }) => {
    if (!agrupado[aerolinea]) agrupado[aerolinea] = {}
    agrupado[aerolinea][anio] = cantidad
  })

  return Object.keys(agrupado).map(aerolinea => ({
    label: aerolinea,
    data: labels.value.map(anio => agrupado[aerolinea][anio] || 0),
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
</script>

<template>
  <div class="p-6">
    <h1 class="text-2xl font-bold mb-4">Consulta Nueve</h1>
    <GraficaAvanzada :labels="labels" :datasets="datasets" />
  </div>
</template>
