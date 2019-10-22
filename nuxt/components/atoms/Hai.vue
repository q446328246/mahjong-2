<template>
    <img
        :src="tile_img"
        :class="class_name">
</template>

<script>
    import constant from '@constants/constant.js'

    export default {
        name: "Hai",

        props:['tile', 'class_name'],

        computed: {
            tile_img: function () {
                return process.env.LARAVEL_URL + constant.tiles_img_path + this.tile + '.png'
            }
        }
    }
</script>

<style scoped>
    .wining-q, .wining_result, .select-dora {
        width: 6.5%;
        margin: 0 2px;
    }

    .select-tehai {
        width: 5.5%;
        margin: 0 4px;
    }


    .wining_ans {
        width: 10%;
        margin: 0 10px;
    }

    .select-naki {
        width: 27.5%
    }

    .select-kawa {
        width: 11.5%
    }

    .select-kawa-side {
        width: 30.5%
    }

    .wining-result-haipai {
        width: 7.5%
    }

</style>
