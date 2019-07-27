<template>
    <dl v-for="value in values">
        <dd>{{value.dd}}</dd>
        <dt>{{value.dt}}</dt>
    </dl>
</template>

<script>
    export default {
        name: "DifinedList",
        props: ['values']
    }

</script>

<style scoped>

</style>