<script setup>
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import GraficaAvanzada from '@/Components/GraficaAvanzada.vue';
import { computed } from 'vue';
import { calcularEstadisticas } from '@/Utils/medidasTendenciaCentral';

const props = defineProps({
    data: {
        type: Object,
        required: true,
    },
});

const labels = computed(() => props.data.map(d => d.estado))
const datasets = computed(() => [{
    label: 'Personas que viajan por estado',
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

const stats = computed(() => calcularEstadisticas(props.data.map(d => d.cantidad)))
</script>

<template>
    <div>
        <div class="p-6 lg:p-8 bg-white border-b border-gray-200">
            <ApplicationLogo class="block h-12 w-auto" />

            <h1 class="mt-8 text-2xl font-medium text-gray-900">
                Consulta Número Diez
            </h1>

            <div class="mt-4 p-4 bg-gray-100 rounded">
                <h2 class="font-bold text-lg mb-2">Estadísticas</h2>
                <p>Media: {{ stats.media.toFixed(2) }}</p>
                <p>Mediana: {{ stats.mediana }}</p>
                <p v-if="stats.moda.length">Moda: {{ stats.moda.join(', ') }}</p>
                <p v-else>Moda: No hay moda</p>
            </div>


            <div>
                <br>
                <GraficaAvanzada :labels="labels" :datasets="datasets" />
            </div>
        </div>
    </div>
</template>
