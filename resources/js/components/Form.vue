<template>
    <div>
        Formページ
        <HeadComp></HeadComp>
        <component
                :is="isComponent"
        ></component>
        <button v-on:click="buttonAction">{{button}}</button>
    </div>
</template>

<script>
    import HeadComp from './modules/HeadComp'
    import TextareaComp from './modules/TextareaComp'
    import StringComp from './modules/StringComp'
    import { mapActions, mapGetters } from 'vuex'

    export default {
        name: 'form-vuex',
        methods: mapActions('VuexSample', {
            'buttonAction': 'buttonAction'
        }),
        computed: mapGetters('VuexSample', {
            'button': 'getButton',
            'isComponent': 'getComponent'
        }),
        components: {
            HeadComp,
            TextareaComp,
            StringComp,
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