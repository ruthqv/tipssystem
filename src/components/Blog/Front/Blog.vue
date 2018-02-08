
<template>
	<div>
		<h1>Blog</h1>
		<div class="col-sm-3">
			<SideBar></SideBar>
		</div>
		<div class="col-sm-9">
			<Posts></Posts>
		</div>
	</div>
</template>
<script>
import Posts from './Posts.vue'	
import SideBar from './SideBar.vue'	

export default {
  name: 'Blog',	

  components:{
  	SideBar,
  	Posts,
  }

}
</script>