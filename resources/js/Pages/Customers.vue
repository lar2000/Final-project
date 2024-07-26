<template>
  <div>
    <div class="nk-content">
      <div class="container-fluid">
        <div class="nk-content-inner">
          <div class="nk-content-body">
            <div class="nk-block-head nk-block-head-sm" v-if="!showForm">
              <div class="nk-block-between">
                <div class="nk-block-head-content">
                  <h3 class="nk-block-title page-title">
                    Customer's Lists
                  </h3>
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
                            <input type="text" class="form-control me-2" v-model="search" @keyup.enter="fetchCustomers" placeholder="Search...">
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
                          <th class="nk-tb-col">ID</th>
                          <th class="nk-tb-col">First Name</th>
                          <th class="nk-tb-col">Last Name</th>
                          <th class="nk-tb-col">Gender</th>
                          <th class="nk-tb-col">Phone Number</th>
                          <th class="nk-tb-col">Actions</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr v-for="customer in customers" :key="customer.id" class="nk-tb-item">
                          <td class="nk-tb-col">{{ customer.cust_id }}</td>
                          <td class="nk-tb-col">{{ customer.firstName }}</td>
                          <td class="nk-tb-col">{{ customer.lastName }}</td>
                          <td class="nk-tb-col">{{ customer.gender }}</td>
                          <td class="nk-tb-col">{{ customer.phoneNumber }}</td>
                          <td class="nk-tb-col">
                            <div class="dropdown">
                              <a href="#" class="dropdown-toggle btn btn-icon btn-trigger" data-bs-toggle="dropdown">
                                <i class="bx bx-dots-horizontal"></i>
                              </a>
                              <div class="dropdown-menu dropdown-menu-end">
                                <ul class="link-list-opt no-bdr">
                                  <li>
                                    <a href="#" @click="toggleForm('edit', customer)">
                                      <i class="menu-icon bx bxs-edit-alt"></i>
                                      <span>Edit</span>
                                    </a>
                                  </li>
                                  <li>
                                    <a href="#" @click="deleteCustomer(customer.id)">
                                      <i class="menu-icon bx bxs-trash"></i>
                                      <span>Delete</span>
                                    </a>
                                  </li>
                                </ul>
                              </div>
                            </div>
                          </td>
                        </tr>
                        <tr v-if="customers.length === 0">
                          <td colspan="6" class="text-center">No customers found</td>
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
              <h3 class="text-center">{{ formMode === 'add' ? 'Add Customer' : 'Edit Customer' }}</h3>
              <form @submit.prevent="formMode === 'add' ? addCustomer() : updateCustomer()">
                <div class="mb-3">
                  <label for="firstName" class="form-label">First Name</label>
                  <input type="text" class="form-control" v-model="form.firstName" required>
                </div>
                <div class="mb-3">
                  <label for="lastName" class="form-label">Last Name</label>
                  <input type="text" class="form-control" v-model="form.lastName" required>
                </div>
                <div class="mb-3">
                  <label for="gender" class="form-label">Gender</label>
                  <select id="gender" class="select2 form-select" v-model="form.gender">
                <option value="select">ເລືອກ</option>
                <option value="ຊາຍ">ຊາຍ</option>
                <option value="ຍິງ">ຍິງ</option>
                <option value="ອື່ນໆ">ອື່ນໆ</option>
              </select>
                </div>
                <div class="mb-3">
                  <label for="phoneNumber" class="form-label">Phone Number</label>
                  <input type="text" class="form-control" v-model="form.phoneNumber" required>
                </div>
                <div class="mt-2">
                  <button type="submit" class="btn btn-primary me-2">{{ formMode === 'add' ? 'Add' : 'Save' }}</button>
                  <button type="button" class="btn btn-danger" @click="toggleForm()">Cancel</button>
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
  name: 'CustomerManagement',
  data() {
    return {
      customers: [],
      showForm: false,
      formMode: 'add',
      form: {
        id: null,
        firstName: '',
        lastName: '',
        gender: '',
        phoneNumber: ''
      },
      search: ''
    };
  },
  methods: {
  fetchCustomers() {
    axios.get('/api/customers')
      .then(response => {
        this.customers = response.data;
      })
      .catch(error => {
        console.error('Error fetching customers:', error);
      });
  },
  toggleForm(mode = 'add', customer = null) {
    this.formMode = mode;
    if (mode === 'edit' && customer) {
      this.form = { ...customer };
    } else {
      this.form = {
        id: null,
        firstName: '',
        lastName: '',
        gender: '',
        phoneNumber: ''
      };
    }
    this.showForm = !this.showForm;
  },
  addCustomer() {
    axios.post('/api/customers', this.form)
      .then(response => {
        this.fetchCustomers();
        alert('User added successfully!');
            this.$router.push('/Customers');
        this.toggleForm();
      })
      .catch(error => {
        console.error('Error adding customer:', error);
      });
  },
  updateCustomer() {
    axios.put(`/api/customers/${this.form.id}`, this.form)
      .then(response => {
        this.fetchCustomers();
        this.toggleForm();
      })
      .catch(error => {
        console.error('Error updating customer:', error);
      });
  },
  
  deleteCustomer(id) {
 
  if (confirm('Are you sure you want to delete this customer?')) {
    axios.delete(`/api/customers/${id}`)
      .then(response => {
        if (response.data.message) {
          this.customers = this.customers.filter(customer => customer.id !== id); // Remove deleted user from the list
          alert('Customer deleted successfully!');
        } else {
          alert('Error deleting customer.');
        }
      })
      .catch(error => {
        console.error('Error deleting customer:', error);
        alert('Failed to delete customer.');
      });
  }
}
},
  mounted() {
    this.fetchCustomers();
  }
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
