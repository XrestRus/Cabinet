<template>
<div class="list-nav">
    <div class="title-nav" @click="toggle">
        <span>{{ title }}</span>
    </div>
    <div class="container-nav" :class="{ unshow: isUnShow }">
        <slot></slot>
    </div>
</div>
</template>

<script>
export default {
    props: ['title'],
    data() {
        return {
            isUnShow: false,
        }
    },

    methods: {
        toggle() {
            this.isUnShow = !this.isUnShow; 
        }
    }
}
</script>

<style lang='scss'>
.list-nav {
    border-radius: 10px;
    overflow: hidden;
   
    .title-nav {
        text-align: center;
        background: var(--color-form-h);
        color: var(--color-white);
        padding: 0.4rem;
        transition: 0.2s;
        user-select: none;
        position: relative;
        border-top: 1px solid silver;
        border-bottom: 1px solid silver;

        &:hover {
            background: var(--color-form-a);     
            cursor: pointer;                   

            ~.container-nav {
                outline: 1px solid var(--color-form-h);
            }
        }
    }

    .unshow {
        display: none;
    }   

}
</style>