require('dotenv').config()

const webpack = require('webpack')
const { AXIOS_URL,
    LARAVEL_URL,} = process.env

export default {
    mode: 'universal',
    /*
    ** Headers of the page
    */
    head: {
        title: process.env.npm_package_name || '',
        meta: [
            { charset: 'utf-8' },
            { name: 'viewport', content: 'width=device-width, initial-scale=1' },
            { hid: 'description', name: 'description', content: process.env.npm_package_description || '' }
        ],
        link: [
            { rel: 'icon', type: 'image/x-icon', href: '/favicon.ico' }
        ]
    },
    /*
    ** Customize the progress-bar color
    */
    loading: { color: '#fff' },
    /*
    ** Global CSS
    */
    css: [
    ],
    /*
    ** Plugins to load before mounting the App
    */
    plugins: [
        { src: 'plugins/localStorage.js', ssr: false },
    ],
    /*
    ** Nuxt.js dev-modules
    */
    buildModules: [
    ],
    /*
    ** Nuxt.js modules
    */
    modules: [
        // Doc: https://bootstrap-vue.js.org
        'bootstrap-vue/nuxt',
        '@nuxtjs/axios',
        '@nuxtjs/proxy',
        '@nuxtjs/dotenv',
        'bootstrap-vue/nuxt',
    ],
    /*
    ** Build configuration
    */
    build: {
        /*
        ** You can extend webpack config here
        */
        extend (config, ctx) {
            let path = require('path');
            config.resolve.alias['@atoms'] = path.join(__dirname, 'components/atoms')
            config.resolve.alias['@molecules'] = path.join(__dirname, 'components/molecules')
            config.resolve.alias['@organism'] = path.join(__dirname, 'components/organism')
            config.resolve.alias['@constants'] = path.join(__dirname, 'constants')
        },

        plugins: [
            new webpack.ProvidePlugin({
                jQuery: 'jquery',
                $: 'jquery'
            }),
        ],

        extractCSS: true
    },
    env: {
        baseUrl: process.env.BASE_URL || 'http://localhost:3000',
        AXIOS_URL,
        LARAVEL_URL,
    },
    proxy: {
        '/api/': { target: 'http://127.0.0.1:8000', pathRewrite: {'^/api/': ''} }
    },
     vue: {
       devtools: true
     },
}

module.exports = {
    // dev: (process.env.NODE_ENV !== 'production'),
    // modules: [
    // ],
    // proxy: {
    //     '/api/': {
    //         // target: (this.dev) ? 'http://127.0.0.1:8000' : 'https://production-url'
    //         target:  'http://127.0.0.1:8000'
    //     }
    // },
    // axios: {
    // },
    plugins: [{ src: '~/plugins/localStorage.js', ssr: false }]
}
