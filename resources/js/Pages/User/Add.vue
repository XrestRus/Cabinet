<template>
<div class="user content page">
    <tools-panel title="Пользователь">
       <inertia-link :href='route("user.create")' :data="user" method="post" as="button" class="user-edit btn--add-fixed" title="Добавить">+</inertia-link>
    </tools-panel>
    <div class="r">
        <div class="c">
            <section-image 
                v-model='user.photo'
                :isLoad='true'
            />
        </div>
        <div class="c">
        <div class="section">
                <div class="section-title">Общая информация</div>
                <div class="section-body">
                    <section-input title="Фамилия" type="text" v-model.trim='user.surname' :error="errors.surname" />
                    <section-input title="Имя" type="text" v-model.trim='user.name' :error="errors.name" />
                    <section-input title="Отчество" type="text" v-model.trim='user.patronymic' :error="errors.name" />
                    <section-select title="Должность" :data='roles' v-model="user.role" />
                </div>
            </div>
            <div class="section">
                <div class="section-title">Контактная информация</div>
                <div class="section-body">
                    <section-input title="Телефон" type="tel" v-model.trim='user.phone' :error="errors.phone" />
                    <section-input title="День рождения" type="date" v-model='user.birthday' :error="errors.birthday" />
                </div>
            </div>
        </div>
        <div class="c">
            <div class="section">
                <div class="section-title">Приватная информация</div>
                <div class="section-body">
                    <section-input title="Почта" type="email" v-model.trim='user.email' :error="errors.email" />
                    <section-input title="Пароль" type="password" v-model.trim='user.password' :error="errors.password"  />
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

export default {

    layout: WorkLayoutVue,
    components: { SectionInput, SectionImage, SectionPresent, SectionSelect, ToolsPanel },

    props: {
        errors: null,
        roles: Array
    },

    data() {
        return {
            user: {
                surname: null,
                name: null,
                patronymic: null,
                phone: null,
                email: null,
                birthday: null,
                role: null,
                password: null,
                photo: null,
            }
        }
    },
}
</script>

<style lang='scss'>

</style>
