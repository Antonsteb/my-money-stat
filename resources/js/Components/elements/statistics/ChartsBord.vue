<script setup>

import PrimaryButton from "@/Components/form/buttons/PrimaryButton.vue";
import PaymentsFileLoad from "@/Components/elements/my-payments/modals/PaymentsFileLoad.vue";
import Modal from "@/Components/elements/Modal.vue";
import {onMounted, ref} from "vue";
import SetCategory from "@/Components/elements/my-payments/modals/SetCategory.vue";
import {useCategoriesStore} from "@/store/categories.js";
import { GridLayout, GridItem } from "vue3-grid-layout-next"
import LineWrapper from "@/Components/charts/LineWrapper.vue";
import BarWrapper from "@/Components/charts/BarWrapper.vue";
import AddChart from "@/Components/elements/statistics/modals/AddChart.vue";
import {useChartParamsStore} from "@/store/cahrtParams.js";

const props= defineProps({
    charts: Array
})
console.log(props)
const layout = ref([
    { x: 0, y: 2, w: 2, h: 2, i: "0" },
    { x: 2, y: 0, w: 2, h: 2, i: "1" },
    { x: 4, y: 0, w: 2, h: 2, i: "2" },
    { x: 6, y: 0, w: 2, h: 2, i: "3" },
    { x: 8, y: 0, w: 2, h: 2, i: "4" },
    { x: 0, y: 0, w: 2, h: 2, i: "7" },
]);
const draggable = ref(true);
const resizable = ref(true);
const colNum = ref(12);
const index = ref(0);

onMounted(()=> {
    index.value = layout.value.length
})

 function addItem() {
    // Add a new item. It must have a unique key!
    layout.value.push({
        x: 0,
        y: 0,
        w: 1,
        h: 1,
        i: index.value,
    });
    // Increment the counter to ensure key is always unique.
     index.value++;
}
 function removeItem(val) {
    const index = layout.value.map(item => item.i).indexOf(val);
     layout.value.splice(index, 1);
}


const openAddChart = ref(false);
const categoriesStore = useCategoriesStore()
const chartParamsStore = useChartParamsStore()

chartParamsStore.loadIntervals()
categoriesStore.get();
chartParamsStore.loadTypes()

const chartsComponents = { line:LineWrapper, bar:BarWrapper }
</script>

<template>
    <div>
        <PrimaryButton @click="openAddChart= true">Добавить график</PrimaryButton>
        <input type="checkbox" v-model="draggable" class="ml-5 " /><span class="text-gray-100 ml-5">Draggable</span>
        <input type="checkbox" v-model="resizable" class="ml-5"/><span class="text-gray-100 ml-5">Resizable</span>
    </div>
    <div class="mt-10">
        <grid-layout
            :layout.sync="charts"
                     :col-num="24"
                     :row-height="30"
                     :is-draggable="draggable"
                     :is-resizable="resizable"
                     :vertical-compact="true"
                     :use-css-transforms="true"
        >
            <grid-item v-for="item in charts"
                       :static="item.static"
                       :x="item.x"
                       :y="item.y"
                       :w="item.w"
                       :h="item.h"
                       :i="item.i"
                       :key="item.i"
            >
                {{item.type}}
                <component :is="chartsComponents[item.type]" :chartData="item.chartData" :chartLabels="item.chartLabels"></component>
                <span class="remove" @click="removeItem(item.i)">x</span>
            </grid-item>
        </grid-layout>
    </div>

    <Modal :show="openAddChart" @close="openAddChart = false">
        <AddChart />
    </Modal>
</template>


<style scoped>
.layoutJSON {
    background: #ddd;
    border: 1px solid black;
    margin-top: 10px;
    padding: 10px;
}

.columns {
    -moz-columns: 120px;
    -webkit-columns: 120px;
    columns: 120px;
}

/*************************************/

.remove {
    position: absolute;
    right: 2px;
    top: 0;
    cursor: pointer;
}

.vue-grid-layout {
    background: #eee;
}

.vue-grid-item:not(.vue-grid-placeholder) {
    background: #ccc;
    border: 1px solid black;
}

.vue-grid-item .resizing {
    opacity: 0.9;
}

.vue-grid-item .static {
    background: #cce;
}

.vue-grid-item .text {
    font-size: 24px;
    text-align: center;
    position: absolute;
    top: 0;
    bottom: 0;
    left: 0;
    right: 0;
    margin: auto;
    height: 100%;
    width: 100%;
}

.vue-grid-item .no-drag {
    height: 100%;
    width: 100%;
}

.vue-grid-item .minMax {
    font-size: 12px;
}

.vue-grid-item .add {
    cursor: pointer;
}

.vue-draggable-handle {
    position: absolute;
    width: 20px;
    height: 20px;
    top: 0;
    left: 0;
    background: url("data:image/svg+xml;utf8,<svg xmlns='http://www.w3.org/2000/svg' width='10' height='10'><circle cx='5' cy='5' r='5' fill='#999999'/></svg>") no-repeat;
    background-position: bottom right;
    padding: 0 8px 8px 0;
    background-repeat: no-repeat;
    background-origin: content-box;
    box-sizing: border-box;
    cursor: pointer;
}
</style>
