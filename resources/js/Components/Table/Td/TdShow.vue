<template>
<td :title='value' class="td-show table-data" :colspan="colspan ?? null">
    <div class="td-show-wrap">
        {{ value }}
    </div>
</td>
</template>

<script>
export default {
    props: {
        value: {
            default: ""
        },
        colspan: {
            default: null
        },
    },
}
</script>

<style>
.td-show-wrap {
    text-overflow: ellipsis;
    white-space: nowrap;
    overflow: hidden;
}
</style>
