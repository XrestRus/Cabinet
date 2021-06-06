<template>
<div class="visit-show">
    <tools-panel title="Календарь событий">
        <input v-model="selectedDate.show" class="tools-input" type='month'>
        <div @click="setDefaultDate" class="tools-item svg-current" ref='input'><span></span></div>
    </tools-panel>

    <div class="visit view">

        <calendare-layout 
            :data='events' 
            :date='selectedDate.show'
            :event='show'
        />

        <transition name="modal-animate">
            <window-event-show
                v-if="modal.isShow && modal.type === 'show'" 
                v-model='modal.isShow'
                :events='currentData'
            />
        </transition>
    </div>
</div>
</template>

<script>
import WorkLayout from '@/Layouts/WorkLayout.vue';
import ToolsPanel from "@/Components/Shared/ToolsPanel.vue";
import WindowEventShow from "@/Windows/Event/Show";
import CalendareLayout from "@/Components/Calendare/CalendareLayout.vue";
import { ref } from 'vue';
import { getDate } from "@/utilits.js";

export default {
    layout: WorkLayout,

    components: {
        ToolsPanel,
        CalendareLayout,
        WindowEventShow
    },

    props: {
        errors: Object,
        date: null,
        events: Object,
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

            currentData: null,

            modal: {
                isShow: Boolean,
                type: String,
            },
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
        },

        show(data, e) {
            this.modal.isShow = true;
            this.modal.type = 'show'
            this.currentData = data;
        }
    },
}
</script>

<style lang='scss'>

</style>