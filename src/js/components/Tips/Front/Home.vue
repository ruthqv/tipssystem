<template>
<div>
  <div id="wrapper" class="">
  <div class="overlay" style="display: none;"></div>
  <div id="page-content-wrapper">

  <b-container>

<hr>
    <!-- User Interface controls -->
    <b-row class="text-center panel">
      <b-col md="5">
        <b-form-group  vertical label="Searcher" >
          <b-input-group  class="form-inline">
            <b-form-input v-model="filter" placeholder="Type here to Search" />
            <b-input-group-button>
              <b-btn :disabled="!filter" @click="filter = ''" class="btn btn-main">Clear</b-btn>
            </b-input-group-button>
          </b-input-group>
        </b-form-group>
      </b-col>
      <b-col md="5">
        <b-form-group vertical label="Shorter">
          <b-input-group  class="form-inline">
            <b-form-select v-model="sortBy" :options="sortOptions">
              <option slot="first" :value="null">-- Short values --</option>
            </b-form-select>
            <b-input-group-button>
              <b-form-select :disabled="!sortBy" v-model="sortDesc">
                <option :value="false">Asc</option>
                <option :value="true">Desc</option>
              </b-form-select>
            </b-input-group-button>
          </b-input-group>
        </b-form-group>
      </b-col>

      <b-col md="2">  
        <b-form-group vertical label="Results" >
          <b-form-select :options="pageOptions" v-model="perPage" />
        </b-form-group>
      </b-col>
    </b-row>

    <hr>
  <button type="button" class="hamburger fadeInLeft is-closed btn btn-main" v-on:click="showLeftNav()" data-toggle="offcanvas">
  SEND TIP
  </button>
    <!-- Main table element -->
    <b-table class=""
             ref="table"
             show-empty
             stacked="md"
             :items="items"
             :fields="fields"
             :current-page="currentPage"
             :per-page="perPage"
             :filter="filter"
             :sort-by.sync="sortBy"
             :sort-desc.sync="sortDesc"
             @filtered="onFiltered"
    >

      <template slot="actions" slot-scope="row">
        <b-button size="sm" @click.stop="row.toggleDetails">
          {{ row.detailsShowing ? 'Hide' : 'Show' }} Details
        </b-button>

       <b-button class="btn btn-primary" @click.prevent="editItem(row.item)">Edit</b-button>
      <b-button class="btn btn-danger" @click.prevent="deleteItem(row.item)">Delete</b-button>


      </template>
      <template slot="row-details" slot-scope="row">
        <b-card>
          Details
        </b-card>
      </template>
    </b-table>
      <b-col md="6">
        <b-pagination :total-rows="totalRows" :per-page="perPage" v-model="currentPage" class="my-0" />
      </b-col>
  </b-container>


<!-- create -->
    <nav class="navbar navbar-inverse navbar-fixed-top" id="sidebar-wrapper" role="navigation">
          <b-row>
            <button type="button" data-toggle="offcanvas" class="pull-right hamburger animated fadeInLeft is-open" v-on:click="hideLeftNav()">
                X
            </button>
          </b-row>
 
            <b-row>
             <div class="text-center padding2">

               <h4>Your Tip</h4>
                  <form method="POST" enctype="multipart/form-data" v-on:submit.prevent="createItem">
                    <div  v-for="(item,index, value) in newItem">
                        
                        <div class="form-group">
                          <label for="index">{{index}}</label>
                          <input type="text" name="index" class="form-control" v-model="newItem[index]" />
                          <span v-if="formErrors['index']" class="error text-danger">@{{ formErrors['index'] }}</span>
                          
                        </div>
                      </div>
                      <div class="form-group">
                        <button type="submit" class="btn btn-main">Submit</button>
                      </div>

                  </form>
            </div>
            </b-row>
    </nav>
<!-- endcreate -->


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

                    <div  v-for="(item,index, value) in newItem">

                      <div class="form-group">
                        <label for="index">{{index}}</label>
                        <input type="text" name="index" class="form-control" v-model="newItem[index]" />
                        <span v-if="formErrors['index']" class="error text-danger">@{{ formErrors['index'] }}</span>
                        
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
</div>


</div>
</template>

<script>

var newItem = {"name": "",
              "description": "",
              "author": "",
              "category":"", 
              }

const items = [newItem]

import bInputGroup from 'bootstrap-vue/es/components/input-group/input-group';

export default {

  data () {
    return {
      items: items,

      fillItem : newItem,
 
      newItem :   newItem,

      formErrors:{},
      formErrorsUpdate:{},
      fields: [
        { key: 'name', label: 'name', sortable: true },
        { key: 'description', label: 'description', sortable: true },        
        { key: 'author', label: 'author', sortable: true },
        { key: 'category', label: 'Category', sortable: true  },
        { key: 'actions', label: 'Actions', sortable: false   }
      ],
      currentPage: 1,
      perPage: 5,
      totalRows: items.length,
      pageOptions: [ 1, 5, 10, 15 ],
      sortBy: null,
      sortDesc: false,
      filter: null,
      modalInfo: { title: '', content: '' }
    }
  },

  created () {
    // fetch the data when the view is created and the data is
    // already being observed
    this.getItems()

  },
  watch: {
    // call again the method if the route changes
    '$route': 'getItems'
  },
  computed: {
    sortOptions () {
      // Create an options list from our fields
      return this.fields
        .filter(f => f.sortable)
        .map(f => { return { text: f.label, value: f.key } })
    }
  },
  methods: {

    resetModal () {
      this.modalInfo.title = ''
      this.modalInfo.content = ''
    },
    onFiltered (filteredItems) {
      // Trigger pagination to update the number of buttons/pages due to filtering
      this.totalRows = filteredItems.length
      this.currentPage = 1
    },

   editItem: function(item){
      this.fillItem._id = item._id;
      this.fillItem.name = item.name;
          this.fillItem.industry = item.industry;
          this.fillItem.years = item.years;

        $("#edit-item").modal('show');
    },

    getItems: function(){
        this.$http.get('api/tips/tip').then(function (response) {
        this.items = response.data;
        console.log(this.items);
        })
        .catch(function (response) {
            console.log(response);
            alert("Could not load datas");
        });

      },
      updateItem: function(item){
        var input = this.fillItem;

        console.log(this.fillItem.newyear)
        this.$http.put('api/tips/tip'+ item.$oid, input).then((response) => {
          this.items= response.data
          // console.log(response)
          $("#edit-item").modal('hide');

         this.$refs.table.refresh();

          }, (response) => {
              this.formErrorsUpdate = response.data;
          });
      },
      deleteItem: function(item){
        console.log(item._id)
        this.$http.delete('api/tips/tip'+item._id.$oid).then((response) => {
          this.items= response.data

        });
      },

        createItem: function(){ 

          var input = this.newItem;
          console.log(this.newItem)
          this.$http.post('api/tips/tip',input).then((response) => {
          this.items= response.data
          this.hideLeftNav()
          this.$refs.table.refresh();
          }, (response) => {
          this.formErrors = response.data;
          });
       },

       showLeftNav:function(){
        $('#wrapper').toggleClass('toggled');
        $('.overlay').show();
        $('.hamburger').addClass('is-open').removeClass('is-closed');
      },

       hideLeftNav:function(){
        $('#wrapper').toggleClass('toggled');
        $('.overlay').hide();
        $('.hamburger').removeClass('is-open').addClass('is-closed');
      },


  },
  components:{
  'b-input-group-button': bInputGroup
  }
}

</script>
