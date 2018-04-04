
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

//Cada componente nuevo se agrega aqui
//responses es la etiqueta que podremos usar en el html
Vue.component('responses', require('./components/Responses.vue'));
Vue.component('notifications', require('./components/Notifications.vue'));

//agregar en el template de laravel(en el global osea layouts.app) un div con id=app
//en caso de no haber tal id
//Al final de esto ejecutar: npm run watch
//esto ejecuta webpack.mix para unir todo el frontend con los componentes
//ver: https://laraveles.com/componente-vuejs-laravel-5-5/
const app = new Vue({
    el: '#app'
});
