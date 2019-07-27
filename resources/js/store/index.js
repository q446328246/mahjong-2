import Vue from 'vue'
import Vuex from 'vuex'
import createPersistedState from "vuex-persistedstate"
import Wining from './modules/Wining'
import Select from './modules/Select'


Vue.use(Vuex)


export default new Vuex.Store({
    modules: {
        Wining,
        Select,
    },
    plugins: [createPersistedState()]
})
