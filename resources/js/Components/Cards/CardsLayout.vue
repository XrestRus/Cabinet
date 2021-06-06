<template>
    <div class="cards">
        <card-item 
            v-for="c in collection"
            :key="c"
            :item="c"
            :tools="tools"
            :namePropImg='namePropImg'
        >
            <slot 
                name="card" 
                :item="c"
            >
            
            </slot>
        </card-item>
    </div>
</template>

<script>
import CardItem from './CardItem.vue'

export default {
    components: {
        CardItem
    },

    props: {
        collection: null,
        namePropImg: null,
        tools: Object,
    },
}
</script>

<style lang='scss'>
.cards {
    display: flex;
    flex-wrap: wrap;
    flex-direction: row;
    flex: 1;
 
}
</style>
