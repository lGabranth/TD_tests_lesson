<template>
  <div class="container h-100 rounded-3 mt-4 p-3" id="dashboard">
    <div class="row h-100">
      <div class="col h-100">
        <h2>Les animaux</h2>

        <MDBModal
          id="exampleModal"
          tabindex="-1"
          labelledby="exampleModalLabel"
          v-model="exampleModal"
          centered
        >
          <MDBModalHeader>
            <MDBModalTitle id="exampleModalLabel"> Ajouter un animal </MDBModalTitle>
          </MDBModalHeader>
          <MDBModalBody>
            <div class="container-fluid">
              <div class="row mb-3">
                <div class="col">
                  <MDBInput white label="Nom" v-model="newBeast.name" />
                </div>
                <div class="col">
                  <select class="form-control" v-model="newBeast.race">
                    <option value="0">Selectionner une race</option>
                    <option v-for="race in races" :value="race.id">{{ race.name }}</option>
                  </select>
                </div>
              </div>

              <div class="row mb-3">
                <div class="col">
                  <MDBInput white label="Date d'arrivée" type="date" v-model="newBeast.arrivalDate"/>
                </div>
                <div class="col">
                  <MDBInput white label="Raison d'arrivée" v-model="newBeast.arrivalReason" />
                </div>
              </div>

              <div class="row">
                <div class="col">
                  <MDBTextarea white label="Commentaires" rows="2" v-model="newBeast.comments" />
                </div>
              </div>
            </div>
          </MDBModalBody>
          <MDBModalFooter>
            <MDBBtn size="sm" color="danger" @click="exampleModal = false">Fermer</MDBBtn>
            <MDBBtn size="sm" color="success" @click="addBeast">Ajouter</MDBBtn>
          </MDBModalFooter>
        </MDBModal>
        <button class="btn btn-sm btn-success mt-2" @click="exampleModal = true"><i class="fas fa-add"></i> Ajouter un animal</button>
        <div class="table-responsive">
          <table class="table align-middle table-hover table-sm mb-0 mask-custom mt-3 rounded-3 h-75">
            <thead class="bg-transparent">
            <tr>
              <th>Name</th>
              <th>Family</th>
              <th>Status</th>
              <th>Arrival date</th>
              <th>Exit date</th>
              <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="beast in beasts">
              <td>
                <div class="d-flex align-items-center">
                  <img
                      src="https://mdbootstrap.com/img/new/avatars/8.jpg"
                      alt=""
                      style="width: 45px; height: 45px"
                      class="rounded-circle"
                  />
                  <div class="ms-3">
                    <p class="fw-bold mb-1">{{ beast.name }}</p>
                    <p class="text-muted mb-0">
                      Chip Number : {{ beast.chipNumber ?? 'N/A' }}
                    </p>
                  </div>
                </div>
              </td>
              <td>Bourtoire</td>
              <td>
                <span v-for="s in beast.status" class="badge rounded-pill d-inline mx-1" :class="'badge-'+s.color">{{
                    s.name
                  }}</span>
              </td>
              <td>
                <p class="fw-normal mb-1">{{ beast.arrivalDate }}</p>
                <p class="text-muted mb-0">{{ beast.arrivalReason }}</p>
              </td>
              <td>{{ beast.exitDate ?? 'N/A' }}</td>
              <td>
                <router-link to="/beasts/1" type="button" class="btn btn-link btn-sm btn-rounded">
                  <i class="fas fa-edit text-warning"></i>
                </router-link>
                <button type="button" class="btn btn-link btn-sm btn-rounded">
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
  name: "BeastsScreen",
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
      exampleModal: false,
      newBeast: {
        name: "",
        race: 0,
        family: "",
        status: [],
        exitDate: null,
        arrivalDate: null,
        arrivalReason: "",
        comments: "",
      },
      beasts: [],
      races: [],
    };
  },
  mounted() {
    this.getBeasts();
    this.getRaces();
  },
  methods: {
    getRaces() {
      axios.get("https://127.0.0.1:8000/races", {
        headers: {
          'Content-Type': 'application/x-www-form-urlencoded',
          'Access-Control-Allow-Origin': '*'
        }
      }).then((res) => {
        this.races = res.data;
      });
    },
    getBeasts() {
      axios.get("https://127.0.0.1:8000/beasts", {
        headers: {
          'Content-Type': 'application/x-www-form-urlencoded',
          'Access-Control-Allow-Origin': '*'
        }
      }).then((res) => {
        this.beasts = res.data;
      });
    },
    addBeast() {
      axios.post("https://127.0.0.1:8000/beasts/add", this.newBeast, {
        headers: {
          'Content-Type': 'application/x-www-form-urlencoded',
          'Access-Control-Allow-Origin': '*'
        }
      }).then((res) => {
        if (res.data.success) {
          this.beasts.push(JSON.parse(JSON.stringify(this.newBeast)));
        }
      });
    }
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