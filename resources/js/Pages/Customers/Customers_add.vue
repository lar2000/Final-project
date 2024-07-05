<template>
  <div>
    <div class="modal fade" tabindex="-1" role="dialog" id="add-customer">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <a href="#" class="close" data-bs-dismiss="modal"
            ><em class="icon ni ni-cross-sm"></em
          ></a>
          <div class="modal-body modal-body-md">
            <h5 class="modal-title">Add Customer</h5>
            <form action="#" class="mt-2">
              <div class="row g-gs">
                <div class="col-md-6">
                  <div class="form-group">
                    <label class="form-label" for="first-name">First Name</label
                    ><input
                      type="text"
                      class="form-control"
                      id="first-name"
                      placeholder="First name"
                    />
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label class="form-label" for="last-name">Last Name</label
                    ><input
                      type="text"
                      class="form-control"
                      id="last-name"
                      placeholder="Last name"
                    />
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label class="form-label" for="email">Email Address</label
                    ><input
                      type="email"
                      class="form-control"
                      id="email"
                      placeholder="Email Address"
                    />
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label class="form-label" for="phone-no">Phone Number</label
                    ><input
                      type="text"
                      class="form-control"
                      id="phone-no"
                      value="+880"
                      placeholder="Phone Number"
                    />
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label class="form-label" for="address">Address</label
                    ><input
                      type="text"
                      class="form-control"
                      id="address"
                      value="2337 Kildeer Drive"
                    />
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label class="form-label" for="package">Last Package</label
                    ><select class="form-select js-select2" id="package">
                      <option>Strater</option>
                      <option>Honeymoon</option>
                      <option>Vacation</option>
                      <option>Continental</option>
                    </select>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label class="form-label" for="group">Group</label
                    ><select class="form-select js-select2" id="group">
                      <option>Dimond</option>
                      <option>Silver</option>
                      <option>Platinum</option>
                      <option>Gold</option>
                    </select>
                  </div>
                </div>
                <div class="col-12">
                  <ul class="align-center flex-wrap flex-sm-nowrap gx-4 gy-2">
                    <li>
                      <button class="btn btn-primary">Add Customer</button>
                    </li>
                    <li>
                      <a href="#" class="link" data-bs-dismiss="modal"
                        >Cancel</a
                      >
                    </li>
                  </ul>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'LaravelVue3CustomersAdd',

  data() {
    return {
      
    };
  },

  mounted() {
    
  },

  methods: {
    
  },
};
</script>