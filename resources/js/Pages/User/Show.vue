<template>
<div class="user content page">
    <tools-panel title="Пользователь">
       <inertia-link
            :href="route('user.edit', { user: user })"
            as='button'
            class="user-edit btn--edit-fixed"
        >

        </inertia-link>
    </tools-panel>
    <div class="r">
        <div class="c">
            <section-image
                v-model='user.photo'
            />
        </div>
        <div class="c">
        <div class="section">
                <div class="section-title">Общая информация</div>
                <div class="section-body">
                    <section-present title="Фамилия" :data="user.surname" />
                    <section-present title="Имя" :data="user.name" />
                    <section-present title="Отчество" :data="user.patronymic" />
                    <section-present title="Должность" :data="user.role.title" />
                    <section-present title="День рождения" :data="user.birthday" />
                </div>
            </div>
            <div class="section">
                <div class="section-title">Контактная информация</div>
                <div class="section-body">
                    <section-present title="Телефон" :data="user.phone" />
                </div>
            </div>
        </div>
        <div class="c">
            <div class="section">
                <div class="section-title">Приватная информация</div>
                <div class="section-body">
                    <section-present title="Почта" :data="user.email" />
                    <section-present title="Пряники" :data="user.money" />
                </div>
            </div>
        </div>
    </div>
</div>
</template>

<script>
import WorkLayoutVue from '../../Layouts/WorkLayout.vue'
import SectionPresent from '@/Components/Modals/Sections/SectionPresent.vue';
import SectionImage from '@/Components/Modals/Sections/SectionImage.vue';
import ToolsPanel from "@/Components/Shared/ToolsPanel.vue";

export default {

    layout: WorkLayoutVue,
    components: { SectionPresent, SectionImage, ToolsPanel },

    props: {
        user: null,
    }


}
</script>

<style lang='scss'>

</style>
