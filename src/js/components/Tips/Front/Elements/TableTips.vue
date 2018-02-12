  <template>
<div>
    <b-table 
             show-empty
             stacked="md"
             :items="items"
             :fields="fields"
             :current-page="currentPage"
             :per-page="perPage"
             :filter="filter"
             :sort-by.sync="sortBy"
             :sort-desc.sync="sortDesc">

      <template slot="actions" slot-scope="row">
        <b-button size="sm" @click.stop="row.toggleDetails">
          {{ row.detailsShowing ? 'Hide' : 'Show' }} Details
        </b-button>

        <div v-if="currentUser   && currentUser.type == 'admin'">
        <b-button class="btn btn-primary" @click.prevent="editItem(row.item)">Edit</b-button>
         <b-button class="btn btn-danger" @click.prevent="deleteItem(row.item)">Delete</b-button>          
        </div>
        <div v-else></div>
     </template>
    
      <template slot="row-details" slot-scope="row">
        <b-card>
          <div class="container text-center">
          <h2>{{row.item.question}}</h2>
          <hr>
          <p v-html="row.item.solution"></p>
           <small>{{row.item.category}}</small>
           <small>{{row.item.resource}}</small>            
          </div>

        </b-card>
      </template>
    </b-table>



<!-- edit -->
    <div class="modal fade" id="edit-item" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
            <h4 class="modal-title" id="myModalLabel">Edit Tip</h4>
          </div>
          <div class="modal-body">


              <form method="POST" enctype="multipart/form-data" v-on:submit.prevent="updateItem(fillItem._id)">

                    <div  v-for="(value,index) in fillItem">

                      <div class="form-group">
                        <label for="index">{{index}}</label>
                        <input type="text" name="index" class="form-control" v-model="fillItem[index]" />
                        
                      </div>    
                    </div>

              <div class="form-group">
                <button type="submit" class="btn btn-success">Submit</button>
              </div>


              </form>


          </div>
        </div>
      </div>

    </div>


  <!-- end edit -->



</div>



</template><!-- Main table element -->
  
<script>
  import bTable from 'bootstrap-vue/es/components/table/table';

  export default{
    name: 'TableTips',
    props:['items', 'currentUser','currentPage' ,'filter' ,'perPage', 'fields', 'totalRows','sortBy', 'sortDesc'],

    data(){
      return{                         
        modalInfo: { title: '', content: '' },
        fillItem :{},            
      }
    },


  methods: {


      resetModal () {
        this.modalInfo.title = ''
        this.modalInfo.content = ''
      },


      editItem: function(item){
          this.fillItem= item;
          $("#edit-item").modal('show');
        },

         updateItem: function(item){
            var input = this.fillItem;


            this.$http.put('api/tips/tip/'+ input._id, input).then((response) => {
              console.log(response.data)

              // this.$parent.items= response.data.items
              $("#edit-item").modal('hide');
              }, (response) => {
                console.log('error updateItem')
               
                this.formErrorsUpdate = response.data;
              });
          },

          deleteItem: function(item){
            console.log(item._id)
            this.$http.delete('api/tips/tip/'+ item._id).then((response) => {
              this.$parent.items= response.data.items


            });
          },




     },
     components:{
        'b-table': bTable,
     }


  }
</script>
 