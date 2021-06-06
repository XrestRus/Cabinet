<template>
    <div class="component-body">
        <tools-panel title="Типы посещений">
            <button @click="showAdd()" class="btn--add-fixed">+</button>
        </tools-panel>
        <div class="marks view">
            <table-standart :collection="marks" :tools="tools" :changeRow='validate'>
                <template v-slot:head>
                    <td-show value='Название' />
                    <td-show value='Код'/>
                </template>
                <template v-slot:show="props">
                    <td-show 
                        :value="props.item.title" 
                    />                       
                    <td-show 
                        :value="props.item.code" 
                    />                       
                </template>

                <template v-slot:edit="props">
                    <td-input 
                        v-model.trim="props.currentItem.title" 
                    />
                    <td-input 
                        v-model.trim="props.currentItem.code" 
                    />
                </template>

            </table-standart>
            <transition name="modal-animate">
                <template v-if="modal.isShow">
                    <window-mark-add 
                        :errors="errors" 
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
import WindowMarkAdd from "@/Windows/Types/Mark/Add";
import TableStandart from "@/Components/Table/TableStandart";
import TdShow from "@/Components/Table/Td/TdShow";
import TdInput from "@/Components/Table/Td/TdInput";
import ToolsPanel from "@/Components/Shared/ToolsPanel.vue";
import { useForm } from '@inertiajs/inertia-vue3';

export default {
    layout: WorkLayout,

    components: {
        WindowMarkAdd,
        TableStandart,
        TdShow,
        TdInput,
        ToolsPanel,
    },

    props: {
        marks: {
            type: Array,
            default: []
        },
        errors: Object,

    },

    data() {
        return {
            tools: {
                isShow: true,
                actions: {
                    remove: this.remove
                }
            },

            currentItem: {
                id: Number,
            },

            modal: {
                isShow: Boolean,
                type: String,
            },

            changeRow: this.validate
        }
    },

    methods: {
        remove(id) {
            this.$inertia.post(this.route("mark.delete", { id: id }));
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
            form.post(this.route("mark.edit", { id: form.id }), {
                onSuccess: p => {
                    this.show(false);
                },
                onError: e => { 
                    
                }
            });
        }
    }
}
</script>

<style scoped>

</style>
