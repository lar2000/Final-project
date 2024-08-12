<template>
    <div>
      <div class="nk-content">
        <div class="container-fluid">
          <div class="nk-content-inner">
            <div class="nk-content-body">
              <div class="nk-block-head nk-block-head-sm" v-if="!showForm">
                <div class="nk-block-between">
                  <div class="nk-block-head-content">
                    <h5 class="nk-block-title page-title">ລາຍການປະເພດຫ້ອງ ແລະ ລາຄາ</h5>
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
                              <input type="text" class="form-control me-2" v-model="search" @keyup.enter="fetchRoomTypes" placeholder="Search...">
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
                            <th class="nk-tb-col">ລະຫັດປະເພດຫ້ອງ</th>
                            <th class="nk-tb-col">ຊື່</th>
                            <th class="nk-tb-col">ລາຄາ</th>
                            <th class="nk-tb-col">ຈັດການ</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr v-for="roomtype in roomtypes" :key="roomtype.roomtype_id" class="nk-tb-item">
                            <td class="nk-tb-col">{{ roomtype.roomtype_id }}</td>
                            <td class="nk-tb-col">{{ roomtype.roomtype_name }}</td>
                            <td class="nk-tb-col">{{ roomtype.room_price }} ກີບ</td>
                            <td class="nk-tb-col">
                              <div class="dropdown">
                                <a href="#" class="dropdown-toggle btn btn-icon btn-trigger" data-bs-toggle="dropdown">
                                  <i class="bx bx-dots-horizontal"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end">
                                  <ul class="link-list-opt no-bdr">
                                    <li>
                                      <a href="#" @click="toggleForm('edit', roomtype)">
                                        <i class="menu-icon bx bxs-edit-alt" style="color: chartreuse;"></i>
                                        <span>ແກ້ໄຂ</span>
                                      </a>
                                    </li>
                                    <li>
                                      <a href="#" @click="deleteRoomT(roomtype.id)">
                                        <i class="menu-icon bx bxs-trash" style="color: red;"></i>
                                        <span>ລົບ</span>
                                      </a>
                                    </li>
                                  </ul>
                                </div>
                              </div>
                            </td>
                          </tr>
                          <tr v-if="roomtypes.length === 0">
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
                <form @submit.prevent="formMode === 'add' ? addRoomT() : updateRoomT()">
                  <div class="mb-3">
                    <label for="roomNumber" class="form-label">ລະຫັດປະເພດຫ້ອງ</label>
                    <input type="number" class="form-control" v-model="form.roomtype_id" required>
                    <div v-if="errors.roomtype_id" class="text-danger">{{ errors.roomtype_id[0] }}</div>
                  </div>
                  <div class="mb-3">
                    <label for="roomtypeName" class="form-label">ຊື່</label>
                    <input type="text" class="form-control" v-model="form.roomtype_name" required>
                    <div v-if="errors.roomtype_name" class="text-danger">{{ errors.roomtype_name[0] }}</div>
                  </div>
                  <div class="mb-3">
                    <label for="room_price" class="form-label">ລາຄາ</label>
                    <input type="number" class="form-control" v-model="form.room_price" required>
                    <div v-if="errors.room_price" class="text-danger">{{ errors.room_price[0] }}</div>
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
  
  export default {
    data() {
      return {
        roomtypes: [],
        showForm: false,
        formMode: 'add', // or 'edit'
        form: {
          id: null,
          roomtype_id: '',
          roomtype_name: '',
          room_price: '',
        },
        search: '',
        errors: {},
      };
    },
    mounted() {
      this.fetchRoomTypes();
    },
    methods: {
      fetchRoomTypes() {
        axios.get('/api/roomtypes', { params: { search: this.search } })
          .then(response => {
            this.roomtypes = response.data;
          })
          .catch(error => {
            console.error('Error fetching roomtypes:', error);
          });
      },
      toggleForm(mode, roomtype = null) {
        this.showForm = !this.showForm;
        this.formMode = mode;
        if (roomtype) {
          this.form = { ...roomtype };
        } else {
          this.form = {
            id: null,
            roomtype_id: '',
            roomtype_name: '',
            room_price: '',
          };
        }
        this.errors = {};
      },
      addRoomT() {
        axios.post('/api/roomtypes', this.form)
          .then(response => {
            alert(response.data.message);
            this.fetchRoomTypes();
            this.toggleForm();
          })
          .catch(error => {
            if (error.response && error.response.data.errors) {
              this.errors = error.response.data.errors;
            } else {
              alert('ເພີ່ມຂໍ້ມູນລົ້ມເຫຼວ. ກະລຸນາລອງອີກຄັ້ງ!');
            }
          });
      },
      updateRoomT() {
        if (this.form.id) {
          axios.put(`/api/roomtypes/${this.form.id}`, this.form)
            .then(response => {
              alert(response.data.message);
              this.fetchRoomTypes();
              this.toggleForm();
            })
            .catch(error => {
              if (error.response && error.response.data.errors) {
                this.errors = error.response.data.errors;
              } else {
                alert('ອັບເດດຂໍ້ມູນລົ້ມເຫຼວ. ກະລຸນາລອງອີກຄັ້ງ');
              }
            });
        } else {
          console.error('ອັບເດດຂໍ້ມູນສຳເລັດແລ້ວ.');
        }
      },
      deleteRoomT(id) {
      axios.delete(`/api/roomtypes/${id}`)
        .then(() => {
          this.fetchRoomTypes();
          alert('ລົບຂໍ້ມູນສຳເລັດແລ້ວ!');
        })
        .catch(error => {
          console.error('Error deleting room:', error);
          alert('ລົບຂໍ້ມູນລົ້ມເຫຼວ. ລອງໃໝ່ອີກຄັ້ງ');
        });
    },
    },
  };
  </script>
  
  <style scoped>
  /* General styles */
  .nk-content {
    padding: 20px;
  }
  
  /* Table styles */
  .nk-tb-list {
    width: 100%;
    border-collapse: collapse;
    margin-bottom: 20px;
  }
  
  .nk-tb-head {
    background-color: #f8f9fa;
  }
  
  .nk-tb-col {
    padding: 10px;
    text-align: left;
    border-bottom: 1px solid #dee2e6;
  }
  
  .nk-tb-col-actions {
    text-align: center;
  }
  
  /* Form styles */
  form {
    max-width: 600px;
    margin: 0 auto;
    padding: 20px;
    background-color: #ffffff;
    border: 1px solid #dee2e6;
    border-radius: 4px;
  }
  
  .form-label {
    font-weight: 500;
  }
  
  .form-control {
    width: 100%;
    padding: 10px;
    margin-bottom: 10px;
    border: 1px solid #ced4da;
    border-radius: 4px;
  }
  
  .btn {
    padding: 10px 20px;
    border-radius: 4px;
  }
  
  /* Error message styles */
  .text-danger {
    color: #dc3545;
  }
  
  /* Responsive styles */
  @media (max-width: 768px) {
    .nk-tb-col {
      font-size: 14px;
      padding: 8px;
    }
  
    form {
      padding: 10px;
    }
  }
  </style>
  