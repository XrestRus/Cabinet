<template>
<div class="visit" @click="reset">
    <tools-panel title="Посещения">
        <input v-model="selectedDate.show" class="tools-input" type='month'>
        <div @click="setDefaultDate" class="tools-item svg-current" ref='input'><span></span></div>
    </tools-panel>

    <div class="wrap visit-grid">

        <table>

            <tr class="tr-head">
                <td class="data-head head-fixed-left">
                    <div>
                        Пользователи
                    </div>
                </td>
                <td class="data-head"  v-for="day of selectedDate.days" :key='day'>
                    <div>
                        <div class="form-clock">
                            {{ day }}
                        </div>
                    </div>
                </td>

            </tr>

            <tr v-for="user of users" :key='user'>

                <td class="data-fixed fixed-left" :title="user.title">
                    <div class="r"
                         title='Скачать в PDF'
                    >
                        <a
                            :href='route("visit.download.pdf", { user: user.id, date: selectedDate.show })'
                            class="tools-item svg-pdf">
                        </a>

                        {{ user.surname }}
                    </div>
                </td>

                <td
                    v-for="day of selectedDate.days"
                    :key='day'
                    class="data"
                    @click='focus({ day, user }, $event)'
                >

                   <div class="div-data-visit"
                        v-if=" day === selected.day && user.id === selected.user_id "
                        :class="{selected: day === selected.day && user.id === selected.user_id }"
                    >
                        <div class="form-clock">
                            <input v-model="selected.clock" autofocus>
                        </div>
                        <div class="form-mark">
                            <select
                                v-model="selected.type_mark"
                            >
                                <option
                                    v-for="m of marks"
                                    :value="m"
                                    :key="m"
                                >
                                    {{ m.title }}
                                </option>
                            </select>
                        </div>

                        <div class="help-message">
                            <span>
                                Часы и тип обязательны
                            </span>
                        </div>
                    </div>

                    <div class="div-data-visit" v-else>
                        <div class="form-clock">
                            {{ user.visits.find(i => new Date(i.date).getDate() === day )?.clock ?? "" }}
                        </div>
                        <div class="form-mark">
                            {{ user.visits.find(i => new Date(i.date).getDate() === day )?.type_mark.code ?? "" }}
                        </div>
                    </div>

                </td>
            </tr>
        </table>
    </div>
</div>
</template>

<script>
import WorkLayout from '@/Layouts/WorkLayout.vue';
import ToolsPanel from "@/Components/Shared/ToolsPanel.vue";
import SectionSelect from "@/Components/Modals/Sections/SectionSelect.vue";
import TdShow from "@/Components/Table/Td/TdShow";
import TdInput from "@/Components/Table/Td/TdInput";
import TableStandart from "@/Components/Table/TableStandart";
import { ref } from 'vue';
import { getDate } from "@/utilits.js";

export default {
    layout: WorkLayout,

    props: ['users', 'marks', 'errors'],

    components: {
        ToolsPanel, SectionSelect, TdShow, TdInput, TableStandart
    },

    setup(props) {
        let selectedDate = ref(getDate());

        return {
            selectedDate
        }
    },

    data() {
        return {
            selected: {
                type: Object,
                default: {
                    id: null,
                    clock: null,
                    date: null,
                    type_mark: null,
                    user_id: null,
                    day: null
                }
            },
            selectedUser: {}
        }
    },

    watch: {
        ['selectedDate.show'](value) {
            let { year, month } = getDate(value);

            this.selectedDate.year = year;
            this.selectedDate.month = month;

            this.reload();
        }
    },

    methods: {

        focus({ day, user }) {
            if (day === this.selected.day && user.id === this.selected.user_id ) return;

            this.action();

            let visit = user.visits.find(i => new Date(i.date).getDate() === day) ?? null;
            this.selectedUser = user;
            this.selected = Object.assign({
                id: visit?.id ?? null,
                clock: visit?.clock ?? null,
                date: this.selectedDate.year + '-' + this.selectedDate.month + '-' + day,
                type_mark: visit?.type_mark ?? null,
                day: day,
                user_id: user.id
            });

        },

        async action() {
            if (!this.selected.clock || !this.selected.type_mark) return;

            let visitCurrent = this.selectedUser?.visits.find(i => i.id === this.selected.id) ?? null;

            if (this.selected.id && visitCurrent.user_id === this.selected.user_id) {
                if (this.selected.clock !== visitCurrent.clock || this.selected.type_mark.id !== visitCurrent.type_mark.id)
                    this.$inertia.post(route('visit.edit', { id: this.selected.id }), this.selected, { only: ['users'] });
                else return;
            } else {
                this.$inertia.post(route('visit.create'), this.selected, { only: ['users'] });
            }

        },

        reload() {
            this.$inertia.reload({
                data: { date: this.selectedDate.show}
            })
        },

        setDefaultDate() {
           this.selectedDate.show = getDate(new Date()).show;
        },

        reset(e) {
            if (e.target.classList.contains('visit')) {
                this.action();
                this.selectedUser = null;
                this.selected = {};
            }
        },
    },
}
</script>

<style lang='scss'>
.help-message {
    position: fixed;
    color: white;
    background-color: var(--color-form);
    margin: 50px 0 0 0;
    width: 100px !important;
    cursor: help;
}

.visit {
    padding: 0 0 0 1rem;

    .visit-grid {
        width: calc(100vw - 220px);
        overflow: auto;
        text-align: center;

        a {
            padding: 16px !important;
        }

        table {
            width: auto;
            margin: 0 0 0.5rem 0;

            .tr-head {

                .head-fixed-left {
                    position: sticky;
                    left: 0;
                    z-index: 1;

                    div {
                        width: 120px;
                    }
                }

                .data-head {
                    width: 100%;
                    transition: 0.1s;

                    div {
                        display: flex;
                        justify-content: center;
                        align-items: center;
                    }
                }
            }

            .data-fixed {
                position: sticky;
                z-index: 1;
                background: white;
                box-shadow: 5px 1px 9px 0px #ff000059;

                div {
                    width: 120px;
                }
            }

            .fixed-right {
                right: 0;
            }

            .fixed-left {
                left: 0;
            }

            .data-head, .head-fixed, .data-fixed {
                &:hover {
                    background-color: var(--color-form-h) !important;
                    color: var(--color-white) !important;
                    cursor: pointer
                }
            }

            .div-data-visit {
                display: flex;
                position: relative;

                div {
                    cursor: pointer;
                    user-select: none;
                    width: 50px;
                    height: 50px;
                    display: flex;
                    justify-content: center;
                    align-items: center;

                    &:hover {
                        outline: 1px solid red;
                    }

                    select {
                        width: 50px;
                        height: 50px;
                        border: none;
                    }

                    input {
                        height: 50px;
                        text-align: center;
                    }
                }

            }
        }

        .selected {
            outline: 1px solid var(--color-form);
        }

        .sticky-list-user {
            position: sticky;
            left: 0;
            background: white;
        }
    }
}
@media (max-width: 700px) {
    .visit {
        .visit-grid {
            width: calc(100vw - 70px);
        }
    }
}

</style>
