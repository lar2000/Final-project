<template>
  <div>
    <div class="nk-content">
      <div class="container-fluid">
        <div class="nk-content-inner">
          <div class="nk-content-body">
            <div class="nk-block-head nk-block-head-sm" v-if="!showForm">
              <div class="nk-block-between">
                <div class="nk-block-head-content">
                  <h5 class="nk-block-title page-title">ລາຍການຫ້ອງ</h5>
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
                            <input type="text" class="form-control me-2" v-model="search" @keyup.enter="fetchRooms" placeholder="Search...">
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
            <div v-if="!showForm" class="nk-block">
              <div class="card card-bordered card-stretch">
                <div class="card-inner-group">
                  <div class="card-inner p-0">
                    <table class="nk-tb-list nk-tb-ulist">
                      <thead>
                        <tr class="nk-tb-item nk-tb-head">
                          <th class="nk-tb-col">ເບີຫ້ອງ</th>
                          <th class="nk-tb-col">ປະເພດຫ້ອງ</th>
                          <th class="nk-tb-col">Status</th>
                          <th class="nk-tb-col">ຈັດການ</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr v-for="room in rooms" :key="room.id" class="nk-tb-item">
                          <td class="nk-tb-col">{{ room.room_number }}</td>
                          <td class="nk-tb-col">{{ getRoomTypeName(room.roomtype_id) }}</td>
                          <td class="nk-tb-col">
                            <span :class="getStatusClass(room.status)">
                              {{ room.status }}
                            </span>
                          </td>
                          <td class="nk-tb-col">
                            <div class="dropdown">
                              <a href="#" class="dropdown-toggle btn btn-icon btn-trigger" data-bs-toggle="dropdown">
                                <i class="bx bx-dots-horizontal"></i>
                              </a>
                              <div class="dropdown-menu dropdown-menu-end">
                                <ul class="link-list-opt no-bdr">
                                  <li>
                                    <a href="#" @click="toggleForm('edit', room)">
                                      <i class="menu-icon bx bxs-edit-alt"></i>
                                      <span>ແກ້ໄຂ</span>
                                    </a>
                                  </li>
                                  <li>
                                    <a href="#" @click="deleteRoom(room.id)">
                                      <i class="menu-icon bx bxs-trash"></i>
                                      <span>ລົບ</span>
                                    </a>
                                  </li>
                                </ul>
                              </div>
                            </div>
                          </td>
                        </tr>
                        <tr v-if="rooms.length === 0">
                          <td colspan="4" class="text-center">No rooms found</td>
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
              <h5 class="text-center">{{ formMode === 'add' ? 'ເພີ່ມຂໍ້ມູນຫ້ອງ' : 'ແກ້ໄຂ ຂໍ້ມູນຫ້ອງ' }}</h5>
              <form @submit.prevent="formMode === 'add' ? addRoom() : updateRoom()">
                <div class="mb-3">
                  <label for="roomNumber" class="form-label">ເບີຫ້ອງ</label>
                  <input type="text" class="form-control" v-model="form.room_number" required>
                  <div v-if="errors.room_number" class="text-danger">{{ errors.room_number[0] }}</div>
                </div>
                <div class="mb-3">
                  <label for="roomtypeId" class="form-label">ປະເພດຫ້ອງ</label>
                  <select id="roomtypeId" class="form-select" v-model="form.roomtype_id" required>
                    <option v-for="roomType in roomTypes" :key="roomType.id" :value="roomType.roomtype_id">
                      {{ roomType.roomtype_name }}
                    </option>
                  </select>
                  <div v-if="errors.roomtype_id" class="text-danger">{{ errors.roomtype_id[0] }}</div>
                </div>
                <div class="mb-3">
                  <label for="status" class="form-label">ສະຖານະຫ້ອງ</label>
                  <select id="status" class="select2 form-select" v-model="form.status" :disabled="formMode === 'edit'">
                    <option value="ຫວ່າງ">ຫວ່າງ</option>
                    <option value="ບໍ່ຫວ່າງ">ບໍ່ຫວ່າງ</option>
                    <option value="ຈອງແລ້ວ">ຈອງແລ້ວ</option>
                  </select>
                  <div v-if="errors.status" class="text-danger">{{ errors.status[0] }}</div>
                </div>
                <button type="submit" class="btn btn-success me-2">{{ formMode === 'add' ? 'ບັນທຶກ' : 'ແກ້ໄຂ' }}</button>
                <button type="button" class="btn btn-danger" @click="toggleForm()">ຍົກເລີກ</button>
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
import CheckOut from '../Check-in-out/check-out.vue';
export default {
 // In your room component script
 components: {
    CheckOut
  },
data() {
  return {
    rooms: [],
    roomTypes: [], // Add this line
    showForm: false,
    formMode: 'add', // or 'edit'
    form: {
      id: null,
      room_number: '',
      roomtype_id: null,
      status: '',
    },
    search: '',
    errors: {},
  };
},
mounted() {
  this.fetchRooms();
  this.fetchRoomTypes(); 
  this.$on('checkout-added', this.updateRoomStatus);// Add this line
},
methods: {
  getRoomTypeName(roomtypeId) {
    const roomType = this.roomTypes.find((roomType) => roomType.roomtype_id === roomtypeId);
    return roomType ? roomType.roomtype_name : '';
  },
  fetchRooms() {
    axios.get('/api/rooms', { params: { search: this.search } })
      .then(response => {
        this.rooms = response.data;
      })
      .catch(error => {
        console.error('Error fetching rooms:', error);
      });
  },
  fetchRoomTypes() { // Add this method
    axios.get('/api/roomtypes')
      .then(response => {
        this.roomTypes = response.data;
      })
      .catch(error => {
        console.error('Error fetching room types:', error);
      });
},
  toggleForm(mode, room = null) {
    this.showForm = !this.showForm;
    this.formMode = mode;
    if (room) {
      this.form = { ...room };
    } else {
      this.form = {
        id: null,
        room_number: '',
        roomtype_id: null,
        status: '',
      };
    }
    this.errors = {};
  },
  addRoom() {
    axios.post('/api/rooms', this.form)
      .then(response => {
        alert(response.data.message);
        this.fetchRooms();
        this.toggleForm();
      })
      .catch(error => {
        if (error.response && error.response.data.errors) {
          this.errors = error.response.data.errors;
        } else {
          alert('Failed to add room. Please try again.');
        }
      });
  },
  updateRoom() {
    if (this.form.id) {
      axios.put(`/api/rooms/${this.form.id}`, this.form)
        .then(response => {
          alert(response.data.message);
          this.fetchRooms();
          this.toggleForm();
        })
        .catch(error => {
          if (error.response && error.response.data.errors) {
            this.errors = error.response.data.errors;
          } else {
            alert('Failed to update room. Please try again.');
          }
        });
    } else {
      console.error('Room ID is missing for update.');
    }
  },
  deleteRoom(id) {
    if (confirm('Are you sure you want to delete this payment?')) {
    axios.delete(`/api/rooms/${id}`)
      .then(() => {
        this.fetchRooms();
        alert('Room deleted successfully!');
      })
      .catch(error => {
        console.error('Error deleting room:', error);
        alert('Failed to delete room. Please try again.');
      });
    }
  },
  updateRoomStatus(rentId) {
      axios.put('/api/rooms/status', { room_number: this.getRoomNumberByRentId(rentId), status: 'ຫວ່າງ' })
        .then(response => {
          console.log('Room status updated successfully');
          this.fetchRooms();
        })
        .catch(error => {
          console.error('Error updating room status:', error);
        });
    },
    getRoomNumberByRentId(rentId) {
      const rent = this.rents.find(rent => rent.rent_id === rentId);
      return rent ? rent.room_number : '';
    },
  getStatusClass(status) {
    return {
      'text-success': status === 'ຫວ່າງ',
      'text-warning': status === 'ບໍ່ຫວ່າງ',
      'text-danger': status === 'ຈອງແລ້ວ'
    };
  }
},
mounted() {
  this.fetchRooms();
  this.fetchRoomTypes(); // Add this line
},
};
</script>

<style scoped>
/* Existing styles */

.text-success {
  color: #28a745; /* Green color for success */
}

.text-warning {
  color: #ffc107; /* Yellow color for warning */
}

.text-danger {
  color: #dc3545; /* Red color for danger */
}
</style>
