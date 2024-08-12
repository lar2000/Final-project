<template>
  <div>
    <div class="nk-content">
      <div class="container-fluid">
        <div class="nk-content-inner">
          <div class="nk-content-body">
            <!-- Header and search form -->
            <div class="nk-block-head nk-block-head-sm" v-if="!showForm">
              <div class="nk-block-between">
                <div class="nk-block-head-content">
                  <h5 class="nk-block-title page-title">ລາຍການຄ່າໃຊ້ຈ່າຍ</h5>
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
                            <input type="text" class="form-control me-2" v-model="search" @keyup.enter="fetchExpenses" placeholder="Search...">
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

            <!-- Expenses Table -->
            <div v-if="!showForm" class="nk-block">
              <div class="card card-bordered card-stretch">
                <div class="card-inner-group">
                  <div class="card-inner p-0">
                    <table class="nk-tb-list nk-tb-ulist">
                      <thead>
                        <tr class="nk-tb-item nk-tb-head">
                          <th class="nk-tb-col">ລະຫັດຜູ້ໃຊ້</th>
                          <th class="nk-tb-col">ວັນທີ</th>
                          <th class="nk-tb-col">ລາຍລະອຽດ</th>
                          <th class="nk-tb-col">ລາຄາ</th>
                          <th class="nk-tb-col">ຈັດການ</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr v-for="expense in paginatedExpenses" :key="expense.id" class="nk-tb-item">
                          <td class="nk-tb-col">{{ expense.user_id }}</td>
                          <td class="nk-tb-col">{{ expense.expen_date }}</td>
                          <td class="nk-tb-col">{{ expense.expen_detail }}</td>
                          <td class="nk-tb-col">{{ expense.total_price }} ກີບ</td>
                          <td class="nk-tb-col">
                            <div class="dropdown">
                              <a href="#" class="dropdown-toggle btn btn-icon btn-trigger" data-bs-toggle="dropdown">
                                <i class="bx bx-dots-horizontal"></i>
                              </a>
                              <div class="dropdown-menu dropdown-menu-end">
                                <ul class="link-list-opt no-bdr">
                                  <li>
                                    <a href="#" @click="generateExpensePDF(expense)">
                                      <span>ບັນທຶກໃບບິນ</span>
                                    </a>
                                  </li>
                                  <li>
                                    <a href="#" @click="toggleForm('edit', expense)">
                                      <i class="menu-icon bx bxs-edit-alt"></i>
                                      <span>ແກ້ໄຂ</span>
                                    </a>
                                  </li>
                                  <li>
                                    <a href="#" @click="deleteExpense(expense.id)">
                                      <i class="menu-icon bx bxs-trash"></i>
                                      <span>ລົບ</span>
                                    </a>
                                  </li>
                                </ul>
                              </div>
                            </div>
                          </td>
                        </tr>
                        <tr v-if="expenses.length === 0">
                          <td colspan="5" class="text-center">No expenses found</td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                  <div class="card-inner">
                    <div class="nk-block-between-md g-3">
                      <div class="g">
                        <ul class="pagination justify-content-center justify-content-md-start">
                          <li class="page-item" :class="{ disabled: currentPage === 1 }">
                            <a class="page-link" @click="changePage(currentPage - 1)">Previous</a>
                          </li>
                          <li v-for="page in totalPages" :key="page" class="page-item" :class="{ active: currentPage === page }">
                            <a class="page-link" @click="changePage(page)">{{ page }}</a>
                          </li>
                          <li class="page-item" :class="{ disabled: currentPage === totalPages }">
                            <a class="page-link" @click="changePage(currentPage + 1)">Next</a>
                          </li>
                        </ul>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Expense Form -->
            <div v-if="showForm">
              <h5 class="text-center">{{ formMode === 'add' ? 'ເພີ່ມຂໍໍມູນລາຍຈ່າຍ' : 'ແກ້ໄຂຂໍໍມູນລາຍຈ່າຍ' }}</h5>
              <form @submit.prevent="formMode === 'add' ? addExpense() : updateExpense()">
                <div class="row">
                  <div class="mb-3 col-md-6">
                    <label for="userId" class="form-label">ລະຫັດຜູ້ໃຊ້</label>
                    <select class="form-control" v-model="form.user_id" required>
                      <option v-for="user in users" :key="user.id" :value="user.id">
                        {{ user.user_id }}
                      </option>
                    </select>
                    <div v-if="errors.user_id" class="text-danger">{{ errors.user_id[0] }}</div>
                  </div>
                  <div class="mb-3 col-md-6">
                    <label for="expenDate" class="form-label">ວັນທີ</label>
                    <input type="date" class="form-control" v-model="form.expen_date" required>
                    <div v-if="errors.expen_date" class="text-danger">{{ errors.expen_date[0] }}</div>
                  </div>
                  <div class="mb-3 col-md-6">
                    <label for="expenDetail" class="form-label">ລາຍລະອຽດ</label>
                    <input type="text" class="form-control" v-model="form.expen_detail" required>
                    <div v-if="errors.expen_detail" class="text-danger">{{ errors.expen_detail[0] }}</div>
                  </div>
                  <div class="mb-3 col-md-6">
                    <label for="totalPrice" class="form-label">ລາຄາລວມ</label>
                    <input type="number" class="form-control" v-model="form.total_price" required>
                    <div v-if="errors.total_price" class="text-danger">{{ errors.total_price[0] }}</div>
                  </div>
                </div>
                <div class="mb-2">
                  <button type="submit" class="btn btn-success me-2">{{ formMode === 'add' ? 'ບັນທຶກ' : 'ແກ້ໄຂ' }}</button>
                  <button type="button" class="btn btn-danger" @click="toggleForm()">ຍົກເລີກ</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Loading spinner -->
    <div v-if="loading" class="loading-overlay">
      <div class="spinner-border text-primary" role="status">
        <span class="visually-hidden">Loading...</span>
      </div>
    </div>
  </div>
