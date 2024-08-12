<template>
  <div>
    <div class="nk-content">
      <div class="container-fluid">
        <div class="nk-content-inner">
          <div class="nk-content-body">
            <!-- Check-Out List Section -->
            <div class="nk-block-head nk-block-head-sm" v-if="!showForm">
              <div class="nk-block-between">
                <div class="nk-block-head-content">
                  <h6 class="nk-block-title page-title">ລາຍການແຈ້ງອອກ</h6>
                </div>
                <div class="nk-block-head-content">
                  <div class="toggle-wrap nk-block-tools-toggle">
                    <a href="#" class="btn btn-icon btn-trigger toggle-expand me-n1" data-target="pageMenu">
                      <em class="icon ni ni-menu-alt-r"></em>
                    </a>
                    <div class="toggle-expand-content" data-content="pageMenu">
                      <ul class="nk-block-tools g-3">
                        <li class="nk-block-tools-opt">
                          <div class="d-flex">
                            <input type="text" class="form-control me-2" v-model="search" @keyup.enter="fetchCheckouts" placeholder="Search...">
                            <button class="btn btn-icon btn-primary" @click="toggleForm('add')">
                              <i class="bx bx-plus-medical"></i>
                            </button>
                          </div>
                        </li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Bill Content Section -->
            <div v-if="showBill" class="nk-block bill-container">
              <div class="card card-bordered card-stretch">
                <div class="card-inner bill-inner" ref="billSection">
                  <div class="bill-details">
                    <h4 class="bill-title text-center">ໃບບິນ</h4>
                    <h6 class="bill-subtitle text-center">ຫ້ອງແຖວຈີເມັ່ງທໍ່</h6>
                 <div class="bill-row">
                      <span class="bill-label">ລະຫັດເຊົ່າ:</span>
                      <span class="bill-value">{{ bill.rent_id }}</span>
                  </div>
                  <div class="bill-row">
                      <span class="bill-label">ເບີຫ້ອງ:</span>
                      <span class="bill-value">{{ bill.room_number }}</span>
                  </div>
                  <div class="bill-row">
                      <span class="bill-label">ຊື່ລູກຄ້າ:</span>
                      <span class="bill-value">{{ bill.cust_name }}</span>
                  </div>
                  <div class="bill-row">
                      <span class="bill-label">ວັນທີ່ແຈ້ງອອກ:</span>
                      <span class="bill-value">{{ bill.date_checkout }}</span>
                  </div>
                <hr>
                <div class="mb-3">
                  <button class="btn btn-success me-2" @click="saveBillAsPDF">ບັນທຶກ</button>
                  <button class="btn btn-danger" @click="showBill = false">Close</button>
                </div>
              </div>
            </div>
          </div>
            </div>

            <!-- Check-Out Table Section -->
            <div v-if="!showForm && !showBill" class="nk-block">
              <div class="card card-bordered card-stretch">
                <div class="card-inner-group">
                  <div class="card-inner p-0">
                    <table class="nk-tb-list nk-tb-ulist">
                      <thead>
                        <tr class="nk-tb-item nk-tb-head">
                          <th class="nk-tb-col">ລະຫັດເຊົ່າ</th>
                          <th class="nk-tb-col">ເບີຫ້ອງ</th>
                          <th class="nk-tb-col">ຊື່ລູກຄ້າ</th>
                          <th class="nk-tb-col">ວັນທີ່ແຈ້ງອອກ</th>
                          <th class="nk-tb-col">ຈັດການ</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr v-for="checkout in checkouts" :key="checkout.checkout_id" class="nk-tb-item">
                          <td class="nk-tb-col">{{ checkout.rent_id }}</td>
                          <td class="nk-tb-col">{{ checkout.room_number }}</td>
                          <td class="nk-tb-col">{{ checkout.cust_name }}</td>
                          <td class="nk-tb-col">{{ checkout.date_checkout }}</td>
                          <td class="nk-tb-col">
                            <div class="dropdown">
                              <a href="#" class="dropdown-toggle btn btn-icon btn-trigger" data-bs-toggle="dropdown">
                                <i class="bx bx-dots-horizontal"></i>
                              </a>
                              <div class="dropdown-menu dropdown-menu-end">
                                <ul class="link-list-opt no-bdr">
                                  <li>
                                      <a href="#" @click="generateBill(checkout)">
                                        <i class="menu-icon bx bxs-file"></i>
                                        <span>ສ້າງໃບບິນ</span>
                                      </a>
                                  </li>
                                  <li>
                                    <a href="#" @click="toggleForm('edit', checkout)">
                                      <i class="menu-icon bx bxs-edit-alt" style="color: chartreuse;"></i>
                                      <span>ແກ້ໄຂ</span>
                                    </a>
                                  </li>
                                  <li>
                                    <a href="#" @click="deleteCheckout(checkout.checkout_id)">
                                      <i class="menu-icon bx bxs-trash" style="color: red;"></i>
                                      <span>ລົບ</span>
                                    </a>
                                  </li>
                                </ul>
                              </div>
                            </div>
                          </td>
                        </tr>
                        <tr v-if="checkouts.length === 0">
                          <td colspan="5" class="text-center">No check-outs found</td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                  <div class="card-inner">
                    <div class="nk-block-between-md g-3">
                      <div class="g">
                        <ul class="pagination justify-content-center justify-content-md-start">
                          <!-- Pagination controls if needed -->
                        </ul>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div v-if="showForm">
              <h5 class="text-center">{{ formMode === 'add' ? 'ແຈ້ງອອກ' : 'ແກ້ໄຂແຈ້ງອອກ' }}</h5>
              <!-- Alert Messages -->
              <div v-if="alertMessage" :class="`alert alert-${alertType}`" role="alert">
                {{ alertMessage }}
              </div>
              <form @submit.prevent="formMode === 'add' ? addCheckout() : updateCheckout()">
                <div class="row">
                  <div class="mb-3 col-md-6">
                    <label for="rentCode" class="form-label">ລະຫັດເຊົ່າ</label>
                    <select class="form-control" v-model="form.rent_id" @change="populateFormFields" required>
                      <option v-for="rent in rents" :key="rent.rent_id" :value="rent.rent_id">
                        {{ rent.rent_id }}
                      </option>
                    </select>
                    <div v-if="errors.rent_id" class="text-danger">{{ errors.rent_id[0] }}</div>
                  </div>
                  <div class="mb-3 col-md-6">
                    <label for="roomNumber" class="form-label">ເບີຫ້ອງ</label>
                    <input type="text" class="form-control" v-model="form.room_number" readonly>
                    <div v-if="errors.room_number" class="text-danger">{{ errors.room_number[0] }}</div>
                  </div>
                  <div class="mb-3 col-md-6">
                    <label for="custName" class="form-label">ຊື່ລູກຄ້າ</label>
                    <input type="text" class="form-control" v-model="form.cust_name" readonly>
                    <div v-if="errors.cust_name" class="text-danger">{{ errors.cust_name[0] }}</div>
                  </div>
                  <div class="mb-3 col-md-6">
                    <label for="dateCheckout" class="form-label">ວັນທີ່ອອກ</label>
                    <input type="date" class="form-control" v-model="form.date_checkout" required>
                    <div v-if="errors.date_checkout" class="text-danger">{{ errors.date_checkout[0] }}</div>
                  </div>
                </div>
                <div class="me-2">
                  <button type="submit" class="btn btn-success me-2">{{ formMode === 'add' ? 'ບັນທຶກ' : 'ບັນທຶກ' }}</button>
                  <button type="button" class="btn btn-danger" @click="toggleForm()">ຍົກເລີກ</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import jsPDF from 'jspdf';
