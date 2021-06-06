<template>
    <div class="btns"
        v-if='isShow'
    >
        <template v-if="buttons">
            <template 
                v-for="b in buttonsIsShow"
                :key="b"
            >
                <label :for="item.id+'loadFile'"
                    v-if="b?.type === 'file'"
                    :class="b.cssClass ?? 'btn--default svg-default'"
                    class='label-btn'
                    :title='b.title'
                >
                    <input 
                        :id="item.id+'loadFile'" 
                        type="file" 
                        class="hidden" 
                        :accept="b.accept" 
                        @input="b.action(item.id, item, $event)"
                    >
                </label>

                <a  v-else-if="b?.type === 'link'"
                    :href="b?.action(item.id, item)"
                    :class="b.cssClass ?? 'btn--default svg-default'"
                    class='label-btn'
                >

                </a>

                <button
                    v-else
                    @click='b.action(item.id, item, $event)'
                    :class="b.cssClass ?? 'btn--default svg-default'"
                    :title='b.title'
                >
                </button>
            </template>
        </template>

        <button
            v-if="show"
            @click="show(item.id, item)"
            class="btn--info svg-info"
            title='Подробнее'
        ></button>
        <button
            v-if="edit"
            @click="edit(item.id, item)"
            class="btn--edit svg-edit"
            title='Изменить'
        ></button>
        <button
            v-if="remove"
            @click='removeConfirm'
            class="btn--delete svg-delete"
            title='Удалить'
        ></button>
    </div>
</template>

<script>
export default {
    props: {
        buttons: {
            type: Array,
            default: null,
        },
        item: Object,
        isShow: false,
        show: Function,
        edit: Function,
        remove: Function
    },

    computed: {
        buttonsIsShow() {
            return this.buttons.filter(i => !i.isShow); 
        }
    },

    methods: {
        removeConfirm() {
            if (confirm('Точно удалить?')) {
                this.remove(this.item.id, this.item);
            }
        },
    },
}
</script>

<style>

</style>