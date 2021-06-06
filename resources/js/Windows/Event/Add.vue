<template>
<modal
    :action="action"
    title="Карточка события"
>
    <div class="r">
        <div class="c">
            <div class="section">
                <div class="section-title">Данные</div>
                <div class="section-body">
                    <section-input title="Название" name='title' type="text" v-model.trim='event.title' :error="errors.title"  />
                    <section-input title="Описание" name='desc' type="text" v-model.trim='event.desc' :error="errors.desc"  />
                    <section-input title="Дата начало" name='date_start' type="date" v-model='event.date_start' :error="errors.date_start"  />
                    <section-input title="Дата окончания" name='date_end' type="date" v-model='event.date_end' :error="errors.date_end"  />
                </div>
            </div>
        </div>
    </div>
</modal>
</template>

<script>
import { getFetch } from "@/utilits.js";
import Modal from '@/Components/Modals/Modal.vue';
import SectionImage from '@/Components/Modals/Sections/SectionImage.vue';
import SectionInput from '@/Components/Modals/Sections/SectionInput.vue';
import SectionSelect from '@/Components/Modals/Sections/SectionSelect.vue';

export default {
    components: { Modal, SectionInput, SectionImage, SectionSelect },
    props: {
        errors: {
            title: null,            
        },
        user: null
    },

    data() {
        return {
            event: this.$inertia.form({
                user_author_id: this.user.id,
                date_start: null,
                date_end: null,
                title: null,
                desc: null,
            }),

            action: {
                title: "Добавить",
                handler: this.add
            },            
        }
    },

    methods: {
        add() {
            this.event.post(this.route("event.create"), {
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
