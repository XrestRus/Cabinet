<template>
<td class="td-date table-data" :colspan="colspan ?? null">
    <div class="td-date-wrap">
        <input type="date" :value="modelValue" @input="$emit('update:modelValue', $event.target.value)">
        <div v-if="error" class="error-wrap"> !
            <span class="error">{{ error }}</span>
        </div>
    </div>
</td>
</template>

<script>
export default {
    props: {
        modelValue: {
            default: ""
        },
        colspan: {
            default: null
        },
        error: null
    },
}
</script>

<style>

</style>
