<template>
<div class="panel-users" v-if='isShow === true'>
    <div class="head-tools">
        <div class="tools-title">
            Пользователи
        </div>
    </div>
    <div class="list">

        <inertia-link
            :class="{ selected: !select }"
            class="list-item btn"
            :href="route(routeName + '.index')"
            :only='only ?? [ many ]'
        >
            <div class="list-wrap">
                <span class="list-text">Все</span>
            </div>
        </inertia-link>

        <inertia-link
            v-for="d in data"
            :key="d"
            :class="{ selected: select === d.id }"
            class="list-item btn"
            :href="route(routeName + '.index', { id: d.id })"
            :only='only ?? [ many ]'
            :title="shorName(d.surname , d.name, d.patronymic)"
        >
            <div class="list-wrap">
                <span class="list-text">{{ shorName(d.surname , d.name, d.patronymic) }}</span>
            </div>
        </inertia-link>

    </div>
</div>
</template>

<script>
import { getSearchToUrl, abbreviatedName } from "@/utilits.js";

export default {
    props: {
        data: Array,
        routeName: String,
        isShow: {
            default: false,
        },
        only: {
            type: Array,
            default: null
        }
    },

    data() {
        return {
            select: +getSearchToUrl()['id']
        }
    },

    computed: {
        many() {
            return `${ this.routeName }s`;
        },
    },

    methods: {
        shorName: (s, n, p) => abbreviatedName(s, n, p)
    }

}
</script>

<style lang="scss">

.panel-users {
    max-width: 200px;
    border-right: 1px solid silver;
}

.list {
    overflow-x: hidden;

    .list-item {
        border-bottom: 1px solid silver;
        position: relative;
        transition: 0.2s;

        .list-wrap {
            padding: 0.2rem 0;

            .list-text {
                margin-right: 0.3rem;

            }
        }

        &:hover {
            animation: nav-hover-animate 1s;
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
}

.selected {
    background: var(--color-form-h);
    color: var(--color-white);
}

@media (max-width: 700px) {

    .panel-users {
        max-width: 50px;

        .tools-title {
            display: none;
        }
    }

    .list-wrap {
        text-overflow: ellipsis;
        white-space: nowrap;
        overflow: hidden;
    }
}
</style>
