<template>
  <div>
    <div class="nk-content">
      <div class="container-fluid">
        <div class="nk-content-inner">
          <div class="nk-content-body">
            <!-- Rent List Section -->
            <div class="nk-block-head nk-block-head-sm" v-if="!showForm">
              <div class="nk-block-between">
                <div class="nk-block-head-content">
                  <h6 class="nk-block-title page-title">ລາຍການຂໍ້ມູນແຈ້ງເຂົ້າ (ເຊົ່າ)</h6>
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
                            <input type="text" class="form-control me-2" v-model="search" @keyup.enter="fetchRents" placeholder="Search...">
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
            <!-- Rent Table Section -->
            <div v-if="!showForm && !showBill" class="nk-block">
              <div class="card card-bordered card-stretch">
                <div class="card-inner-group">
                  <div class="card-inner p-0">
                    <table class="nk-tb-list nk-tb-ulist">
                      <thead>
                        <tr class="nk-tb-item nk-tb-head">
                          <th class="nk-tb-col">ລະຫັດເຊົ່າ</th>
                          <th class="nk-tb-col">ລະຫັດຈອງ</th>
                          <th class="nk-tb-col">ລະຫັດລູກຄ້າ</th>
                          <th class="nk-tb-col">ເບີຫ້ອງ</th>
                          <th class="nk-tb-col">ວັນທີ່ເລີ່ມ</th>
                          <th class="nk-tb-col">ວັນທີສິ້ນສຸດ</th>
                          <th class="nk-tb-col">ຄ່າຫ້ອງ</th>
                          <th class="nk-tb-col">ຈັດການ</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr v-for="rent in rents" :key="rent.rent_id" class="nk-tb-item">
                          <td class="nk-tb-col">{{ rent.rent_id }}</td>
                          <td class="nk-tb-col">{{ rent.book_id }}</td> 
                          <td class="nk-tb-col">{{ rent.cust_id}}</td>
                          <td class="nk-tb-col">{{ rent.room_number }}</td>
                          <td class="nk-tb-col">{{ rent.date_start }}</td>
                          <td class="nk-tb-col">{{ rent.date_end }}</td>
                          <td class="nk-tb-col">{{ rent.room_price }} ກີບ</td>
                          <td class="nk-tb-col">
                            <div class="dropdown">
                              <a href="#" class="dropdown-toggle btn btn-icon btn-trigger" data-bs-toggle="dropdown">
                                <i class="bx bx-dots-horizontal"></i>
                              </a>
                              <div class="dropdown-menu dropdown-menu-end">
                                <ul class="link-list-opt no-bdr">
                                  <li>
                                    <a href="#" @click="toggleForm('edit', rent)">
                                      <i class="menu-icon bx bxs-edit-alt" style="color: chartreuse;"></i>
                                      <span>ແກ້ໄຂ</span>
                                    </a>
                                  </li>
                                  <li>
                                    <a href="#" @click="deleteRent(rents.rent_id)">
                                      <i class="menu-icon bx bxs-trash" style="color: red;"></i>
                                      <span>ລົບ</span>
                                    </a>
                                  </li>
                                  <li>
                                    <a href="#" @click="generateBill(rent)">
                                      <i class="menu-icon bx bxs-receipt"></i>
                                      <span>ສ້າງບິລ</span>
                                    </a>
                                  </li>
                                </ul>
                              </div>
                            </div>
                          </td>
                        </tr>
                        <tr v-if="rents.length === 0">
                          <td colspan="7" class="text-center">No rents found</td>
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
            <!-- Form Section for Adding/Editing Rents -->
            <div v-if="showForm">
              <h5 class="text-center">{{ formMode === 'add' ? 'ເພີ່ມແຈ້ງເຂົ້າ' : 'ແກ້ໄຂການແຈ້ງເຂົ້າ' }}</h5>
              <!-- Alert Messages -->
              <div v-if="alertMessage" :class="`alert alert-${alertType}`" role="alert">
                {{ alertMessage }}
              </div>
              <form @submit.prevent="formMode === 'add' ? addRent() : updateRent()">
                <div class="row">
                  <div class="mb-3 col-md-6">
                    <label for="bookId" class="form-label">ລະຫັດຈອງ</label>
                    <select class="form-control" v-model="form.book_id" @change="populateFormFields" required>
                      <option v-for="booking in bookings" :key="booking.book_id" :value="booking.book_id">
                        {{ booking.book_id }}
                      </option>
                    </select>
                    <div v-if="errors.book_id" class="text-danger">{{ errors.book_id[0] }}</div>
                  </div>
                  <div class="mb-3 col-md-6">
                    <label for="custId" class="form-label">ລະຫັດລູກຄ້າ</label>
                    <input type="number" class="form-control" v-model="form.cust_id">
                    <div v-if="errors.cust_id" class="text-danger">{{ errors.cust_id[0] }}</div>
                  </div>
                  <div class="mb-3 col-md-6">
                    <label for="roomNumber" class="form-label">ເບີຫ້ອງ</label>
                    <input type="text" class="form-control" v-model="form.room_number">
                    <div v-if="errors.room_number" class="text-danger">{{ errors.room_number[0] }}</div>
                  </div>
                  <div class="mb-3 col-md-6">
                    <label for="dateStart" class="form-label">ວັນທີ່ເລີ່ມ</label>
                    <input type="date" class="form-control" v-model="form.date_start" required>
                    <div v-if="errors.date_start" class="text-danger">{{ errors.date_start[0] }}</div>
                  </div>
                  <div class="mb-3 col-md-6">
                    <label for="roomPrice" class="form-label">ຄ່າຫ້ອງ</label>
                    <input type="number" class="form-control" v-model="form.room_price" required>
                    <div v-if="errors.room_price" class="text-danger">{{ errors.room_price[0] }}</div>
                  </div>
                  <div class="mb-3 col-md-6">
                    <label for="dateEnd" class="form-label">ວັນທີສິ້ນສຸດ</label>
                    <input type="date" class="form-control" v-model="form.date_end" required>
                    <div v-if="errors.date_end" class="text-danger">{{ errors.date_end[0] }}</div>
                  </div>
                </div>
                <div class="me-2">
                  <button type="submit" class="btn btn-success me-2">{{ formMode === 'add' ? 'ບັນທຶກ' : 'ບັນທຶກ' }}</button>
                  <button type="button" class="btn btn-danger" @click="toggleForm()">ຍົກເລີກ</button>
                </div>
              </form>
            </div>
            <!-- Bill Section -->
