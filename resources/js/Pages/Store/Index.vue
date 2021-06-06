<template>
<div class="component-body">
    <tools-panel title="Магазин">
        <button
            v-if='isAdmin'
            @click="showAdd()"
            class="btn--add-fixed"
        >
            +
        </button>
    </tools-panel>
    <div class="store view">
        <transition name='view-animate' mode="out-in">
            <cards-layout
                :collection="products"
                :tools="tools"
                namePropImg='photo'
            >
                <template v-slot:card='props'>
                    <div class="text">
                        <span>{{ props.item.title }}</span>
                    </div>
                    <div class="text">
                        <span>{{ props.item.price }}</span>
                    </div>
                    <div class="text">
                        <span>{{ props.item.description }}</span>
                    </div>
                </template>
            </cards-layout>
        </transition>
        <template v-if="modal.isShow">
            <window-product-add
                :errors="errors"
                v-model='modal.isShow'
                v-if="modal.type === 'add'"
            />
             <window-product-edit
                :errors="errors"
                :product='product'
                v-model='modal.isShow'
                v-else-if="modal.type === 'edit'"
            />
        </template>
    </div>
</div>
</template>

<script>
import WorkLayout from '@/Layouts/WorkLayout.vue';
import ToolsPanel from "@/Components/Shared/ToolsPanel.vue";
import CardsLayout from "@/Components/Cards/CardsLayout.vue";
import CardItem from '@/Components/Cards/CardItem.vue'
import WindowProductAdd from "@/Windows/Store/Add";
import WindowProductEdit from "@/Windows/Store/Edit";
import { canAdmin } from '@/utilits.js'
import { ref } from 'vue';

export default {
    layout: WorkLayout,

    components: {
        ToolsPanel,
        CardsLayout,
        CardItem,
        WindowProductAdd,
        WindowProductEdit
    },

    props: {
        products: {
            type: Array,
            default: []
        },
        errors: Object,
        auth: Object,
    },

    setup(props) {
        const isAdmin = ref(canAdmin(props.auth.user.role.id));

        return {
            isAdmin
        }
    },

    data() {
        return {
            tools: {
                buttons: [
                    {
                        title: 'Купить',
                        action: this.order,
                        cssClass: 'svg-buy',
                    }
                ],
                isShow: true,
                actions: {
                    remove: this.isAdmin ? this.remove : null,
                    edit: this.isAdmin ? this.showEdit : null,
                }
            },

            product: {
                id: Number,
            },

            modal: {
                isShow: Boolean,
                type: String,
            },
        }
    },

    methods: {
        order(id) {
            if (confirm("Вы точно хотите это купить?")) {
                this.$inertia.post(this.route('store.order.create'), {
                    user_id: this.auth.user.id,
                    product_id: id
                });
            }
        },

        showAdd() {
            this.modal.type = 'add';
            this.show(true);
        },
        showEdit(id, item) {
            this.modal.type = 'edit';
            this.product = item;
            this.show(true);
        },
        remove(id) {
            this.$inertia.post(this.route("store.remove", { id: id }));
        },
        show(toggle) {
            this.modal.isShow = toggle
        },
    }
}
</script>

<style lang='scss'>

</style>
