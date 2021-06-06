<template>
    <panel-with-users
        :data='users'
        :isShow='isAdmin'
        routeName='vacation'
    />
    <div class="component-body">
        <tools-panel title="Отпуска">
            <button
                v-if="isAdmin"
                @click="showAdd()"
                class="btn--add-fixed"
            >
                +
            </button>
        </tools-panel>
        <div class="vacations view view--free-section">
            <table-standart :collection="vacationsFillter" :tools="tools" :changeRow='validate'>
                <template v-slot:head>
                    <td-show value='Сотрудник' />
                    <td-show value='Дата начало' />
                    <td-show value='Дата конца' />
                    <td-show value='Кол-во дней' />
                </template>
                <template v-slot:show="props">
                    <td-show
                        :value="props.item.user.title"
                    />
                    <td-show
                        :value="props.item.date_start"
                    />
                    <td-show
                        :value="props.item.date_end"
                    />
                    <td-show
                        :value="props.item.days"
                    />
                </template>
                <template v-slot:edit="props">
                    <td-select
                        v-model="props.currentItem.user"
                        :data="users"
                        :error="props.errors.title"
                    />
                    <td-date
                        v-model="props.currentItem.date_start"
                        :error="props.errors.date_start"
                    />
                    <td-date
                        v-model="props.currentItem.date_end"
                        :error="props.errors.date_end"
                    />
                    <td-show
                        :value="props.item.days"
                    />
                </template>
            </table-standart>
            <transition name="modal-animate">
                <template v-if="modal.isShow">
                    <window-vacation-add
                        :errors="errors"
                        :users="users"
                        v-model='modal.isShow'
                        v-if="modal.type === 'add'"
                    />
                </template>
            </transition>
        </div>
    </div>
</template>

<script>
import WorkLayout from '@/Layouts/WorkLayout.vue';
import WindowVacationAdd from "@/Windows/Vacation/Add";
import TableStandart from "@/Components/Table/TableStandart";
import TdShow from "@/Components/Table/Td/TdShow";
import TdInput from "@/Components/Table/Td/TdInput";
import TdSelect from "@/Components/Table/Td/TdSelect";
import TdDate from "@/Components/Table/Td/TdDate";
import ToolsPanel from "@/Components/Shared/ToolsPanel.vue";
import { useForm } from '@inertiajs/inertia-vue3';
import { canAdmin } from '@/utilits.js'
import PanelWithUsers from "@/Components/PanelWithUsers/PanelWithUsers";

export default {
    layout: WorkLayout,

    components: {
        WindowVacationAdd,
        TableStandart,
        TdShow,
        TdInput,
        TdSelect,
        TdDate,
        ToolsPanel,
        PanelWithUsers
    },

    props: {
        vacations: {
            type: Array,
            default: []
        },
        users: {
            type: Array,
            default: []
        },
        auth: Object,
        errors: Object,
    },

    data() {
        return {
            tools: {
                isShow: canAdmin(this.$inertia.page.props.auth.user.role.id),
                actions: {
                    remove: this.remove
                }
            },

            currentItem: {
                id: Number,
            },

            modal: {
                isShow: Boolean,
                type: String,
            },

            vacation: {
                date_start: null,
                date_end: null,
                user_id: null
            },

            changeRow: this.validate,

            isAdmin: canAdmin(this.$inertia.page.props.auth.user.role.id),
        }
    },

    computed: {
        vacationsFillter() {
            return this.vacations.map(i => {
                let s = new Date(i.date_start);
                let e = new Date(i.date_end);

                let days = s >= e ? s - e : e - s;
                days = days / 1000 / 60 / 60 / 24;

                return {...i, days};
            });
        }
    },

    methods: {
        remove(id) {
            this.$inertia.post(this.route("vacation.delete", { id: id }));
        },
        showAdd() {
            this.modal.type = 'add';
            this.show(true);
        },
        show(toggle) {
            this.modal.isShow = toggle
        },

        validate(currentItem) {
            this.submit(useForm(currentItem));
        },

        submit(form) {
            form.post(this.route("vacation.edit", { id: form.id }), {
                onSuccess: p => {
                    console.log("Success");
                },
                onError: e => {
                    console.log("Error");
                }
            });
        }
    }
}
</script>

<style lang='scss' scoped>

</style>
