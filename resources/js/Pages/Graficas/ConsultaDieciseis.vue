<script setup>
import GraficaAvanzada from '@/Components/GraficaAvanzada.vue'
import { computed } from 'vue'

const props = defineProps({
  data: Array // aeropuerto, ciudad, pais, cantidad
})

const labels = computed(() =>
  props.data.map(d => `${d.aereopuerto} (${d.ciudad}, ${d.pais})`)
)

const datasets = computed(() => [{
  label: 'Aeropuerto(s) donde menos personas parten',
  data: props.data.map(d => d.cantidad),
  backgroundColor: labels.value.map(() => getRandomColor()),
  borderWidth: 1
}])

function getRandomColor() {
  const r = Math.floor(Math.random() * 200)
  const g = Math.floor(Math.random() * 200)
  const b = Math.floor(Math.random() * 200)
  return `rgba(${r}, ${g}, ${b}, 0.6)`
}
</script>

<template>
  <div class="p-6">
    <h1 class="text-2xl font-bold mb-4">Consulta Dieciseis</h1>
    <GraficaAvanzada :labels="labels" :datasets="datasets" />
  </div>
</template>
