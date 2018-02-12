<template>
<div>

<div class="container">
        <div class="row">

            <div class="col-sm-6 col-md-4 col-lg-3 mt-4"  v-for="row in filteredData">
                <div class="card">
                    <img class="card-img-top" src="http://success-at-work.com/wp-content/uploads/2015/04/free-stock-photos.gif">
                    <div class="card-block">
                        <h4 class="card-title">{{row.question}}</h4>
                        <div class="meta">
      						 <router-link :to="{ name: 'singletip' , params: { id : row._id } }">See more</router-link>
                        </div>
                        <div class="card-text">

						    	Solution:
								{{row.solution}}

                        </div>
                    </div>
                    <div class="card-footer">
                        <span class="float-right">Category: {{row.category}}</span>
                        {{makeroute(row._id)}}

                        <span><i class=""></i>

					</span>
                    </div>
                </div>
            </div>

        </div>
</div>



</div>

</template>

<script>
	export default{
		name: 'CardTips',

		props:[  
		  "items",
		  "currentPage",
		  "perPage",
		  "filter",
		  "fields",
		  "sortBy",
		  "sortDesc",
		  "totalRows"
		  ],

 	 data: function () {

			    return {
			      currentRoute:'https://vuejs.org',		
			      sortKey: this.sortBy,
			    }
		  },
			methods:{
				makeroute:function(row){
					var route = ''
					route = this.currentRoute +'/tip/' + row
					console.log(String(route)) 

					return String(route)

				},

			},
		  computed:{

			    filteredData: function () {
			      var sortKey = this.sortBy
			      var filterKey = this.filter
			      var limit = this.perPage
			      var data = this.items
			      var order = this.sortDesc ? -1 :  1 
			      var currentPage = this.currentPage
 
			      if (filterKey) {

			        data = data.filter(function (row) {

			          return Object.keys(row).some(function (key) {

			            return String(row[key]).indexOf(filterKey) > -1
			          })
			        })
			      }


			    if(sortKey){

					data = data.sort(function (a, b) {
			          a = a[sortKey]
			          b = b[sortKey]

			          return (a === b ? 0 : a > b ? 1 : -1) * order
			    	})	
			    }


			    if(limit){

			    	if(data.length >  limit ){

			        if(currentPage >= 1){


			        var page= currentPage - 1	

					data = data.slice(page, page+limit)

			        }
	
			    	}



			    }

			     return data
			    }

		  	
		  	
		  },


	}
	
</script>		
