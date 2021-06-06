<template>
<div class="section-select">
    <span>{{ title }}</span>

    <div class="drop-list" 
        :class="{ 'drop-fixed': isDrop }"
    >
        <div class="drop-list-present" 
            :class="{ 'drop-fixed': isDrop }"
            @click="isDrop = !isDrop" 
        >
            {{ modelValue ? modelValue?.title : "Не выбранно" }}
        </div>
        <ul v-if="data.length > 0" 
            :class="{ click: isDrop }"
            class="drop-list-items" 
        >
            <li v-for="d of data" 
                :key="d" 
                :value="d.id" 
                class="drop-list-item" 
                @click="select(d, $event)"
            >
                {{ d.title }}
            </li>
        </ul>
    </div>

    <span class="error" v-if="error">{{ error }}</span>
</div>
</template>

<script>
export default {
    props: ['title', 'data', 'modelValue', 'error', 'present'],

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

<style lang='scss'>


</style>
