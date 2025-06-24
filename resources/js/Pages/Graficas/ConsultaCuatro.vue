<script setup>
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import GraficaConsulta from '@/Components/GraficaConsulta.vue';
import { computed } from 'vue';

const props = defineProps({
    data: {
        type: Object,
        required: true,
    },
});

const labels = computed(() => props.data.map(d => d.anio))
const valores = computed(() => props.data.map(d => d.cantidad))
</script>

<template>
    <div>
        <div class="p-6 lg:p-8 bg-white border-b border-gray-200">
            <ApplicationLogo class="block h-12 w-auto" />

            <h1 class="mt-8 text-2xl font-medium text-gray-900">
                Consulta Número Cuatro
            </h1>


            <div>
                <br>
                <GraficaConsulta :labels="labels" :data="valores" />
            </div>
        </div>
    </div>
</template>