</template>


<script>
import axios from 'axios';
import jsPDF from 'jspdf';
import 'jspdf-autotable';

export default {
  data() {
    return {
      users: [],
      expenses: [],
      showForm: false,
      formMode: 'add',
      form: {
        id: null,
        user_id: '',
        expen_date: '',
        expen_detail: '',
        total_price: ''
      },
      search: '',
      errors: {},
      loading: false,
      currentPage: 1,
      itemsPerPage: 10
    };
  },
  computed: {
    totalPages() {
      return Math.ceil(this.expenses.length / this.itemsPerPage);
    },
    paginatedExpenses() {
      const start = (this.currentPage - 1) * this.itemsPerPage;
      const end = start + this.itemsPerPage;
      return this.expenses.slice(start, end);
    }
  },
  mounted() {
    this.fetchExpenses();
    this.fetchUsers();
  },
  methods: {
    fetchExpenses() {
      this.loading = true;
      axios.get('/api/expenses', { params: { search: this.search } })
        .then(response => {
          this.expenses = response.data;
          this.loading = false;
        })
        .catch(error => {
          console.error('Error fetching expenses:', error);
          this.loading = false;
        });
    },
    fetchUsers() {
      axios.get('/api/users')
        .then(response => {
          this.users = response.data.users;
        })
        .catch(error => {
          console.error('Error fetching users:', error);
        });
    },
    toggleForm(mode, expense = null) {
      this.showForm = !this.showForm;
      this.formMode = mode;
      if (expense) {
        this.form = { ...expense };
      } else {
        this.form = {
          id: null,
          user_id: '',
          expen_date: '',
          expen_detail: '',
          total_price: ''
        };
      }
      this.errors = {};
    },
    addExpense() {
      axios.post('/api/expenses', this.form)
        .then(response => {
          alert(response.data.message);
          this.fetchExpenses();
          this.toggleForm();
        })
        .catch(error => {
          if (error.response && error.response.data.errors) {
            this.errors = error.response.data.errors;
          } else {
            alert('Failed to add expense. Please try again!');
          }
        });
    },
    updateExpense() {
      if (this.form.id) {
        axios.put(`/api/expenses/${this.form.id}`, this.form)
          .then(response => {
            alert(response.data.message);
            this.fetchExpenses();
            this.toggleForm();
          })
          .catch(error => {
            if (error.response && error.response.data.errors) {
              this.errors = error.response.data.errors;
            } else {
              alert('Update failed. Please try again!');
            }
          });
      } else {
        console.error('Update failed.');
      }
    },
    deleteExpense(id) {
      axios.delete(`/api/expenses/${id}`)
        .then(() => {
          this.fetchExpenses();
          alert('Expense deleted successfully!');
        })
        .catch(error => {
          console.error('Error deleting expense:', error);
          alert('Delete failed. Please try again!');
        });
    },
    generateExpensePDF(expense) {
  const doc = new jsPDF();

  // Set font and size
  doc.setFont('Phetsarath OT');
  doc.setFontSize(12);

  doc.text('ບິນລາຍຈ່າຍ', 10, 10);
  doc.text(`ລະຫັດຜູ້ໃຊ້: ${expense.user_id}`, 10, 20);
  doc.text(`ວັນທີ: ${expense.expen_date}`, 10, 30);
  doc.text(`ລາຍລະອຽດ: ${expense.expen_detail}`, 10, 40);
  doc.text(`ລາຄາລວມ: ${expense.total_price} ກີບ`, 10, 50);

  doc.save('expense.pdf');
}
,
    generateTablePDF() {
      const doc = new jsPDF();
      doc.text('ລາຍການຄ່າໃຊ້ຈ່າຍ', 10, 10);

      const tableData = this.expenses.map(expense => [
        expense.user_id,
        expense.expen_date,
        expense.expen_detail,
        `${expense.total_price} ກີບ`
      ]);

      doc.autoTable({
        head: [['ລະຫັດຜູ້ໃຊ້', 'ວັນທີ', 'ລາຍລະອຽດ', 'ລາຄາ']],
        body: tableData,
        startY: 20
      });

      doc.save('expenses.pdf');
    },
    changePage(pageNumber) {
      if (pageNumber < 1 || pageNumber > this.totalPages) return;
      this.currentPage = pageNumber;
    }
  }
};
</script>

<style scoped>
.loading-overlay {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0, 0, 0, 0.5);
  display: flex;
  align-items: center;
  justify-content: center;
  z-index: 1000;
}
</style>