<div v-if="showBill" class="bill-section">
  <h5 class="text-center">ບິນລາຍການ</h5>
  <div class="bill-details">
    <div class="bill-row">
      <span class="bill-label">ລະຫັດເຊົ່າ:</span>
      <span class="bill-value">{{ bill.rent_id }}</span>
    </div>
    <div class="bill-row">
      <span class="bill-label">ລະຫັດຈອງ:</span>
      <span class="bill-value">{{ bill.book_id }}</span>
    </div>
    <div class="bill-row">
      <span class="bill-label">ລະຫັດລູກຄ້າ:</span>
      <span class="bill-value">{{ bill.cust_id }}</span>
    </div>
    <div class="bill-row">
      <span class="bill-label">ເບີຫ້ອງ:</span>
      <span class="bill-value">{{ bill.room_number }}</span>
    </div>
    <div class="bill-row">
      <span class="bill-label">ວັນທີ່ເລີ່ມ:</span>
      <span class="bill-value">{{ bill.date_start }}</span>
    </div>
    <div class="bill-row">
      <span class="bill-label">ວັນທີສິ້ນສຸດ:</span>
      <span class="bill-value">{{ bill.date_end }}</span>
    </div>
    <div class="bill-row">
      <span class="bill-label">ຄ່າຫ້ອງ:</span>
      <span class="bill-value">{{ bill.room_price }} ກີບ</span>
    </div>
    <div class="bill-row">
      <span class="bill-label">ຈຳນວນວັນ:</span>
      <span class="bill-value">{{ calculateDays(bill.date_start, bill.date_end) }} ວັນ</span>
    </div>
    <div class="bill-row total">
      <span class="bill-label">ລວມ:</span>
      <span class="bill-value">{{ calculateTotal(bill.room_price, calculateDays(bill.date_start, bill.date_end)) }} ກີບ</span>
    </div>
  </div>
  <div class="bill-buttons text-center">
    <button class="btn btn-primary" @click="printBill">ບັນທຶກ</button>
    <button class="btn btn-danger" @click="showBill = false">ຍົກເລີກ</button>
  </div>
</div>

          </div>
        </div>
      </div>
    </div>
  </div>
</template>


<script>
import axios from 'axios';

