<template>
    <div>
        <div v-for="(ans_tiles, index) in answers"
             :key="index"
             @click="pickedAns($event, index)"
             class="row my-4 mx-2 py-2 ans"
        >

            <div class="col-3 m-auto">
                <div v-if="status === 1 || status == 2" :class="{incorrect:checkIncorrectClass(index), correct:checkCorrectClass(index) }">
                    <span></span>
                    {{ index + 1 }}
                </div>
                <div v-else>
                    {{ index + 1 }}
                </div>
            </div>

            <div class="col-9 text-left">
                <HaiComp
                    v-for="(tile, index) in ans_tiles" :key="index"
                    :tile=tile
                    class_name="wining_ans"
                ></HaiComp>
            </div>
        </div>
    </div>
</template>

<script>
    import HaiComp from '../atoms/Hai'
    import { mapState } from 'vuex'

    export default {
        name: "Machihai",

        components: {
            HaiComp,
        },

        props: [
            'answers',
        ],

        created() {
        },

        methods: {
            pickedAns(event, index) {
                if (this.status === 0) {
                    // jQueryでclassの追加と削除
                    var selected_element = $(".selected")
                    selected_element.each(function () {
                        $(this).removeClass("selected")
                    })
                    $(event.currentTarget).addClass("selected")

                    this.$emit('picked', index + 1)
                }
            },

            checkIncorrectClass: function (index) {
                if (Number(index + 1) === this.ans_picked) {
                    if (this.ans_picked !== this.ans_num[this.question_now_cnt - 1]) {
                        return true
                    } else {
                        return false
                    }
                } else {
                    return false
                }
            },

            checkCorrectClass: function (index) {
                if (Number(index + 1) === this.ans_num[this.question_now_cnt - 1]) {
                    return true
                } else {
                    return false
                }
            },
        },

        computed: {
            ...mapState('Wining', [
                'status', 'ans_num', 'ans_picked', 'question_now_cnt'
            ]),
        }

    }
</script>

<style scoped>
    .selected {
        background: rgba(240,255,255,0.5);
        border:solid 1px #00a1e9;
        color: #00a1e9;
        outline: 0;
        box-shadow: 0 0 0 0.2rem rgba(0,123,255,.25);
    }

    .correct {
        width: 30px;
        height: 30px;
        margin: auto;
        line-height:1.8em;
        padding-top:0.1em;
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
