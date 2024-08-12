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
                           
                            <router-link to="/Report">
                           <span>ກັບຄືນ</span>
                             </router-link>
                          </div>
                        </li>
                      </ul>
                    </div>
                    <li class="nk-block-tools-opt">
              <button class="btn btn-primary" @click="saveToPDF">Save as PDF</button>
            </li>
                    </div>
                  </div>
              </div>
            </div>
            <!-- Rent Table Section -->
            <div v-if="!showForm" class="nk-block">
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
                          
                        </tr>
                        <tr v-if="rents.length === 0">
                          <td colspan="7" class="text-center">No rents found</td>
                        </tr>
                        <tr v-if="rents.length > 0">
    <td colspan="6" class="text-end">ລວມຍອດທັງໝົດ:</td>
    <td class="nk-tb-col" style="color: chartreuse;">{{ totalRoomPrice.toFixed(2) }} ກີບ</td>
    <td></td>
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
            


          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from 'axios';
import jsPDF from 'jspdf';
import html2canvas from 'html2canvas';
export default {
  data() {
    return {
      rents: [],
      bookings: [],
      roomTypes: [], 
      customers: [],
      showForm: false,
      formMode: 'add',
      form: {
        rent_id: null, // Ensure rent_id is included in the form for edits
        book_id: '',
        room_number: '',
        date_start: '',
        date_end: '',
        cust_id: '',
        room_price: ''
      },
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
    console.log('Fetched rents:', response.data); // Check data structure
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
          rent_id: null, // Reset rent_id to null for add mode
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
          alert('Added');
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
        this.showAlert('success', 'Updated successfully');
        this.toggleForm();
      })
      .catch(error => {
        if (error.response && error.response.data.errors) {
          this.errors = error.response.data.errors;
        } else {
          this.showAlert('danger', 'Failed to update. Please try again.');
        }
      });
  } else {
    console.error('ID is missing for update.');
  }
},
  deleteRent(id) {
      if (confirm('Are you sure you want to delete this rent?')) {
        axios.delete(`/api/rents/${id}`)
        .then(() => {
          this.fetchRents();
          alert('Room deleted successfully!');
        })
        .catch(error => {
        console.error('Error deleting:', error);
        alert('Failed to delete. Please try again.');
      })
     }
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
    },
    async saveToPDF() {
      // Target the HTML element you want to convert to PDF
      const element = document.querySelector('.nk-content'); // Adjust the selector as needed

      // Use html2canvas to capture the HTML element as an image
      const canvas = await html2canvas(element);
      const imgData = canvas.toDataURL('image/png');

      // Create a new jsPDF instance
      const pdf = new jsPDF('p', 'mm', 'a4');
      const imgWidth = 210; // A4 width in mm
      const imgHeight = (canvas.height * imgWidth) / canvas.width;
      const pdfHeight = Math.max(imgHeight, 297); // A4 height in mm

      // Add image to the PDF
      pdf.addImage(imgData, 'PNG', 0, 0, imgWidth, imgHeight);
      pdf.save('document.pdf'); // Save the PDF
    }
  },
  computed: {
    totalRoomPrice() {
      return this.rents.reduce((total, rent) => total + parseFloat(rent.room_price || 0), 0);
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
</style>
