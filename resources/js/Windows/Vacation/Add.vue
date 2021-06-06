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
                    <section-select title="Сотрудник" 
                        :data='users' 
                        :error='errors.user'
                        v-model='vacation.user' 
                    />
                    <section-input title="Дата начало"  
                        type="date" 
                        :error='errors.date_start'
                        v-model='vacation.date_start'
                    />
                    <section-input 
                        title="Дата конца" 
                        type="date"
                        :error='errors.date_end'
                        v-model='vacation.date_end'
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
import { ref } from 'vue';

export default {
    components: { Modal, SectionInput, SectionSelect },
    props: ['errors', 'users'],

    data() {
        return {
            vacation: this.$inertia.form({
                user: null,
                date_start: null,
                date_end: null
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
            this.vacation.post(this.route("vacation.create"), {
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
