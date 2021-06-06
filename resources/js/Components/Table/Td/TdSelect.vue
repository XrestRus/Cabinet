<template>
<td 
    class="td-select table-data" 
    :colspan="colspan ?? null"
>
    <div 
        class="td-select-wrap"
    >
        <div 
            class="drop-list" 
            :class="{ 'drop-fixed': isDrop }"
        >
            <div 
                class="drop-list-present" 
                @click="isDrop = !isDrop" 
                :class="{ 'drop-fixed': isDrop }"
            >
                {{ modelValue ? modelValue?.title : "Не выбранно" }}
            </div>
            <ul 
                v-if="data.length > 0" 
                class="drop-list-items" 
                :class="{ click: isDrop }"
            >
                <li 
                    v-for="d of data" 
                    :key="d" 
                    :value="d.id" 
                    class="drop-list-item" 
                    @click="select(d, $event)"
                >
                    {{ d.title }}
                </li>
            </ul>
        </div>
    </div>
</td>
</template>

<script>
export default {
    props: {
        modelValue: null,
        colspan: null,
        data: {
            type: Array,
            default: []
        }
    },

    data() {
        return {
            selected: this.data.length > 0 ? this.data[0] : { id: 0, title: "Пусто" },
            isDrop: false
        }
    },

    methods: {
        select(item, e) {
            this.$emit('update:modelValue', item);
            this.isDrop = false;
        }
    }
}
</script>

<style>

</style>
