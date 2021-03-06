/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue').default;

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
 Vue.component('frmtipocomida', require('./components/frmtipocomida.vue').default);
 Vue.component('frmcomida', require('./components/frmcomida.vue').default);
 Vue.component('frmtipoejercicio', require('./components/frmtipoejercicio.vue').default);
 Vue.component('frmejercicio', require('./components/frmejercicio.vue').default);
 Vue.component('frmcliente', require('./components/frmcliente.vue').default);
 Vue.component('frmconsulta', require('./components/frmconsulta.vue').default);
 Vue.component('frmfichamedica', require('./components/frmfichamedica.vue').default);
 Vue.component('frmcuestionario', require('./components/frmcuestionario.vue').default);
 Vue.component('frmgestdieta', require('./components/frmgestdieta.vue').default);
 Vue.component('frmgestrutina', require('./components/frmgestrutina.vue').default);
 Vue.component('frmdieta', require('./components/frmdieta.vue').default);
//frmcuestionario
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
 const app = new Vue({
    el: '#app',
    data:{
        menu:0
    }
});
