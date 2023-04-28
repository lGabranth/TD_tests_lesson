<template>
  <div class="container h-100 rounded-3 mt-4 p-3" id="dashboard">
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
              <a
                  class="nav-link text-white-50"
                  id="v-tabs-profile-tab"
                  data-mdb-toggle="tab"
                  href="#v-tabs-profile"
                  role="tab"
                  aria-controls="v-tabs-profile"
                  aria-selected="false"
              >Profile</a
              > <a
                class="nav-link text-white-50"
                id="v-tabs-messages-tab"
                data-mdb-toggle="tab"
                href="#v-tabs-messages"
                role="tab"
                aria-controls="v-tabs-messages"
                aria-selected="false"
            >Messages</a
            >
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
                      <MDBInput white label="Nom" v-model="message"/>
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
                          <input class="form-check-input mt-0" type="checkbox" value="" aria-label="Checkbox for following text input"/>
                        </div>
                        <MDBInput white label="Numéro puce" size="sm" />
                      </div>
                    </div>
                  </div>
                  <div class="row mb-4">
                    <div class="col">
                      <div class="input-group">
                        <MDBInput white label="Date d'arrivée" type="date" v-model="test"/>
                        <MDBInput white label="Raison d'arrivée" />
                      </div>
                    </div>
                    <div class="col">
                      <div class="input-group">
                        <MDBInput white label="Date de départ" type="date"/>
                        <MDBInput white label="Raison du départ"/>
                      </div>
                    </div>
                  </div>
                  <div class="row mb-3">
                    <div class="col-4">
                      <MDBCheckbox label="Tatoué" />
                    </div>
                    <div class="col-8">
                      <MDBTextarea white label="Commentaire" rows="3" />
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
                  class="tab-pane fade"
                  id="v-tabs-profile"
                  role="tabpanel"
                  aria-labelledby="v-tabs-profile-tab"
              >
                Profile content
              </div>
              <div
                  class="tab-pane fade"
                  id="v-tabs-messages"
                  role="tabpanel"
                  aria-labelledby="v-tabs-messages-tab"
              >
                Messages content
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
import { MDBInput, MDBBtn, MDBCheckbox, MDBTextarea } from "mdb-vue-ui-kit";
export default {
  name: "BeastScreen",
  components: {
    MDBInput,
    MDBBtn,
    MDBCheckbox,
    MDBTextarea,
  },
  data() {
    return {
      message: "Hello Vue!",
      test: null,
    };
  },
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