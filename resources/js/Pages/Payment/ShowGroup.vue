<template>
    <div class="component-body">
        <tools-panel :title="title">
            <a
                class="tools-item svg-pdf"
                title="Скачать в PDF"
                :href='route("payment.group.download.pdf", { user: payments[0]?.user_id, year: year, month: month })'
            >
            </a>
            <button
                v-if='isAdmin'
                @click='showAdd'
                title='Добавить'
                class="payment-add btn--add-fixed"
            >
                +
            </button>
        </tools-panel>
        <div class="view">
            <div class="table-layout">
                <table-standart
                    :collection="accrual.list"
                    :tools="tools" class="w-60"
                    :changeRow='validate'
                >
                    <template v-slot:head>
                        <td-show value='Вид (начислений)'/>
                        <td-show value='Период'/>
                        <td-show value='Дни'/>
                        <td-show value='Часы'/>
                        <td-show value='Сумма'/>
                    </template>
                    <template v-slot:show="props">
                        <td-show :value="props.item.type_payment.title"/>
                        <td-show :value="props.item.date"/>
                        <td-show :value="props.item.days"/>
                        <td-show :value="props.item.clock"/>
                        <td-show :value="props.item.sum"/>
                    </template>
                    <template v-slot:edit="props">
                        <td-select
                            v-model="props.currentItem.type_payment"
                            :error='props.errors.type_payments'
                            :data='type_payments'
                        />
                        <td-date
                            v-model="props.currentItem.date"
                            :error='props.errors.date'

                        />
                        <td-input
                            v-model="props.currentItem.days"
                            :error='props.errors.days'
                            type='number'
                        />
                        <td-input
                            v-model="props.currentItem.clock"
                            :error='props.errors.clock'
                            type='number'
                        />
                        <td-input
                            v-model="props.currentItem.sum"
                            :error='props.errors.sum'
                            type='number'
                        />
                    </template>
                </table-standart>
                <table-standart
                    :collection="retention.list"
                    :tools="tools" class="w-40"
                    :changeRow='validate'
                >
                    <template v-slot:head>
                        <td-show value='Вид (удержаний)'/>
                        <td-show value='Период'/>
                        <td-show value='Сумма'/>
                    </template>
                    <template v-slot:show="props">
                        <td-show :value="props.item.type_payment.title"/>
                        <td-show :value="props.item.date"/>
                        <td-show :value="props.item.sum"/>
                    </template>
                    <template v-slot:edit="props">
                        <td-select
                            v-model="props.currentItem.type_payment"
                            :error='props.errors.type_payment'
                            :data='type_payments'
                        />
                        <td-date
                            v-model="props.currentItem.date"
                            :error='props.errors.date'
                            type='number'
                        />
                        <td-input
                            v-model="props.currentItem.sum"
                            :error='props.errors.sum'
                            type='number'
                        />
                    </template>
                </table-standart>
            </div>
        </div>

        <template v-if="modal.isShow">
            <window-payment-add
                :errors="errors"
                :user="selectedUser"
                :type_payments="type_payments"
                :users="users"
                :month='month'
                :year='year'
                v-model='modal.isShow'
                v-if="modal.type === 'add'"
            />
        </template>

        <div class="statistica r">
            <div class="total-up r">
                <span>
                    Всего начислено:
                </span>
                <span>
                    {{ accrual.sum }}
                </span>
            </div>
            <div class="total-down r">
                    <span>
                    Всего удержано:
                </span>
                <span>
                    {{ retention.sum }}
                </span>
            </div>
            <div class="total-sum r">
                <span>
                    Сумма к выплате:
                </span>
                <span>
                    {{ +accrual.sum - +retention.sum }}
                </span>
            </div>
        </div>
    </div>
</template>

<script>
import WorkLayout from '@/Layouts/WorkLayout.vue';
import TableStandart from "@/Components/Table/TableStandart";
import TdShow from "@/Components/Table/Td/TdShow";
import TdSelect from "@/Components/Table/Td/TdSelect";
import TdInput from "@/Components/Table/Td/TdInput";
import TdDate from "@/Components/Table/Td/TdDate";
import ToolsPanel from "@/Components/Shared/ToolsPanel.vue";
import { useForm } from '@inertiajs/inertia-vue3';
import { canAdmin } from '@/utilits.js'
import WindowPaymentAdd from "@/Windows/Payment/Add";

export default {
    layout: WorkLayout,

    components: {
        TableStandart,
        TdShow,
        TdSelect,
        TdInput,
        TdDate,
        ToolsPanel,
        WindowPaymentAdd
    },

    props: ['selectedUser', 'payments', 'month', 'year', 'type_payments', 'users', 'errors'],

    data() {
        return {
            title: `Расчетный лист за ${ this.year }/${ this.month }`,
            tools: {
                isShow: canAdmin(this.$inertia.page.props.auth.user.role.id),
                actions: {
                    remove: this.removePayment
                }
            },
            modal: {
                isShow: Boolean,
                type: String,
            },
            isAdmin: canAdmin(this.$inertia.page.props.auth.user.role.id),
        }
    },

    computed: {
        accrual() {
            let list = this.payments.filter(i => i.type_payment.type_transaction.title === 'Начисления');

            return  {
                list: list,
                sum: list.reduce((s, i) => s += Number.parseFloat(i.sum), 0),
            }
        },
        retention() {
            let list = this.payments.filter(i => i.type_payment.type_transaction.title === 'Удержания');

            return {
                list: list,
                sum: +list.reduce((s, i) => s += Number.parseFloat(i.sum), 0),
            }
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

        removePayment(id, item) {
            this.$inertia.form().transform(data => {
                    return {...data, year: this.year, month: this.month, user_id: item.user_id }
                })
                .post(route('payment.remove', { payment: id }));
        },

        validate(currentItem) {
            this.submit(useForm(currentItem));
        },

        submit(form) {
            form.transform(data => {
                    return {...data, year: this.year, month: this.month }
                })
                .post(this.route("payment.edit", { payment: form.id }), {
                    onSuccess: p => {

                    },
                    onError: e => {

                    }
                });
        },

    },

}
</script>

<style lang='scss' scoped>

.component-body {
    .view {
        height: calc(100vh - 137px) !important;
    }

    .table-layout {
        display: flex;
        width: 100%;

        .w-40 {
            flex: 0.4;
        }
        .w-60 {
            flex: 0.6;
        }
    }

    .statistica {
        padding: 0 1rem;
        height: 50px;
        width: 100%;

        div {
            justify-content: space-evenly;
            align-items: center;
            font-size: 20px;
            background: white;
            box-shadow: 3px 1px 9px 0px #ff000059;
        }
    }
}
@media (max-width: 1000px) {
    .statistica {
        * {
            font-size: 13px !important;
        }
    }
}
</style>
