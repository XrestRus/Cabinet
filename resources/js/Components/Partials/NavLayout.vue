<template>
<nav class="nav">

     <nav-list title='Кабинет'>
        <inertia-link
            :href="route('payment.index', { id: user.id })"
            title='Расчеты'
            class='nav-item'
            :class='{ current: current === "payment.index" }'
        >
            <div class="nav-img svg svg-payment"></div>
            <div class="nav-text">Расчеты</div>
        </inertia-link>
        <inertia-link
            :href="route('user.show', { user: user })"
            title='Профиль'
            class='nav-item'
            :class='{ current: current === "user.show" }'
        >
            <div class="nav-img svg svg-cabinet"></div>
            <div class="nav-text">Профиль</div>
        </inertia-link>
        <inertia-link
            :href="route('visit.show', { id: user.id })"
            :data="{ date: `${ new Date().getFullYear() }-${ new Date().getMonth() + 1 }` }"
            title='Посещения'
            class='nav-item'
            :class='{ current: current === "visit.show" }'
        >
            <div class="nav-img svg svg-visit"></div>
            <div class="nav-text">Посещения</div>
        </inertia-link>
        <inertia-link
            :href="route('role.show.pdf', { id: user.role.id })"
            title='Инструкция'
            class='nav-item'
            :class='{ current: current === "role.show.pdf" }'
        >
            <div class="nav-img svg svg-project"></div>
            <div class="nav-text">Инструкция</div>
        </inertia-link>
        <inertia-link
            :href="route('vacation.index')"
            :data="{ id: user.id }"
            title='Отпуска'
            class='nav-item'
            :class='{ current: current === "vacation.index" }'
        >
            <div class="nav-img svg svg-vacation"></div>
            <div class="nav-text">Отпуска</div>
        </inertia-link>
    </nav-list>

    <template v-if='isAdmin'>

        <nav-list title='Списки'>
            <inertia-link
                :href="route('payment.index')"
                title='Список расчетов'
                class='nav-item'
                :class='{ current: current === "payment.index" }'
            >
                <div class="nav-img svg svg-list-b"></div>
                <div class="nav-text">Список расчетов</div>
            </inertia-link>
            <inertia-link
                :href="route('user.index')"
                title='Список пользователей'
                class='nav-item'
                :class='{ current: current === "user.index" }'
            >
                <div class="nav-img svg svg-list-b"></div>
                <div class="nav-text">Список пользователей</div>
            </inertia-link>
            <inertia-link
                :href="route('visit.index')"
                title='Список посещений'
                class='nav-item'
                :class='{ current: current === "visit.index" }'
            >
                <div class="nav-img svg svg-list-b"></div>
                <div class="nav-text">Список посещений</div>
            </inertia-link>
            <inertia-link
                :href="route('role.index')"
                title='Список должностей'
                class='nav-item'
                :class='{ current: current === "role.index" }'
            >
                <div class="nav-img svg svg-list-b"></div>
                <div class="nav-text">Список должностей</div>
            </inertia-link>
            <inertia-link
                :href="route('vacation.index')"
                title='Список отпусков'
                class='nav-item'
                :class='{ current: current === "vacation.index" }'
            >
                <div class="nav-img svg svg-list-b"></div>
                <div class="nav-text">Список отпусков</div>
            </inertia-link>
            <inertia-link
                :href="route('event.index')"
                title='Список событий'
                class='nav-item'
                :class='{ current: current === "event.index" }'
            >
                <div class="nav-img svg svg-list-b"></div>
                <div class="nav-text">Список событий</div>
            </inertia-link>
            <inertia-link
                :href="route('store.order.index')"
                title='Список заказов'
                class='nav-item'
                :class='{ current: current === "store.order.index" }'
            >
                <div class="nav-img svg svg-list-b"></div>
                <div class="nav-text">Список заказов</div>
            </inertia-link>
        </nav-list>

        <nav-list title='Типы'>
            <inertia-link
                :href="route('mark.type.index')"
                title='Типы посещений'
                class='nav-item'
                :class='{ current: current === "mark.type.index" }'
            >
                <div class="nav-img svg svg-table-b"></div>
                <div class="nav-text">Типы посещений</div>
            </inertia-link>
            <inertia-link
                :href="route('payment.type.index')"
                title='Типы расчетов'
                class='nav-item'
                :class='{ current: current === "payment.type.index" }'
            >
                <div class="nav-img svg svg-table-b"></div>
                <div class="nav-text">Типы расчетов</div>
            </inertia-link>
            <inertia-link
                :href="route('transaction.type.index')"
                title='Типы транзакций'
                class='nav-item'
                :class='{ current: current === "transaction.type.index" }'
            >
                <div class="nav-img svg svg-table-b"></div>
                <div class="nav-text">Типы транзакций</div>
            </inertia-link>
        </nav-list>

    </template>

    <template v-else>

        <nav-list title='Списки'>
            <inertia-link
                :href="route('user.index')"
                title='Список пользователей'
                class='nav-item'
                :class='{ current: current === "user.index" }'
            >
                <div class="nav-img svg svg-list-b"></div>
                <div class="nav-text">Список пользователей</div>
            </inertia-link>
        </nav-list>

    </template>

    <nav-list title='Календари'>
        <inertia-link
            :href="route('calendar.production.index')"
            title='Календарь производственный'
            class='nav-item'
            :class='{ current: current === "calendar.production.index" }'
        >
            <div class="nav-img svg svg-vacation"></div>
            <div class="nav-text">Календарь производственный</div>
        </inertia-link>
        <inertia-link
            :href="route('calendar.corporation.index')"
            title='Календарь корпоративный'
            class='nav-item'
            :class='{ current: current === "calendar.corporation.index" }'
        >
            <div class="nav-img svg svg-vacation"></div>
            <div class="nav-text">Календарь корпоративный</div>
        </inertia-link>
    </nav-list>

    <nav-list title='Магазин'>
        <inertia-link
            :href="route('store.index')"
            title='Товары'
            class='nav-item'
            :class='{ current: current === "store.index" }'
        >
            <div class="nav-img svg svg-shop-b"></div>
            <div class="nav-text">Товары</div>
        </inertia-link>
        <inertia-link
            :href="route('store.order.show', { id: user.id })"
            title='Покупки'
            class='nav-item'
            :class='{ current: current === "store.order.show" }'
        >
            <div class="nav-img svg svg-buy-b"></div>
            <div class="nav-text">Покупки</div>
        </inertia-link>
    </nav-list>

