<template  style="margin-left: 0;">
                <nav id="sidebar" class="m-0"  style="margin-left: 0;">

                    <div class="sidebar-header" style="background-image:url(../assets/images/catalog/user.jpg);text-shadow: 2px 2px #3c3f41" >
                        <img src="../assets/images/catalog/user.jpg" alt="Avatar" style="width:120px;height:120px;border-radius:50%;">
                        <br>
                        <p><font size="6" color="white"> Admin</font></p>

                    </div>
                    <ul class="list-unstyled components">
                        <p>Services :</p>
                        <li class="service">
                            <a href="#" data-toggle="collapse" aria-expanded="false">Catalog</a>
                            <ul class="subservice list-unstyled">
                                <li>
                                    <router-link to="/admin/catalog">All Catalogs</router-link>
                                </li>
                                <li>
                                    <router-link to="/admin/catalog/add">Add Catalog</router-link>
                                </li>
                                <li>
                                    <router-link to="/admin/catalog/CatalogProducts">Add Products to Catalogs</router-link>
                                </li>
                                <li>
                                    <router-link to="/admin/catalog/deleteProductFromCatalog">Delete Products from Catalogs</router-link>
                                </li>

                            </ul>
                        </li>
                        <li class="service">
                            <router-link to="/admin/payments">Payment</router-link>
                            <ul class="subservice list-unstyled">
                                <li>
                                    <router-link to="/admin/payments/transactions">Transactions</router-link>
                                </li>
                                <li>
                                    <router-link to="/admin/payments/authorizations">Authorizations
                                        <b-badge variant="danger" v-if="countNotCaptured > 0">{{ countNotCaptured }}</b-badge>
                                    </router-link>
                                </li>
                                <li>
                                    <router-link to="/admin/payments/refunds">Refunds</router-link>
                                </li>
                            </ul>
                        </li>
                        <li class="service">
                            <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false">Products</a>
                        </li>
                        <li class="service">
                            <a href="#">Users</a>
                        </li>
                        <li class="service">
                            <a href="#">Carts</a>
                        </li>


                    </ul>
                </nav>
</template>
<script>
import axios from "axios";
export default {
  name: "AdminSideBar",
  data() {
    return {
      countNotCaptured: 0
    };
  },
  mounted(){
      axios.get(this.paymentService + 'payments/authorizations/getCountNotCaptured')
      .then(response =>{
          var result = response.data;
          if(result.CountNotCaptured){
              this.countNotCaptured = result.CountNotCaptured;
          }
      })
      .catch(e => {
        console.log(e);
      })
      .finally(() => {
      });
  },
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

.sidebar-header{
     background-image: url('../assets/images/catalog/user.jpg'); text-align: center;

}
</style>
