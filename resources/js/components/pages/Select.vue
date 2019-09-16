<template>
    <div>
        <Header text="どれを切る？"></Header>
        <h3>
            {{ selectQuestion.title}}
        </h3>

        <div class="select-relative">
            <div class="score toi">
                <p v-if="selectQuestionDetail.place === 'ton'">西家 {{selectQuestionDetail.toi_score}}</p>
                <p v-else-if="selectQuestionDetail.place === 'nan'">北家 {{selectQuestionDetail.toi_score}}</p>
                <p v-else-if="selectQuestionDetail.place === 'sya'">東家 {{selectQuestionDetail.toi_score}}</p>
                <p v-else-if="selectQuestionDetail.place === 'pei'">南家 {{selectQuestionDetail.toi_score}}</p>
            </div>

            <div v-if="selectQuestionDetail.toi_naki !== ''" class="naki toi">
                <HaipaiComp
                    :tiles=toi_naki_tiles
                    class_name="select-naki"
                ></HaipaiComp>
            </div>

            <div v-if="selectQuestionDetail.toi_kawa !== ''" class="kawa toi">
                <KawahaiComp
                    :tiles=toi_kawa_tiles
                    class_name="select-kawa"
                ></KawahaiComp>
            </div>

            <div class="score shimo">
                <p v-if="selectQuestionDetail.place === 'ton'">南家 {{selectQuestionDetail.shimo_score}}</p>
                <p v-else-if="selectQuestionDetail.place === 'nan'">西家 {{selectQuestionDetail.shimo_score}}</p>
                <p v-else-if="selectQuestionDetail.place === 'sya'">北家 {{selectQuestionDetail.shimo_score}}</p>
                <p v-else-if="selectQuestionDetail.place === 'pei'">東家 {{selectQuestionDetail.shimo_score}}</p>
            </div>

            <div v-if="selectQuestionDetail.toi_naki !== ''" class="naki shimo">
                <HaipaiComp
                    :tiles=shimo_naki_tiles
                    class_name="select-naki"
                    shimo_tile=true
                ></HaipaiComp>
            </div>




            <div v-if="selectQuestionDetail.kami_kawa !== ''" class="kawa kami">
                <KawahaiComp
                    :tiles=kami_kawa_tiles
                    class_name="select-kawa"
                    kami_tile=true
                ></KawahaiComp>
            </div>


            <div class="place-station">
                {{ place_station }}
            </div>

            <div class="place-dora">
                <HaiComp
                    :tile=selectQuestionDetail.dora
                    class_name="select-dora"
                ></HaiComp>
            </div>

            <div v-if="selectQuestionDetail.shimo_kawa !== ''" class="kawa shimo">
                <KawahaiComp
                    :tiles=shimo_kawa_tiles
                    class_name="select-kawa"
                    shimo_tile=true
                ></KawahaiComp>
            </div>







            <div class="score kami">
                <p v-if="selectQuestionDetail.place === 'ton'">北家 {{selectQuestionDetail.kami_score}}</p>
                <p v-else-if="selectQuestionDetail.place === 'nan'">東家 {{selectQuestionDetail.kami_score}}</p>
                <p v-else-if="selectQuestionDetail.place === 'sya'">南家 {{selectQuestionDetail.kami_score}}</p>
                <p v-else-if="selectQuestionDetail.place === 'pei'">西家 {{selectQuestionDetail.kami_score}}</p>
            </div>

            <div v-if="selectQuestionDetail.kami_naki !== ''" class="naki kami">
                <HaipaiComp
                    :tiles=kami_naki_tiles
                    class_name="select-naki"
                    kami_tile=true
                ></HaipaiComp>
            </div>


            <div v-if="selectQuestionDetail.toi_kawa !== ''" class="kawa me">
                <KawahaiComp
                    :tiles=me_kawa_tiles
                    class_name="select-kawa"
                ></KawahaiComp>
            </div>


            <div class="score me">
                <p v-if="selectQuestionDetail.place === 'ton'">東家 {{selectQuestionDetail.me_score}}</p>
                <p v-else-if="selectQuestionDetail.place === 'nan'">南家 {{selectQuestionDetail.me_score}}</p>
                <p v-else-if="selectQuestionDetail.place === 'sya'">西家 {{selectQuestionDetail.me_score}}</p>
                <p v-else-if="selectQuestionDetail.place === 'pei'">北家 {{selectQuestionDetail.me_score}}</p>
            </div>

            <div v-if="selectQuestionDetail.me_naki !== ''" class="naki me">
                <HaipaiComp
                    :tiles=me_naki_tiles
                    class_name="select-naki"
                ></HaipaiComp>
            </div>


        </div>



        <SelectTehaiComp
            :tehai_tiles=tehai_tiles
        ></SelectTehaiComp>


        <!-- 解答フィールド -->
        <div v-if="status == 1" class="container">
            <div>
                <div
                    v-for="(Answer, index) in selectResultAnswers"
                    :key="index"
                    class="row"
                >
                    <div class="col-2">
                        第{{ index + 1 }}位
                    </div>
                    <div class="col-6">
                    <HaiComp
                        :tile=Answer.hai
                        class_name="select-kawa"
                    ></HaiComp>
                    </div>
                    <div class="col-2">
                        {{ Answer.count }}票
                    </div>
                    <div class="col-2" v-if="Answer.is_comment">
                        <button
                            type="button"
                            class="btn btn-primary"
                            @click="showComment"
                        >コメントを見る</button>
                    </div>
                </div>
            </div>
            <SelectResultChartComp
                v-if="chart_render"
            ></SelectResultChartComp>
        </div>

        <div class="btn-box">
            <a href="/select_tile/top" class="btn btn-primary">TOPに戻る</a>
            <button
                v-if="status == 0 && ans_picked !== ''"
                @click="modal = true"
                type="button"
                class="btn btn-primary">回答</button>
        </div>

        <!--　解答時、モーダルウィンドウコンポーネント -->
        <ModalComp @close="closeModal" v-if="modal">
            <h3 slot="header">選択牌理由</h3>
            <div slot="body">
                選んだ牌
                <HaiComp
                    :tile=tehai_tiles[ans_picked]
                    class_name="wining_ans"
                ></HaiComp>

                <textarea v-model="comment" class="form-control mb-2" rows="3" placeholder="選んだ牌の理由を記入してください。（任意）"></textarea>

                <button
                    type="button"
                    class="btn btn-warning"
                    @click="Answer">
                    回答
                </button>
            </div>
            <!-- /footer -->
        </ModalComp>

        <!-- コメント表示時、モーダルウィンドウコンポーネント -->
        <ModalComp @close="closeCommentModal" v-if="comment_modal">
            <h3 slot="header">投票コメント</h3>
            <div slot="body">
                選んだ牌
                <HaiComp
                        :tile=tehai_tiles[ans_picked]
                        class_name="wining_ans"
                ></HaiComp>

                <div class="comment" v-for="">

                </div>

                <button
                        type="button"
                        class="btn btn-warning"
                        @click="comment_modal = false">
                    閉じる
                </button>
            </div>
            <!-- /footer -->
        </ModalComp>
    </div>
