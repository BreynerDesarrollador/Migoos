
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
import eventos from './components/eventos.vue'
import VueRouter from 'vue-router'
import nuevoevento from './components/nuevoevento.vue'
import * as VueGoogleMaps from 'vue2-google-maps'
import bounceSpinner from 'vue-spinner/src/BounceLoader.vue'
import VTooltip from 'v-tooltip'
import VueTimeago from 'vue-timeago'

require('./bootstrap');
require('toastr');
require('bootstrap4-datetimepicker');
require('jquery-validation');
require('jquery-mask-plugin');

window.Vue = require('vue');
Vue.use(VueRouter);
Vue.use(VTooltip);
Vue.use(VueGoogleMaps, {
    load: {
        key: 'AIzaSyBF_SYKs0H5kKG9zK1RDoIdLDNKAd9859w',
        libraries: 'visualization', // This is required if you use the Autocomplete plugin
        // OR: libraries: 'places,drawing'
        // OR: libraries: 'places,drawing,visualization'
        // (as you require)
    }
});
Vue.use(VueTimeago, {
    name: 'Timeago', // Component name, `Timeago` by default
    locale: undefined, // Default locale
    locales: {
        'es-ES': require('date-fns/locale/es'),
        'es': require('date-fns/locale/es'),
    }
})
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
var router =new VueRouter({
    mode:'history',
    routes:[
        {
            path:'/app/home/nuevoevento',
            name:'nuevoevento',
            component:require('./components/nuevoevento.vue')
        },
        {
            path:'/app/home/',
            name:'home',
            component:require('./components/admineventos.vue')
        },
        {
            path:'/app/home/edit/:id',
            name:'edit',
            component:require('./components/edit.vue')
        }
    ]
});


Vue.component('example-component', require('./components/ExampleComponent.vue'));
Vue.component('Index', require('./components/index.vue'));
Vue.component('SelectVue', require('./components/select.vue'));
Vue.component('Eventos', eventos);
Vue.component('LoaderSpinner', bounceSpinner);

const app = new Vue({
    router
}).$mount('#app');
