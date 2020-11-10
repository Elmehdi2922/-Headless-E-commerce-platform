<template>
  <div  >
    <div class="center">
      <div class="" >
        <img src="../assets/images/catalog/user.jpg" alt="Avatar" style="width:120px;height:120px;border-radius:50%;">
        <br>
        <p><font size="6" color="white"> Admin</font></p>

      </div>
      <b-form @submit="formSubmit" v-if="show">
        <b-form-group
                id="input-group-1"

                label-for="input-1"
        >
          <b-form-input
                  id="input-1"
                  v-model="form.login"
                  type="text"
                  required
                  placeholder="Login"

          ></b-form-input>
          <br>
          <br>
          <b-form-input
                  id="input-2"
                  v-model="form.password"
                  type="password"
                  required
                  placeholder="Password"

          ></b-form-input>
        </b-form-group>
        <b-button type="submit" variant="primary">Connect</b-button>
      </b-form>
    </div>
    </div>
</template>

<script>
export default {
  name: "Home",
  data() {
    return {
      form: {
        login: '',
        password: ''
      },
      foods: [{ text: 'Select One', value: null }, 'Carrots', 'Beans', 'Tomatoes', 'Corn'],
      show: true
    }
  },methods:{

  formSubmit() {
    if(this.form.login=="mehdi" && this.form.password=="123")
    {
      this.$router.push({ path: '/admin/catalog'});
    }else{
      alert("ERROR LOGIN & PASSWORD !");
    }


  }

  }
};
</script>
<style>
  .center {
  text-align: center;
  margin: auto;
  width: 500px;
  padding: 50px;
    background-color: #ccc;
    border-radius: 5%;
  margin-top: 100px;

    box-shadow: 1px 1px 5px 3px grey;
  }
</style>