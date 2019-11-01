<template>
    <div>
        <div id="app">
                <router-view></router-view> <!-- ここがVueによって書き換わる -->
        </div>
        <!-- <footer class="footer">
                <p class="text-muted">Vueサンプル フッター</p>
        </footer> -->
    </div>
</template>

<script>
    export default {
        name: 'App',
    }
</script>

<style lang="scss">
    html {
        position: relative;
        min-height: 100%;
    }
    body {
        /* Margin bottom by footer height */
        font-family: 'Orbitron', sans-serif;
        margin-bottom: 100px;
    }

    #app {
        -webkit-font-smoothing: antialiased;
        -moz-osx-font-smoothing: grayscale;
        text-align: center;
        color: #2c3e50;
        /*max-width: 1024px;*/
    }


    .selected {
        background: rgba(240,255,255,0.5);
        border:solid 1px #00a1e9;
        color: #00a1e9;
        outline: 0;
        box-shadow: 0 0 0 0.2rem rgba(0,123,255,.25);
    }

    /** モーダルスタイル **/
    button.closed {
        right: 26% !important;

        position: absolute;
        right: 5%;
        z-index: 2;
    }

    .modal {
        &.modal-mask {
            display: flex;
            align-items: center;
            justify-content: center;
            position: fixed;
            z-index: 30;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            overflow-y: auto; /* scrollにはしないことでスクロールの必要がないときはスクロールバーを表示させない */
            -webkit-overflow-scrolling: touch;
        }
        &-window {
            background: #fff;
            border-radius: 4px;
            overflow: hidden;
        }

        &-content {
            padding: 10px 20px;
        }

        /*&-footer {*/
        /*    background: #ccc;*/
        /*    padding: 10px;*/
        /*    text-align: right;*/
        /*}*/
    }

    .modal-wrapper {
        display: table-cell;
        vertical-align: middle;
    }

    .modal-container {
        width: 100%;
        margin: 0px auto;
        padding: 0 10px;
        background-color: #fff;
        border-radius: 15px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 1);
        transition: all 0.3s ease;
        overflow: auto;
        max-height: 90%;
        opacity: 1;
        overflow-y: auto;
        h3 {
            padding: 0.5em 1em; /*文字の上下 左右の余白*/
            color: #494949; /*文字色*/
            border: none;
            margin: 0 auto;
        }
    }


    @media all and (-ms-high-contrast: none) {
        .modal-container {
            overflow-y: hidden;
        }
        .modal-body {
            height: calc(100vh - 210px);
        }
    }
</style>
