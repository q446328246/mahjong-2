<template>
    <div class="tehai">
        <HaipaiComp
            :tiles=tehai_tiles
            class_name="select-tehai"
        ></HaipaiComp>

        <p>ツモ牌</p>
        <HaiComp
            :tile=selectQuestionDetail.tumo_tile
            class_name="select-dora"
        ></HaiComp>

    </div>

    <!--    <div class="my-5">-->
<!--        <p v-if="status === 0">待ち牌は？</p>-->
<!--        <p v-else-if="(status === 1 || status == 2) && correct[question_now_cnt - 1]">正解！</p>-->
<!--        <p v-else-if="(status === 1 || status == 2) && !correct[question_now_cnt - 1]">不正解</p>-->
<!--        <MachihaiComp-->
<!--            :answers = "answers_tiles"-->
<!--            @picked="putPickedAnswer($event)"-->
<!--        ></MachihaiComp>-->
<!--        <p v-if="ans_picked === 0">選択してください</p>-->
<!--    </div>-->
</template>

<script>
    import HaipaiComp from '../molecules/Haipai'
    import HaiComp from '../atoms/Hai'
    import { mapState } from 'vuex'


    export default {
        name: "SelectTehai",

        components: {
            HaipaiComp, HaiComp
        },

        props: [
            'tehai_tiles'
        ],

        data: function() {
            return {
            }
        },

        created() {
        },

        methods: {


            putPickedAnswer(index) {
                this.pickedAns(index)
            },

        },

        computed: {
            ...mapState('Select', [
                'selectQuestionDetail'
            ]),
        },
    }
</script>

<style scoped>

</style>
