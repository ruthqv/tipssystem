
<template>
	<div>
		<h1><label>TIP {{ $route.params.id }}</label></h1>
		<div class="col-sm-3">
		</div>
		<div class="col-sm-9" >
			{{item.question}}

			{{item.solution}}

			{{item.category}}

                        	<social-sharing  
						                      title=""
						                      description=""
						                      quote=""
						                      hashtags="hashtags currentRoute"
						                      twitter-user="vuejs"
						                      inline-template>
							  <div>
							    <network network="facebook">
							      <i class="fa fa-fw fa-facebook"></i> 
							    </network>
							    <network network="googleplus">
							      <i class="fa fa-fw fa-google-plus"></i>  
							    </network>
							    <network network="linkedin">
							      <i class="fa fa-fw fa-linkedin"></i> 
							    </network>
							    <network network="pinterest">
							      <i class="fa fa-fw fa-pinterest"></i> 
							    </network>
							    <network network="reddit">
							      <i class="fa fa-fw fa-reddit"></i> 
							    </network>
							    <network network="twitter">
							      <i class="fa fa-fw fa-twitter"></i> 
							    </network>
							    <network network="vk">
							      <i class="fa fa-vk"></i> 
							    </network>
							    <network network="weibo">
							      <i class="fa fa-weibo"></i> 
							    </network>
							    <network network="whatsapp">
							      <i class="fa fa-fw fa-whatsapp"></i> 
							    </network>
							  </div>
							</social-sharing>


		</div>
	</div>
</template>
<script>


export default {
  name: 'Tip',	

  props: ['id'],

  data(){
  	return{
  		item : {},

  	}
  },

  mounted(){
      console.log(this.id)
	  this.$http.get('/api/tips/tip/'+ this.id).then((response) => {
	  	console.log('okrespones')
	  	this.item= response.data.item


	  }, (response) => {
	   console.log('error nodata')
	  this.formErrors = response.data;
	  });

  }


}
</script>