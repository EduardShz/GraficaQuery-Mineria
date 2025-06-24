<script setup>
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import GraficaAvanzada from '@/Components/GraficaAvanzada.vue';
import { computed } from 'vue';

const props = defineProps({
    data: {
        type: Object,
        required: true,
    },
});

const labels = computed(() => props.data.map(d => d.categoria))
const datasets = computed(() => [{
    label: 'Personas que viajaron por categoría de edad',
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
    <div>
        <div class="p-6 lg:p-8 bg-white border-b border-gray-200">
            <ApplicationLogo class="block h-12 w-auto" />

            <h1 class="mt-8 text-2xl font-medium text-gray-900">
                Consulta Número Seis
            </h1>


            <div>
                <br>
                <GraficaAvanzada :labels="labels" :datasets="datasets" />
            </div>
        </div>
    </div>
</template>
