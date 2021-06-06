<template>
<div
    class="tools-item svg-back" 
    @click="back"
    title="Назад"
>
    <span></span>
</div>
</template>

<script>
export default {
    methods: {
        back() {
            window.history.back();
            setTimeout(_ => this.$inertia.reload(), 100);
        },
    }
}
</script>

<style>

</style>