</template>

<script>
    import 'es6-promise/auto'
    import SelectTehaiComp from '../organism/SelectTehai'
    import SelectResultChartComp from '../organism/SelectResultChart'
    import Header from '../molecules/header'
    import HaipaiComp from '../molecules/Haipai'
    import KawahaiComp from '../molecules/Kawahai'
    import HaiComp from '../atoms/Hai'
    import ModalComp from '../atoms/Modal'
    import { mapState, mapActions, mapGetters } from 'vuex'

    export default {
        name: "Select",
        components: {
            SelectResultChartComp,SelectTehaiComp, Header, HaipaiComp, HaiComp, KawahaiComp,ModalComp
        },

        created() {
            this.status = 0
        },

        data: function() {
            return {
                status: 0,
                modal: false,
                comment_modal:false,
                // modal: true,
                comment: '',
            }
        },

        methods: {
            ...mapActions('Select', [
                'answerAction'
            ]),

             Answer: function () {
                this.status = 1
                this.answerAction(this.comment)
                this.closeModal()
            },

            closeModal() {
                this.modal = false
            },

            showComment() {

            }
        },

        computed: {
            ...mapState('Select', [
                'selectQuestion',
                'selectQuestionDetail',
                'ans_picked',
                'chart_render',
                'selectResultAnswers'
            ]),

            ...mapGetters('Select', [
                'splitTiles',
                'getPlaceAndStation',
            ]),

            toi_naki_tiles() {
                return this.splitTiles('toi_naki')
            },
            toi_kawa_tiles() {
                return this.splitTiles('toi_kawa')
            },
            shimo_naki_tiles() {
                return this.splitTiles('shimo_naki')
            },
            shimo_kawa_tiles() {
                return this.splitTiles('shimo_kawa')
            },
            kami_naki_tiles() {
                return this.splitTiles('kami_naki')
            },
            kami_kawa_tiles() {
                return this.splitTiles('kami_kawa')
            },
            me_naki_tiles() {
                return this.splitTiles('me_naki')
            },
            me_kawa_tiles() {
                return this.splitTiles('me_kawa')
            },
            tehai_tiles() {
                return this.splitTiles('tehai')
            },


            place_station() {
                return this.getPlaceAndStation
            }
        }
    }
