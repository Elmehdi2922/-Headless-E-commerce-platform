<template>
  <div>

    <div class="form-group">
      <label for="libelle" >Libelle:</label>
      <b-input
              required minlength="2"
              type="text"
              id="libelle"

              class="form-control"
              v-model="catalog.libelle" />
    </div>
    <div class="form-group">
      <label for="details">Detail :</label>
      <b-input
              required minlength="10"
              type="text"
              id="details"
              class="form-control"
              v-model="catalog.details" />
    </div>
    <template>
      <div class="form-group">
        <label for="image">Image :</label>
        <b-form-file
                required minlength="2"
                v-model="catalog.image"
                ref="file-input"
                class="mb-2"
                accept="image/png, image/jpeg"
        ></b-form-file>
      </div>
    </template>

    <template>
      <div>
        <label for="datec">Choose a date</label>
        <b-form-datepicker id="datec" v-model="catalog.datec" class="mb-2"></b-form-datepicker>

      </div>
    </template>



    <div class="form-group">
      <label for="etat">Etat:</label>
      <select id="etat" class="form-control" v-model="catalog.etat">
        <option value="1">Active</option>
        <option value="0">Desactive</option>
      </select>
    </div>
    <button class="btn btn-danger">Save</button>
  </div>
</template>
<script>
  export default {
    name: "CatalogForm",
    props: {
      catalog: {
        libelle: String,
        details: String,
        image: String ,
        etat: Boolean,
        datec: String
      }
    },data() {
      return {
        image: null,
        value: ''
      }
    }
  };
</script>
