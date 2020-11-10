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
                                <router-link :to="{name: 'Catalogs'}">
                                    Catalogs
                                </router-link> &nbsp;

                                <i class="fas fa-chevron-right" style="font-size: 12px"></i> &nbsp;
                                <div class="d-inline txt">Add Catalog</div>
                            </div>
                            </div>
                        </div>
                    </div>
                    <template>
                        <div>
                            <b-alert
                                    :show="dismissCountDown"
                                    dismissible
                                    variant="success"
                                    @dismissed="dismissCountDown=0"
                                    @dismiss-count-down="countDownChanged"
                            >
                                <h5> Catalog added with success .</h5>This alert will dismiss after {{ dismissCountDown }} seconds...
                            </b-alert>

                        </div>
                        <div>
                            <b-alert
                                    :show="dismissCountDown2"
                                    dismissible
                                    variant="danger"
                                    @dismissed="dismissCountDown2=0"
                                    @dismiss-count-down="countDownChanged2"
                            >
                                <h5> Error !! .</h5>This alert will dismiss after {{ dismissCountDown2 }} seconds...
                            </b-alert>

                        </div>
                    </template>
                    <div class="card">
                        <div class="card-header text-center">
                            <h3>Add Catalog</h3>
                        </div>
                        <div class="card-body text-left">
                            <b-overlay :show="loading" rounded="lg">
                                <form @submit="formSubmit">
                                    <CatalogForm :catalog="catalog" :violations="anerror.violations" />
                                </form>
                                <div class="alert alert-danger text-left my-2" v-if="anerror.isError">
                                    <i class="fas fa-exclamation-triangle"></i> <b>{{ anerror.title }}</b>
                                    <div class="text-muted">
                                        {{ anerror.detail }}
                                    </div>
                                </div>
                            </b-overlay>
                        </div>
                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>
  </div>
</template>
<script>
    import axios from "axios";
    import AdminSideBar from "@/components/AdminSideBar.vue";
    import CatalogForm from "@/components/catalog/admin/CatalogForm.vue";
    import Header from "@/components/Header.vue";

    export default {
        name: "AddCatalog",
        components: {
            AdminSideBar,
            CatalogForm,
            Header
        },
        beforeMount(){

        },
        data() {
            return {
                dismissSecs: 5,
                dismissCountDown: 0,
                dismissCountDown2: 0,
                loading: false,
                initialErrors: {
                    isError: false,
                    title: "",
                    detail: "",
                    violations:{
                        email: null,
                        emailViolations: []
                    }
                },
                anerror: {},
                catalog: {
                    libelle: '',
                    details: '',
                    image: '',
                    etat: 0,
                    datec: ''
                },
            };
        },
        methods: {
            countDownChanged(dismissCountDown) {
                this.dismissCountDown = dismissCountDown
            },
            countDownChanged2(dismissCountDown2) {
                this.dismissCountDown2 = dismissCountDown2
            },
            formSubmit(e) {
                e.preventDefault();
                this.loading = true;

                this.anerror = {};

                console.log(this.catalog.image.name);

                const params = new URLSearchParams();
                params.append('libelle',this.catalog.libelle);
                params.append('details',this.catalog.details);
                params.append('image', this.catalog.image.name);
                params.append('etat', this.catalog.etat);
                params.append('datec', this.catalog.datec+' 00:00:01');
                axios.post('http://localhost:8087/apigateway/rest/catalogs/addCatalog', params)
                    .then(response => {
                        console.log(response);
                        this.catalog.libelle="";
                        this.catalog.details="";
                        this.catalog.image="";
                        this.catalog.etat ="";
                        this.dismissCountDown = this.dismissSecs;

                    })
                    .catch(error => {
                        this.dismissCountDown2 = this.dismissSecs;
                        this.anerror.isError = true;
                        if(error.response){
                            this.anerror.title = error.response.data.message
                        }else{
                            this.anerror.title = error;
                        }
                    })
                    .finally(() => {
                        this.loading = false;
                    });
            }
        }
    }
</script>
