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
        name: 'App'
    }
</script>

<style>
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
        max-width: 1024px;
    }

</style>
