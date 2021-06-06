<template>
<div class="home-menu">
    <div class="menu-wrap">
        <div class="menu-row">
            <inertia-link
                :href="route('payment.index', { id: user.id })"
                title='Расчеты'
                class="menu-section"
            >
                <div class="menu-img svg-big svg-payment"></div>
                <span class="menu-text">Расчеты</span>
            </inertia-link>
            <inertia-link
                :href="route('user.show', { id: user.id })"
                title='Профиль'
                class="menu-section"
            >
                <div class="menu-img svg-big svg-cabinet"></div>
                <span class="menu-text">Профиль</span>
            </inertia-link>
            <inertia-link
                :href="route('visit.show', { id: user.id })"
                :data="{ date: `${ new Date().getFullYear() }-${ new Date().getMonth() + 1 }` }"
                title='Посещения'
                class="menu-section"
            >
                <div class="menu-img svg-big svg-visit"></div>
                <span class="menu-text">Посещения</span>
            </inertia-link>
        </div>
        <div class="menu-row">
            <inertia-link
                :href="route('role.show.pdf', { id: user.role.id })"
                title='Инструкция'
                class="menu-section"
            >
                <div class="menu-img svg-big svg-project"></div>
                <span class="menu-text">Инструкция</span>
            </inertia-link>
            <inertia-link
                :href="route('vacation.index')"
                :data="{ id: user.id }"
                title='Отпуска'
                class="menu-section"
            >
                <div class="menu-img svg-big svg-vacation"></div>
                <span class="menu-text">Отпуска</span>
            </inertia-link>
            <inertia-link
                :href="route('calendar.production.index')"
                class="menu-section"
            >
                <div class="menu-img svg-big svg-vacation"></div>
                <span class="menu-text">Календарь производственный</span>
            </inertia-link>
        </div>
        <div class="menu-row">
            <inertia-link
                :href='route("calendar.corporation.index")'
                class="menu-section"
            >
                <div class="menu-img svg-big svg-vacation"></div>
                <span class="menu-text">Календарь корпоративный</span>
            </inertia-link>
            <inertia-link
                :href="route('store.order.show', { id: user.id })"
                class="menu-section"
            >
                <div class="menu-img svg-big svg-buy-b"></div>
                <span class="menu-text">Покупки</span>
            </inertia-link>
            <inertia-link
                :href="route('store.index')"
                class="menu-section"
            >
                <div class="menu-img svg-big svg-shop-b"></div>
                <span class="menu-text">Магазин</span>
            </inertia-link>
        </div>


        <template v-if="isAdmin">

            <div class="menu-row">
                <inertia-link
                    :href="route('mark.type.index')"
                    title='Типы посещений'
                    class='menu-section'
                >
                    <div class="menu-img svg-big svg-table-b"></div>
                    <div class="menu-text">Типы посещений</div>
                </inertia-link>
                <inertia-link
                    :href="route('payment.type.index')"
                    title='Типы расчетов'
                    class='menu-section'
                >
                    <div class="menu-img svg-big svg-table-b"></div>
                    <div class="menu-text">Типы расчетов</div>
                </inertia-link>
                <inertia-link
                    :href="route('transaction.type.index')"
                    title='Типы транзакций'
                    class='menu-section'
                >
                    <div class="menu-img svg-big svg-table-b"></div>
                    <div class="menu-text">Типы транзакций</div>
                </inertia-link>
            </div>

            <div class="menu-row">
                <inertia-link
                    :href="route('payment.index')"
                    title='Список расчетов'
                    class='menu-section'
                >
                    <div class="menu-img svg-big svg-list-b"></div>
                    <div class="menu-text">Список расчетов</div>
                </inertia-link>
                <inertia-link
                    :href="route('user.index')"
                    title='Список пользователей'
                    class='menu-section'
                >
                    <div class="menu-img svg-big svg-list-b"></div>
                    <div class="menu-text">Список пользователей</div>
                </inertia-link>
                <inertia-link
                    :href="route('visit.index')"
                    title='Список посещений'
                    class='menu-section'
                >
                    <div class="menu-img svg-big svg-list-b"></div>
                    <div class="menu-text">Список посещений</div>
                </inertia-link>
                <inertia-link
                    :href="route('role.index')"
                    title='Список должностей'
                    class='menu-section'
                >
                    <div class="menu-img svg-big svg-list-b"></div>
                    <div class="menu-text">Список должностей</div>
                </inertia-link>
                <inertia-link
                    :href="route('vacation.index')"
                    title='Список отпусков'
                    class='menu-section'
                >
                    <div class="menu-img svg-big svg-list-b"></div>
                    <div class="menu-text">Список отпусков</div>
                </inertia-link>
                <inertia-link
                    :href="route('event.index')"
                    title='Список событий'
                    class='menu-section'
                >
                    <div class="menu-img svg-big svg-list-b"></div>
                    <div class="menu-text">Список событий</div>
                </inertia-link>
                <inertia-link
                    :href="route('store.order.index')"
                    title='Список заказов'
                    class='menu-section'
                >
                    <div class="menu-img svg-big svg-list-b"></div>
                    <div class="menu-text">Список заказов</div>
                </inertia-link>
            </div>

        </template>

    </div>
</div>
</template>

<script>
import HomeLayout from '@/Layouts/HomeLayout.vue'
import { isAdmin } from '@/utilits.js'

export default {

    layout: HomeLayout,

    data() {
        return {
            user: this.$inertia.page.props.auth.user,
            isAdmin: isAdmin(this.$inertia.page.props.auth.user.role.id)
        }
    },

}
</script>

<style lang='scss'>
.home-menu {
    display: flex;
    flex-direction: column;
    flex: 1;
    margin: auto;
    background: var(--color-form);
    padding: 1rem 0.2rem;
    justify-content: center;
    align-items: center;

    .menu-wrap {
        display: flex;
        flex-direction: column;
        flex: 1;
        max-height: 1000px;
        max-width: 1000px;
        width: 1000px;

        .menu-row {
            display: flex;
            flex-direction: row;
            flex: 1;

            .menu-section {
                flex: 1;
                margin: 0.2rem;
                background: var(--color-white);
                display: flex;
                flex-direction: column;

                .menu-img {
                    flex: 1;
                }
                .menu-text {
                    text-align: center;
                    padding-bottom: 0.4rem;
                    font-size: 18px;
                }

                &:hover {
                    .menu-img {
                        filter: invert(1);
                    }
                }
            }

            @media (max-width: 780px) {
                flex-direction: column;

                .menu-img {
                    min-height: 30px;
                    width: 50px;
                    position: absolute;
                }
            }
        }

        @media (max-width: 1020px) {
            width: 93vw;
        }
    }

    @media (max-width: 780px) {
        padding: 1rem 0;
    }
}
</style>
