<template>
<td class="td-input table-data" :colspan="colspan ?? null">
    <div class="td-input-wrap">
        <input  
            :type="type" :value="modelValue" 
            @input="update"
            autofocus
            min="1"
            minlength="1"
            required
        >
        <div v-if="error" class="error-wrap"> !
            <span class="error">{{ error }}</span>
        </div>
    </div>
</td>
</template>

<script>
import { ref } from 'vue'
export default {
    props: {
        modelValue: {
            default: ""
        },
        colspan: {
            default: null
        },
        type: null,
        error: null
    },

    setup(props) {
        const type = props.type ?? ref(typeof props.modelValue);


        return {
            type
        }
    },

    methods: {
        update($event) {
            this.$emit('update:modelValue', $event.target.value);
        },
    }
}
</script>

<style lang='scss'>

</style>
