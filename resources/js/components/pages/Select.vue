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

        <div class="btn-box">
            <a href="/select_tile/top" class="btn btn-primary">TOPに戻る</a>
        </div>
    </div>
</template>

<script>
    import 'es6-promise/auto'
    import Header from '../molecules/header'
    import HaipaiComp from '../molecules/Haipai'
    import KawahaiComp from '../molecules/Kawahai'
    import HaiComp from '../atoms/Hai'
    import { mapState, mapActions, mapGetters } from 'vuex'

    export default {
        name: "Select",
        components: {
            Header,HaipaiComp,HaiComp, KawahaiComp
        },

        created() {

        },

        methods: {
            ...mapActions('Select', [
            ]),
        },

        computed: {
            ...mapState('Select', [
                'selectQuestion', 'selectQuestionDetail'
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
        left: -8%;
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
        right: -8%;
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
