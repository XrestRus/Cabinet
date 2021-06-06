<template>
<modal
    :action="action"
    title="Карточка продукта"
>
    <div class="r">
        <div class="c">
            <div class="section">
                <div class="section-title">Описание</div>
                <div class="section-body">
                    <section-input 
                        title="Название" 
                        name='title' 
                        type="text" 
                        v-model.trim='form.title' 
                        :error="errors.title"  
                    />
                    <section-input 
                        title="Описание" 
                        name='description' 
                        type="text" 
                        v-model.trim='form.description' 
                        :error="errors.description"  
                    />
                    <section-input 
                        title="Цена" 
                        name='price'
                        type="number" 
                        v-model.trim='form.price' 
                        :error="errors.price"  
                    />
                    <section-image 
                        v-model='form.photo'
                        :isLoad='true'
                    />
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
    props: ['errors', 'product'],

    data() {
        return {
            form: this.$inertia.form(this.product),
            action: {
                title: "Изменить",
                handler: this.edit
            },
            modelValue: Boolean
        }
    },

    methods: {
        edit() {
            this.form.post(this.route("store.edit", { id: this.form.id }), {
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
