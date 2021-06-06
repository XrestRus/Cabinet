<template>
<div
    class="c-cell body"
    :class="{ currentMonth: isCurrentMonth }"
    @click='data && data.length > 0 && event ? event(data, $event) : ""'
    :title="data && data.length > 0 ? data[0].desc : ''"
>
    <span class='c-day' :class="{ 'no-work-day': column === 6 || column === 7 }">{{ cell }}</span>
    <div class="wrap">
        <span class='c-info'
              v-for="d of data"
              :key="d"
              :title="d.desc"
        >
            {{ d.title }}
        </span>
    </div>
</div>
</template>

<script>
export default {
    props: {
        row: Number,
        column: Number,
        cell: Number,
        event: {
            type: Function,
            default: null
        },

        day: Number,
        data: null,
        isCurrentMonth: Boolean
    },
}
</script>

<style lang='scss'>
.c-cell {
    .wrap {
        display: flex;
        flex-direction: column;
        align-items: center;
        flex: 1;
        max-height: 90px;
        overflow: overlay;
    }
}
.no-work-day {
    color: red;
}
</style>
