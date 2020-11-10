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
                                <div class="d-inline txt">Add Product to Catalog</div>
                            </div>
                            </div>
                        </div>
                    </div>

                    <div class="alert alert-info text-left">
                        <b-icon icon="exclamation-circle-fill" variant="info" font-scale="1.5" style="vertical-align: middle" /> <b>Catalog and Product management :</b> add Products to catalogs .
                    </div>
                    <div v-if="showAlert==true">
                        <b-alert variant="success" show dismissible>
                            Product added to Catalog with success !
                        </b-alert>
                    </div>


                    <table class="table text-center table-striped">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th></th>
                            <th>Libelle</th>
                            <th class="text-right">
                                <template>
                                    <div>
                                        <template>
                                            <select v-model="selected" name="catalogs" id="catalogs" class="form-control" tabindex="12">
                                                <option v-for="(catalog) in catalogs.datas" :key="catalog.id" :value="catalog.id" selected>{{ catalog.libelle }}</option>
                                            </select>
                                        </template>

                                    </div>
                                </template> &nbsp;
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
                                <tr v-for="(product, index) in datas.datas" :key="product.id">
                                    <td>{{ product.id }}</td>
                                    <td> <img alt="commerce"  :src="require(`../../../assets/images/catalog/`+product.image)" style="width:80px;height:80px"/></td>
                                    <td>{{ product.lib }}</td>



                                    <td class="text-right">

                                        <template>
                                            <b-button
                                                    v-b-tooltip.hover
                                                    class="btn text-white px-0"
                                                    type="button"
                                                    title="add"
                                                    @click="addProductToCatalog(product.id, index)"
                                                    style="background-color:#007bff; width: 42px"
                                            >
                                                <b-icon icon="bookmark-plus" class="align-middle" />
                                            </b-button>

                                        </template>
                                    </td>
                                </tr>
                            </template>
                        </template>
                        </tbody>
                    </table>
                </div>
            </div>
            </div>
        </div>
    </div>
  </div>
</template>

<script>
import Header from "@/components/Header.vue";
import AdminSideBar from "@/components/AdminSideBar.vue";
import axios from "axios";
export default {
  name: "CatalogProducts",
  components: {
    AdminSideBar,
      Header
  },
  data() {
    return {
      showAlert : false,
      selected: null,
      loading: true,
      errored: false,
      error: {},
      datas: {},
        catalogs: {},
    };
  },
  mounted(){
      axios.get('http://localhost:8083/rest/products/get')
          .then(response =>{
              this.datas = response.data;
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
      var location = this.$route.fullPath;
      this.$router.replace("/");
      this.$nextTick(() => this.$router.replace(location));

    },
      addProductToCatalog: function(id, index){

        if(this.selected==null)
        {
            alert("Please choose Catalog")
        }else {
            axios.post('http://localhost:8087/apigateway/rest/catalogs/ajouterProd/' + id + '/ToCatalog/' + this.selected)
                .then(response => {

                    console.log(response.data.title);
                    Object.assign(this.datas.datas[index], response);

                    if(response.data.title=="Product already exist in this catalog!")
                        alert("Product already exist in this catalog!");
                    else
                        this.showAlert = true;
                }).catch(e => {
                if (e.response) {
                    alert(e.response.data.message);
                } else {
                    alert(e);
                }
            })
                .finally(() => {
                });
        }
      },

      Refresh: function(){
          axios.get('http://localhost:8087/apigateway/rest/catalogs/getAllCat')
              .then(response =>{
                  this.datas = response.data;
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
      }
  }
};
</script>
