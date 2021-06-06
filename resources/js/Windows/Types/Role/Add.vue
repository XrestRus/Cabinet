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
                    <section-input title="Название" name='title' type="text" v-model.trim='role.title' :error="errors.title"  />
                    <section-input title="PDF" name='code' type="file" accept=".pdf" @input='role.pdf_path = $event.target.files[0]' :error='errors.pdf_path' />
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
            role: this.$inertia.form({
                title: "",
                pdf_path: null,
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
            this.role.post(this.route("role.create"), {
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
