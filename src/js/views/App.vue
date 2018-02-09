<template>
  <div id="app" class="text-center">
<!--   <NavBar></NavBar>	
 -->  <h2>Laravel Tips & Tricks</h2>
<!--   <Searcher></Searcher>
 -->  <!-- the router outlet, where all matched components would ber viewed -->
  <router-view></router-view>
  </div>
</template>

<script>
// import NavBar from '../components/NavBar/NavBar'	
// import Searcher from '../components/NavBar/Searcher'	


export default {
  name: 'app',

  components: {
  	// Searcher,
  	// NavBar
  }
}
</script>
