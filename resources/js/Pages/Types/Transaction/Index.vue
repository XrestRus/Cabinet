<template>
<div class="component-body">
    <tools-panel title="Типы операций начисления">
        <button @click="showAdd()" class="btn--add-fixed">+</button>
    </tools-panel>
    <div class="types-transaction view">
        <table-standart :collection="transactions" :tools="tools" :changeRow='validate'>
            <template v-slot:head>
                <td-show value='Название' />
            </template>
            <template v-slot:show="props">
                <td-show 
                    :value="props.item.title" 
                />                       
            </template>

            <template v-slot:edit="props">
                <td-input 
                    v-model.trim="props.currentItem.title" 
                />
            </template>
        </table-standart>
        <transition name="modal-animate">
            <template v-if="modal.isShow">
                <window-transaction-type-add 
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
import WindowTransactionTypeAdd from "@/Windows/Types/Transaction/Add";
import TableStandart from "@/Components/Table/TableStandart";
import TdShow from "@/Components/Table/Td/TdShow";
import TdInput from "@/Components/Table/Td/TdInput";
import ToolsPanel from "@/Components/Shared/ToolsPanel.vue";
import { useForm } from '@inertiajs/inertia-vue3';

export default {
    layout: WorkLayout,

    components: {
        WindowTransactionTypeAdd,
        TableStandart,
        TdShow,
        TdInput,
        ToolsPanel,
    },

    props: {
        transactions: {
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
            this.$inertia.post(this.route("transaction.delete", { id: id }));
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
            let res;

            form.post(this.route("transaction.edit", { id: form.id }), {
                onSuccess: p => {
                    this.show(false);
                },
                onError: e => { 

                }
            });
            
            return res;
        }
    }
}
</script>

<style scoped>

</style>
