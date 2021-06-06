<template>
<modal
    :action="action"
    title="Карточка типа посещения"
>
    <div class="r">
        <div class="c">
            <div class="section">
                <div class="section-title">Данные</div>
                <div class="section-body">
                    <section-select 
                        title="Сотрудники" 
                        :data='users' 
                        v-model='payment.user' 
                        :error='errors.user'
                    />
                    <section-select 
                        title="Типы расчетов" 
                        :data='type_payments' 
                        v-model='payment.type_payment' 
                        :error='errors.type_payment'
                    />
                    <section-input 
                        type='number' 
                        title="Часы" 
                        v-model='payment.clock' 
                        :error='errors.clock'
                    />
                    <section-input 
                        type='number' 
                        title="Дни" 
                        v-model='payment.days'
                        :error='errors.days'
                    />
                    <section-input 
                        type='number' 
                        title="Сумма" 
                        v-model='payment.sum' 
                        :error='errors.sum'
                    />
                    <section-input 
                        type='date' 
                        title="Дата" 
                        v-model='payment.date' 
                        :error='errors.date'
                    />
                </div>
            </div>
        </div>
    </div>
</modal>
</template>

<script>
import Modal from '@/Components/Modals/Modal.vue';
import SectionSelect from '@/Components/Modals/Sections/SectionSelect.vue';
import SectionInput from '@/Components/Modals/Sections/SectionInput.vue';
import { getDate } from "@/utilits.js";

export default {
    components: { Modal, SectionInput, SectionSelect },
    props: {
        errors: null,
        type_payments: null,
        users: null,
        user: null,
        month: null,
        year: null
    },

    data() {
        return {
            payment: this.$inertia.form({
                type_payment: null,
                user: this.user,
                clock: null,
                sum: null,
                comment: null,
                days: null,
                date: this.year ? getDate(this.year + "-" + this.month).show  + "-01" : null,
            }),
            action: {
                title: "Добавить",
                handler: this.add
            },
            modelValue: Boolean
        }
    },

    methods: {
        add() {
            let year = new Date(this.payment.date).getFullYear();
            let month = new Date(this.payment.date).getMonth() + 1;

            this.payment
                .transform(data => {
                        return {...data, year: year, month: month }
                    })
                .post(this.route("payment.create"), {
                    onSuccess: p => {
                        this.$emit("update:modelValue", false);
                    },
                    onError: e => { }
                });
        },
    },
}
</script>

<style>

</style>