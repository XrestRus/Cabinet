<template>
<div class="modal-wrap">
    <div class="modal">
        <div class="modal-title r-0">
            <span>{{ title }}</span>
            <button @click="toggle">Закрыть</button>
        </div>
        <div class="modal-body">
            <slot></slot>
        </div>
        <div class="modal-action" v-if="action">
            <button @click="proxyHandler">{{ action.title }}</button>
        </div>
    </div>
</div>
</template>

<script>
export default {
    props: {
        action: {
            title: {
                type: String,
                default: "Действие"
            },
            handler: {
                type: Function
            }
        },
        title: {
            type: String,
            default: "Карточка"
        },
        modelValue: Boolean,
    },

    methods: {
        toggle() {
            this.$emit("update:modelValue", false);
        },
        proxyHandler() {
            this.loading(this.action.handler);
        },
        async loading(func) {
            this.loader = true;
            await func();
            this.loader = false;
        },
    },
}
</script>

<style lang='scss'>
.modal-wrap {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    z-index: 10000;
    background-color: rgba(192, 192, 192, 0.418);
    display: flex;
    justify-content: center;
    align-items: center;

    .modal {
        background-color: silver;
        display: flex;
        flex-direction: column;
        border-radius: 15px;
        overflow: hidden;

        .modal-title {
            text-align: center;
            font-size: 28px;
            padding: 1rem;
            background-color: white;

            span {
                width: 80%;
                margin-right: 2rem;
            }
            button {
                width: min-content;
                border-radius: 10px;
            }
        }

        .modal-body {
            flex: 1;
            display: flex;
            flex-wrap: wrap;
            max-height: calc(100vh - 40vh);
            overflow: auto;

            input {
                flex: 1;
            }
        }

        .modal-action {
            height: 50px;

            button {
                height: 100%;
            }
        }
    }
}

</style>
