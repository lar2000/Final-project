<template>
  <div class="report-container">
    <!-- Header Section -->
    <header class="report-header">
      <h1 class="report-title">ລາຍງານ</h1>
    </header>

    <!-- Toggle Section -->
    <div class="toggle-wrap nk-block-tools-toggle">
      <button class="btn btn-icon btn-trigger toggle-expand" aria-expanded="false">
        <em class="icon ni ni-menu-alt-r"></em>
      </button>
      <div class="toggle-expand-content" aria-hidden="true">
        <ul class="nk-block-tools g-3">
          <!-- Add interactive tools here if needed -->
        </ul>
      </div>
    </div>

    <!-- Action Buttons Section -->
    <div class="report-actions">
      <router-link to="/pay" class="btn btn-outline-info">
        <i class='menu-icon bx bx-credit-card'></i>
        ຄ່າເຊົ່າ  
      </router-link>
      <router-link to="/cin" class="btn btn-outline-secondary">
        <i class='menu-icon bx bx-log-in-circle'></i>
        ຂໍ້ມູນການແຈ້ງເຂົ້າ
      </router-link>
      <router-link to="/Repay" class="btn btn-outline-primary">
        <i class='menu-icon bx bx-money'></i>
        ລາຍຈ່າຍ
      </router-link>
    </div>
  </div>
</template>

<script>
import html2pdf from 'html2pdf.js';
import axios from 'axios';

export default {
  data() {
    return {
      payments: []
    };
  },
  methods: {
    async fetchPayments() {
      try {
        const response = await axios.get('/api/payments');
        this.payments = response.data;
      } catch (error) {
        console.error('Error fetching payments:', error);
      }
    },
    calculateTotalBill(payment) {
      return parseInt(payment.room_price) + parseInt(payment.ele_price) + parseInt(payment.water_price) + parseInt(payment.gar_price);
    },
    saveReportAsPDF() {
      const reportElement = this.$refs.reportSection;
      html2pdf()
        .from(reportElement)
        .set({
          filename: 'report.pdf',
          html2canvas: { scale: 2 },
          jsPDF: { orientation: 'portrait' }
        })
        .save();
    }
  },
  mounted() {
    this.fetchPayments();
  }
};
</script>

<style scoped>
.report-container {
  padding: 20px;
  background-color: #f5f7fa;
  border-radius: 8px;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
  max-width: 1200px;
  margin: auto;
}

.report-header {
  margin-bottom: 20px;
}

.report-title {
  font-size: 2rem;
  color: #333;
  text-align: center;
}

.toggle-wrap {
  margin-bottom: 20px;
  display: flex;
  justify-content: flex-end;
}

.btn-trigger {
  background-color: #007bff;
  color: #fff;
}

.toggle-expand-content {
  margin-top: 10px;
}

.report-actions {
  display: flex;
  justify-content: center;
  gap: 10px;
}

.report-actions .btn {
  padding: 10px 20px;
  border-radius: 4px;
  font-size: 16px;
  transition: background-color 0.3s, color 0.3s;
}

.report-actions .btn:hover {
  background-color: #0056b3;
  color: #fff;
}
</style>
