<template>
<div class="visit-show">
    <tools-panel title="Посещения">
        <input v-model="selectedDate.show" class="tools-input" type='month'>
        <div @click="setDefaultDate" class="tools-item svg-current" ref='input'><span></span></div>
        <a
            title='Скачать в PDF'
            :href='route("visit.download.pdf", { user: user.id, date: selectedDate.show })'
            class="tools-item svg-pdf">
        </a>
    </tools-panel>

    <div class="visit view">

        <calendare-layout :data='entities' :date='selectedDate.show'/>

    </div>
</div>
</template>

<script>
import WorkLayout from '@/Layouts/WorkLayout.vue';
import ToolsPanel from "@/Components/Shared/ToolsPanel.vue";
import CalendareLayout from "@/Components/Calendare/CalendareLayout.vue";
import { ref } from 'vue';
import { getDate } from "@/utilits.js";

export default {
    layout: WorkLayout,

    components: {
        ToolsPanel,
        CalendareLayout,
    },

    props: {
        user: {
            type: Object,
            default: {}
        },
        errors: Object,
        date: null,
    },

    setup(props) {
        let selectedDate = ref(getDate());

        return {
            selectedDate
        }
    },

    data() {
        return {
            selected: {
                type: Object,
                default: {
                    id: null,
                    clock: null,
                    date: null,
                    type_mark: null,
                    user_id: null,
                    day: null
                }
            },
            selectedUser: {},
        }
    },

    computed: {
        entities() {
            return this.user.visits.map(i => {
                return {
                    title: i.type_mark.code + " " + i.clock,
                    desc: i.type_mark.title,
                    date: i.date,
                }
            });
        }
    },

    watch: {
        ['selectedDate.show'](value) {
            let { year, month } = getDate(value);

            this.selectedDate.year = year;
            this.selectedDate.month = month;

            this.reload();
        }
    },

    methods: {

        reload() {
            this.$inertia.reload({
                data: { date: this.selectedDate.show}
            })
        },

        setDefaultDate() {
           this.selectedDate.show = getDate(new Date()).show;
        }

    },
}
</script>

<style lang='scss'>

</style>
