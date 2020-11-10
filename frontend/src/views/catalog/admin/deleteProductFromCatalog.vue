<template>
    <div class="container-fluid"  style="padding: 0;margin-left: 0;">
        <div class="row" >
            <div class="col" style="margin-left: 0;">
                <div class="wrapper"  style="margin-left: 0;">
                    <AdminSideBar />

                    <!-- Content -->
                    <div id="content" style="padding: 0;margin:0px;height: 100%;">
                        <Header  />
                        <div style="padding: 50px;">


                        <h1><img alt="commerce" src="../../../assets/images/catalog.png" /> Catalogs</h1>
                    <div class="bg-light mb-3">
                        <div class="container">
                            <div class="row">
                            <div class="col p-2">
                                <router-link :to="{name: 'Home'}">
                                    <i class="fas fa-home"></i> home
                                </router-link>&nbsp;
                                <i class="fas fa-chevron-right" style="font-size: 12px"></i> &nbsp;
                                <router-link :to="{name: 'Admin'}">
                                    Administration
                                </router-link> &nbsp;
                                <i class="fas fa-chevron-right" style="font-size: 12px"></i> &nbsp;
                                <div class="d-inline txt">Delete Products from Catalog</div>
                            </div>
                            </div>
                        </div>
                    </div>

                    <div class="alert alert-info text-left">
                        <b-icon icon="exclamation-circle-fill" variant="info" font-scale="1.5" style="vertical-align: middle" /> <b>Catalog and Product management :</b> delete Products from catalogs .
                    </div>
                    <div v-if="showAlert==true">
                        <b-alert variant="success" show dismissible>
                            Product deleted from Catalog with success !
                        </b-alert>
                    </div>

                    <form>
                        <div class="row">
                            <div class="col">
                                <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
                                    <labelle class="btn btn-secondary">Catalog :</labelle>

                                    <div class="btn-group" role="group">
                                        <select v-model="selectedcatalogs" @change="fillTable();" name="catalogs" id="catalogs" class="btn btn-secondary dropdown-toggle" tabindex="12" required>
                                            <option :key="0" v-bind:value="{ id: 0, text: null }" selected disabled>Choose here</option>
                                            <option v-for="(catalog) in catalogs.datas" :key="catalog.id" v-bind:value="{ id: catalog.id, text: catalog.libelle }" >{{ catalog.libelle }}</option>
                                        </select>
                                    </div>
                                    <template v-if="showEmpty==true">
                                        <button type="button" @click="EmptyCatalog()" class="btn btn-warning">Empty</button>
                                    </template>
                                </div>
                            </div>
                            <div class="col">
                                <template>
                                    <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
                                        <button type="button" class="btn btn-secondary">Product :</button>
                                        <div class="btn-group" role="group">
                                            <select v-model="selectedproducts" @change="fillTable()" name="products" id="products" class="btn btn-secondary dropdown-toggle" tabindex="12" required>
                                                <option :key="0" v-bind:value="{ id: 0, text: null }" selected disabled>Choose here</option>
                                                <option v-for="(product) in products.datas"  :key="product.id" v-bind:value="{ id: product.id, text: product.lib }" >{{ product.id }} {{ product.lib }}</option>
                                            </select>
                                        </div>
                                    </div>
                                </template>
                            </div>
                        </div>
                    </form>
                    <br>
                    <table class="table text-center table-striped">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Catalog</th>
                            <th>Product</th>
                            <th>Date</th>
                            <th></th>
                            <th class="text-right">

                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-if="loading">
                            <td colspan="5">
                                <b-spinner variant="danger" style="width: 3rem; height: 3rem;" /><br />
                                Loading
                            </td>
                        </tr>
                        <template v-else>
                            <tr v-if="errored">
                                <td colspan="5">
                                    <b style="color:#CC0000">{{ error.title }}</b>
                                    <div class="text-left">
                                        {{ error.detail }}
                                    </div>
                                </td>
                            </tr>
                            <template v-else>
                                <tr v-for="(productcata, index) in datas.datas" :key="productcata.id">
                                    <td>{{ productcata.id }}</td>
                                    <td>
                                        <b-badge variant="primary">
                                            {{cata}}
                                        </b-badge>

                                    </td>
                                    <td>
                                        <b-badge variant="success" >
                                            {{prod}}
                                        </b-badge>

                                    </td>
                                    <td>{{ productcata.datecp }}</td>
                                    <td>{{ productcata.lib }}</td>



                                    <td class="text-right">

                                        <template>
                                            <b-button
                                                    v-b-tooltip.hover
                                                    class="btn text-white px-0"
                                                    type="button"
                                                    title="Delete"
                                                    @click="deleteProductfromCatalog(productcata.id, index)"
                                                    style="background-color:#ffc107; width: 42px"
                                            >
                                                <b-icon icon="trash" class="align-middle" />
                                            </b-button>

                                        </template>
                                    </td>
                                </tr>
                            </template>
                        </template>
                        </tbody>
                    </table>
                    <div v-if="showAlert2==true">
                        <b-alert variant="danger" show dismissible>
                            Empty !
                        </b-alert>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </div>
  </div>
