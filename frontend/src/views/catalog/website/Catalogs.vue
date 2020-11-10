<template>
    <div class="container-fluid">
        <div class="row">
            <div class="col text-left">
                <div class="wrapper">
                    <catalogSideBar />
                    <!-- Content -->
                    <div id="content">
                        <h1><img alt="commerce" src="../../../assets/images/catalog.png" />Catalog Products </h1>
                        <div class="bg-light mb-3">
                            <div class="container">
                                <div class="row">
                                    <div class="col p-2">
                                        <router-link :to="{name: 'Home'}">
                                            <i class="fas fa-home"></i> home
                                        </router-link>&nbsp;

                                        <i class="fas fa-chevron-right" style="font-size: 12px"></i> &nbsp;
                                        <div class="d-inline txt">Products</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="alert alert-info text-left">
                            <b-icon icon="exclamation-circle-fill" variant="info" font-scale="1.5" style="vertical-align: middle" /> <b></b> Catalog Products  .
                        </div>
                        <br>
                        <br>
                        <div class="flex-container">
                            <div v-for="(product) in datas.datas" :key="product.id">
                                <b-card
                                        :title="product.lib"
                                        src="../../../assets/images/catalog.png"
                                        v-bind:img-src="require(`../../../assets/images/catalog/`+product.image)"
                                        img-alt="Image"
                                        img-top
                                        tag="article"
                                        v-bind:img-height="'200px'"
                                        v-bind:img-width="'100px'"
                                        style="max-width: 20rem;background-color:#DCDCDC"
                                        class="mb-2"
                                >
                                    <b-card-text >
                                        {{product.lib}}
                                    </b-card-text>

                                    <b-button href="#" variant="primary">Add to Cart</b-button>
                                </b-card>
                            </div>

                        </div>


                    </div>
                </div>
            </div>
        </div>
        </div>
</template>


<script>
import catalogSideBar from "@/components/ClientCatalogSideBar.vue";
import axios from "axios";
export default {
  name: "homeCatalog",
  components: {
      catalogSideBar
  },
  data() {
    return {
      loading: true,
      interv: '0',
      url: '',
      errored: false,
      error: {},
      datas: {},
      idprod: {},
      prods: {}
    };
  },
  mounted(){
      axios.get('http://localhost:8083/rest/CatProds/getbyCatalog/'+this.$route.params.id)
          .then(response =>{

             // console.log(response.data);
              this.idprod = response.data.id;

              for(var i=0;i<this.idprod.length;i++)
              {
                  if(i==0)
                      this.interv=this.idprod[i];
                  else
                      this.interv=this.interv+','+this.idprod[i];
              }
              this.url='http://localhost:8083/rest/products/getProdsbyCatalog/'+this.interv;
              console.log("-"+this.interv+"-");
              axios.get(this.url)//+this.interv)
                  .then(response =>{
                      this.datas = response.data;
                      console.log(response.data.datas);
                      console.log(this.interv);

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



  }
};
</script>
<style>
    .flex-container {
        display: flex;
        flex-wrap: wrap;


    }

    .flex-container > div {
        width: 300px;
        margin: 10px;
        text-align: center;
        line-height: 75px;
        font-size: 20px;
        margin-left: auto;
        margin-right: auto
    }
</style>