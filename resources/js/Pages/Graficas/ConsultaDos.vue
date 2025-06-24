<script setup>
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import GraficaAvanzada from '@/Components/GraficaAvanzada.vue';
import { computed } from 'vue';
import { calcularEstadisticas } from '@/Utils/medidasTendenciaCentral';

const props = defineProps({
  data: {
    type: Array,
    required: true,
  },
});

// Obtener todos los años únicos
const labels = computed(() => {
  return [...new Set(props.data.map(d => d.anio))].sort();
});

// Agrupar por estado y construir datasets por año
const datasets = computed(() => {
  const agrupado = {};

  props.data.forEach(({ estado, anio, cantidad }) => {
    if (!agrupado[estado]) agrupado[estado] = {};
    agrupado[estado][anio] = cantidad;
  });

  return Object.keys(agrupado).map(estado => ({
    label: estado,
    data: labels.value.map(anio => agrupado[estado][anio] || 0),
    backgroundColor: getRandomColor(),
    borderWidth: 1,
    fill: false
  }));
});

// Color aleatorio para cada dataset
function getRandomColor() {
  const r = Math.floor(Math.random() * 200);
  const g = Math.floor(Math.random() * 200);
  const b = Math.floor(Math.random() * 200);
  return `rgba(${r}, ${g}, ${b}, 0.6)`;
}

const stats = computed(() => calcularEstadisticas(props.data.map(d => d.cantidad)))
</script>

<template>
  <div>
    <div class="p-6 lg:p-8 bg-white border-b border-gray-200">
      <ApplicationLogo class="block h-12 w-auto" />

      <h1 class="mt-8 text-2xl font-medium text-gray-900">
        Consulta Número Dos
      </h1>

      <div class="mt-4 p-4 bg-gray-100 rounded">
        <h2 class="font-bold text-lg mb-2">Estadísticas</h2>
        <p>Media: {{ stats.media.toFixed(2) }}</p>
        <p>Mediana: {{ stats.mediana }}</p>
        <p>Moda: {{ stats.moda.join(', ') }}</p>
      </div>

      <div class="mt-6">
        <GraficaAvanzada :labels="labels" :datasets="datasets" />
      </div>
    </div>
  </div>
</template>