</script>

<style scoped>
    .bg-green {
        background-color: greenyellow;
    }

    .score.toi {
        position: absolute;
        top: 0;
        left: 5%;
    }
    .score.shimo {
        position: absolute;
        top: 0;
        right: 3%;
    }
    .score.me {
        position: absolute;
        top: 70%;
        right: 4%;
    }
    .score.kami {
        position: absolute;
        top: 70%;
        left: 4%;
    }
    .naki.toi {
        position: absolute;
        top: 2%;
        left: 3%;
        width: 22%;
    }
    .naki.shimo {
        position: absolute;
        top: 6%;
        right: 3%;
        width: 22%;
    }
    .naki.me {
        position: absolute;
        top: 80%;
        right: 3%;
        width: 22%;
    }
    .naki.kami {
        position: absolute;
        top: 80%;
        left: 0;
        width: 22%;
    }
    .kawa.toi {
        position: absolute;
        top: 5%;
        left: 26%;
        width: 50%;
    }
    .kawa.kami {
        position: absolute;
        top: 35%;
        left: -4%;
        width: 50%;
    }
    .kawa.me {
        position: absolute;
        top: 65%;
        left: 26%;
        width: 50%;
    }
    .kawa.shimo {
        position: absolute;
        top: 35%;
        left: 52%;
        width: 50%;
    }

    .place-dora {
        position: absolute;
        top: 45%;
        left: 0;
        width: 100%;
    }

    .tehai {
        margin-top: 10%;
    }
    .btn-box {
        margin-top: 10px;
    }


    /* SP */
    @media screen and (min-width: 300px) and (max-width: 760px){
        .select-relative {
            position: relative;
            height: 400px;
        }
        .score {
            font-size: 10px;
        }
        .place-station {
            position: absolute;
            top: 35%;
            left: 40%;
        }
    }

    /* iPad */
    @media screen and ( min-width:761px) and (max-width: 1023px){
        .select-relative {
            position: relative;
            height: 761px;
        }
        .score {
            font-size: 15px;
        }
        .place-station {
            position: absolute;
            top: 35%;
            left: 45%;
        }
    }

    /* PC */
    @media screen and (min-width: 1024px) {
        .select-relative {
            position: relative;
            height: 1035px;
        }
        .score {
            font-size: 15px;
        }
        .place-station {
            position: absolute;
            top: 35%;
            left: 45%;
        }
    }

</style>