import html2canvas from 'html2canvas';

export default {
  data() {
    return {
      customers: [],
      checkouts: [], // Data for check-outs
      rents: [], // Data for rents
      form: {
        checkout_id: '',
        rent_id: '',
        room_number: '',
        cust_name: '',
        date_checkout: ''
      },
      formMode: 'add', // or 'edit'
      showForm: false,
      showBill: false,
      bill: {},
      search: '',
      alertMessage: '',
      alertType: '',
      errors: {}
    };
  },
  mounted() {
    this.loadInitialData();
  },
  methods: {
    loadInitialData() {
      this.fetchCheckouts();
      this.fetchRents();
      this.fetchCustomers();
    },
    toggleForm(mode = 'add', checkout = {}) {
      this.showForm = !this.showForm;
      this.formMode = mode;
      if (mode === 'add') {
        this.form = {
          checkout_id: '',
          rent_id: '',
          room_number: '',
          cust_name: '',
          date_checkout: ''
        };
      } else {
        this.form = { ...checkout };
      }
    },
    async fetchCheckouts() {
      try {
        // Fetch check-outs from API and set `this.checkouts`
        const response = await axios.get('/api/checkouts');
        this.checkouts = response.data;
      } catch (error) {
        console.error('Error fetching check-outs:', error);
      }
    },
    async fetchRents() {
      try {
        // Fetch rents from API and set `this.rents`
        const response = await axios.get('/api/rents');
        this.rents = response.data;
      } catch (error) {
        console.error('Error fetching rents:', error);
      }
    },
    fetchCustomers() {
      axios.get('/api/customers')
        .then(response => {
          this.customers = response.data;
        })
        .catch(this.handleError);
    },
    addCheckout() {
      axios.post('/api/checkouts', this.form)
        .then(response => {
          alert('add successfully!')
          this.navigateToTableList();
          this.checkouts.push(response.data);
          this.handleSuccess(response);
          this.$emit('checkout-added', this.form.rent_id); // Emit event with rent_id
        })
        .catch(this.handleError);
    },
    updateCheckout() {
      axios.put(`/api/checkouts/${this.form.checkout_id}`, this.form)
        .then(response => {
          const index = this.checkouts.findIndex(checkout => checkout.checkout_id === this.form.checkout_id);
          alert('ອັບເດດຂໍ້ມູນສຳເລັດ!')
          this.navigateToTableList();
          if (index !== -1) {
            this.$set(this.checkouts, index, response.data);
          }
          this.handleSuccess(response);
        })
        .catch(this.handleError);
    },
    deleteCheckout(checkout_id) {
      if (confirm("ຕ້ອງລົບຂໍ້ມູນການແຈ້ງອອກບໍ່ ?")) {
    axios.delete(`/api/checkouts/${checkout_id}`)
      .then(response => {
        this.checkouts = this.checkouts.filter(checkout => checkout.checkout_id !== checkout_id);
        alert('ລົບຂໍ້ມູນສຳເລັດ!')
        this.navigateToTableList();
        this.handleSuccess(response);
      })
      .catch(this.handleError);
  }
},
    populateFormFields() {
      const selectedRent = this.rents.find(rent => rent.rent_id === this.form.rent_id);
      if (selectedRent) {
        this.form.room_number = selectedRent.room_number;
        this.form.cust_name = this.getCustomerName(selectedRent.cust_id);
      }
    },
    navigateToTableList() {
    this.showForm = false;
    this.showBill = false;
    this.fetchCheckouts(); // Optionally refetch the checkouts to ensure the list is up-to-date
  },
  handleSuccess(response) {
      this.alertMessage = response.data.message;
      this.alertType = 'success';
      this.showForm = false;
    },
    handleError(error) {
      if (error.response && error.response.data.errors) {
        this.errors = error.response.data.errors;
      } else {
        this.alertMessage = 'An error occurred. Please try again.';
        this.alertType = 'danger';
      }
    },
    getCustomerName(custId) {
      const customer = this.customers.find(customer => customer.id === custId);
      return customer ? `${customer.firstName} ${customer.lastName}` : 'ບໍ່ມີ';
    },
    resetForm() {
      this.form = {
        rent_id: '',
        room_number: '',
        cust_name: '',
        date_checkout: ''
      };
      this.errors = {};
    },
    generateBill(checkout) {
    this.bill = {
      rent_id: checkout.rent_id,
      room_number: checkout.room_number,
      cust_name: checkout.cust_name,
      date_checkout: checkout.date_checkout
    };
    this.showBill = true;
  },
  saveBillAsPDF() {
    const billSection = this.$refs.billSection;

    html2canvas(billSection).then(canvas => {
      const imgData = canvas.toDataURL('image/png');
      const pdf = new jsPDF();
      pdf.addImage(imgData, 'PNG', 10, 10);
      pdf.save('bill.pdf');
    }).catch(error => {
      console.error('Error generating PDF:', error);
    });
  },
  },
  created() {
    this.fetchCheckouts();
    this.fetchRents();
  }
};
</script>

<style scoped>
.bill-container {
  padding: 250px;
  background-color: #fff;
  border-radius: 8px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}
.bill-inner {
  text-align: center;
}
.bill-title {
  font-size: 24px;
  margin-bottom: 10px;
}
.bill-subtitle {
  font-size: 18px;
  margin-bottom: 20px;
}
.bill-details {
  margin-bottom: 20px;
}
.bill-row {
  display: flex;
  justify-content: space-between;
  margin-bottom: 8px;
}
.bill-label {
  font-weight: bold;
}
.total-row {
  border-top: 2px solid #000;
  padding-top: 10px;
  font-size: 18px;
}
.bill-actions {
  text-align: center;
}
.btn {
  padding: 10px 20px;
  border-radius: 5px;
  font-size: 16px;
}
</style>
