<template>
<div class="auth-layout">
    <div class="conteiner">
        <slot></slot>
    </div>
</div>
</template>

<script>
export default {
    
}
</script>

<style lang='scss'>
.auth-layout {
    display: flex;
    justify-content: center;
    align-items: center;
    flex-wrap: wrap;
    height: 100vh;

    .conteiner {
        background: #e32f2c;
        display: flex;
        justify-content: center;
        align-items: center;
        flex-wrap: wrap;
        height: 100%;
    }
}
</style>