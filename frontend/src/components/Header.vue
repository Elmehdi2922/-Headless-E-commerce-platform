<template>
<div>

    <b-navbar toggleable="md" type="dark" style="background: #2F4F4F; line-height: 0;padding: 0;margin-left: 0;box-shadow:0 4px 10px -2px #0b2e13;text-shadow: 2px 2px #0b2e13" class="py-0">
        <b-container>
            <b-row>
                <b-collapse id="nav-collapse" is-nav>
                    <b-navbar-nav>
                        <b-nav-item><router-link to="/home/catalog/0" class="nav-link active" title="Home"><i class="fas fa-home" style="font-size: 13px"></i> Vue as Client</router-link></b-nav-item>
                        <b-nav-item><router-link to="/admin" class="nav-link active" title="Administration"><i class="fas fa-users-cog" style="font-size: 13px"></i> Administration</router-link></b-nav-item>
                        <b-nav-item><router-link to="/makePayment" class="nav-link active" title="Administration"><i class="fas fa-users-cog" style="font-size: 13px"></i> make Payment</router-link></b-nav-item>
                    </b-navbar-nav>
                </b-collapse>
            </b-row>
        </b-container>
        <div class="collapse navbar-collapse" id="navbarTogglerDemo02">

            <form class="form-inline my-2 my-lg-1" style="padding-right:10px;padding-top:5px;">


                <b-button @click="logout()" variant="outline-info" class="mb-2">
                    <b-icon icon="power" aria-hidden="true"></b-icon>
                </b-button>
            </form>

        </div>
    </b-navbar>
</div>
</template>
<script>
export default {
  name: "Header",
    methods:{
      logout: function () {
          this.$router.push({ path: '/'});
      }
    }
};
</script>
