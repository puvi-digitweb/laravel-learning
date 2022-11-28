<template>
	<Header></Header>

	<div>
		{{ Aml }}
	</div>
</template>

<script>
//importing bootstrap 5 Modules
import Header from "./Components/Header.vue"
//importing bootstrap 5 Modules
import fetchData from "./Some/Fetch.js"

export default {
	name: 'GetOrders',
	data() {
		return {
			Aml: []
		}
	},
	created() {
		fetchData({
			host: '',
			url: '/orders',
			success: (res) => {
				this.Aml = res
			},
			error: (e) => {
				console.log(e)
			}
		})
	},
	components: {
		Header
	}
}
</script>