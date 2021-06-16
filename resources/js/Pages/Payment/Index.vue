<template>
    <panel-with-users
        :data='users'
        :isShow='isAdmin'
        routeName='payment'
    />
    <div class="component-body">
        <tools-panel title="Расчетные листы">
            <button
                v-if="isAdmin"
                @click='showAdd'
                title='Добавить'
                class="payment-add btn--add-fixed"
            >
                +
            </button>
        </tools-panel>
        <div
            :class="{ 'view--free-section': isAdmin }" 
            class="view"
        >
            <table-standart :collection="payments" :tools="tools" >
                <template v-slot:head>
                    <td-show value='Пользователь'/>
                    <td-show value='Дата'/>
                </template>
                <template v-slot:show="props">
                    <td-show :value="props.item.user"/>
                    <td-show :value="(new Date(props.item.date))
                            .toLocaleString('ru', {
                                year: 'numeric',
                                month: 'long',
                            }
                        )"
                    />
                </template>
            </table-standart>
            <template v-if="modal.isShow">
                <window-payment-add
                    :errors="errors"
                    :type_payments="type_payments"
                    :users="users"
                    v-model='modal.isShow'
                    v-if="modal.type === 'add'"
                />
            </template>
        </div>
    </div>
</template>

<script>
import WorkLayout from '@/Layouts/WorkLayout.vue';
import TableStandart from "@/Components/Table/TableStandart";
import TdShow from "@/Components/Table/Td/TdShow";
import TdInput from "@/Components/Table/Td/TdInput";
import WindowPaymentAdd from "@/Windows/Payment/Add";
import ToolsPanel from "@/Components/Shared/ToolsPanel.vue";
import PanelWithUsers from "@/Components/PanelWithUsers/PanelWithUsers";
import { canAdmin } from '@/utilits.js'
import { ref } from 'vue';
import { Inertia } from '@inertiajs/inertia';

export default {
    layout: WorkLayout,

    components: {
        TableStandart,
        TdShow,
        TdInput,
        WindowPaymentAdd,
        ToolsPanel,
        PanelWithUsers
    },

    props: {
        payments: {
            type: Array,
            default: []
        },
        type_payments: Array,
        users: {
            type: Array,
            default: []
        },
        auth: Object,
        errors: Object,
    },

    setup(props) {
        let isAdmin = ref(canAdmin(props.auth.user.role.id));

        const showGroupPayment = function(id, item) {
            let year = new Date(item.date).getFullYear();
            let month =  new Date(item.date).getMonth() + 1;

            Inertia.get(route('payment.group.show', { user: id, year: year, month: month }));
        };

        const removeGroupPayment = function(id, item) {
            let year = new Date(item.date).getFullYear();
            let month =  new Date(item.date).getMonth() + 1;

            Inertia.post(route('payment.group.remove',
            {
                year: year,
                month: month,
                user: item.user_id
            }));
        };

        const downloadPDF = function(id, item) {
            let year = new Date(item.date).getFullYear();
            let month =  new Date(item.date).getMonth() + 1;

            return route("payment.group.download.pdf",
            {
                user: item.user_id,
                year: year,
                month: month
            });
        };

        const tools = ref({
            isShow: true,
            buttons: [
                {
                    title: 'Скачать в PDF',
                    type: 'link',
                    action: downloadPDF,
                    cssClass: 'svg-pdf',
                }
            ],
            actions: {
                show: showGroupPayment,
                remove: isAdmin.value ?  removeGroupPayment : null
            }
        });

        return {
            isAdmin,
            tools,
            showGroupPayment,
            removeGroupPayment,
            downloadPDF
        }
    },

    data() {
        return {
            modal: {
                isShow: Boolean,
                type: String,
            },

        }
    },

    methods: {
        showAdd() {
            this.modal.type = 'add';
            this.show(true);
        },
        show(toggle) {
            this.modal.isShow = toggle
        },
    }
}
</script>

<style lang='scss'>

</style>
