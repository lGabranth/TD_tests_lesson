<template>
  <div class="container h-100 rounded-3 mt-4 p-3" id="dashboard">
    <MDBModal
      id="exampleModal"
      tabindex="-1"
      labelledby="exampleModalLabel"
      v-model="displayAddPathologyModal"
      centered
    >
      <MDBModalHeader>
        <MDBModalTitle id="exampleModalLabel"> Ajouter une pathologie à <span class="text-primary">{{ beast.name }}</span> </MDBModalTitle>
      </MDBModalHeader>
      <MDBModalBody>
        <div class="container-fluid">
          <div class="row">
            <div class="col">
              <MDBInput
                v-model="searchPathology"
                inputGroup
                :formOutline="false"
                wrapperClass="mb-3"
                placeholder="Search"
                aria-label="Search"
                aria-describedby="button-addon2"
              >
                <MDBBtn color="primary">
                  <MDBIcon icon="search" />
                </MDBBtn>
              </MDBInput>

              <div class="row">
                <div class="col">
                  <div class="d-flex justify-content-between align-items-center">
                    Lèpre
                    <button class="btn btn-rounded btn-sm btn-link ripple-surface-success">
                      <i class="fas fa-add text-success"></i>
                    </button>
                  </div>
                  <hr class="my-2">
                </div>
              </div>
              <div class="row">
                <div class="col">
                  <div class="d-flex justify-content-between align-items-center">
                    Leuco
                    <button class="btn btn-rounded btn-sm btn-link ripple-surface-danger">
                      <i class="fas fa-times text-danger"></i>
                    </button>
                  </div>
                  <hr class="my-2">
                </div>
              </div>
            </div>
          </div>
        </div>
      </MDBModalBody>
      <MDBModalFooter>
        <MDBBtn color="danger" @click="displayAddPathologyModal = false">Annuler</MDBBtn>
        <MDBBtn color="success">Ajouter</MDBBtn>
      </MDBModalFooter>
    </MDBModal>
    <div class="row h-100">
      <div class="col h-100">
        <div class="d-flex align-middle">
          <router-link to="/beasts"><i class="fas fa-arrow-left fa-2x"></i></router-link>
          <h2 class="mx-2">Gnocchi</h2>
        </div>

        <div class="row w-100 mt-3">
          <div class="col-2 rounded-3 mask-custom">
            <!-- Tab navs -->
            <div
                class="nav flex-column nav-tabs text-center"
                id="v-tabs-tab"
                role="tablist"
                aria-orientation="vertical"
            >
              <button
                  class="nav-link active text-white"
                  id="home-tab0"
                  data-mdb-toggle="tab"
                  data-mdb-target="#v-tabs-home"
                  type="button"
                  role="tab"
                  aria-controls="v-tabs-home"
                  aria-selected="true"
              >
                <i class="fas fa-clipboard"></i> Home
              </button>
              <button
                  class="nav-link text-white-50"
                  id="v-tabs-profile-tab"
                  data-mdb-toggle="tab"
                  data-mdb-target="#v-tabs-profile"
                  type="button"
                  role="tab"
                  aria-controls="v-tabs-profile"
                  aria-selected="false"
              >
                <i class="fas fa-file-medical"></i> Santé
              </button>
              <button
                class="nav-link text-white-50"
                id="v-tabs-messages-tab"
                data-mdb-toggle="tab"
                data-mdb-target="#v-tabs-messages"
                role="tab"
                type="button"
                aria-controls="v-tabs-messages"
                aria-selected="false"
                disabled
            >
              <i class="fas fa-history"></i> Historique
            </button>
            </div>
            <!-- Tab navs -->
          </div>

          <div class="offset-1 col-9 rounded-3 mask-custom">
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
                      <MDBInput white label="Nom" v-model="beast.name"/>
                    </div>
                    <div class="col">
                      <MDBInput label="Race" disabled />
                      <!--<div class="select">
                        <select class="form-control select-text" required>
                          <option value="" disabled selected></option>
                          <option value="1">Option 1</option>
                          <option value="2">Option 2</option>
                          <option value="3">Option 3</option>
                        </select>
                        <label class="select-label text-white-50">Select</label>
                      </div>-->
                    </div>
                    <div class="col">
                      <div class="input-group">
                        <div class="input-group-text">
                          <input class="form-check-input mt-0" v-model="beast.chip" type="checkbox" value="" aria-label="Checkbox for following text input"/>
                        </div>
                        <MDBInput white label="Numéro puce" size="sm" v-model="beast.chipNumber" />
                      </div>
                    </div>
                  </div>
                  <div class="row mb-4">
                    <div class="col">
                      <div class="input-group">
                        <MDBInput white label="Date d'arrivée" type="date" v-model="beast.arrivalDate"/>
                        <MDBInput white label="Raison d'arrivée" v-model="beast.arrivalReason" />
                      </div>
                    </div>
                    <div class="col">
                      <div class="input-group">
                        <MDBInput white label="Date de départ" type="date" v-model="beast.exitDate"/>
                        <MDBInput white label="Raison du départ" v-model="beast.exitReason"/>
                      </div>
                    </div>
                  </div>
                  <div class="row mb-3">
                    <div class="col-4">
                      <MDBCheckbox label="Tatoué" v-model="beast.tattoo" />
                    </div>
                    <div class="col-8">
                      <MDBTextarea white label="Commentaire" rows="3" v-model="beast.identification" />
                    </div>
                  </div>
                </div>
                <hr>
                <div class="row mb-3">
                  <div class="col d-flex justify-content-between">
                    <router-link to="/beasts" class="btn btn-sm btn-outline-secondary">
                      <i class="fas fa-arrow-left"></i>
                    </router-link>
                    <MDBBtn size="sm" outline="info"><i class="fas fa-save"></i></MDBBtn>
                  </div>
                </div>
              </div>
              <div
                  class="tab-pane fade mb-3"
                  id="v-tabs-profile"
                  role="tabpanel"
                  aria-labelledby="v-tabs-profile-tab"
              >
                <MDBTabs v-model="activeTabId2">
                  <!-- Tabs navs -->
                  <MDBTabNav fill tabsClasses="mb-3">
                    <MDBTabItem tabId="ex2-1" href="ex2-1">Aperçu</MDBTabItem>
                    <MDBTabItem tabId="ex2-2" href="ex2-2">Rendez-vous</MDBTabItem>
                  </MDBTabNav>
                  <!-- Tabs navs -->
                  <!-- Tabs content -->
                  <MDBTabContent>
                    <MDBTabPane tabId="ex2-1">
                      <div>
                        Pathologies :
                        <MDBBadge v-for="p in beast.pathologies" pill color="danger" class="mx-2"><i class="fas fa-times"></i>{{ p.pathology.name }}</MDBBadge>
                        <MDBBadge pill color="light" class="mx-2" @click="displayAddPathologyModal = true" style="cursor: pointer;"><i class="fas fa-add"></i> Ajouter</MDBBadge>
                      </div>
                      <hr>
                      <div class="d-flex">
                        Vaccins :
                        <MDBBadge pill color="success" class="mx-2"><i class="fas fa-times text-danger"></i> Rage</MDBBadge>
                        <MDBBadge pill color="warning" class="mx-2"><i class="fas fa-times text-danger"></i> Leuco <i class="fas fa-clock text-warning"></i></MDBBadge>
                        <MDBBadge pill color="light" class="mx-2"><i class="fas fa-add"></i> Ajouter</MDBBadge>
                      </div>
                      <hr>
                      <p>
                        Dernier rendez-vous médical le : <strong>02/05/2023</strong>
                      </p>
                    </MDBTabPane>
                    <MDBTabPane tabId="ex2-2">
                      <h3>Historique des rendez-vous médicaux</h3>
                      <div class="table-responsive">
                        <MDBTable class="align-middle mb-0 bg-transparent table-hover table-sm">
                          <thead>
                            <tr>
                              <th>Date</th>
                              <th>Doctor</th>
                              <th>Compte rendu</th>
                              <th>Vaccins</th>
                              <th>Actions</th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr>
                              <td>
                                02/05/2023
                              </td>
                              <td>
                                <div class="d-flex align-items-center">
                                  <img src="https://mdbootstrap.com/img/new/avatars/8.jpg" alt="" style="width: 45px; height: 45px"
                                    class="rounded-circle" />
                                  <div class="ms-3">
                                    <p class="fw-bold mb-1">Dr. Chen</p>
                                    <a href="tel:0673057880" class="text-muted mb-0">06.73.05.78.80</a>
                                  </div>
                                </div>
                              </td>
                              <td>En fait il avait juste un truc coincé...</td>
                              <td>
                                <MDBBadge badge="success" pill class="d-inline">Rage</MDBBadge>
                              </td>
                              <td>
                                <MDBBtn color="link" size="sm" rounded>
                                  <i class="fas fa-edit text-warning"></i>
                                </MDBBtn>
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
                        </MDBTable>
                      </div>
                    </MDBTabPane>
                  </MDBTabContent>
                  <!-- Tabs content -->
                </MDBTabs>
              </div>
              <div
                  class="tab-pane fade"
                  id="v-tabs-messages"
                  role="tabpanel"
                  aria-labelledby="v-tabs-messages-tab"
              >
                <h3>Historique de Gnocchi</h3>

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
      beast: {},
      displayAddPathologyModal: false,
      searchPathology: "",
      test: null,
      activeTabId2: "ex2-1",
    };
  },
  mounted() {
    this.getBeast(this.$route.params.id);
  },
  methods: {
    getBeast() {
      axios
        .get(`/beasts/${this.$route.params.id}`)
        .then((response) => {
          this.beast = response.data;
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