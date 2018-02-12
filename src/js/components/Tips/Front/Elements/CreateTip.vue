<template>
    <div>
        <!-- create -->
        <div class="col-sm-2 col-xs-6 prev">
            <button class="myclose btn btn-main" type="button" v-on:click="tooglefixedb()">
                {{togglemessage}}
            </button>
        	<div class="col-sm-12">
	        	<b-row class="fixedb">
	                <span v-if="formErrors" v-model="formErrors">
	                    <ul class="text-danger">
	                        <li v-for="errors in formErrors.errors">
	                            {{ errors[0] }}
	                        </li>
	                    </ul>
	                </span>
	                <span v-if="formSuccess">
	                    {{ formSuccess }}
	                </span>
	                <b-row>
	                        <form enctype="multipart/form-data" method="POST" v-on:submit.prevent="createItem">
	                            <div class="form-group col-sm-12" v-for="(item,index, value) in newItem">
	                                <input :placeholder="index" class="form-control" name="index" type="text" v-if="index !=='category' && index !=='solution' " v-model="newItem[index]"/>
	                                <textarea :placeholder="index" class="form-control" cols="100" id="textareatip" name="index" rows="2" type="text" v-if="index =='solution' " v-model="newItem[index]">
	                                </textarea>

								<div v-if="index =='category'">
								    <input class="form-control" name="index" placeholder="Category" type="text" v-model="categoryselected" v-on:keyup="searchCategory(categoryselected)"/>
								    <div id="categoryselector" v-if="availablesCategories">
								        <ul id="selection" name="index">
								            <li v-for="categoryselected in availablesCategories" v-model="newItem[index]" v-on:click="selectCategory(categoryselected)">
								                {{categoryselected}}
								            </li>
								        </ul>
								    </div>
								</div>
	                            </div>

								<div class="form-group col-sm-1">
								    <button class="btn custom" type="submit">
								        SEND TIP
								    </button>
								</div>

	                        </form>
	                </b-row>
	            </b-row>
        	</div>

        </div>
    </div>
</template>
</div>
<!-- endcreate -->
<script>
    export default{
		name :'CreateTip',
		props:['newItem'],
		data(){
			return{

			      togglemessage: 'X',
			      
			      availablesCategories: null,

			      categoryselected:null, 
			      
			      fillItem : this.newItem,
			 
			      formErrors:{},
			      
			      formSuccess: '',



			}
		},
		methods:{
			createItem: function(){ 

              var input = this.newItem;
              console.log(this.newItem)
              this.$http.post('api/tips/tip',input).then((response) => {
              this.$parent.items= response.data.items

    		  this.$root.$emit('refresh');

              }, (response) => {
               console.log('error createItem')
              this.formErrors = response.data;
              });
           },
	      searchCategory:function(category){

	        // console.log(category)

	          this.$http.post('api/tips/searchcategory/'+ category).then((response) => {

	          // if(response.data != ''){
	            $('#categoryselector').show();
	            this.availablesCategories = response.data

	            console.log(response.data)
	            console.log(this.availablesCategories)
	            // this.categoryselected =response.data[0].name
	            // this.newItem.category = this.categoryselected         

	          // }else{
	          //   // this.categoryselected = category
	          //   this.newItem.category = category         
	          //     // console.log(this.categoryselected)


	          //   }
	          }, (response) => {
	          console.log('error searchcategory')
	          this.formErrors = response.data;
	          });

	      },
	      selectCategory:function(category){
	          console.log(category.name)
	          this.categoryselected = category
	          this.newItem.category = category
	          $('#categoryselector').hide();
	      },

	       tooglefixedb:function(){
	        $('.fixedb').slideToggle();
	   		$('.myclose').toggleClass('closing');
	        if(this.togglemessage == 'X'){this.togglemessage = 'SEND TIP'}else{this.togglemessage = 'X'};
	      },

		}
	}
</script>