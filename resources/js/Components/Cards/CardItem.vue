<template>
    <div class="card">
        <div class="c">
            <section-image
                v-model='item[namePropImg]'
            />
        </div>
        <div class="wrap c">
            <div class="wrap-text">
                <slot></slot>
            </div>
            <div class="wrap-btns">
                <buttons-panel
                    :isShow="tools?.isShow"
                    :item='item'
                    :buttons='tools?.buttons'
                    :show='tools?.actions?.show'
                    :edit='tools?.actions?.edit'
                    :remove='tools?.actions?.remove'
                />
            </div>
        </div>
    </div>
</template>

<script>
import ButtonsPanel from '../Shared/ButtonsPanel.vue'
import SectionImage from '@/Components/Modals/Sections/SectionImage.vue';

export default {
    components: {
        ButtonsPanel,
        SectionImage
    },

    props: {
        item: Object,
        namePropImg: null,
        tools: {
            type: Object,
            default: {
                buttons: null,
                isShow: false,
                actions: null
            }
        },
    },
}
</script>

<style lang='scss'>
.card {
    border: 1px solid #ddddddc0;
    border-radius: 10px;
    margin: 1rem;
    display: flex;
    max-height: 320px;
    width: 400px;

    .wrap {
        justify-content: space-between;
        .wrap-text {
            margin: 0.3rem;
            .text {
                border-bottom: 1px solid #ddddddc0;
                text-align: center;
                padding: 0.4rem 0px;
                display: flex;
                flex-wrap: wrap;
                font-size: 14px;
                max-width: 189px;

                span {
                    margin: 0 0.4rem;
                }
            }
        }
    }

    .wrap-btns {
        background-color: rgb(196 196 196 / 25%);
        padding: 0.2rem 0;
        border-radius: 25px 0 0 0;
    }

    .img {
        width: 200px;
        margin: auto;
        flex: 1;
        background-color: rgb(196 196 196 / 25%);
    }

}
@media (max-width: 700px) {
   .card {
       max-height: initial;
       width: 100%;
       flex-direction: column;

       .text {
           max-width: 100% !important;
       }
   }
}
</style>
