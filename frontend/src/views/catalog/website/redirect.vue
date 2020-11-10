

<script>
export default {
  name: "redirect",
  components: {
  },
  data() {
    return {

    };
  },
  mounted(){

      this.$router.push({ path: '/home/catalog/'+this.$route.params.id});

  }
};
</script>
