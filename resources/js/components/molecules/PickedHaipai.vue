<template>
    <div class="my-3" :class="[shimo_tile ? 'shimo-hai-tile' : '', kami_tile ? 'kami-hai-tile' : '']">
        <div
            v-for="(tile, index) in tiles"
            :key="index"
            @click="pickedAns($event, index)"
            class="tile"
        >
            <HaiComp
                :tile=tile
                :class_name=class_name
            ></HaiComp>
        </div>
    </div>
</template>

<script>
    import HaiComp from '../atoms/Hai'

    export default {
        name: "PickedHaipai",

        components: {
            HaiComp,
        },

        props: [
            'tiles', 'class_name', 'shimo_tile', 'kami_tile'
        ],

        methods: {
            pickedAns(event, index) {
                // jQueryでclassの追加と削除
                var selected_element = $(".selected")
                selected_element.each(function () {
                    $(this).removeClass("selected")
                })
                $(event.currentTarget).addClass("selected")

                this.$emit('picked', index)
            },
        },

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

    .tile {
        display: inline;
        padding: 3% 0;
    }

</style>
