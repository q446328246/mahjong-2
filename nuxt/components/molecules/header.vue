<template>
    <nav class="navbar navbar-expand-md navbar-light bg-green justify-content-center">
        <b-navbar-toggle target="nav_collapse"></b-navbar-toggle>
        <b-navbar-brand>
            <Title :title=text></Title>
        </b-navbar-brand>
    </nav>
</template>

<script>
    import Title from '../atoms/Title'

    export default {
        name: "Header",
        components: {
            Title,
        },
        props: ['text'],
    }
</script>

<style scoped>
    .bg-green {
        background-color: greenyellow;
    }
    nav {
        margin-bottom: 60px;
    }
</style>
