<template>
<div class="section-text">
    <span>{{ title }}</span>
    <input :type='type' 
        :value="modelValue" 
        :key="name" 
        :name='name' 
        :class="error ? 'i-error' : ''" 
        @input="updateValue"
        :required='required'
        :disabled='disabled'
    >
    <span class="error" v-if="error">{{ error }}</span>
</div>
</template>

<script>
export default {
    props: [
        "title", 
        "type",
        "modelValue",
        "name",
        "error",
        "required",
        "disabled"
    ],

    emits: ['update:modelValue'],

    methods: {
        updateValue(e) {
            this.$emit("update:modelValue", e.target.value);
        }
    }
}
</script>

<style>

</style>