<template>
    <div>
        <h3 v-if="level === 1">初級</h3>
        <h3 v-else-if="level === 2">中級</h3>
        <h3 v-else-if="level === 3">上級</h3>
        <h4>{{ question_now_cnt }}/{{ question_amt }}</h4>
        <HaipaiComp
                :tiles=q_tiles
                class_name="wining-q"
        ></HaipaiComp>
    </div>
</template>

<script>
    import 'es6-promise/auto'
    import HaipaiComp from '../molecules/Haipai'
    import { mapState, mapGetters } from 'vuex'



    export default {
        name: "WiningQuestion",

        components: {
            HaipaiComp,
        },

        props: [
            'question'
        ],

        data: function() {
            return {
            }
        },

        created() {
        },

        computed: {
            ...mapState('Wining', [
                'level',
                'question_now_cnt',
                'question_amt',
            ]),

            ...mapGetters('Wining', {
                q_tiles: 'splitTiles',
            }),

        },

        methods: {
        }
    }
</script>

<style scoped>

</style>
