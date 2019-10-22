<template>
    <div class="my-3" :class="[shimo_tile ? 'shimo-hai-tile' : '', kami_tile ? 'kami-hai-tile' : '']">
        <KawaComp
            v-for="(tile, index) in tiles" :key="index"
            :tile=tile
            :class_name=class_name
            :count=index
        ></KawaComp>
    </div>
</template>

<script>
    import KawaComp from '../atoms/Kawa'

    export default {
        name: "Kawahai",

        components: {
            KawaComp,
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
