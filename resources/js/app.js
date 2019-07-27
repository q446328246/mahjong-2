window.Vue = require('vue');


// Botstrap-vue
import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'
import BootstrapVue from 'bootstrap-vue'
Vue.use(BootstrapVue)

// Vue-router
// import VueRouter from 'vue-router';
// Vue.use(VueRouter);
import router from './router'

// ヘッダー＆フッター
import App from './components/App'

// Vuex
import store from './store/index'

import jQuery from 'jquery'
global.jquery = jQuery
global.$ = jQuery
window.$ = window.jQuery = require('jquery')


// Vue.jsの実行
const app = new Vue({
    router,
    components: { App },
    template: '<App/>',
    store,
}).$mount('#app');

