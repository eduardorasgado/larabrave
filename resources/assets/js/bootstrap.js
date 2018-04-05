
window._ = require('lodash');
//Agregamos esta linea tambien
import Popper from 'popper.js/dist/umd/popper.js';

/**
 * We'll load jQuery and the Bootstrap jQuery plugin which provides support
 * for JavaScript based Bootstrap features such as modals and tabs. This
 * code may be modified to fit the specific needs of your application.
 */

try {
    window.$ = window.jQuery = require('jquery');
    //Añadimos esta linea para popper
    window.Popper = Popper;

    //Aqui cambiamos de bootstrap-sass a bootstrap
    require('bootstrap');
} catch (e) {}

/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

window.axios = require('axios');

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

/**
 * Next we will register the CSRF Token as a common header with Axios so that
 * all outgoing HTTP requests automatically have it attached. This is just
 * a simple convenience so we don't have to attach every token manually.
 */

let token = document.head.querySelector('meta[name="csrf-token"]');

if (token) {
    window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
} else {
    console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token');
}

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 
 PASOS PARA USAR PUSHER -----------------------------
 Instalar:
	npm install laravel-echo pusher-js --save-dev
	composer require pusher/pusher-php-server
	npm run watch

 Pasos para usar pusher:
 Loguearse y generar app en pusher.com
 
 Despues copiar credenciales en app keys, y llevarlas a .env
 donde laravel ya tiene un area especial para pusher.

 Ahora vamos a config/broadcasting.php y activamos el driver
 poneniendo pusher en lugar de null.

 Seguido descomentamos las lineas siguientes de laravel echo
y sustituimos 'your-pusher-key' por 'la key en.env', porque
no podemos usar variables de entorno aqui, asi mismo 
con cluster

y en config/app.php descomentar:
// App\Providers\BroadcastServiceProvider::class,
de los providers

programamos el componente y las notificaciones

 */

import Echo from 'laravel-echo'

window.Pusher = require('pusher-js');

window.Echo = new Echo({
	broadcaster: 'pusher',
	key: 'a7a624e299e8fb2716f4',
    cluster: 'us2',
    //debe estar sincronizado con broadcasting.php
    encrypted: true
 });
