<template>
    <nav id="sidebar" class="m-0">
        <div class="sidebar-header">
            <h3>Client</h3>
        </div>
        <ul class="list-unstyled components">

            <li class="service">
                <a href="#" data-toggle="collapse" aria-expanded="false">Catalogs :</a>
                <ul class="subservice list-unstyled">
                    <li v-for="catalog in datas.datas" :key="catalog.id">
                        <router-link :to="'/redirect/'+catalog.id">{{catalog.libelle}}</router-link>
                    </li>


                </ul>
            </li>
        </ul>
    </nav>
</template>
<script>
    import axios from "axios";
    export default {
        name: "catalogSideBar",
        data() {
            return {
                loading: true,
                errored: false,
                error: {},
                datas: {}
            };
        },
        mounted(){
            axios.get('http://localhost:8087/apigateway/rest/catalogs/getActiveCatalog')
                .then(response =>{
                    this.datas = response.data;
                    console.log(this.datas);
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
        },methods: {
            Refresh: function(id){

                this.$router.push({ path: '/redirect/'+id});

            }
        }
    };
</script>
<style>
    .service a.router-link-exact-active{
        background: #6D7FCC;
        background-color: #6D7FCC
    }
    .service{
        background: #343A40;
        background-color: #343A40;
    }
</style>
