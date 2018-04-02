let mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js('resources/assets/js/app.js', 'public/js')
   .sass('resources/assets/sass/app.scss', 'public/css');

/*
Instalar webpackmix
requerido modificar:

package.json / la version de bootstrap

//Cambiamos bootstrap-sas a bootstrap
        //y la version a la actual de bootstrap
        //cuando instalemos webpackmix con npm
tambien en consola:
npm install popper.js --save-dev
y algunas dependencias necesarias(no sera muy necesario)

y en resources/assets/js:
	bootstrap.js
	de require('bootstrap-sass');
		a require('bootstrap');
	abajo de window.$ anadimos:
		window.Popper = Popper;
	y hasta arriba:
		import Popper from 'popper.js/dist/umd/popper.js';

y en resources/assets/sass:
	app.scss
	de @import "~bootstrap-sass/assets/stylesheets/bootstrap";
	a @import "~bootstrap/assets/stylesheets/bootstrap";

Ahora si:
	npm install
	npm prune (para ver si hay dependencias inservibles)
	npm run dev

y luego cambiar el CDN usado en las views de bootstrap y usar
las librerias instaladas



*/