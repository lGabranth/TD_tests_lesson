<template>
  <div class="container h-100 rounded-3 mt-4 p-3" id="dashboard">
    <div class="row h-100">
      <div class="col h-100">
        <h2>Les animaux</h2>

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
                    <p class="text-muted mb-0">Chip Number : 0X10993029</p>
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
                <p class="text-muted mb-0">SDF</p>
              </td>
              <td>N/A</td>
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
export default {
  name: "BeastsScreen",
  data() {
    return {
      beasts: [
        {
          id: 1,
          name: "Gnocchi",
          family: "Bourtoire",
          status: [
            {
              id: 1,
              name: "Typhus",
              color: "success"
            },
            {
              id: 2,
              name: "Rage",
              color: "danger"
            }
          ],
          arrivalDate: "23/10/1996",
          exitDate: null
        }
      ]
    };
  },
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