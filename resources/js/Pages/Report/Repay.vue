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
                     
                      <div class="mb-3">
              <button @click="exportToPDF" class="btn btn-primary">Export to PDF</button>
            </div>
                      <div class="mb-2">
                      <div class="toggle-expand-content" data-content="pageMenu">
                      <ul class="nk-block-tools g-3">
                        <li class="nk-block-tools-opt">
                          <button class="btn btn-secondary">
                           
                            <router-link to="/Report">
                           <span>ກັບຄືນ</span>
                             </router-link>
                          </button>
                        </li>
                      </ul>
                    </div>
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
                          </tr>
                        </thead>
                        <tbody>
                          <tr v-for="expense in paginatedExpenses" :key="expense.id" class="nk-tb-item">
                            <td class="nk-tb-col">{{ expense.user_id }}</td>
                            <td class="nk-tb-col">{{ expense.expen_date }}</td>
                            <td class="nk-tb-col">{{ expense.expen_detail }}</td>
                            <td class="nk-tb-col">{{ expense.total_price }} ກີບ</td>
                           
                              
                          </tr>
                          
                          <tr v-if="expenses.length === 0">
                            <td colspan="5" class="text-center">No expenses found</td>
                          </tr>
                        
                        
                <tr class="nk-tb-item">
                  <td colspan="3" class="text-end"><strong>ຍອດຈ່າຍທັງໝົດ:</strong></td>
                  <td class="nk-tb-col" style="color: crimson;"><strong>{{ totalExp }} ກີບ</strong></td>
                </tr>
    
            </tbody>
                      </table>
                    </div>
                    <div class="card-inner ">
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
import html2canvas from 'html2canvas';

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
    },
    totalExp() {
      return this.paginatedExpenses.reduce((sum, expense) => sum + parseFloat(expense.total_price || 0), 0).toFixed(2);
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
    changePage(pageNumber) {
      if (pageNumber < 1 || pageNumber > this.totalPages) return;
      this.currentPage = pageNumber;
    },
    exportToPDF() {
      const doc = new jsPDF();

      // Capture the table content
      html2canvas(document.querySelector('.nk-tb-list')).then(canvas => {
        const imgData = canvas.toDataURL('image/jpeg');
        
        // Add the image to PDF
        doc.addImage(imgData, 'JPEG', -5, 5);
        doc.save('expenses-report.pdf');
      });
    }
  }
}
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
  