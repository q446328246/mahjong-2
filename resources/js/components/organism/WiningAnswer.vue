<template>
    <div class="my-5">
        <p v-if="status === 0">待ち牌は？</p>
        <p v-else-if="(status === 1 || status == 2) && correct[question_now_cnt - 1]">正解！</p>
        <p v-else-if="(status === 1 || status == 2) && !correct[question_now_cnt - 1]">不正解</p>
        <MachihaiComp
            :answers = "answers_tiles"
            @picked="putPickedAnswer($event)"
        ></MachihaiComp>
        <p v-if="ans_picked === 0">選択してください</p>
    </div>
</template>

<script>
    import MachihaiComp from '../molecules/Machihai'
    import { mapState, mapGetters, mapActions } from 'vuex'


    export default {
        name: "WiningAnswer",

        components: {
            MachihaiComp,
        },

        data: function() {
            return {
            }
        },

        created() {
        },

        methods: {
            ...mapActions('Wining', [
                'pickedAns'
            ]),

            putPickedAnswer(index) {
                this.pickedAns(index)
            },

        },

        computed: {
            ...mapState('Wining', [
                'question_now_cnt',
                'answers',
                'status',
                'correct',
                'ans_picked'
            ]),

            ...mapGetters('Wining', {
                answers_tiles: 'createAnswersTiles',
            }),
        },
    }
</script>

<style scoped>

</style>
