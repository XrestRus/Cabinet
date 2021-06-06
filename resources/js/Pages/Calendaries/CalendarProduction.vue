<template>
<div class="visit-show">
    <tools-panel>
        <select v-model="selectedYear">
            <option 
                v-for="s of years"
                :key="s"
            >
                {{ s }}            
            </option>
        </select>
        <div @click="setDefaultDate" class="tools-item svg-current" ref='input'><span></span></div>
    </tools-panel>

    <div class="visit view r">

        <iframe :src='path' class="c" sandbox="allow-scripts">

        </iframe>

    </div>
</div>
</template>

<script>
import WorkLayout from '@/Layouts/WorkLayout.vue';
import ToolsPanel from "@/Components/Shared/ToolsPanel.vue";
import { ref } from 'vue';

export default {
    layout: WorkLayout,

    components: {
        ToolsPanel
    },

    setup() {
        const selectedYear = ref(new Date().getFullYear());
        const years = [selectedYear.value, selectedYear.value + 1, selectedYear.value + 2];

        return {
            selectedYear,
            years,
        }
    },
    
    computed: {
        path() {
            return 'https://calendar.yoip.ru/print/'+ this.selectedYear +'-proizvodstvennyj-calendar.html';
        }
    },

    methods: {
        setDefaultDate() {
           this.selectedYear = new Date().getFullYear();
        },
    }

}
</script>

<style scoped>
    select {
        margin: 1rem;
        width: 90px;
        border: 1px solid var(--color-form);
        border-radius: 6px;
    }
</style>