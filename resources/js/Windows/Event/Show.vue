<template>
<modal
    title="Карточка событий"
>
    <div class="r">
        <div class="c">
            <div class="section">
                <div class="section-title">События</div>
                <div class="section-body">
                    <template v-if='events'>
                        <section-present 
                            v-for="e of events"
                            :key='e'
                            :title="e.title"
                            :data='e.desc'
                            :date='e.date'
                        />
                    </template>
                    <section-present 
                        v-else
                        title=""
                        data='нету'
                    />
                </div>
            </div>
        </div>
    </div>
</modal>
</template>

<script>
import Modal from '@/Components/Modals/Modal.vue';
import SectionPresent from '@/Components/Modals/Sections/SectionPresent.vue';

export default {
    components: { Modal, SectionPresent },
    props: {
        events: null
    }
}
</script>

<style>

</style>
