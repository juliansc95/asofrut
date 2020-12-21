
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
import Vue from 'vue';
import vSelect from 'vue-select';
import Datepicker from 'vuejs-datepicker';



/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('categoria', require('./components/Categoria.vue'));
Vue.component('articulo', require('./components/Articulo.vue'));
Vue.component('cliente', require('./components/Cliente.vue'));
Vue.component('productor', require('./components/Productor.vue'));
Vue.component('rol', require('./components/Rol.vue'));
Vue.component('user', require('./components/User.vue'));
Vue.component('finca', require('./components/Finca.vue'));
Vue.component('cultivo', require('./components/Cultivo.vue'));
Vue.component('categoriamora', require('./components/categoriaMora.vue'));
Vue.component('v-select', vSelect);
Vue.component('v-datepicker', Datepicker);
Vue.component('venta', require('./components/Venta.vue'));
Vue.component('lugarventa', require('./components/LugarVenta.vue'));
Vue.component('encuestafitosanitaria', require('./components/EncuestaFitosanitaria.vue'));
Vue.component('visita', require('./components/EncuestaAsofrut.vue'));



const app = new Vue({
    el: '#app',
    data:{
        menu:0
    }
});
