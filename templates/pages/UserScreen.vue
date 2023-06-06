<template>
  <div class="container h-100 rounded-3 mt-4 p-3" id="dashboard">
    <div class="row h-100">
      <div class="col h-100">
        <div class="d-flex align-middle">
          <router-link to="/"><i class="fas fa-arrow-left fa-2x"></i></router-link>
          <h2 class="mx-2">Liste</h2>
        </div>

        <div class="row w-100 mt-3">
          <div class="col rounded-3 mask-custom">
            <!-- Tab content -->
            <div class="tab-content" id="v-tabs-tabContent">
              <div
                  class="tab-pane fade show active"
                  id="v-tabs-home"
                  role="tabpanel"
                  aria-labelledby="v-tabs-home-tab"
              >
                <div class="container-fluid">
                  <div class="row mt-3">
                    <div class="col">
                      <h2>Informations générales</h2>
                    </div>
                  </div>
                  <hr class="mt-1">
                  <div class="row my-4">
                    <div class="col">
                      <img
                        :src="user.img"
                        alt=""
                        style="width: 45px; height: 45px"
                        class="rounded-circle"
                      />
                    </div>
                  </div>
                  <div class="row my-4">
                    <div class="col">
                      <MDBInput white label="Login" v-model="user.login"/>
                    </div>
                    <div class="col">
                      <MDBInput white label="Email" v-model="user.email"/>
                    </div>
                  </div>
                  <div class="row my-4">
                    <div class="col">
                      <MDBInput white label="Prénom" v-model="user.firstname"/>
                    </div>
                    <div class="col">
                      <MDBInput white label="Nom" v-model="user.lastname"/>
                    </div>
                  </div>
                  <div class="row mb-3">
                    <div class="col">
                      <MDBCheckbox label="Admin" v-model="user.role" />
                    </div>
                    <div class="col">
                      <MDBCheckbox label="Actif" v-model="user.active" />
                    </div>
                  </div>
                </div>
                <hr>
                <div class="row mb-3">
                  <div class="col d-flex justify-content-between">
                    <router-link to="/" class="btn btn-sm btn-outline-secondary">
                      <i class="fas fa-arrow-left"></i>
                    </router-link>
                    <MDBBtn size="sm" outline="info"><i class="fas fa-save"></i></MDBBtn>
                  </div>
                </div>
              </div>
            </div>
            <!-- Tab content -->
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { MDBInput, MDBBtn, MDBCheckbox, MDBTextarea, MDBTabs, MDBTabNav, MDBTabItem, MDBTabContent, MDBTabPane, MDBBadge, MDBTable, MDBModal, MDBModalHeader, MDBModalBody, MDBModalFooter, MDBModalTitle, MDBIcon } from "mdb-vue-ui-kit";
const axios = require("axios");
export default {
  name: "BeastScreen",
  components: {
    MDBInput,
    MDBBtn,
    MDBCheckbox,
    MDBTextarea,
    MDBTabs,
    MDBTabNav,
    MDBTabItem,
    MDBTabContent,
    MDBTabPane,
    MDBBadge,
    MDBTable,
    MDBModal,
    MDBModalHeader,
    MDBModalBody,
    MDBModalFooter,
    MDBModalTitle,
    MDBIcon,
  },
  data() {
    return {
      user: {},
    };
  },
  mounted() {
    this.getUser(this.$route.params.id);
  },
  methods: {
    getUser() {
      axios
        .get(`/users/${this.$route.params.id}`)
        .then((response) => {
          this.user = response.data;
        })
        .catch((error) => {
          console.log(error);
        });
    },
    openModalAddPathology() {
      console.log('add')
    }
  }
}
</script>

<style scoped>
.select {
	position: relative;
}

.select-text {
	position: relative;
	font-family: inherit;
	background-color: transparent;
}

/* Remove focus */
.select-text:focus {
	outline: none;
}

	/* Use custom arrow */
.select .select-text {
	appearance: none;
	-webkit-appearance:none;
  color: gray;
}

.select:after {
	position: absolute;
	top: 15px;
	right: 10px;
	/* Styling the down arrow */
	width: 0;
	height: 0;
	padding: 0;
	content: '';
	border-left: 6px solid transparent;
	border-right: 6px solid transparent;
	border-top: 6px solid rgba(0, 0, 0, 0.12);

	pointer-events: none;
}

/* LABEL ======================================= */
.select-label {
	font-size: 18px;
	font-weight: normal;
	position: absolute;
	pointer-events: none;
  padding: 0 5px;
	left: 10px;
	top: 4px;
	transition: 0.2s ease all;
}


/* active state */
.select-text:focus ~ .select-label, .select-text:valid ~ .select-label {
  color: var(--mdb-primary) !important;
	top: -8px;
	transition: 0.2s ease all;
	font-size: 14px;
}

.select-text:valid:not(focus) ~ .select-label {
  color: rgba(0,0,0, 0.26);
}
.select-text:valid:focus ~ .select-label {
  color: orange;
}
</style>