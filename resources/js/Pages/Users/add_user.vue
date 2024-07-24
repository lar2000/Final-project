<template>
  <div>
    <div class="card mb-4">
      <!-- Account -->
      <div class="card-body">
        <div class="d-flex align-items-start align-items-sm-center gap-4">
          <img :src="uploadimg" alt="user-avatar" class="d-block rounded" height="90" width="90" id="uploadimg">
          <div class="button-wrapper">
            <label for="upload" class="btn btn-primary me-2 mb-4" tabindex="0">
              <span class="d-none d-sm-block">ເພີ່ມຮູບພາບ</span>
              <i class="bx bx-upload d-block d-sm-none"></i>
              <input type="file" id="upload" class="account-file-input" hidden accept="image/png, image/jpeg" @change="onFileChange">
            </label>
            <button type="button" class="btn btn-danger account-image-reset mb-4" @click="resetImage">
              <i class="bx bx-reset d-block d-sm-none"></i>
              <span class="d-none d-sm-block">Reset</span>
            </button>
          </div>
        </div>
      </div>
      <hr>
      <div class="card-body">
        <form id="form_add" @submit.prevent="saveChanges">
          <div class="mb-3 col-md-2">
            <label for="user_id" class="form-label">ລະຫັດຜູ້ໃຊ້</label>
            <input class="form-control" type="text" id="user_id" v-model="form.user_id" placeholder="...." autofocus>
            <div v-if="formErrors.user_id" class="text-danger">{{ formErrors.user_id }}</div>
          </div>
          <div class="row">
            <div class="mb-3 col-md-6">
              <label for="firstName" class="form-label">ຊື່</label>
              <input class="form-control" type="text" id="firstName" v-model="form.firstName" placeholder="name" autofocus>
              <div v-if="formErrors.firstName" class="text-danger">{{ formErrors.firstName }}</div>
            </div>
            <div class="mb-3 col-md-6">
              <label for="lastName" class="form-label">ນາມສະກຸນ</label>
              <input class="form-control" type="text" v-model="form.lastName" id="lastName" placeholder="Surname">
              <div v-if="formErrors.lastName" class="text-danger">{{ formErrors.lastName }}</div>
            </div>
            <div class="mb-3 col-md-6">
              <label for="gender" class="form-label">ເພດ</label>
              <select id="gender" class="select2 form-select" v-model="form.gender">
                <option value="select">ເລືອກ</option>
                <option value="ຊາຍ">ຊາຍ</option>
                <option value="ຍິງ">ຍິງ</option>
                <option value="ອື່ນໆ">ອື່ນໆ</option>
              </select>
              <div v-if="formErrors.gender" class="text-danger">{{ formErrors.gender }}</div>
            </div>
            <div class="mb-3 col-md-6">
              <label for="email" class="form-label">ອີເມວ໌</label>
              <input class="form-control" type="email" v-model="form.email" id="email" placeholder="johnwick.hex@example.com">
              <div v-if="formErrors.email" class="text-danger">{{ formErrors.email }}</div>
            </div>
            <div class="mb-3 col-md-6">
              <label class="form-label" for="phoneNumber">ເບີໂທ/whatapp</label>
                <input type="text" id="phoneNumber" v-model="form.phoneNumber" class="form-control" placeholder="020 ########">
                <div v-if="formErrors.phoneNumber" class="text-danger">{{ formErrors.phoneNumber }}</div>
            </div>
            <div class="mb-3 col-md-6">
              <label for="password" class="form-label">ລະຫັດຜ່ານ</label>
              <input type="password" class="form-control" v-model="form.password" id="password" placeholder="pass">
              <div v-if="formErrors.password" class="text-danger">{{ formErrors.password }}</div>
            </div>
          </div>
          <div class="mt-2">
            <button type="submit" class="btn btn-primary me-2">ບັນທຶກ</button>
            <button type="button" class="btn btn-danger" @click="resetForm">ຍົກເລີກ</button>
          </div>
        </form>
      </div>
      <!-- /Account -->
    </div>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  name: 'LaravelVue3Account',
  data() {
    return {
      uploadimg: 'assets/.giff/img.gif',
      form: {
        user_id: '',
        firstName: '',
        lastName: '',
        gender: '',
        email: '',
        password: '',
        phoneNumber: '',
        profile_path: null,
      },
      formErrors: {
        user_id: '',
        firstName: '',
        lastName: '',
        gender: '',
        email: '',
        password: '',
        phoneNumber: '',
      },
    };
  },
  methods: {
    onFileChange(event) {
      const file = event.target.files[0];
      if (file) {
        this.uploadimg = URL.createObjectURL(file);
        this.form.profile_path = file; // Save file object to form data
      }
    },
    resetImage() {
      this.uploadimg = 'assets/.giff/img.gif';
      this.form.profile_path = null; // Clear file object from form data
      document.getElementById('upload').value = null;
    },
    saveChanges() {
      if (!this.validateForm()) {
        return; // Stop submission if validation fails
      }

      let formData = new FormData();
      formData.append('user_id', this.form.user_id);
      formData.append('firstName', this.form.firstName);
      formData.append('lastName', this.form.lastName);
      formData.append('gender', this.form.gender);
      formData.append('email', this.form.email);
      formData.append('password', this.form.password);
      formData.append('phoneNumber', this.form.phoneNumber);
      if (this.form.profile_path) {
        formData.append('profile_path', this.form.profile_path);
      }

      axios.post('/api/add', formData)
        .then(response => {
          if (response.data.success) {
            // Reset form after successful submission
            this.resetForm();
            alert('User added successfully!');
            this.$router.push('/Users');
          } else {
            alert('Failed to add user.');
          }
        })
        .catch(error => {
          console.error('Error adding user:', error);
          alert('Failed to add user.');
        });
    },
    resetForm() {
      this.form = {
        user_id: '',
        firstName: '',
        lastName: '',
        gender: '',
        email: '',
        password: '',
        phoneNumber: '',
        profile_path: null,
      };
      this.resetImage();
      this.clearFormErrors();
    },
    validateForm() {
      let isValid = true;
      this.clearFormErrors();

      if (!this.form.user_id.trim()) {
        this.formErrors.user_id = 'ກະລຸນາປ້ອນລະຫັດຜູ້ໃຊ້';
        isValid = false;
      }
      if (!this.form.firstName.trim()) {
        this.formErrors.firstName = 'ກະລຸນາປ້ອນຊື່';
        isValid = false;
      }
      if (!this.form.lastName.trim()) {
        this.formErrors.lastName = 'ກະລຸນາປ້ອນນາມສະກຸນ';
        isValid = false;
      }
      if (!this.form.gender.trim() || this.form.gender === 'select') {
        this.formErrors.gender = 'ກະລຸນາເລືອກເພດ';
        isValid = false;
      }
      if (!this.form.email.trim()) {
        this.formErrors.email = 'ກະລຸນາປ້ອນອີເມວ໌';
        isValid = false;
      }
      if (!this.form.phoneNumber.trim()) {
        this.formErrors.phoneNumber = 'ກະລຸນາປ້ອນເບີໂທ';
        isValid = false;
      }
      if (!this.form.password.trim()) {
        this.formErrors.password = 'ກະລຸນາປ້ອນລະຫັດຜ່ານ';
        isValid = false;
      }

      return isValid;
    },
    clearFormErrors() {
      this.formErrors = {
        user_id: '',
        firstName: '',
        lastName: '',
        gender: '',
        email: '',
        password: '',
        phoneNumber: '',
      };
    },
  },
};
</script>

<style scoped>
.form-icon-right .ni-calendar {
  position: absolute;
  right: 10px;
  top: 50%;
  transform: translateY(-50%);
  pointer-events: none;
}
</style>
