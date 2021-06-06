<template>
<td 
    title="Изображение" 
    class="td-image table-data" 
    :colspan="colspan ?? null"
>
    <div class="td-image-wrap">
        <div 
            class="section-img image" 
            :style="{ backgroundImage: img }"
        >
        </div>
    </div>
</td>
</template>

<script>
export default {
    props: {
        value: null,
        colspan: null
    },

    computed: {
        img: function() {
            return this.value ? `url(/storage/${ this.value })` : null
        },
    },

}
</script>

<style lang='scss'>
.td-image-wrap {
    div {
        height: 40px;
        display: flex;
    }
}
</style>