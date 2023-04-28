<template>
  <div class="row">
    <div class="col-12">
      <h3>BeastRow</h3>
      <div class="form-outline">
        <input disabled type="text" id="beast-name" class="form-control" />
        <label class="form-label" for="beast-name">Race</label>
      </div>
      <ul id="studentList">
          <li v-for="beast in beasts">{{ beast.name }}</li>
      </ul>
    </div>
  </div>
</template>

<script>
import axios from 'axios';
export default {
  name: "BeastRow",
  data() {
    return {
      beasts: []
    }
  },
  mounted() {
    this.loadBeasts();
  },
  methods: {
    loadBeasts() {
      axios.get('/beasts')
        .then((response) => {
          this.beasts = response.data;
        })
        .catch((error) => {
          console.log(error);
        });
    }
  }
}
</script>

<style scoped>

</style>