<template>
    <div>
        Thanksページ
        <HeadComp></HeadComp>
        送信ありがとうございました！
        <p><a href="/">TOP</a></p>
        <uranai></uranai>
    </div>
</template>

<script>
    import HeadComp from './modules/HeadComp'
    import uranai from './Divination'
    // import { mapActions, mapGetters } from 'vuex'

    export default {
        name: 'Thanks',
        components: {
            HeadComp,
            uranai
        }
    }
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
    h1, h2 {
        font-weight: normal;
    }

    ul {
        list-style-type: none;
        padding: 0;
    }

    li {
        display: inline-block;
        margin: 0 10px;
    }

    a {
        color: #42b983;
    }
</style>
