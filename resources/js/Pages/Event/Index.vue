<template>
    <div class="component-body">
        <tools-panel title="События">
            <button @click="showAdd()" class="btn--add-fixed">+</button>
        </tools-panel>
        <div class="events view">
            <table-standart :collection="events" :tools="tools" :changeRow='validate'>
                <template v-slot:head>
                    <td-show value='Название' />
                    <td-show value='Описание' />
                    <td-show value='Дата начало' />
                    <td-show value='Дата конца' />
                    <td-show value='Автор' />
                </template>
                <template v-slot:show="props">
                    <td-show 
                        :value="props.item.title" 
                    />       
                    <td-show 
                        :value="props.item.desc" 
                    />  
                    <td-show 
                        :value="props.item.date_start" 
                    />      
                    <td-show 
                        :value="props.item.date_end" 
                    />   
                    <td-show 
                        :value="props.item.user_author.surname" 
                    />   
                </template>
                <template v-slot:edit="props">
                    <td-input 
                        v-model.trim="props.currentItem.title" 
                    />
                    <td-input 
                        v-model.trim="props.currentItem.desc" 
                    />
                    <td-date 
                        v-model="props.currentItem.date_start" 
                    />
                    <td-date 
                        v-model="props.currentItem.date_end" 
                    />
                    <td-show 
                        :value="props.item.user_author.surname" 
                    />   
                </template>
            </table-standart>
            <transition name="modal-animate">
                <template v-if="modal.isShow">
                    <window-event-add 
                        :errors="errors" 
                        :users="users"
                        :user="auth.user"
                        v-model='modal.isShow'
                        v-if="modal.type === 'add'" 
                    />
                </template>
            </transition>
        </div>
    </div>
</template>

<script>
import WorkLayout from '@/Layouts/WorkLayout.vue';
import WindowEventAdd from "@/Windows/Event/Add";
import TableStandart from "@/Components/Table/TableStandart";
import TdShow from "@/Components/Table/Td/TdShow";
import TdInput from "@/Components/Table/Td/TdInput";
import TdSelect from "@/Components/Table/Td/TdSelect";
import TdDate from "@/Components/Table/Td/TdDate";
import ToolsPanel from "@/Components/Shared/ToolsPanel.vue";
import PanelWithUsers from "@/Components/PanelWithUsers/PanelWithUsers";
import { useForm } from '@inertiajs/inertia-vue3';

export default {
    layout: WorkLayout,

    components: {
        WindowEventAdd,
        TableStandart,
        TdShow,
        TdInput,
        TdSelect,
        TdDate,
        ToolsPanel,
        PanelWithUsers
    },

    props: {
        events: {
            type: Array,
            default: []
        },
        auth: Object,
        errors: Object,

    },

    data() {
        return {
            tools: {
                isShow: true,
                actions: {
                    remove: this.remove,
                }
            },

            currentItem: {
                id: Number,
            },

            modal: {
                isShow: Boolean,
                type: String,
            },

            event: {
                date_start: null,
                date_end: null,
                title: null,
                desc: null,
            },

            changeRow: this.validate
        }
    },

    methods: {
        remove(id) {
            this.$inertia.post(this.route("event.remove", { id: id }));
        },
        showAdd() {
            this.modal.type = 'add';
            this.show(true);
        },
        show(toggle) {
            this.modal.isShow = toggle
        },

        validate(currentItem) {
            this.submit(useForm(currentItem));
        },

        submit(form) {
            form.post(this.route("event.edit", { id: form.id }), {
                onSuccess: p => {
                    this.show(false);
                },
                onError: e => { 
                    console.log("Error");
                }
            });
        }
    }
}
</script>

<style lang='scss'>

</style>
