<template>
<div class="head-tools">
    <div class="tools-title">
        {{ title }}
    </div>

    <slot>
    </slot>

    <button-back />
</div>
</template>

<script>
import ButtonBack from "./ButtonBack";

export default {

    components: {
        ButtonBack,
    },

    props: ['title'],
}
</script>

<style lang='scss'>
.head-tools {
    height: 35px;
    width: 100%;
    border-bottom: 1px solid #dddddd75;
    display: flex;
    justify-content: flex-end;
    padding-right: 1rem;
    margin: 0 0 0.1rem 0;
    align-items: center;

    .tools-title {
        text-align: center;
        font-size: 24px;
        flex: 1;
        text-align: center;
        border-bottom: 1px solid silver;
        margin: 0 1rem;
    }

    .tools-item {
        display: flex;
        justify-content: center;
        align-items: center;
        width: 30px;
        height: 30px;
        cursor: pointer;
        user-select: none;
        margin: 0.2rem;
        border-radius: 50%;
        background-color: var(--color-form);
        background-size: 78%;

        &:hover {
            background-color: var(--color-form-h);
            color: var(--color-white);
        }
        &:active {
            background-color: var(--color-form-a);
            color: var(--color-white);
        }
    }

    .tools-input {
        width: min-content;
        background-color: transparent;
    }
}
@media (max-width: 700px) {
    .head-tools {
        .tools-title {
            font-size: 16px;
        }
    }

    .tools-input {
        width: 80px !important;
    }
}
</style>
