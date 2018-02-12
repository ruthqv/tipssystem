<template>
<div>
  <div id="wrapper" class="">
  <div class="overlay" style="display: none;"></div>
  <div id="page-content-wrapper">

  <b-container>



    <!-- User Interface controls -->
    <b-row class="text-center panel">
      
      <b-col md="4">
        <b-form-group vertical label="SEARCH" >
          <div class="form-inline">
            <b-form-input class="form-control" v-model="filter" placeholder="Type here to Search" />
            <b-input-group-button>
              <b-btn  :disabled="!filter" @click="filter = ''" class="btn btn-main custom">Clear</b-btn>
            </b-input-group-button>
          </div>
        </b-form-group>
      </b-col>

      <b-col md="4">
        <b-form-group vertical label="SHORT">
          <div class="form-inline">
            <b-form-select v-model="sortBy" :options="sortOptions">
              <option slot="first" :value="null">-- Short columns --</option>
            </b-form-select>
            <b-input-group-button>
              <b-form-select :disabled="!sortBy" v-model="sortDesc">
                <option :value="false">Asc</option>
                <option :value="true">Desc</option>
              </b-form-select>
            </b-input-group-button>
          </div>
        </b-form-group>
      </b-col>

      <b-col md="2">  
        <b-form-group vertical label="RESULTS" >
          <b-form-select :options="pageOptions" v-model="perPage" />
        </b-form-group>
      </b-col>
      <b-col md="2">  
        <b-form-group vertical label="VIEW" >

        <button v-bind:class="{showcard: showcard}" class="btn custom"  v-on:click="togglecard()"> {{showcardtext}} </button>
        </b-form-group>


      </b-col>

    </b-row>

    <hr>


    <!-- Main table element -->
    <TableTips 
             v-if="!showcard" 
             id="my-table"
             @refresh="refreshtable" 
             :currentUser="currentUser"
             :items="items"
             :currentPage="currentPage"
             :perPage="perPage"
             :filter="filter"
             :fields="fields"
             :sortBy="sortBy"
             :sortDesc="sortDesc"
             :totalRows="totalRows"
             ></TableTips>

    <CardTips 
            v-if="showcard"
            :items="items"
            :currentPage="currentPage"
            :perPage="perPage"
            :filter="filter"
            :fields="fields"
            :sortBy="sortBy"
            :sortDesc="sortDesc"
            :totalRows="totalRows"
            ></CardTips>

  </b-container>


    <b-col md="6">
      <b-pagination :total-rows="totalRows" :per-page="perPage" v-model="currentPage" class="my-0" />
    </b-col>

 

<CreateTip :newItem="newItem"></CreateTip>



</div>
</div>


</div>
</template>

<script>

import bInputGroup from 'bootstrap-vue/es/components/input-group/input-group';
import CreateTip from '../components/Tips/Front/Elements/CreateTip';
import CardTips from '../components/Tips/Front/Elements/CardTips';
import TableTips from '../components/Tips/Front/Elements/TableTips';

var newItem = {"question": "",
              "category": "",
              "solution":"", 
              "username": "",
              "resource": "",
              "email":"",
              }

const items = [newItem]



export default {
  name:'Home',

  data () {
    return {

      showcard : true,
      showcardtext: 'CARDS',
      currentUser:currentUser,

      items: items,  

      newItem: newItem,
        
    // tabledatas
      currentPage: 1,
      
      perPage: 10,
      
      pageOptions: [ 1, 5, 10, 15 ],
      
      sortBy: null,
      
      sortDesc: false,

      filter: null,

      totalRows: items.length,

      fields: [
        { key: 'question', label: 'question', sortable: true },
        { key: 'solution', label: 'Tip', sortable: true },        
        { key: 'category', label: 'Category', sortable: true  },
        // { key: 'resource', label: 'resource', sortable: true },        
        // { key: 'username', label: 'username', sortable: true },
        { key: 'actions', label: 'Actions', sortable: false   }
      ],

      // endtabledatas


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
        this.totalRows = this.items.length

      // Create an options list from our fields
      return this.fields
        .filter(f => f.sortable)
        .map(f => { return { text: f.label, value: f.key } })
    },


  },

  methods: {
    togglecard: function(){
      this.showcard = !this.showcard
      this.showcardtext ==='CARDS' ? this.showcardtext ='TABLE' : this.showcardtext ='CARDS' 
      
    },

    refreshtable(){
      this.items = this.getItems()
    },
 
    getItems: function(){
        this.$http.get('api/tips/tip').then(function (response) {
        this.items = response.data.items;
        })
        .catch(function (response) {
            alert("Sorry, Could not load datas");
        });

      },
 




  },
  components:{
  'b-input-group-button': bInputGroup,
  CreateTip,
  TableTips,
  CardTips
  }
}

</script>