export default {
  data() {
    return {
      rents: [],
      bookings: [],
      roomTypes: [],
      customers: [],
      showForm: false,
      showBill: false,
      formMode: 'add',
      form: {
        book_id: '',
        room_number: '',
        date_start: '',
        date_end: '',
        cust_id: '',
        room_price: ''
      },
      bill: {},
      errors: {},
      alertMessage: '',
      alertType: ''
    }
  },
  mounted() {
    this.loadInitialData();
  },
  methods: {
    async loadInitialData() {
      try {
        await Promise.all([
          this.fetchRents(),
          this.fetchBookings(),
          this.fetchCustomers()
        ]);
      } catch (error) {
        console.error('Error loading initial data:', error);
      }
    },
    async fetchRents() {
      try {
        const response = await axios.get('/api/rents');
        console.log('Fetched rents:', response.data);
        this.rents = response.data;
      } catch (error) {
        this.handleError(error);
      }
    },
    async fetchBookings() {
      try {
        const response = await axios.get('/api/bookings');
        this.bookings = response.data;
      } catch (error) {
        this.handleError(error);
      }
    },
    async fetchCustomers() {
      try {
        const response = await axios.get('/api/customers');
        this.customers = response.data;
      } catch (error) {
        this.handleError(error);
      }
    },
    handleError(error) {
      console.error('API Error:', error);
      this.showAlert('danger', 'An error occurred. Please try again.');
    },
    toggleForm(mode, rent = null) {
      this.showForm = !this.showForm;
      this.formMode = mode;
      this.resetForm(rent);
    },
    resetForm(rent = null) {
      if (this.formMode === 'edit' && rent) {
        this.form = { ...rent };
      } else {
        this.form = {
          rent_id: null,
          book_id: '',
          room_number: '',
          date_start: '',
          date_end: '',
          cust_id: '',
          room_price: ''
        };
      }
    },
    addRent() {
      axios.post('/api/rents', this.form)
        .then(response => {
          this.fetchRents();
          alert('ແຈ້ງເຂົ້າສຳເລັດແລ້ວ');
          this.toggleForm();
        })
        .catch(error => {
          if (error.response && error.response.data.errors) {
            this.errors = error.response.data.errors;
          } else {
            alert('Failed to add. Please try again.');
          }
        });
    },
    updateRent() {
      if (this.form.rent_id) {
        axios.put(`/api/rents/${this.form.rent_id}`, this.form)
          .then(response => {
            this.fetchRents();
            alert('Updated successfully');
            this.toggleForm();
          })
          .catch(error => {
            if (error.response && error.response.data.errors) {
              this.errors = error.response.data.errors;
            } else {
              alert('Failed to update. Please try again.');
            }
          });
      } else {
        console.error('ID is missing for update.');
      }
    },
    async deleteRent(rentId) {
      if (confirm('ຕ້ອງການລົບຂໍ້ມູນແທ້ບໍ່?')) {
        try {
          const response = await axios.delete(`/rents/${rentId}`);
          this.alertMessage = response.data.message;
          alert('ລົບຂໍ້ມູນສຳເລັດແລ້ວ');
          this.fetchRents(); // Refresh the list
        } catch (error) {
          this.alertMessage = error.response.data.message || 'Failed to delete record.';
          alert('ລົບຂໍ້ມູນລົ້ມເຫຼວ!!');
        }
      }
    },
    generateBill(rent) {
      this.bill = { ...rent };
      this.showBill = true;
    },
    calculateDays(startDate, endDate) {
      const start = new Date(startDate);
      const end = new Date(endDate);
      const timeDiff = end - start;
      return Math.ceil(timeDiff / (1000 * 3600 * 24));
    },
    calculateTotal(roomPrice, days) {
      return roomPrice * days;
    },
    printBill() {
      // Implement print functionality here
      window.print(); // Simple print for demo purposes
    },
    getRoomTypeName(roomtype_id) {
      const roomType = this.roomTypes.find(roomType => roomType.roomtype_id === roomtype_id);
      return roomType ? roomType.room_price : 'Unknown';
    },
    populateFormFields() {
      const booking = this.bookings.find(booking => booking.book_id === this.form.book_id);
      if (booking) {
        this.form.room_number = booking.room_number;
        this.form.date_start = booking.book_date;
        this.form.cust_id = booking.cust_id;

        this.calculateEndDate();
      } else {
        this.resetForm();
      }
    },
    calculateEndDate() {
      if (this.form.date_start) {
        const startDate = new Date(this.form.date_start);
        const endDate = new Date(startDate);
        endDate.setDate(startDate.getDate() + 30);
        this.form.date_end = endDate.toISOString().split('T')[0];
      } else {
        this.form.date_end = '';
      }
    },
    showAlert(type, message) {
      this.alertMessage = message;
      this.alertType = type;
    }
  }
};
</script>


<style scoped>
.nk-tb-list .nk-tb-col {
  padding: 10px;
}
.nk-tb-list .nk-tb-item {
  background-color: #fff;
}
.bill-section {
  background-color: #f8f9fa;
  border-radius: 8px;
  padding: 250px;
  box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
  margin: 20px 0;
}

.bill-details {
  margin: 20px 0;
}

.bill-row {
  display: flex;
  justify-content: space-between;
  margin-bottom: 10px;
  padding: 10px;
  border-bottom: 1px solid #dee2e6;
}

.bill-row:last-child {
  border-bottom: none;
}

.bill-label {
  font-weight: 600;
  color: #333;
}

.bill-value {
  text-align: right;
  color: #555;
}

.total {
  font-weight: bold;
  color: #007bff; /* Bootstrap primary color */
}

.bill-buttons {
  margin-top: 20px;
}

.bill-buttons .btn {
  margin: 0 5px;
}
</style>
