<template>
  <div>
    <div class="nk-content">
      <div class="container-fluid">
        <div class="nk-content-inner">
          <div class="nk-content-body">
            <!-- Payment List Section -->
            <div class="nk-block-head nk-block-head-sm" v-if="!showForm">
              <div class="nk-block-between">
                <div class="nk-block-head-content">
                  <h6 class="nk-block-title page-title">ລາຍການການຊຳລະ</h6>
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
                            <input type="text" class="form-control me-2" v-model="search" @keyup.enter="fetchPayments" placeholder="Search...">
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
    <!-- Bill Display Section -->
            <div v-if="showBill" class="nk-block bill-container" ref="billSection">
              <div class="card card-bordered card-stretch">
                <div class="card-inner bill-inner">
                  <div class="bill-details">
                    <h4 class="bill-title text-center">ໃບບິນ</h4>
                   <h6 class="bill-subtitle text-center">ຫ້ອງແຖວຈີເມັ່ງທໍ່</h6>
                   <hr>
                    <div class="bill-row">
                      <span class="bill-label">ລະຫັດເຊົ່າ:</span>
                      <span class="bill-value">{{ bill.rent_id }}</span>
                    </div>
                    <div class="bill-row">
                      <span class="bill-label">ປີ-ເດືອນ:</span>
                      <span class="bill-value">{{ bill.month_year }}</span>
                    </div>
                    <div class="bill-row">
                      <span class="bill-label">ເບີຫ້ອງ:</span>
                      <span class="bill-value">{{ bill.room_number }}</span>
                    </div>
                    <div class="bill-row">
                      <span class="bill-label">ຊື່ລູກຄ້າ:</span>
                      <span class="bill-value">{{ getCustomerName(bill.cust_id) }}</span>
                    </div>
                    <div class="bill-row">
                      <span class="bill-label">ຄ່າຫ້ອງ:</span>
                      <span class="bill-value">{{ bill.room_price }} ກີບ</span>
                    </div>
                    <div class="bill-row">
                      <span class="bill-label">ຄ່າໄຟ:</span>
                      <span class="bill-value">{{ bill.ele_price }} ກີບ</span>
                    </div>
                    <div class="bill-row">
                      <span class="bill-label">ຄ່ານໍ້າ:</span>
                      <span class="bill-value">{{ bill.water_price }} ກີບ</span>
                    </div>
                    <div class="bill-row">
                      <span class="bill-label">ຄ່າຂີ້ເຫຍື້ອ:</span>
                      <span class="bill-value">{{ bill.gar_price }} ກີບ</span>
                    </div>
                    <div class="bill-row total-row">
                      <span class="bill-label">ລວມ:</span>
                      <span class="bill-value">{{ calculateTotalBill(bill) }} ກີບ</span>
                    </div>
                  </div>
                  <div class="bill-actions">
                    <button type="button" class="btn btn-success me-2" @click="saveBillAsPDF">Save</button>
                    <button type="button" class="btn btn-danger" @click="showBill=false">Close</button>
                  </div>
                </div>
              </div>
            </div>

            <!-- Payment Table Section -->
            <div v-if="!showForm && !showBill" class="nk-block">
              <div class="card card-bordered card-stretch">
                <div class="card-inner-group">
                  <div class="card-inner p-0">
                    <table class="nk-tb-list nk-tb-ulist">
                      <thead>
                        <tr class="nk-tb-item nk-tb-head">
                          <th class="nk-tb-col">ລະຫັດເຊົ່າ</th>
                          <th class="nk-tb-col">ປີ-ເດືອນ</th>
                          <th class="nk-tb-col">ເບີຫ້ອງ</th>
                          <th class="nk-tb-col">ລະຫັດລູກຄ້າ</th>
                          <th class="nk-tb-col">ຄ່າຫ້ອງ</th>
                          <th class="nk-tb-col">ຄ່າໄຟ</th>
                          <th class="nk-tb-col">ຄ່ານໍ້າ</th>
                          <th class="nk-tb-col">ຄ່າຂີ້ເຫຍື້ອ</th>
                          <th class="nk-tb-col">ຈັດການ</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr v-for="payment in payments" :key="payment.id" class="nk-tb-item">
                          <td class="nk-tb-col">{{ payment.rent_id }}</td>
                          <td class="nk-tb-col">{{ payment.month_year }}</td>
                          <td class="nk-tb-col">{{ payment.room_number }}</td>
                  
                          <td class="nk-tb-col">{{ payment.cust_id}}</td>
                          <td class="nk-tb-col">{{ getRoomTypeName(payment.roomtype_id) }} ກີບ</td>
                          <td class="nk-tb-col">{{ payment.ele_price }} ກີບ</td>
                          <td class="nk-tb-col">{{ payment.water_price }} ກີບ</td>
                          <td class="nk-tb-col">{{ payment.gar_price }} ກີບ</td>
                          <td class="nk-tb-col">
                            <div class="dropdown">
                              <a href="#" class="dropdown-toggle btn btn-icon btn-trigger" data-bs-toggle="dropdown">
                                <i class="bx bx-dots-horizontal"></i>
                              </a>
                              <div class="dropdown-menu dropdown-menu-end">
                                <ul class="link-list-opt no-bdr">
                                  <!-- In your payment list section -->
                                 <li>
                                    <a href="#" @click="showBill = true; bill = generateBill(payment)">
                                      <i class="menu-icon bx bx-news"></i>
                                         <span>ໃບບິນ</span>
                                    </a>
                                  </li>
 
                                  <li>
                                    <a href="#" @click="toggleForm('edit', payment)">
                                      <i class="menu-icon bx bxs-edit-alt"></i>
                                      <span>ແກ້ໄຂ</span>
                                    </a>
                                  </li>
                                  <li>
                                    <a href="#" @click="deletePayment(payment.id)">
                                      <i class="menu-icon bx bxs-trash"></i>
                                      <span>ລົບ</span>
                                    </a>
                                  </li>
                                </ul>
                              </div>
                            </div>
                          </td>
                        </tr>
                        <tr v-if="payments.length === 0">
                          <td colspan="9" class="text-center">ບໍ່ມີຂໍ້ມູນການຊຳລະ</td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
            <!-- Payment Form Section -->
            <div v-if="showForm" class="nk-block">
              <div class="card card-bordered card-stretch">
                <div class="card-inner">
                  <h4 class="card-title text-center">{{ formMode === 'add' ? 'ເພີ່ມການຊຳລະ' : 'ແກ້ໄຂການຊຳລະ' }}</h4>
                  <form @submit.prevent="formMode === 'add' ? addPayment() : updatePayment()">
                    
                    <div class="mb-3 col-md-2">
                      <label for="rentId" class="form-label">ເບີຫ້ອງ</label>
                      <select class="form-control" v-model="form.rent_id" @change="populateFormFields" required>
                        <option v-for="rent in rents" :key="rent.rent_id" :value="rent.rent_id.toString()">
                          {{ rent.room_number }}
                        </option>
                      </select>
                      <div v-if="errors.rent_id" class="text-danger">{{ errors.rent_id[0] }}</div>
                    </div>

                    <div class="row">
                      <div class="mb-3 col-md-6">
                        <label for="custId" class="form-label">ຊື່ລູກຄ້າ</label>
                        <select class="form-control" v-model="form.cust_id" required>
                          <option v-for="customer in customers" :key="customer.id" :value="customer.id">
                            {{ customer.firstName }} {{ customer.lastName }}
                          </option>
                        </select>
                       
                        <div v-if="errors.cust_id" class="text-danger">{{ errors.cust_id[0] }}</div>
                      </div>
                      <div class="mb-3 col-md-6">
                        <label for="monthYear" class="form-label">ວັນເດືອນປີ</label>
                        <input type="date" class="form-control" v-model="form.month_year" required>
                        <div v-if="errors.month_year" class="text-danger">{{ errors.month_year[0] }}</div>
                      </div>
                      <div class="mb-3 col-md-6">
                        <label for="roomtypeId" class="form-label">ຄ່າຫ້ອງ</label>
                        <select id="roomtypeId" class="form-select" v-model="form.roomtype_id" @change="updateRoomPrice" required>
                          <option v-for="roomType in roomTypes" :key="roomType.roomtype_id" :value="roomType.roomtype_id">
                            {{ roomType.room_price }}
                          </option>
                        </select>
                        <div v-if="errors.roomtype_id" class="text-danger">{{ errors.roomtype_id[0] }}</div>
                      </div>
                      <div class="mb-3 col-md-6">
                        <label for="elePrice" class="form-label">ຄ່າໄຟ</label>
                        <input type="number" class="form-control" v-model="form.ele_price" required>
                        <div v-if="errors.ele_price" class="text-danger">{{ errors.ele_price[0] }}</div>
                      </div>
                      <div class="mb-3 col-md-6">
                        <label for="waterPrice" class="form-label">ຄ່ານໍ້າ</label>
                        <input type="number" class="form-control" v-model="form.water_price" required>
                        <div v-if="errors.water_price" class="text-danger">{{ errors.water_price[0] }}</div>
                      </div>
                      <div class="mb-3 col-md-6">
                        <label for="garPrice" class="form-label">ຄ່າຂີ້ເຫຍື້ອ</label>
                        <input type="number" class="form-control" v-model="form.gar_price" required>
                        <div v-if="errors.gar_price" class="text-danger">{{ errors.gar_price[0] }}</div>
                      </div>
                    </div>
                    <div class="mb-2">
                      <button type="submit" class="btn btn-success me-2">{{ formMode === 'add' ? 'ເພີ່ມ' : 'ບັນທຶກ' }}</button>
                      <button type="button" class="btn btn-danger" @click="toggleForm()">ຍົກເລີກ</button>
                    </div>
                  </form>
                </div>
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
import html2pdf from 'html2pdf.js';
export default {
  data() {
    return {
      payments: [],
      rents: [],
      customers: [],
      roomTypes: [], // Room types data
      form: {
        rent_id: '',
        cust_id: '',
        roomtype_id: '',
        month_year: '',
        room_number: '',
        room_price: '',
        ele_price: '',
        water_price: '',
        gar_price: '',
        date_start: '',
        date_end: ''
      },
      showBill: false,
      errors: {},
      showForm: false,
      formMode: 'add',
      search: ''
    };
  },
  methods: {
    async fetchPayments() {
      try {
        const response = await axios.get('/api/payments', {
          params: {
            search: this.search
          }
        });
        this.payments = response.data;
      } catch (error) {
        console.error('Error fetching payments:', error);
      }
    },
    async fetchRents() {
      try {
        const response = await axios.get('/api/rents');
        this.rents = response.data;
      } catch (error) {
        console.error('Error fetching rents:', error);
      }
    },
    async fetchCustomers() {
      try {
        const response = await axios.get('/api/customers');
        this.customers = response.data;
      } catch (error) {
        console.error('Error fetching customers:', error);
      }
    },
    async fetchRoomtypes() {
      try {
        const response = await axios.get('/api/roomtypes');
        this.roomTypes = response.data;
      } catch (error) {
        console.error('Error fetching room types:', error);
      }
    },
    toggleForm(mode, payment = null) {
  this.showForm = !this.showForm;
  this.formMode = mode;

  if (mode === 'edit' && payment) {
    this.form = { ...payment };
    this.populateFormFields();
  } else {
    this.form = {
      rent_id: '',
      cust_id: '',
      roomtype_id: '',
      month_year: '',
      room_number: '',
      room_price: '',
      ele_price: '',
      water_price: '',
      gar_price: '',
      date_start: '',
      date_end: ''
    };
  }
}
,
    populateFormFields() {
      const rent = this.rents.find(rent => rent.rent_id.toString() === this.form.rent_id);
      if (rent) {
        this.form.room_number = rent.room_number || '';
        this.form.date_start = rent.book_date || '';
        this.form.cust_id = rent.cust_id || '';
        this.form.roomtype_id = rent.roomtype_id || ''; // Assuming rent has roomtype_id

        this.updateRoomPrice();

        if (this.form.date_start) {
          const startDate = new Date(this.form.date_start);
          const endDate = new Date(startDate);
          endDate.setDate(startDate.getDate() + 30);
          this.form.date_end = endDate.toISOString().split('T')[0];
        } else {
          this.form.date_end = '';
        }
      } else {
        this.form.room_number = '';
        this.form.date_start = '';
        this.form.date_end = '';
        this.form.cust_id = '';
        this.form.roomtype_id = '';
        this.form.room_price = '';
      }
    },
    updateRoomPrice() {
      const roomType = this.roomTypes.find(roomType => roomType.roomtype_id === this.form.roomtype_id);
      this.form.room_price = roomType ? roomType.room_price : '';
    },
    async addPayment() {
      try {
        await axios.post('/api/payments', this.form);
        this.toggleForm();
        alert('add payment successfilly')
        this.fetchPayments();
      } catch (error) {
        console.error('Error adding payment:', error);
        this.errors = error.response.data.errors || {};
      }
    },
    async updatePayment() {
  try {
    await axios.put(`/api/payments/${this.form.id}`, this.form);
    this.toggleForm();
    alert('Update successful');
    this.fetchPayments();
  } catch (error) {
    console.error('Error updating payment:', error);
    this.errors = error.response.data.errors || {};
  }
}
,
    async deletePayment(id) {
  if (confirm('Are you sure you want to delete this payment?')) {
    try {
      await axios.delete(`/api/payments/${id}`); // Changed from pay_id to id
      this.fetchPayments();
      alert('success');
    } catch (error) {
      alert('error')
      console.error('Error deleting payment:', error);
    }
  }
}
,
    getCustomerName(cust_id) {
      const customer = this.customers.find(customer => customer.id === cust_id);
      return customer ? `${customer.firstName} ${customer.lastName} `: 'ບໍ່ມີ';
    },
    getRoomTypeName(roomtype_id) {
      const roomType = this.roomTypes.find(roomType => roomType.roomtype_id === roomtype_id);
      return roomType ? roomType.room_price : 'Unknown';
    },
    generateBill(payment) {
      return {
        rent_id: payment.rent_id,
        month_year: payment.month_year,
        room_number: payment.room_number,
        cust_id: payment.cust_id,
        room_price: payment.room_price,
        ele_price: payment.ele_price,
        water_price: payment.water_price,
        gar_price: payment.gar_price
      };
    },
    calculateTotalBill(bill) {
      return parseInt(bill.room_price) + parseInt(bill.ele_price) + parseInt(bill.water_price) + parseInt(bill.gar_price);
    },
    saveBillAsPDF() {
      const billElement = this.$refs.billSection;
      html2pdf()
        .from(billElement)
        .set({
          filename: 'bill.pdf',
          html2canvas: { scale: 2 },
          jsPDF: { orientation: 'portrait' }
        })
        .save();
    }
  },
  mounted() {
    this.fetchPayments();
    this.fetchRents();
    this.fetchCustomers();
    this.fetchRoomtypes(); // Make sure to call this method
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