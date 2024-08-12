<template>
  <div>
    <div class="nk-content">
      <div class="container-fluid">
        <div class="nk-content-inner">
          <div class="nk-content-body">
            <!-- Booking List Section -->
            <div class="nk-block-head nk-block-head-sm" v-if="!showForm">
              <div class="nk-block-between">
                <div class="nk-block-head-content">
                  <h6 class="nk-block-title page-title text-center">ລາຍການຂໍ້ມູນການຈອງ</h6>
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
                           
                            <router-link to="/Home">
                           <span>ກັບຄືນ</span>
                             </router-link>
                          </div>
                        </li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- Booking Table Section -->
            <div v-if="!showForm" class="nk-block">
              <div class="card card-bordered card-stretch">
                <div class="card-inner-group">
                  <div class="card-inner p-0">
                    <table class="nk-tb-list nk-tb-ulist">
                      <thead>
                        <tr class="nk-tb-item nk-tb-head">
                          <th class="nk-tb-col">ລະຫັດການຈອງ</th>
                          <th class="nk-tb-col">ວັນທີຈອງ</th>
                          <th class="nk-tb-col">ວັນທີສິ້ນສຸດ</th>
                          <th class="nk-tb-col">ເບີຫ້ອງ</th>
                          <th class="nk-tb-col">ຊື່ລູກຄ້າ</th>
                          <th class="nk-tb-col">ຄ່າມັດຈຳ</th>
                          
                        </tr>
                      </thead>
                      <tbody>
                        <tr v-for="booking in bookings" :key="booking.book_id" class="nk-tb-item">
                          <td class="nk-tb-col">{{ booking.book_id }}</td>
                          <td class="nk-tb-col">{{ booking.book_date }}</td>
                          <td class="nk-tb-col">{{ booking.book_enddate }}</td>
                          <td class="nk-tb-col">{{ booking.room_number }}</td>
                          <td class="nk-tb-col">{{ getCustomerName(booking.cust_id) }}</td>
                          <td class="nk-tb-col">{{ booking.book_pay }} ກີບ</td>
                          
                            
                        </tr>
                        <tr v-if="bookings.length === 0">
                          <td colspan="7" class="text-center">No bookings found</td>
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
            <!-- Booking Form Section -->
            <div v-if="showForm">
              <h5 class="text-center">{{ formMode === 'add' ? 'ເພີ່ມການຈອງໃໝ່' : 'ແກ້ໄຂການຈອງ' }}</h5>
              <!-- Alert Messages -->
              <div v-if="alertMessage" :class="`alert alert-${alertType}`" role="alert">
                {{ alertMessage }}
              </div>
              <form @submit.prevent="formMode === 'add' ? addBooking() : updateBooking()">
                <div class="mb-3 col-md-3">
                  <label for="roomNumber" class="form-label">ເບີຫ້ອງ</label>
                  <select class="form-control" v-model="form.room_number" required>
                    <option v-for="room in vacantRooms" :key="room.id" :value="room.room_number">
                      {{ room.room_number }}
                    </option>
                  </select>
                  <div v-if="errors.room_number" class="text-danger">{{ errors.room_number[0] }}</div>
                </div>
                <div class="row">
                  <div class="mb-3 col-md-6">
                    <label for="bookDate" class="form-label">ວັນທີຈອງ</label>
                    <input type="date" class="form-control" v-model="form.book_date" required>
                    <div v-if="errors.book_date" class="text-danger">{{ errors.book_date[0] }}</div>
                  </div>
                  <div class="mb-3 col-md-6">
                    <label for="bookEndDate" class="form-label">ວັນທີສິ້ນສຸດ</label>
                    <input type="date" class="form-control" v-model="form.book_enddate" required>
                    <div v-if="errors.book_enddate" class="text-danger">{{ errors.book_enddate[0] }}</div>
                  </div>
                  <div class="mb-3 col-md-6">
                    <label for="custId" class="form-label">ຊື່ລູກຄ້າ</label>
                    <select class="form-control" v-model="form.cust_id" required>
                      <option v-for="customer in customers" :key="customer.id" :value="customer.id.toString()">
                        {{ customer.firstName }} {{ customer.lastName }}
                      </option>
                    </select>
                    <div v-if="errors.cust_id" class="text-danger">{{ errors.cust_id[0] }}</div>
                  </div>
                  <div class="mb-3 col-md-6">
                    <label for="bookPay" class="form-label">ຄ່າມັດຈຳ</label>
                    <input type="number" class="form-control" v-model="form.book_pay" required>
                    <div v-if="errors.book_pay" class="text-danger">{{ errors.book_pay[0] }}</div>
                  </div>
                  <div class="mb-2">
                    <button type="submit" class="btn btn-success me-2">{{ formMode === 'add' ? 'ບັນທຶກ' : 'ແກ້ໄຂ' }}</button>
                    <button type="button" class="btn btn-danger" @click="toggleForm()">ຍົກເລີກ</button>
                  </div>
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
import axios from 'axios';

