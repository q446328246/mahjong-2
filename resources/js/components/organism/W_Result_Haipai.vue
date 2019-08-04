<template>
    <div class="container">
        <div v-for="(q_tiles, q_index) in all_q_tiles" :key="q_index" class="my-3 row">
            <div class="col-1 m-auto">
                <div :class="{incorrect:checkIncorrectClass(q_index), correct:checkCorrectClass(q_index) }">
                    <span></span>
                    {{ q_index + 1 }}
                </div>
            </div>
            <div class="col-11 text-left">
                <HaipaiComp
                    class_name="wining-result-haipai"
                    :tiles=q_tiles
                ></HaipaiComp>
            </div>
            <div class="col-12">
                待ち牌は、
                <HaiComp
                    v-for="(tile, ans_index) in answers_tiles[q_index]" :key="ans_index"
                    :tile=tile
                    class_name="wining_result"
                ></HaiComp>
            </div>
        </div>
    </div>
</template>

<script>
    import 'es6-promise/auto'
    import HaipaiComp from '../molecules/Haipai'
    import HaiComp from '../atoms/Hai'
    import { mapState, mapGetters } from 'vuex'

    export default {
        name: "W_Result_Haipai",

        components: {
            HaipaiComp,HaiComp
        },

        methods: {
            checkIncorrectClass: function (index) {
                if (!this.correct[index]) {
                    return true
                } else {
                    return false
                }
            },

            checkCorrectClass: function (index) {
                if (this.correct[index]) {
                    return true
                } else {
                    return false
                }
            },
        },

        computed: {
            ...mapState('Wining', [
                'correct'
            ]),

            ...mapGetters('Wining', {
                all_q_tiles: 'getAllQuestionTiles',
                answers_tiles: 'getCorrectWiningTiles',

            }),
        }

    }
</script>

<style scoped>

    .correct {
        width: 30px;
        height: 30px;
        margin: auto;
        line-height:1.8em;
        padding-left:0.5em;
        padding-right:0.5em;
        border:1px solid #ff0000;
        border-radius: 50%;
    }

    .incorrect {
        width: 30px;
        height: 30px;
        margin: auto;
        display: inline-block;
        position: relative;
        cursor: pointer;
        line-height: 2em;
    }

    .incorrect span::before,
    .incorrect span::after {
        display: block;
        content: "";
        position: absolute;
        top: 50%;
        left: 50%;
        width: 84%;
        height: 16%;
        margin: -8% 0 0 -42%;
        background: #0017ff;
        opacity: 0.5;

    }
    .incorrect span::before {
        transform: rotate(-45deg);
    }
    .incorrect span::after {
        transform: rotate(45deg);
    }
</style>
