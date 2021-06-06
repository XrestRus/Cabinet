<template>
<modal
    :action="action"
    title="Карточка типа расчета"
>
    <div class="r">
        <div class="c">
            <div class="section">
                <div class="section-title">Данные</div>
                <div class="section-body">
                    <section-input title="Название" name='title' type="text" v-model.trim='payment.title' :error="errors.title"  />
                    <section-select title="Транзакция" :data="types" v-model="payment.type_transaction" :error="errors.type_transaction"  />
                </div>
            </div>
        </div>
    </div>
</modal>
</template>

<script>
import Modal from '@/Components/Modals/Modal.vue';
import SectionImage from '@/Components/Modals/Sections/SectionImage.vue';
import SectionInput from '@/Components/Modals/Sections/SectionInput.vue';
import SectionSelect from '@/Components/Modals/Sections/SectionSelect.vue';

export default {
    components: { Modal, SectionInput, SectionImage, SectionSelect },
    props: {
        errors: {
            title: null,
            type_transaction: null,
        },
        types: Array
    },

    data() {
        return {
            payment: this.$inertia.form({
                title: "",
                type_transaction: null
            }),
            action: {
                title: "Добавить",
                handler: this.add
            },
        }
    },

    methods: {
        add() {
            this.payment.post(this.route("payment.type.create"), {
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
