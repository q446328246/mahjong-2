<template>
    <div>
        <Header text="待ち牌当て"></Header>
        <div>
            待ち牌当て
        </div>
        <hr>

        <WiningQuestionComp></WiningQuestionComp>
        <div class="timer" v-if="level===2">次の問題まで後「{{ counter }}」</div>
        <WiningAnswerComp></WiningAnswerComp>

        <button v-if="status === 0" @click="Answer" type="button" class="btn btn-primary">回答</button>
        <button v-else-if="status === 1" @click="NextQuestion" type="button" class="btn btn-warning">次の問題へ</button>
        <button v-else-if="status === 2" @click="moveResult" type="button" class="btn btn-warning">結果画面へ</button>

        <a href="/" class="btn btn-primary">TOPに戻る</a>
    </div>
</template>

<script>
    import 'es6-promise/auto'
    import Header from '../molecules/header'
    import WiningQuestionComp from '../organism/WiningQuestion'
    import WiningAnswerComp from '../organism/WiningAnswer'
    import { mapState, mapActions } from 'vuex'

    export default {
        name: "Wining",
        components: {
            Header,WiningQuestionComp,WiningAnswerComp
        },

        async created() {
            await this.createWiningQuestions()

            if (this.level === 2) {
                this.setTimer()
            }
        },

        beforeDestroy() {
            if (this.level === 2) {
                this.destroyTimer()
            }
        },

        methods: {
            ...mapActions('Wining', [
                'createWiningQuestions',
                'answerAction',
                'setNextQuestion',
                'moveResult',
                'setTimer',
                'destroyTimer'
            ]),

            Answer: function () {
                // // 選択時の.selectedを消す
                // var selected_element = $(".selected")
                // selected_element.each(function () {
                //     $(this).removeClass("selected")
                // })
                this.answerAction()
            },

            NextQuestion: function() {
                // スクロール位置をトップ
                scrollTo(0, 0)
                this.setNextQuestion()
            },

            Result: function () {

            }
        },

        computed: {
            ...mapState('Wining', [
                'status', 'ans_picked','level','counter'
            ]),
        }
    }
</script>

<style scoped>
    .bg-green {
        background-color: greenyellow;
    }
</style>
