<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import ConsultaUno from './ConsultaUno.vue';
import ConsultaDos from './ConsultaDos.vue';
import ConsultaTres from './ConsultaTres.vue';
import ConsultaCuatro from './ConsultaCuatro.vue';
import ConsultaCinco from './ConsultaCinco.vue';
import ConsultaSeis from './ConsultaSeis.vue';
import ConsultaSiete from './ConsultaSiete.vue';
import ConsultaOcho from './ConsultaOcho.vue';
import ConsultaNueve from './ConsultaNueve.vue';
import ConsultaDiez from './ConsultaDiez.vue';
import ConsultaOnce from './ConsultaOnce.vue';
import ConsultaDoce from './ConsultaDoce.vue';
import ConsultaTrece from './ConsultaTrece.vue';

const props = defineProps({
    estados: {
        type: Object,
    },
    consultaUno: {
        type: Object,
        required: true,
    },
    consultaDos: {
        type: Array,
        required: true,
    },
    consultaTres: {
        type: Array,
        required: true,
    },
    consultaTresEstado: {
        required: true,
    },
    consultaCuatro: {
        type: Array,
        required: true,
    },
    consultaCinco: {
        type: Array,
        required: true,
    },
    consultaSeis: {
        type: Array,
        required: true,
    },
    consultaSiete: {
        type: Array,
        required: true,
    },
    consultaOcho: {
        type: Array,
        required: true,
    },
    consultaNueve: {
        type: Array,
        required: true,
    },
    consultaDiez: {
        type: Array,
        required: true,
    },
    consultaOnce: {
        type: Array,
        required: true,
    },
    consultaDoce: {
        type: Array,
        required: true,
    },
    consultaTrece: {
        type: Array,
        required: true,
    },
    consultaCatorce: {
        type: Array,
        required: true,
    },
    consultaQuince: {
        type: Array,
        required: true,
    },
    consultaDieciseis: {
        type: Array,
        required: true,
    },
    consultaDiecisiete: {
        type: Array,
        required: true,
    },
    consultaDieciocho: {
        type: Array,
        required: true,
    },
});
</script>

<template>
    <AppLayout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Graficas
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <ConsultaUno :consulta-uno="consultaUno" />
                </div>
            </div>
        </div>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <ConsultaDos :consulta-dos="consultaDos" />
                </div>
            </div>
        </div>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <ConsultaTres :data="consultaTres" :estado="consultaTresEstado" :estados-disponibles="estados"
                        :in-index="true" />
                </div>
            </div>
        </div>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <ConsultaCuatro :data="consultaCuatro" />
                </div>
            </div>
        </div>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <ConsultaCinco :data="consultaCinco" />
                </div>
            </div>
        </div>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <ConsultaSeis :data="consultaSeis" />
                </div>
            </div>
        </div>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <ConsultaSiete :data="consultaSiete" />
                </div>
            </div>
        </div>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <ConsultaOcho :data="consultaOcho" />
                </div>
            </div>
        </div>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <ConsultaNueve :data="consultaNueve" />
                </div>
            </div>
        </div>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <ConsultaDiez :data="consultaDiez" />
                </div>
            </div>
        </div>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <ConsultaOnce :data="consultaOnce" />
                </div>
            </div>
        </div>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <ConsultaDoce :data="consultaDoce" />
                </div>
            </div>
        </div>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <ConsultaTrece :data="consultaTrece" />
                </div>
            </div>
        </div>
    </AppLayout>
</template>
