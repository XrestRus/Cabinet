<template>
<div class="component-body">
    <tools-panel title="Пользователи">
        <div
            v-if="isAdmin"
            @click="view = 'table'"
            class="tools-item svg-table"
        >
            <span></span>
        </div>
        <div
            @click="view = 'card'"
            class="tools-item svg-card"
        >
            <span></span>
        </div>
        <inertia-link
            v-if="isAdmin"
            title="Добавить"
            as='button'
            :href='route("user.create")'
            class="btn--add-fixed"
        >
            +
        </inertia-link>
    </tools-panel>
    <div class="users view">
        <transition name='view-animate' mode="out-in">
            <template v-if="view === 'table'">
                <table-standart :collection="users" :tools="tools">
                    <template v-slot:head>
                        <td-show value='Фотография'/>
                        <td-show value='Фамилия'/>
                        <td-show value='Имя'/>
                        <td-show value='Отчество'/>
                        <td-show value='Должность'/>
                        <td-show value='Почта'/>
                        <td-show value='Телефон'/>
                    </template>
                    <template v-slot:show="props">
                        <td-image :value="props.item.photo"/>
                        <td-show :value="props.item.surname"/>
                        <td-show :value="props.item.name"/>
                        <td-show :value="props.item.patronymic"/>
                        <td-show :value="props.item.role.title"/>
                        <td-show :value="props.item.email"/>
                        <td-show :value="props.item.phone"/>
                    </template>
                </table-standart>
            </template>
            <template v-else-if="view === 'card'">
                <cards-layout
                    :collection="users"
                    :tools="tools"
                    namePropImg='photo'
                >
                    <template
                        v-slot:card='props'
                    >
                        <div class="text">
                            <span>{{ props.item.surname }}</span>
                            <span>{{ props.item.name }}</span>
                            <span>{{ props.item.patronymic }}</span>
                        </div>
                        <div class="text">
                            <span>{{ props.item.role.title }}</span>
                        </div>
                        <div class="text">
                            <span>{{ props.item.birthday }}</span>
                        </div>
                    </template>
                </cards-layout>
            </template>
        </transition>
    </div>
</div>
</template>

<script>
import WorkLayout from '@/Layouts/WorkLayout.vue';
import TableStandart from "@/Components/Table/TableStandart";
import TdShow from "@/Components/Table/Td/TdShow";
import TdImage from "@/Components/Table/Td/TdImage";
import TdInput from "@/Components/Table/Td/TdInput";
import ToolsPanel from "@/Components/Shared/ToolsPanel.vue";
import CardsLayout from "@/Components/Cards/CardsLayout.vue";
import CardItem from '@/Components/Cards/CardItem.vue'
import { canAdmin } from '@/utilits.js'
import { ref } from 'vue';
import { Inertia } from '@inertiajs/inertia';

export default {
    layout: WorkLayout,

    components: {
        TableStandart,
        TdShow,
        TdInput,
        TdImage,
        ToolsPanel,
        CardsLayout,
        CardItem
    },

    props: {
        users: {
            type: Array,
            default: []
        },
        errors: Object,
        auth: Object,

    },

    setup(props) {
        const isAdmin = ref(canAdmin(props.auth.user.role.id));
        const view = ref(isAdmin.value ? 'table' : 'card');

        const remove = function(id) {
            Inertia.post(this.route("user.delete", { user: id }));
        };
        const showUser = function(id) {
            Inertia.get(route('user.show', { user: id }));
        };
        const editUser = function(id) {
            Inertia.get(route('user.edit', { user: id }));
        };
        const payment = function(id, item) {
            if(confirm(`Заплатить пользователю ${ item.title } - 100 пряников?`)) {
                Inertia.post(route("user.pay", { user: item }));
            }
        };

        const tools = ref({
            isShow: true,
            buttons: [
                {
                    title: 'Начислить',
                    action: payment,
                    cssClass: 'svg-pay',
                }
            ],
            actions: {
                remove: isAdmin.value ? remove : null,
                show: isAdmin.value ? showUser : null,
                edit: isAdmin.value ? editUser : null,
            }
        });

        return {
            isAdmin,
            view,
            remove,
            showUser,
            editUser,
            payment,
            tools
        }
    },

    data() {
        return {
            modal: {
                isShow: Boolean,
                type: String,
            },
        }
    },

    methods: {

        show(toggle) {
            this.modal.isShow = toggle
        },
    }
}
</script>

<style lang='scss'>

</style>
