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
                    <section-input title="Название" name='title' type="text" v-model.trim='mark.title' :error="errors.title"  />
                    <section-input title="Код" name='code' type="text" v-model.trim='mark.code' :error="errors.code"  />
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
            mark: this.$inertia.form({
                title: "",
                code: "",
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
            this.mark.post(this.route("mark.create"), {
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
