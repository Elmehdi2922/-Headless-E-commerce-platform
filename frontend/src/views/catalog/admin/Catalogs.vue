<template>
  <div class="container-fluid"  style="padding: 0;margin-left: 0;">
    <div class="row" >
        <div class="col" style="margin-left: 0;">
            <div class="wrapper"  style="margin-left: 0; ">
                <AdminSideBar />

                <!-- Content -->
                <div id="content" style="padding: 0;margin:0px;height: 100%;border-top:7px #2F4F4F;">
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
                                <div class="d-inline txt">Catalogs</div>
                            </div>
                            </div>
                        </div>
                    </div>
                    <div class="alert alert-info text-left">
                        <b-icon icon="exclamation-circle-fill" variant="info" font-scale="1.5" style="vertical-align: middle" /> <b>Catalog management :</b> Manage catalogs methods.
                    </div>
                    <div class="btn-group" role="group" aria-label="kkk">
                        <span class="btn btn-secondary">Action :</span>
                        <button type="button" @click="activeAll()" class="btn btn-info">Active All</button>
                        <button type="button" @click="desactiveAll()" class="btn btn-info">Desactive All</button>

                        <div class="btn-group" role="group">



                        </div>
                    </div>
                    <table class="table text-center table-striped">
                        <thead>
                            <tr>
                            <th>#</th>
                            <th>Image</th>
                            <th>Libelle</th>
                            <th>Details</th>
                            <th>Date</th>
                            <th>Etat</th>
                            <th>Action</th>
                            <th class="text-right">
                                &nbsp;<div class="btn-group" role="group" aria-label="Etat catalog">
                                <button type="button" @click="Refresh()" class="btn btn-info">All</button>
                                <button type="button" @click="getactive()" class="btn btn-info">Active</button>
                                <button type="button" @click="getdesactive()" class="btn btn-info">Desactive</button>
                            </div></th>

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
                                <tr v-for="(catalog, index) in datas.datas" :key="catalog.id">
                                    <td>{{ catalog.id }}</td>
                                    <td> <img v-bind:src="require(`../../../assets/images/catalog/`+catalog.image)"  style="width:80px;height:80px" /></td>
                                    <td>{{ catalog.libelle }}</td>
                                    <td>{{ catalog.details }}</td>
                                    <td>{{ catalog.datec }}</td>
                                    <td v-if="catalog.etat == 0"><span class="badge badge-pill badge-danger">Desactive</span></td>
                                    <td v-if="catalog.etat == 1"><span class="badge badge-pill badge-success">Active</span></td>
                                    <td class="text-right">
                                        <template v-if="catalog.etat == 0" class="ml-md-3">
                                            <b-button v-b-tooltip.hover class="btn text-white px-0" type="button" @click="etataCatalog(1, catalog.id, index)" title="Activer" variant="success" style="  width: 42px">
                                                <b-icon icon="check2-circle" class="align-middle" />
                                            </b-button>
                                        </template>
                                        <template v-else >
                                            <b-button
                                                    v-b-tooltip.hover
                                                    class="btn text-white px-0"
                                                    type="button"
                                                    title="Désactiver"
                                                    variant="danger"
                                                    @click="etataCatalog(0, catalog.id, index)"
                                                    style=" width: 42px"

                                            >
                                                <b-icon icon="x-circle" class="align-middle" />
                                            </b-button>
                                        </template>
                                        </td>
                                        <td class="text-right">
                                        <router-link :to="'/admin/catalog/update/'+catalog.id">
                                            <b-button v-b-tooltip.hover class="btn text-white px-0" title="Edit" style="background-color:#5F9EA0; width: 42px">
                                                <b-icon icon="pencil" class="align-middle" />
                                            </b-button>
                                        </router-link>&nbsp;
                                        <template>
                                            <b-button
                                                    v-b-tooltip.hover
                                                    class="btn text-white px-0"
                                                    type="button"
                                                    title="Delete"
                                                    @click="deleteCatalog(catalog.id, index)"
                                                    style="background-color:#8B0000; width: 42px"
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
  name: "Catalogs",
  components: {
    AdminSideBar,
    Header
  },
  data() {
    return {
      loading: true,
      errored: false,
      error: {},
      datas: {}
    };
  },
  mounted(){
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
  },
  methods: {
    reload: function() {
      var location = this.$route.fullPath;
      this.$router.replace("/");
      this.$nextTick(() => this.$router.replace(location));

    },
      etataCatalog: function(etat, id, index){
          var msg = "Are you sure ?";
          var url = "http://localhost:8087/apigateway/rest/catalogs/ActiveCatalog/";
          if(etat == 0){
              url = "http://localhost:8087/apigateway/rest/catalogs/DesactiveCatalog/";
          }
          if(confirm(msg)){
             axios.patch(url + id )
                  .then(response => {

                      console.log(response);
                      Object.assign(this.datas.datas[index], response);
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

                  }).catch(e => {
                  if(e.response){
                      alert(e.response.data.message);
                  }else{
                      alert(e);
                  }
              })
                  .finally(()=>{});
          }
      },
      activatePayment: function(status, id, index){
          var msg = "";
          if(status == 0){
              msg = "Are you sure to activate this payment method ?";
          }else{
              msg = "Are you sure to disable this payment method ?";
          }
          if(confirm(msg)){
              const params = new URLSearchParams();
              params.append('status', 1-status);
              axios.patch(this.paymentService + 'payments/payments/updatePayment/' + id , params)
                  .then(response => {
                      var theResponse = response.data;
                      if(theResponse.status == "updated"){
                          Object.assign(this.datas.datas[index], theResponse.data);
                      }else{
                          alert("Error");
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
      },
      getactive: function(){
          axios.get('http://localhost:8087/apigateway/rest/catalogs/getActiveCatalog')
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
      },
      getdesactive: function(){
          axios.get('http://localhost:8087/apigateway/rest/catalogs/getDesactiveCatalog')
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
      },
      activeAll: function(){
          axios.get('http://localhost:8087/apigateway/rest/catalogs/ActiveAllCatalog')
              .then(response =>{
                  console.log(response);
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
      desactiveAll: function(){
          axios.get('http://localhost:8087/apigateway/rest/catalogs/DesactiveAllCatalog')
              .then(response =>{
                console.log(response);
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
      deleteCatalog: function( id, index){
          var msg = "Are you sure ?";

          if(confirm(msg)){
              axios.patch('http://localhost:8087/apigateway/rest/catalogs/deleteCatalog/' + id )
                  .then(response => {

                          console.log(response.data);
                          Object.assign(this.datas.datas[index], response);
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
  }
};
</script>
