<template>
    <div class="component-body">
        <tools-panel title="Должности">
            <button @click="showAdd()" class="btn--add-fixed">+</button>
        </tools-panel>
        <div class="roles view">
            <table-standart :collection="roles" :tools="tools" :changeRow='validate'>
                <template v-slot:head>
                    <td-show value='Название' />
                </template>
                <template v-slot:show="props">
                    <td-show 
                        :value="props.item.title" 
                    />                       
                </template>
                <template v-slot:edit="props">
                    <td-input 
                        v-model.trim="props.currentItem.title" 
                        :error="props.errors.title"
                    />
                </template>
            </table-standart>
            <transition name="modal-animate">
                <template v-if="modal.isShow">
                    <window-role-add 
                        :errors="errors" 
                        v-model='modal.isShow'
                        v-if="modal.type === 'add'" 
                    />
                </template>
            </transition>
        </div>
    </div>
</template>

<script>
import WorkLayout from '@/Layouts/WorkLayout.vue';
import WindowRoleAdd from "@/Windows/Types/Role/Add";
import TableStandart from "@/Components/Table/TableStandart";
import TdShow from "@/Components/Table/Td/TdShow";
import TdInput from "@/Components/Table/Td/TdInput";
import ToolsPanel from "@/Components/Shared/ToolsPanel.vue";
import { useForm } from '@inertiajs/inertia-vue3';

export default {
    layout: WorkLayout,

    components: {
        WindowRoleAdd,
        TableStandart,
        TdShow,
        TdInput,
        ToolsPanel,
    },

    props: {
        roles: {
            type: Array,
            default: []
        },
        errors: Object,

    },

    data() {
        return {
            tools: {
                isShow: true,
                actions: {
                    remove: this.remove,
                    show: this.present
                },
                buttons: [{
                    title: 'Загрузить',
                    action: this.load,
                    type: 'file',
                    accept: '.pdf',
                    cssClass: 'svg-download'
                }]
            },

            currentItem: {
                id: Number,
            },

            modal: {
                isShow: Boolean,
                type: String,
            },

            changeRow: this.validate
        }
    },

    methods: { 
        remove(id) {
            this.$inertia.post(this.route("role.delete", { id: id }));
        },
        showAdd() {
            this.modal.type = 'add';
            this.show(true);
        },
        show(toggle) {
            this.modal.isShow = toggle
        },

        validate(currentItem) {
            this.submit(useForm(currentItem));
        },

        submit(form) {
            let res;

            form.post(this.route("role.edit", { id: form.id }));
            
            return res;
        },

        load(id, item, e) {
            item.pdf_path = e.target.files[0];
           
            let form = useForm(item);
            
            form.post(this.route("role.edit", { id: form.id }), {
                preserveState: false
            });
        },
        present(id) {
            this.$inertia.get(route("role.show.pdf", { id: id }));
        }
    }
}
</script>

<style lang='scss' scoped>
.role-tools {
    display: flex;
    
    a,label, span {
        flex: 1;
        padding-left: 0.44rem;
        align-items: center;
        display: flex;
    }

    a, span {
        max-width: 50%;
    }
}
</style>
