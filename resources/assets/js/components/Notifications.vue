<template>
	<div class="dropdown-menu">
		<!--La nomenclatura :href hace que sea una propiedad manejada por Vue-->
		<a :href="'/'+ notification.data.follower.username" class="dropdown-item" v-for="notification in notifications">
			@{{ notification.data.follower.username }} 
			te está siguiendo.
		</a>
	</div>
</template>

<script>
	export default {
		//propiedades
		props: ['user'],
		data () {
			return {
				notifications: []
			}
		},
			//cuando cargue, y
			//no pasamos parametros a la url porque vamos a usar la sesion para saber
			//quien es el usuario logueado 
			mounted(){
					axios.get('/api/notifications')
						.then(response => {
							this.notifications = response.data;
					//Estamos escuchando el canal del usuario
					//porque es un metodo privado, ademas usamos el namespace de la clase
					//que tiene como propiedad el this.user (asi porque accedemos desde
					//fuera del backend
					Echo.private(`App.User.${this.user}`)
						//y por cada notificacion se va a ejecutar this.notifications
						.notification(notification => {
							//con unshift hacemos lo contrario de push
							//las notificaciones nuevas quedaran arriba
							this.notifications.unshift(notification);
						});
				});
			}
	}
</script>
