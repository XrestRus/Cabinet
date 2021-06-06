<template>
<div class="user content page">
    <tools-panel title="Пользователь">
        <inertia-link
            :href='route("user.edit", { user: form })'
            :data="form"
            method="post" as="button"
            class="user-edit btn--edit-fixed"
            title="Сохранить">

        </inertia-link>
    </tools-panel>
    <div class="r">
        <div class="c">
            <section-image
                v-model='form.photo'
                :isLoad='true'
            />
        </div>
        <div class="c">
        <div class="section">
                <div class="section-title">Общая информация</div>
                <div class="section-body">
                    <section-input title="Фамилия" type="text" v-model.trim='form.surname' :error="errors.surname" />
                    <section-input title="Имя" type="text" v-model.trim='form.name' :error="errors.name" />
                    <section-input title="Отчество" type="text" v-model.trim='form.patronymic' :error="errors.patronymic" />

                    <section-select
                        v-if="isAdmin"
                        title="Должность"
                        :data='roles'
                        v-model="form.role"
                    />
                    <section-present
                        v-else
                        title="Должность"
                        :data="form.role.title"
                    />

                    <section-input title="День рождения" type="date" v-model='form.birthday' :error="errors.birthday" />
                </div>
            </div>
            <div class="section">
                <div class="section-title">Контактная информация</div>
                <div class="section-body">
                    <section-input title="Телефон" type="tel" v-model.trim='form.phone' :error="errors.phone" />
                </div>
            </div>
        </div>
        <div class="c">
            <div class="section">
                <div class="section-title">Приватная информация</div>
                <div class="section-body">
                    <section-input title="Почта" type="email" v-model.trim='form.email' :error="errors.email" disabled />
                    <section-present title="Пряники" :data="user.money" />
                </div>
            </div>
        </div>
    </div>
</div>
</template>

<script>
import WorkLayoutVue from '../../Layouts/WorkLayout.vue'
import SectionInput from '@/Components/Modals/Sections/SectionInput.vue';
import SectionImage from '@/Components/Modals/Sections/SectionImage.vue';
import SectionPresent from '@/Components/Modals/Sections/SectionPresent.vue';
import SectionSelect from '@/Components/Modals/Sections/SectionSelect.vue';
import ToolsPanel from "@/Components/Shared/ToolsPanel.vue";
import { canAdmin } from '@/utilits.js'
import { ref } from 'vue';

export default {

    layout: WorkLayoutVue,
    components: { SectionInput, SectionImage, SectionPresent, SectionSelect, ToolsPanel },

    props: {
        user: {},
        errors: {},
        auth: {},
        roles: Array,
    },

    setup(props) {
        const isAdmin = ref(canAdmin(props.auth.user.role.id));

        return {
            isAdmin
        }
    },

    data() {
        return {
            form: this.user
        }
    },
}
</script>

<style lang='scss'>

</style>
