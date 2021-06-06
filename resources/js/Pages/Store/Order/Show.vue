<template>
    <div class="component-body">
        <tools-panel title="Заказанные товары">

        </tools-panel>
        <div class="orders view">
            <cards-layout
                :collection="products"
                namePropImg='photo'
            >
                <template v-slot:card='props'>
                    <div class="text">
                        <span>{{ props.item.title }}</span>
                    </div>
                    <div class="text">
                        <span>{{ props.item.description }}</span>
                    </div>
                    <div class="text">
                        <span>{{ props.item.price }}</span>
                    </div>
                    <div class="text">
                        <span>{{ props.item.state }}</span>
                    </div>
                </template>
            </cards-layout>
        </div>
    </div>
</template>

<script>
import WorkLayout from '@/Layouts/WorkLayout.vue';
import CardsLayout from "@/Components/Cards/CardsLayout.vue";
import CardItem from '@/Components/Cards/CardItem.vue'
import ToolsPanel from "@/Components/Shared/ToolsPanel.vue";

export default {
    layout: WorkLayout,

    components: {
        ToolsPanel,
        CardsLayout,
        CardItem
    },

    props: {
        products: Object
    }

    
}
</script>

<style lang='scss' scoped>

</style>