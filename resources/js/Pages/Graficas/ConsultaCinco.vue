<script setup>
import GraficaAvanzada from '@/Components/GraficaAvanzada.vue'
import { computed } from 'vue'

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
</script>

<template>
  <div class="p-6">
    <h1 class="text-2xl font-bold mb-4">Personas que viajaron por mes y año</h1>
    <GraficaAvanzada :labels="labels" :datasets="datasets" />
  </div>
</template>