</template>

<script>
import AdminSideBar from "@/components/AdminSideBar.vue";
import Header from "@/components/Header.vue";
import axios from "axios";
export default {
  name: "deleteProductFromCatalog.vue",
  components: {
    AdminSideBar,
      Header
  },
  data() {
    return {
      showEmpty : false,
      cata : null,
      prod : null,
      showAlert : false,
      showAlert2 : false,
      selectedproducts: null,
      selectedcatalogs: null,
      loading: true,
      errored: false,
      error: {},
      datas: {},
      products: {},
        catalogs: {},
    };
  },
  mounted(){
      this.cata = 'sss';
      axios.get('http://localhost:8083/rest/products/get')
          .then(response =>{
              this.products = response.data;
          })
          .catch(e => {
              this.errored = true;
              if(e.response){
                  this.error = e.response.data;
              }else{
                  this.error.title = e;
                  this.error.detail = '';
              }

          })
          .finally(() => {
              this.loading = false;
          });
      axios.get('http://localhost:8087/apigateway/rest/catalogs/getActiveCatalog')
          .then(response =>{
              this.catalogs = response.data;
          })
          .catch(e => {
              this.errored = true;
              if(e.response){
                  this.error = e.response.data;
              }else{
                  this.error.title = e;
                  this.error.detail = '';
              }

          })
          .finally(() => {
              this.loading = false;
          });
  },
  methods: {
    reload: function() {
        this.cata = null;
      var location = this.$route.fullPath;
      this.$router.replace("/");
      this.$nextTick(() => this.$router.replace(location));

    },fillTable: function(){
          this.cata = null;
          if(this.selectedcatalogs != null)
          {
              this.showEmpty = true;
              console.log("showEmpty");
          }
            if(this.selectedcatalogs != null && this.selectedproducts !=null)
            {

                this.Refresh();
                this.showAlert2=false;
            }else{
                this.showAlert2=true;
                this.showAlert=false;
            }

      },EmptyCatalog: function(){
          var id=this.selectedcatalogs.id;
          console.log(id);

          axios.patch('http://localhost:8087/apigateway/rest/catalogs/ViderCatalog/'+id)
              .then(response => {

                  console.log(response);

                  alert(response.data.title);


              }).catch(e => {
              if(e.response){
                  alert(e.response.data.message);
              }else{
                  alert(e);
              }
          })
              .finally(()=>{});
      },
      deleteProductfromCatalog: function(id, index){

          axios.post('http://localhost:8087/apigateway/rest/CatProds/deleteCatProd/'+id)
                  .then(response => {

                      console.log(response);
                      Object.assign(this.datas.datas[index], response);
                      this.showAlert=true;
                      this.Refresh();

                  }).catch(e => {
                  if(e.response){
                      alert(e.response.data.message);
                  }else{
                      alert(e);
                  }
              })
                  .finally(()=>{});

      },

      Refresh: function(){
          this.cata=this.selectedcatalogs.text;
          this.prod=this.selectedproducts.text;
          console.log('this.selectedcatalogs '+this.selectedcatalogs.text+' ++ this.selectedproducts '+this.selectedproducts.text)
          console.log('this. '+this.cata);
          axios.post('http://localhost:8087/apigateway/rest/CatProds/getbyCat/'+this.selectedcatalogs.id+'/Prod/'+this.selectedproducts.id)
              .then(response => {

                  console.log(response);
                  this.datas=response.data;
                  if(response.data=="Error")
                  {
                      this.showAlert=false;
                      this.showAlert2=true;
                  }

              }).catch(e => {
              if(e.response){
                  alert(e.response.data.message);
              }else{
                  alert(e);
              }
          })
              .finally(()=>{});
      }
  }
};
</script>
