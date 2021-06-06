<template>
    <panel-with-users  
        :data='users'
        routeName='store.order'
        :only='[ "orders" ]'
    />
    <div class="component-body">
        <tools-panel title="Заказанные товары">

        </tools-panel>
        <div class="orders view">
            <table-standart :collection="orders" :tools='tools'>
                <template v-slot:head>
                    <td-show value='Дата' />
                    <td-show value='Пользователь'/>
                    <td-show value='Товар'/>
                    <td-show value='Цена'/>
                    <td-show value='Состояние'/>
                </template>
                <template v-slot:show="props">
                    <td-show 
                        :value="props.item.date" 
                    />                       
                    <td-show 
                        :value="props.item.user.title" 
                    />
                    <td-show 
                        :value="props.item.product.title" 
                    />
                    <td-show 
                        :value="props.item.product.price" 
                    />
                    <td-show 
                        :value="props.item.state?.title" 
                    />
                </template>
            </table-standart>
        </div>
    </div>
</template>

<script>
import WorkLayout from '@/Layouts/WorkLayout.vue';
import ToolsPanel from "@/Components/Shared/ToolsPanel.vue";
import TableStandart from "@/Components/Table/TableStandart";
import TdShow from "@/Components/Table/Td/TdShow";
import PanelWithUsers from "@/Components/PanelWithUsers/PanelWithUsers";

export default {
    layout: WorkLayout,

    components: {
        ToolsPanel,
        TableStandart,
        TdShow,
        PanelWithUsers
    },

    props: {
        orders: Object,
        users: Object,
        errors: Object,
        auth: Object
    },

    data() {
        return {
            tools: {
                buttons: [
                    {
                        title: 'Отменить',
                        action: this.cancel,
                        cssClass: 'svg-cancel',
                    },
                    {
                        title: 'Подтвердить',
                        action: this.success ,
                        cssClass: 'svg-success',
                    }
                ],
                isShow: true,
            },

            currentItem: {
                id: Number,
            },

            modal: {
                isShow: Boolean,
                type: String,
            },

            changeRow: this.validate
        }
    },

    methods: {
        cancel(id) {
            this.$inertia.post(this.route("store.order.cancel", { id: id }));
        },
        success(id) {
            this.$inertia.post(this.route("store.order.success", { id: id }));
        },
    }
}
</script>

<style lang='scss' scoped>

</style>
