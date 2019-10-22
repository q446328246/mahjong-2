<template>
    <div class="my-3" :class="[shimo_tile ? 'shimo-hai-tile' : '', kami_tile ? 'kami-hai-tile' : '']">
        <HaiComp
            v-for="(tile, index) in tiles" :key="index"
            :tile=tile
            :class_name=class_name
        ></HaiComp>
    </div>
</template>

<script>
    import HaiComp from '../atoms/Hai'

    export default {
        name: "Haipai",

        components: {
            HaiComp,
        },

        props: [
            'tiles', 'class_name', 'shimo_tile', 'kami_tile'
        ],

        computed: {
        }

    }
</script>

<style scoped>
    .shimo-hai-tile {
        transform: rotate(-90deg);
    }

    .kami-hai-tile {
        transform: rotate(90deg);
    }
</style>
