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
		data () {
			return {
				notifications: [],
			}
		},
			//cuando cargue, y
			//no pasamos parametros a la url porque vamos a usar la sesion para saber
			//quien es el usuario logueado 
			mounted(){
			axios.get('/api/notifications')
				.then(response => {
					this.notifications = response.data;
				});
			}
	}
</script>