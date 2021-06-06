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
                        v-model.trim='product.title' 
                        :error="errors.title"  
                    />
                    <section-input 
                        title="Описание" 
                        name='description' 
                        type="text" 
                        v-model.trim='product.description' 
                        :error="errors.description"  
                    />
                    <section-input 
                        title="Цена" 
                        name='price'
                        type="number" 
                        v-model.trim='product.price' 
                        :error="errors.price"  
                    />
                    <section-image 
                        v-model='product.photo'
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
    props: ['errors'],

    data() {
        return {
            product: this.$inertia.form({
                title: "",
                description: "",
                price: 0,
                photo: null,
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
            this.product.post(this.route("store.create"), {
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
