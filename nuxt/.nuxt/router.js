import Vue from 'vue'
import Router from 'vue-router'
import { interopDefault } from './utils'
import scrollBehavior from './router.scrollBehavior.js'

const _94528c7c = () => interopDefault(import('../pages/Select.vue' /* webpackChunkName: "pages/Select" */))
const _d68fec3a = () => interopDefault(import('../pages/SelectTop.vue' /* webpackChunkName: "pages/SelectTop" */))
const _e510c368 = () => interopDefault(import('../pages/Wining.vue' /* webpackChunkName: "pages/Wining" */))
const _375d55ee = () => interopDefault(import('../pages/WiningResult.vue' /* webpackChunkName: "pages/WiningResult" */))
const _0691949c = () => interopDefault(import('../pages/index.vue' /* webpackChunkName: "pages/index" */))

Vue.use(Router)

export const routerOptions = {
  mode: 'history',
  base: decodeURI('/'),
  linkActiveClass: 'nuxt-link-active',
  linkExactActiveClass: 'nuxt-link-exact-active',
  scrollBehavior,

  routes: [{
    path: "/Select",
    component: _94528c7c,
    name: "Select"
  }, {
    path: "/SelectTop",
    component: _d68fec3a,
    name: "SelectTop"
  }, {
    path: "/Wining",
    component: _e510c368,
    name: "Wining"
  }, {
    path: "/WiningResult",
    component: _375d55ee,
    name: "WiningResult"
  }, {
    path: "/",
    component: _0691949c,
    name: "index"
  }],

  fallback: false
}

export function createRouter () {
  return new Router(routerOptions)
}
