<template>
<modal
    :action="action"
    title="Карточка типа операций начисления"
>
    <div class="r">
        <div class="c">
            <div class="section">
                <div class="section-title">Данные</div>
                <div class="section-body">
                    <section-input title="Название" name='title' type="text" v-model.trim='transaction.title' :error="errors.title"  />
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

export default {
    components: { Modal, SectionInput, SectionImage },
    props: ['errors'],

    data() {
        return {
            transaction: this.$inertia.form({
                title: "",
            }),
            action: {
                title: "Добавить",
                handler: this.add
            },
        }
    },

    methods: {
        add() {
            this.transaction.post(this.route("transaction.create"), {
                onSuccess: p => {
                    this.$emit("show", false);
                },
                onError: e => { }
            });
        },
    },
}
</script>

<style>

</style>
