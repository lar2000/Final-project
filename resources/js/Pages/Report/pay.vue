<template>
  <div>
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
              <span class="bill-label">ລະຫັດລູກຄ້າ:</span>
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
    <div v-if="!showForm && !showBill" class="nk-block" ref="paymentTable">
        <!-- Add this button to your template where appropriate -->
  
      <div class="card card-bordered card-stretch">
        <div class="card-inner-group">
          <div class="card-inner p-0">
            <table class="nk-tb-list nk-tb-ulist">
              <thead>
                <tr class="nk-tb-item nk-tb-head">
                  <th class="nk-tb-col">ລະຫັດ</th>
                  <th class="nk-tb-col">ລະຫັດເຊົ່າ</th>
                  <th class="nk-tb-col">ລະຫັັດລູກຄ້າ</th>
                  <th class="nk-tb-col">ເບີຫ້ອງ</th>
                  <th class="nk-tb-col">ຄ່າຫ້ອງ</th>
                  <th class="nk-tb-col">ຄ່າໄຟ</th>
                  <th class="nk-tb-col">ຄ່ານໍ້າ</th>
                  <th class="nk-tb-col">ຄ່າຂີ້ເຫຍື້ອ</th>
                  <th class="nk-tb-col">ລວມ</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="payment in payments" :key="payment.pay_id" class="nk-tb-item">
                  <td class="nk-tb-col">{{ payment.pay_id }}</td>
                  <td class="nk-tb-col">{{ payment.rent_id }}</td>
                  <td class="nk-tb-col">{{ payment.cust_id }}</td>
                  <td class="nk-tb-col">{{ payment.room_number }}</td>
                  <td class="nk-tb-col">{{ payment.room_price }} ກີບ</td>
                  <td class="nk-tb-col">{{ payment.ele_price }} ກີບ</td>
                  <td class="nk-tb-col">{{ payment.water_price }} ກີບ</td>
                  <td class="nk-tb-col">{{ payment.gar_price }} ກີບ</td>
                  <td class="nk-tb-col">{{ payment.room_price + payment.ele_price + payment.water_price + payment.gar_price }} ກີບ</td>
                </tr>
              </tbody>
              <tfoot>
                <tr class="nk-tb-item">
                  <td class="nk-tb-col" colspan="4">ຍອດທັງໝົດ:</td>
                  <td class="nk-tb-col" style="color:chartreuse">{{ totalRoomPrice }} ກີບ</td>
                  <td class="nk-tb-col" style="color:chartreuse">{{ totalElePrice }} ກີບ</td>
                  <td class="nk-tb-col" style="color:chartreuse">{{ totalWaterPrice }} ກີບ</td>
                  <td class="nk-tb-col" style="color:chartreuse">{{ totalGarPrice }} ກີບ</td>
                  <td class="nk-tb-col" style="color:chartreuse">{{ totalSum }} ກີບ</td>
                </tr>
              </tfoot>
            </table>
          </div>
        </div>
      </div>
    </div>
    <div class="text-center">
<button type="button" class="btn btn-primary me-2" @click="saveTableAsPDF">Save as PDF</button>
<button class="btn btn-secondary">
                           
                           <router-link to="/Report">
                          <span>ກັບຄືນ</span>
                            </router-link>
                         </button>
</div>

    <!-- Payment Form Section -->
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
      roomTypes: [],
      form: {
        pay_id: null,
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
  computed: {
    totalRoomPrice() {
      return this.payments.reduce((total, payment) => total + parseFloat(payment.room_price || 0), 0);
    },
    totalElePrice() {
      return this.payments.reduce((total, payment) => total + parseFloat(payment.ele_price || 0), 0);
    },
    totalWaterPrice() {
      return this.payments.reduce((total, payment) => total + parseFloat(payment.water_price || 0), 0);
    },
    totalGarPrice() {
      return this.payments.reduce((total, payment) => total + parseFloat(payment.gar_price || 0), 0);
    },
    totalSum() {
      return this.totalRoomPrice + this.totalElePrice + this.totalWaterPrice + this.totalGarPrice;
    }
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
          pay_id: null,
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
    },
    async saveTableAsPDF() {
    try {
      // Reference to the table element
      const tableElement = this.$refs.paymentTable;

      // Generate PDF from the HTML content
      const pdf = html2pdf()
        .from(tableElement)
        .set({
          filename: 'payments.pdf',
          html2canvas: { scale: 2 }, // Adjust scale for better resolution
          jsPDF: { orientation: 'portrait' } // Orientation of the PDF
        });

      // Save the generated PDF
      pdf.save();
    } catch (error) {
      console.error('Error saving table as PDF:', error);
    }
  },
    populateFormFields() {
      const rent = this.rents.find(rent => rent.rent_id.toString() === this.form.rent_id);
      if (rent) {
        this.form.room_number = rent.room_number || '';
        this.form.date_start = rent.book_date || '';
        this.form.cust_id = rent.cust_id || '';
        this.form.roomtype_id = rent.roomtype_id || '';

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
        alert('Add payment successfully');
        this.fetchPayments();
      } catch (error) {
        console.error('Error adding payment:', error);
        this.errors = error.response.data.errors || {};
      }
    },
    async updatePayment() {
      try {
        await axios.put(`/api/payments/${this.form.pay_id}`, this.form);
        this.toggleForm();
        alert('Update successful');
        this.fetchPayments();
      } catch (error) {
        console.error('Error updating payment:', error);
        this.errors = error.response.data.errors || {};
      }
    },
    async deletePayment(id) {
      if (confirm('Are you sure you want to delete this payment?')) {
        try {
          await axios.delete(`/api/payments/${id}`);
          this.fetchPayments();
          alert('Delete successful');
        } catch (error) {
          console.error('Error deleting payment:', error);
        }
      }
    },
    getCustomerName(cust_id) {
      const customer = this.customers.find(customer => customer.id === cust_id);
      return customer ? `${customer.firstName} ${customer.lastName}` : 'ບໍ່ມີ';
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
    async saveBillAsPDF() {
      try {
        // Reference to the bill section element
        const billElement = this.$refs.billSection;

        // Generate PDF from the HTML content
        const pdf = html2pdf()
          .from(billElement)
          .set({
            filename: 'bill.pdf',
            html2canvas: { scale: 2 }, // Adjust scale for better resolution
            jsPDF: { orientation: 'portrait' } // Orientation of the PDF
          });

        // Save the generated PDF
        pdf.save();
      } catch (error) {
        console.error('Error saving bill as PDF:', error);
      }
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
