<template>
<div class='role-pdf content page'>
    <tools-panel :title="'Должность - описание  ' + role.title">
    </tools-panel>
    <div class="r">
        <div class="c">
            <iframe :src="'/storage/' + role.pdf_path"></iframe>
        </div>
    </div>
</div>
</template>

<script>
import WorkLayout from '@/Layouts/WorkLayout.vue';
import WindowPaymentTypeAdd from "@/Windows/Types/Payment/Add";
import TableStandart from "@/Components/Table/TableStandart";
import TdShow from "@/Components/Table/Td/TdShow";
import TdInput from "@/Components/Table/Td/TdInput";
import TdSelect from "@/Components/Table/Td/TdSelect";
import ToolsPanel from "@/Components/Shared/ToolsPanel.vue";
import { useForm } from '@inertiajs/inertia-vue3';

export default {
    layout: WorkLayout,

    components: {
        WindowPaymentTypeAdd,
        TableStandart,
        TdShow,
        TdInput,
        TdSelect,
        ToolsPanel,
    },

    props: {
        role: {},
        errors: Object,
    },

}
</script>

<style>
iframe {
    flex: 1;
    margin: 0 1rem;
}
</style>