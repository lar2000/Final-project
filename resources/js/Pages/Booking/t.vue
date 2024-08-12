<script>
import axios from 'axios';

export default {
  data() {
    return {
      bookings: [],
      customers: [],
      vacantRooms: [],
      search: '',
      showForm: false,
      formMode: 'add', // 'add' or 'edit'
      form: {
        book_id: '',
        book_date: '',
        book_enddate: '',
        room_number: '',
        cust_id: '',
        book_pay: '',
      },
      errors: {},
      alertMessage: '',
      alertType: 'success', // 'success', 'error'
    };
  },
  methods: {
    fetchBookings() {
      axios.get('/api/bookings', { params: { search: this.search } })
        .then(response => {
          this.bookings = response.data;
        })
        .catch(error => {
          console.error('Error fetching bookings:', error);
        });
    },
    fetchCustomers() {
      axios.get('/api/customers')
        .then(response => {
          this.customers = response.data;
        })
        .catch(error => {
          console.error('Error fetching customers:', error);
        });
    },
    fetchVacantRooms() {
      axios.get('/api/rooms/vacant')
        .then(response => {
          this.vacantRooms = response.data;
        })
        .catch(error => {
          console.error('Error fetching vacant rooms:', error);
        });
    },
    toggleForm(mode, booking = {}) {
      if (mode === 'add') {
        this.form = {
          book_id: '',
          book_date: '',
          book_enddate: '',
          room_number: '',
          cust_id: '',
          book_pay: '',
        };
        this.errors = {};
      } else {
        this.form = { ...booking };
        this.errors = {};
      }
      this.formMode = mode;
      this.showForm = !this.showForm;
    },
    validateForm() {
      this.errors = {};
      let isValid = true;

      if (!this.form.room_number) {
        this.$set(this.errors, 'room_number', ['Room number is required.']);
        isValid = false;
      }
      if (!this.form.book_date) {
        this.$set(this.errors, 'book_date', ['Booking date is required.']);
        isValid = false;
      }
      if (!this.form.book_enddate) {
        this.$set(this.errors, 'book_enddate', ['End date is required.']);
        isValid = false;
      }
      if (!this.form.cust_id) {
        this.$set(this.errors, 'cust_id', ['Customer is required.']);
        isValid = false;
      }
      if (!this.form.book_pay) {
        this.$set(this.errors, 'book_pay', ['Payment amount is required.']);
        isValid = false;
      }

      return isValid;
    },
    addBooking() {
      if (this.validateForm()) {
        axios.post('/api/bookings', this.form)
          .then(response => {
            this.fetchBookings();
            this.showForm = false;
            this.alertMessage = 'Booking added successfully!';
            this.alertType = 'success';
          })
          .catch(error => {
            this.alertMessage = 'Error adding booking!';
            this.alertType = 'error';
            console.error('Error adding booking:', error);
          });
      }
    },
    updateBooking() {
      if (this.validateForm()) {
        axios.put(`/api/bookings/${this.form.book_id}`, this.form)
          .then(response => {
            this.fetchBookings();
            this.showForm = false;
            this.alertMessage = 'Booking updated successfully!';
            this.alertType = 'success';
          })
          .catch(error => {
            this.alertMessage = 'Error updating booking!';
            this.alertType = 'error';
            console.error('Error updating booking:', error);
          });
      }
    },
    deleteBooking(id) {
      if (confirm('Are you sure you want to delete this booking?')) {
        axios.delete(`/api/bookings/${id}`)
          .then(response => {
            this.fetchBookings();
            this.alertMessage = 'Booking deleted successfully!';
            this.alertType = 'success';
          })
          .catch(error => {
            this.alertMessage = 'Error deleting booking!';
            this.alertType = 'error';
            console.error('Error deleting booking:', error);
          });
      }
    },
    getCustomerName(id) {
      const customer = this.customers.find(c => c.id.toString() === id.toString());
      return customer ? `${customer.firstName} ${customer.lastName}` : '';
    },
  },
  mounted() {
    this.fetchBookings();
    this.fetchCustomers();
    this.fetchVacantRooms();
  }
};
</script>
