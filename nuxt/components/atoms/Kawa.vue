<template>
    <span :class="newLine">
        <img
            :src="tile_img"
            :class="[class_name]"
            class="select-kawa"
        >
    </span>
</template>

<script>
    import constant from '../../constants/constant'

    export default {
        name: "Kawa",

        props:['tile', 'class_name', 'count'],

        computed: {
            tile_img: function () {
                return constant.tiles_img_path + this.tile + '.png'
            },
            
            newLine: function () {
                return{
                    'br': this.count  === 5 || this.count  === 11
                }
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
        margin: 0 2px;
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
    .br::after {
        white-space: pre;
        content: "\A";
    }

</style>
