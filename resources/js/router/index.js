import Vue from 'vue'
import VueRouter from 'vue-router';
import Top from '../components/Pages/Top'
import Wining from '../components/Pages/Wining'
import WiningResult from '../components/Pages/WiningResult'
import SelectTop from '../components/Pages/SelectTop'
import Select from '../components/Pages/Select'

Vue.use(VueRouter)

export default new VueRouter({
    mode: 'history',
    routes: [
        {path: '', name: 'Top', component: Top},

        {path: '/wining_tile/:level', name: 'Wining', component: Wining},
        {path: '/wining_result', name: 'Wining_Result', component: WiningResult},

        {path: '/select_tile/top', name: 'SelectTop', component: SelectTop},
        {path: '/select_tile/:id', name: 'Select', component: Select},
    ]
})
