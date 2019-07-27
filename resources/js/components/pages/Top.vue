<template>
    <div>
        <Header text="麻雀上達ゲーム"></Header>
        <div>
            待ち牌当て
        </div>

        <div>
            <button type="button" @click="letsWiningTile(1)" class="btn btn-info">初級</button>
            <button type="button" @click="letsWiningTile(2)" class="btn btn-warning">中級</button>
            <button type="button" @click="letsWiningTile(3)" class="btn btn-danger">上級</button>
        </div>
        <hr>

        <div>
            どれを切る？
        </div>

        <div>
            <a href="/select_tile/top" class="btn btn-info">問題を選ぶ</a>
        </div>
        <hr>
    </div>
</template>

<script>
    import Header from '../molecules/header'
    import { mapActions } from 'vuex'

    export default {
        name: "Top",
        components: {
            Header,
        },

        methods: {
            ...mapActions('Wining', [
                'letsWiningTile'
            ])
        }
    }
</script>

<style scoped>
    .bg-green {
        background-color: greenyellow;
    }
</style>
