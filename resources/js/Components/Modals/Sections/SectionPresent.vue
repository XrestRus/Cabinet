<template>
<div class="section-text">
    <span>{{ title }}</span>
    <span>{{ data }}</span>
    <span class="date">{{ date }}</span>
</div>
</template>

<script>
export default {
    props: {
        title: null,
        data: null,
        date: null
    }
}
</script>

<style>
.date {
    bottom: -5px;
    position: absolute;
}
</style>