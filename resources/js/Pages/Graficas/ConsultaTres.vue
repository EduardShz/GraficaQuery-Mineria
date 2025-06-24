<script setup>
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import GraficaAvanzada from '@/Components/GraficaAvanzada.vue';
import { computed, ref } from 'vue';
import { router } from '@inertiajs/vue3';
import { calcularEstadisticas } from '@/Utils/medidasTendenciaCentral';

const props = defineProps({
  data: {
    type: Array,
    required: true,
  },
  estado: {
    type: String,
    required: true
  },
  estadosDisponibles: {
    type: Array,
    required: true
  },
  inIndex: {
    type: Boolean,
    required: false,
    default: false,
  }
})

const estadoSeleccionado = ref(props.estado)

// Emitir navegación con estado nuevo
function actualizarEstado() {
  if (props.inIndex == true) {
    router.get('/graficas', { estado: estadoSeleccionado.value }, { preserveScroll: true })
  } else {
    router.get('/graficas/third-query', { estado: estadoSeleccionado.value }, { preserveScroll: true })
  }
}

// labels = municipios
const labels = computed(() => {
  return props.data.map(d => d.municipio)
})

// dataset único con cantidades
const datasets = computed(() => [{
  label: `Personas que viajaron en ${estadoSeleccionado.value}`,
  data: props.data.map(d => d.cantidad),
  backgroundColor: 'rgba(54, 162, 235, 0.6)',
  borderWidth: 1
}])

const stats = computed(() => calcularEstadisticas(props.data.map(d => d.cantidad)))
</script>

<template>
  <div>
    <div class="p-6 lg:p-8 bg-white border-b border-gray-200">
      <ApplicationLogo class="block h-12 w-auto" />

      <h1 class="mt-8 text-2xl font-medium text-gray-900">
        Consulta Tres
      </h1>

      <div class="mt-4 p-4 bg-gray-100 rounded">
        <h2 class="font-bold text-lg mb-2">Estadísticas</h2>
        <p>Media: {{ stats.media.toFixed(2) }}</p>
        <p>Mediana: {{ stats.mediana }}</p>
        <p v-if="stats.moda.length">Moda: {{ stats.moda.join(', ') }}</p>
        <p v-else>Moda: No hay moda</p>
      </div>

      <div class="mt-4 mb-6">
        <label for="estado" class="block mb-1 text-gray-700">Selecciona un estado:</label>
        <select id="estado" v-model="estadoSeleccionado" @change="actualizarEstado" class="border rounded p-2">
          <option v-for="e in estadosDisponibles" :key="e" :value="e.nombre">{{ e.nombre }}</option>
        </select>
      </div>

      <GraficaAvanzada :labels="labels" :datasets="datasets" />
    </div>
  </div>
</template>
