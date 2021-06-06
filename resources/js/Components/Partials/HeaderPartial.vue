<template>
<header class="header" :style="cssList">
    <inertia-link href="/" class="header-title"><span>Ваш кабинет!</span></inertia-link>
    <div class="header-box">
        <inertia-link :href='route("logout")' method='post' as='button'>Выйти</inertia-link>
    </div>
</header>
</template>

<script>
export default {
    props: {
        cssList: {
            type: String,
            default: ""
        }
    }
}
</script>

<style lang='scss'>
.header {
    padding: 0.5rem;
    display: flex;
    justify-content: space-between;
    z-index: 1;
    height: 50px;
    align-items: center;
    
    .header-title {
        font-size: 22px;
        border: 2px solid var(--color-form);
        padding: 0.2rem !important;
        border-radius: 5px;
        font-family: Arial;
        cursor: pointer;
        color: var(--color-text);

        &:hover {
            background: var(--color-form-h);
            color: var(--color-white);
        }
        &:active {
            background: var(--color-form-a);
            color: var(--color-white);
        }
    }
    
    .header-box {
        button {
            padding: 0.2rem;
            border-radius: 5px;
        }
    }
}
</style>