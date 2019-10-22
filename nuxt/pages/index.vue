<template>
    <div>
        <Header text="麻雀上達ゲーム"></Header>

        <div class="container">
            <div>
                待ち牌当て
            </div>

            <div class="row justify-content-center">
                    <button type="button" @click="letsWiningTile(1)" class="col-3 btn btn-info">初級</button>
                    <button type="button" @click="letsWiningTile(2)" class="col-3 btn btn-warning">中級</button>
                    <button type="button" @click="letsWiningTile(3)" class="col-3 btn btn-danger">上級</button>
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
    </div>
</template>

<script>
    import Header from '@molecules/header'
    import { mapActions } from 'vuex'

    export default {
        name: "Top",

        created() {
            this.clearState()
        },

        components: {
            Header,
        },

        methods: {
            ...mapActions('Wining', [
                'letsWiningTile',
                'clearState'
            ])
        }
    }
</script>

<style scoped>
    .bg-green {
        background-color: greenyellow;
    }
</style>
