<template>
<div class="work-layout">
    <header-partials />
    <div class="main">
        <nav-layout :current='route().current()' />
        <div class="component">
            <slot></slot>
        </div>
    </div>
</div>
</template>

<script>
import HeaderPartials from '../Components/Partials/HeaderPartial.vue'
import NavLayout from '../Components/Partials/NavLayout.vue'

export default {

    components: { 
        HeaderPartials, 
        NavLayout 
    },

}
</script>

<style lang='scss' scope>
.work-layout {
    height: 100vh;
    display: flex;
    flex-direction: column;

    .main {
        display: flex;
        height: 100%;
        
    }

    .component {
        box-shadow: inset 1px 2px 8px 1px #0000008c;
        border-radius: 10px 0 0 0;
        flex: 1;
        display: flex;

        &>div {
            flex: 1;
        }
    }
}
</style>
