<template>
<div class="home-layout">
    <header-partials cssList="box-shadow: 1px 2px 8px 1px #0000008c"/>
    <slot></slot>
</div>
</template>

<script>
import HeaderPartials from '../Components/Partials/HeaderPartial.vue'
export default {
    components: { HeaderPartials },

}
</script>

<style lang='scss' scope>
.home-layout {
    height: 100vh;
    display: flex;
    flex-direction: column;
}
</style>