export default {
data() {
  return {
    bookings: [],
    rooms: [],
    customers: [],
    showForm: false,
    formMode: 'add',
    oldRoomNumber: null,
    form: {
      book_id: null,
      book_date: '',
      book_enddate: '',
      room_number: '',
      cust_id: '',
      book_pay: '',
    },
    search: '',
    errors: {},
    alertMessage: '',
    alertType: '',
  };
},
mounted() {
  this.fetchBookings();
  this.fetchRooms();
  this.fetchCustomers();
},
computed: {
  vacantRooms() {
    return this.rooms.filter(room => room.status === 'ຫວ່າງ');
  },
},
methods: {
  fetchBookings() {
    axios.get('/api/bookings', { params: { search: this.search } })
      .then(response => {
        this.bookings = response.data;
      })
      .catch(error => {
        console.error(error);
      });
  },
  fetchRooms() {
    axios.get('/api/rooms')
      .then(response => {
        this.rooms = response.data;
      })
      .catch(error => {
        console.error(error);
      });
  },
  fetchCustomers() {
    axios.get('/api/customers')
      .then(response => {
        this.customers = response.data;
      })
      .catch(error => {
        console.error(error);
      });
  },
  getCustomerName(cust_id) {
    const customer = this.customers.find(c => c.id === cust_id);
    return customer ? `${customer.firstName} ${customer.lastName}` : 'ບໍ່ມີ';
  },

  toggleForm(mode = 'add', booking = null) {
this.showForm = !this.showForm;
if (mode === 'edit' && booking) {
  this.formMode = 'edit';
  this.form = { ...booking };
  // Store the old room_number value
  this.oldRoomNumber = booking.room_number;
  axios.put(`/api/rooms/status/${booking.room_number}`, { status: 'ຫວ່າງ' })
    .then(response => {
      this.fetchRooms(); // Update rooms list
    })
    .catch(error => {
      console.error('Error updating room status:', error);
    });
} else {
  this.formMode = 'add';
  this.form = {
    book_id: null,
    book_date: '',
    book_enddate: '',
    room_number: '',
    cust_id: '',
    book_pay: '',
  };
  // Reset the oldRoomNumber value
  this.oldRoomNumber = null;
}

// If mode is 'edit' and no booking is provided, clear the form
if (mode === 'edit' && !booking) {
  this.form = {
    book_id: null,
    book_date: '',
    book_enddate: '',
    room_number: '',
    cust_id: '',
    book_pay: '',
  };
  // Reset the oldRoomNumber value
  this.oldRoomNumber = null;
}
},
  addBooking() {
    const formData = { ...this.form, cust_id: this.form.cust_id.toString() };
    axios.post('/api/bookings', formData)
      .then(response => {
        this.updateRoomStatus(formData.room_number, 'ຈອງແລ້ວ');
        this.fetchBookings();
        alert('added')
        this.toggleForm();
      })
      .catch(error => {
        if (error.response && error.response.data.errors) {
          this.errors = error.response.data.errors;
          alert('Error adding booking. Please check the form.');
  
        }
      });
  },
  updateRoomStatus(roomNumber, status) {
    axios.put(`/api/rooms/status/${roomNumber}`, { status })
      .then(response => {
        this.fetchRooms();
      })
      .catch(error => {
        console.error('Error updating room status:', error);
      });
  },
  updateBooking() {
    const formData = { ...this.form, cust_id: this.form.cust_id.toString() };
    axios.put(`/api/bookings/${formData.book_id}`, formData)
      .then(response => {
          axios.put(`/api/rooms/status/${formData.room_number}`, { status: 'ຈອງແລ້ວ' })
      .then(() => {
        this.fetchBookings();
        this.fetchRooms(); // Update rooms list
        alert('updated')
        this.toggleForm();
      })
      .catch(error => {
        console.error('Error updating room status:', error);
      });
  })
  .catch(error => {
    if (error.response && error.response.data.errors) {
      this.errors = error.response.data.errors;
      alert('Error updating booking. Please check the form.');
      
    }
  });
  },
  deleteBooking(book_id) {
if (confirm('Are you sure you want to delete this booking?')) {
  axios.delete(`/api/bookings/${book_id}`)
    .then(response => {
      // Update room status to "ຫວ່າງ"
      const roomNumber = this.bookings.find(booking => booking.book_id === book_id).room_number;
      axios.put(`/api/rooms/status/${roomNumber}`, { status: 'ຫວ່າງ' })
        .then(() => {
          this.fetchBookings();
          this.fetchRooms(); // Update rooms list
          alert('Booking deleted successfully!');
        })
        .catch(error => {
          console.error('Error updating room status:', error);
        });
    })
    .catch(error => {
      console.error(error);
      alert('Error deleting booking.');
    });
}
}
}
};
</script>

<style scoped>
/* Existing styles */
form {
max-width: 600px;
margin: 0 auto;
padding: 20px;
background: #f8f9fa;
border-radius: 5px;
}
</style>
