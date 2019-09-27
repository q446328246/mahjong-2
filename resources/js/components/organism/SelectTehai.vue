<template>
    <div class="tehai">
        <PickedHaipaiComp
            :tiles=tehai_tiles
            @picked="putPickedAnswer($event)"
            class_name="select-tehai"
        ></PickedHaipaiComp>

        <p>ツモ牌</p>
        <div
            class="tumo-tile"
            @click="pickedTumoTile($event, 14)">
            <HaiComp
                :tile=selectQuestionDetail.tumo_tile
                class_name="select-dora"
            ></HaiComp>
        </div>
    </div>

</template>

<script>
    import PickedHaipaiComp from '../molecules/PickedHaipai'
    import HaiComp from '../atoms/Hai'
    import { mapState,mapActions } from 'vuex'


    export default {
        name: "SelectTehai",

        components: {
            PickedHaipaiComp, HaiComp
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
            ...mapActions('Select', [
                'pickedAns'
            ]),

            pickedTumoTile(event, index) {
                // jQueryでclassの追加と削除
                var selected_element = $(".selected")
                selected_element.each(function () {
                    $(this).removeClass("selected")
                })
                $(event.currentTarget).addClass("selected")

                this.putPickedAnswer(index)
            },

            putPickedAnswer(index) {
                this.pickedAns(index)
            },

        },

        computed: {
            ...mapState('Select', [
                'selectQuestionDetail',
                'ans_picked'
            ]),
        },
    }
</script>

<style scoped>
    .tumo-tile {
        display: inline;
        padding: 3% 0;
    }

    .tehai {
        margin-bottom: 30px;
    }

</style>
