<template>
	<b-pagination :total-rows="totaltofilter" 
                   :per-page="perPage" 
                    v-model="currentPage" 
                      class="my-0" />
</template>
<script>
	
	export default{

		name: 'Pagination',
		props: [ 'totaltofilter', 'perPage' ,'currentPage'],
		data(){
			return{

			}
		}
	}
</script>