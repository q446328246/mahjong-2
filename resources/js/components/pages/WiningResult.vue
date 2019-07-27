<template>
    <div>
        <Header text="待ち牌当て結果"></Header>
        <h3 v-if="level === 1">初級</h3>
        <h3 v-else-if="level === 2">中級</h3>
        <h3 v-else-if="level === 3">上級</h3>
        <h4>結果</h4>
        <p>{{ question_amt }}問中<span class="red">{{ correct_amt }}</span>問正解！</p>
        <hr>

        <WiningResultHaipaiComp></WiningResultHaipaiComp>

        <a href="/" class="btn btn-primary">TOPに戻る</a>
    </div>
</template>

<script>
    import 'es6-promise/auto'
    import Header from '../molecules/header'
    import WiningResultHaipaiComp from '../organism/W_Result_Haipai'
    import { mapState, mapGetters } from 'vuex'

    export default {
        name: "Wining",
        components: {
            Header,WiningResultHaipaiComp
        },

        created() {
        },

        methods: {

        },

        computed: {
            ...mapState('Wining', [
                'status',
                'level',
                'question_amt',
            ]),

            ...mapGetters('Wining', {
                correct_amt: 'getCorrectAmount'
            })
        }
    }
</script>

<style scoped>
    .red {
        color: red;
    }


</style>
