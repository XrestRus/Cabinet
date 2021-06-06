<template>
<div class="component-body">
    <tools-panel title="Типы расчета">
        <button @click="showAdd()" class="btn--add-fixed">+</button>
    </tools-panel>
    <div class="types-payment view">
        <table-standart :collection="payments" :tools="tools" :changeRow='validate'>
            <template v-slot:head>
                <td-show value='Название' />
                <td-show value='Тип транзакции'/>
            </template>
            <template v-slot:show="props">
                <td-show 
                    :value="props.item.title" 
                />                       
                <td-show 
                    :value="props.item.type_transaction.title" 
                />                       
            </template>
            <template v-slot:edit="props">
                <td-input 
                    v-model.trim="props.currentItem.title" 
                />
                <td-select 
                    v-model="props.currentItem.type_transaction" 
                    :data='types'
                />
            </template>
        </table-standart>
        <transition name="modal-animate">
            <template v-if="modal.isShow">
                <window-payment-type-add 
                    :errors="errors" 
                    v-model='modal.isShow'
                    :types='types'
                    v-if="modal.type === 'add'" 
                />
            </template>
        </transition>
    </div>
</div>
</template>

<script>
import WorkLayout from '@/Layouts/WorkLayout.vue';
import WindowPaymentTypeAdd from "@/Windows/Types/Payment/Add";
import TableStandart from "@/Components/Table/TableStandart";
import TdShow from "@/Components/Table/Td/TdShow";
import TdInput from "@/Components/Table/Td/TdInput";
import TdSelect from "@/Components/Table/Td/TdSelect";
import ToolsPanel from "@/Components/Shared/ToolsPanel.vue";
import { useForm } from '@inertiajs/inertia-vue3';

export default {
    layout: WorkLayout,

    components: {
        WindowPaymentTypeAdd,
        TableStandart,
        TdShow,
        TdInput,
        TdSelect,
        ToolsPanel,
    },

    props: {
        payments: {
            type: Array,
            default: []
        },
        types: {
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

            changeRow: this.validate
        }
    },


    methods: {
        remove(id) {
            this.$inertia.post(this.route("payment.type.delete", { id: id }));
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

            form.post(this.route("payment.type.edit", { id: form.id }), {
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