</nav>
</template>

<script>
import NavList from '@/Components/Partials/NavList.vue'
import { isAdmin } from '@/utilits.js'

export default {
    components: {
        NavList
    },

    props: ['current'],

    data() {
        return {
            user: this.$inertia.page.props.auth.user,
            isAdmin: isAdmin(this.$inertia.page.props.auth.user.role.id),
        }
    },

}
</script>

<style lang='scss'>
.nav {
    // box-shadow: 1px 2px 8px 1px #0000008c;
    width: 200px;
    height: calc(100vh - 50px);
    overflow: overlay;

    .nav-item {
        display: flex !important;
        align-items: center;
        position: relative;
        transition: 0.2s;

        .nav-img {
            display: flex;
            width: 25px;
            height: 25px;
            margin: 0 0.4rem 0 0;
        }

        &:hover {
            animation: nav-hover-animate 1s;

            .nav-img {
                filter: invert(1);
            }
        }

        @keyframes nav-hover-animate {
            0% {
                left: 0;
            }
            50% {
                left: 10px;
            }
            100% {
                left: 0;
            }
        }
    }

    .current {
        background-color: var(--color-form-h) !important;
        color: var(--color-white) !important;

        .nav-img {
            filter: invert(1);
        }
    }
}
@media (max-width: 700px) {

    .nav {
        width: 50px;
        min-width: 50px;

        .list-nav {
            border-radius: 0;

            .title-nav {
                span {
                    visibility: hidden;
                }
            }
            .nav-text {
                visibility: hidden;
            }
        }
    }
}
</style>
