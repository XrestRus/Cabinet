<template>
    <div class="table-wrap"
        @mouseleave="mouseleave"
        @click='reset'
    >

        <table>
            <tr class="tr-head">
                <slot name="head" class=" td-sticky"></slot>

                <td-show
                    class='td-head-tools-fixed'
                    :style="{ width: widthTools + 'px' }" v-if='tools.isShow'
                />
            </tr>

            <template  v-if="collection.length > 0">

                <tr
                    v-for="(item, index) of collection"
                    :key="index"
                    @click='changeRow ? focus(item, $event) : null'
                    @keypress="changeRow ? enter($event) : null"
                >

                    <slot
                        v-if="tools.isShow && selected && selected.id === item.id"
                        name='edit'
                        :item="item"
                        :currentItem='selected'
                        :errors='errors'
                    ></slot>
                    <slot
                        v-else name='show'
                        :item="item"
                    ></slot>

                    <td
                        class="table-btns"
                        v-if='tools.isShow'
                    >
                        <buttons-panel
                            :isShow="tools.isShow"
                            :buttons='tools?.buttons'
                            :show='tools?.actions?.show'
                            :edit='tools?.actions?.edit'
                            :remove='tools?.actions?.remove'
                            :item='item'
                            :style="{ width: widthTools + 'px' }"
                        >
                        </buttons-panel>
                    </td>
                </tr>

            </template>
            <template v-else>
                <div class="tr-no-data">
                    <span>
                        Данных нету
                    </span>
                </div>
            </template>
        </table>
    </div>
</template>

<!-- Example
    <td-date  v-model="model.date" />
    <td-input  v-model="model.input" />
    <td-select  v-model="model.selected" :data="select" />
-->

<script>
import TdDate from './Td/TdDate.vue'
import TdInput from './Td/TdInput.vue'
import TdSelect from './Td/TdSelect.vue'
import TdShow from './Td/TdShow.vue'
import ButtonsPanel from '../Shared/ButtonsPanel.vue'
import { ref } from 'vue'

export default {
    props: {
        collection: {
            type: Array,
            default: []
        },
        tools: {
            type: Object,
            default: {
                buttons: Array,
                isShow: false,
                actions: {
                    type: Object,
                    default: {
                        show: Function,
                        edit: Function,
                        remove: Function,
                    }
                }
            }
        },
        changeRow: Function
    },

    components: {
        TdDate,
        TdInput,
        TdSelect,
        TdShow,
        ButtonsPanel
    },

    setup(props) {
        const widthTools = ref(0);

        let count = props.tools.actions ? Object.values(props.tools.actions)?.filter(i => i !== null).length : 0;

        let wA = props.tools?.actions ? count : 0;
        let wB = props.tools?.buttons?.length ?? 0;

        widthTools.value = (wA + wB) * 50;

        return {
            widthTools
        }
    },

    data() {
        return {
            selected: null,
            errors: {}
        }
    },

    methods: {
        enter(e) {
            if (e.key !== 'Enter') return;

            if (this.validate()) {
                this.subscriptEvents(null);
                this.action();
            } else {
                this.selected = null;
            }
        },

        mouseleave(e) {
            if (this.selected && this.validate()) this.action();

            this.selected = null;
        },

        reset(e) {
            if (e.target.classList.contains('table-wrap')) {
                if (this.selected && this.validate()) this.action();

                this.selected = null;
            }
        },

        focus(newSelected, e) {
            if (!this.selected)  this.selected = Object.assign({...newSelected});

            if (newSelected.id === this.selected.id) return;

            if (this.validate()) {
                this.subscriptEvents(newSelected);
                this.action();
            } else {
                this.selected = Object.assign({...newSelected});
            }
        },

        validate() {
            let p = this.collection.find(item => item.id === this.selected.id);

            if (p && p.id
                  && JSON.stringify(p) !== JSON.stringify(this.selected)
                ) {
                return true;
            }

            return false;
        },

        action() {
            this.changeRow(this.selected);
        },

        subscriptEvents(newSelected) {

            let removeSucces = this.$inertia.on('success', (event) => {
                this.selected = Object.assign({...newSelected});
                this.errors = {};
            });

            let removeError = this.$inertia.on('error', (errors) => {
                this.errors = errors.detail.errors;
            });

            let removeFinish = this.$inertia.on('finish', (event) => {

                removeSucces();
                removeError();
                removeFinish();
            });
        },

    },

}
</script>

<style lang='scss'>
</style>
