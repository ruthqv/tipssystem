
<template>
	<div>
		<h1>Blog</h1>
		<div class="col-sm-3">
			<SideBar></SideBar>
		</div>
		<div class="col-sm-9">
			<CardTips></CardTips>
		</div>
	</div>
</template>
<script>
import CardTips from './CardTips.vue'	
import SideBar from './SideBar.vue'	

export default {
  name: 'Tips',	

  components:{
  	SideBar,
  	CardTips,
  }

}
</script>