<template>
  <div class="container h-100 rounded-3 mt-4 p-3" id="dashboard">
    <div class="row h-100">
      <div class="col h-100">
        <h2>Utilisateurs</h2>

        <button class="btn btn-sm btn-success mt-2" disabled><i class="fas fa-add"></i> Ajouter un utilisateur</button>
        <div class="table-responsive">
          <table class="table align-middle table-hover table-sm mb-0 mask-custom mt-3 rounded-3 h-75">
            <thead class="bg-transparent">
            <tr>
              <th>#</th>
              <th>Identité</th>
              <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="(user, index) in users">
              <td>{{ index + 1 }}</td>
              <td>
                <div class="d-flex align-items-center">
                  <img
                      :src="user.img"
                      alt=""
                      style="width: 45px; height: 45px"
                      class="rounded-circle"
                  />
                  <div class="ms-3">
                    <p class="fw-bold mb-1">{{ user.firstname }}</p>
                    <p class="text-muted mb-0">
                      {{ user.lastname }}
                    </p>
                  </div>
                </div>
              </td>
              <td>
                <router-link :to="'/user/'+user.id" type="button" class="btn btn-link btn-sm btn-rounded">
                  <i class="fas fa-edit text-warning"></i>
                </router-link>
                <button type="button" class="btn btn-link btn-sm btn-rounded" disabled>
                  <i class="fas fa-trash text-danger"></i>
                </button>
              </td>
            </tr>
            </tbody>
            <tfoot>
            <tr>
              <td colspan="6" class="text-center">
                <div class="input-group-sm">
                  <button disabled type="button" class="btn btn-link btn-sm btn-rounded">
                    <i class="fas fa-arrow-circle-left"></i>
                  </button>
                  <span class="mx-2">1</span>
                  <button disabled type="button" class="btn btn-link btn-sm btn-rounded">
                    <i class="fas fa-arrow-circle-right"></i>
                  </button>
                </div>
              </td>
            </tr>
            </tfoot>
          </table>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { MDBModal, MDBModalHeader, MDBModalTitle, MDBModalBody, MDBModalFooter, MDBBtn, MDBInput, MDBTextarea } from "mdb-vue-ui-kit";
const axios = require("axios");
export default {
  name: "DashboardScreen",
  components: {
    MDBModal,
    MDBModalHeader,
    MDBModalTitle,
    MDBModalBody,
    MDBModalFooter,
    MDBBtn,
    MDBInput,
    MDBTextarea
  },
  data() {
    return {
      users: [],
    };
  },
  mounted() {
    this.getUsers();
  },
  methods: {
    getUsers() {
      axios.get("https://127.0.0.1:8000/users", {
        headers: {
          'Content-Type': 'application/x-www-form-urlencoded',
          'Access-Control-Allow-Origin': '*'
        }
      }).then((res) => {
        this.users = res.data;
      });
    },
  }
}
</script>

<style scoped>
.mask-custom {
  box-shadow: 0 0 1rem 0 rgba(0, 0, 0, .3);
  background-color: rgba(0, 0, 0, .25);
  /*background-color: rgba(255, 255, 255, .25);*/
  backdrop-filter: blur(5px);
}
</style>