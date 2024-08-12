<template>
  <div>
    <div class="card mb-4">
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
        <form id="form_edit" @submit.prevent="saveChanges">
          <div class="mb-3 col-md-2">
            <label for="user_id" class="form-label">ລະຫັດຜູ້ໃຊ້</label>
            <input class="form-control" type="text" id="user_id" v-model="form.user_id" placeholder="...." disabled>
            <div v-if="formErrors.user_id" class="text-danger">{{ formErrors.user_id }}</div>
          </div>
          <div class="row">
            <div class="mb-3 col-md-6">
              <label for="firstName" class="form-label">ຊື່</label>
              <input class="form-control" type="text" id="firstName" v-model="form.firstName" placeholder="name">
              <div v-if="formErrors.firstName" class="text-danger">{{ formErrors.firstName }}</div>
            </div>
            <div class="mb-3 col-md-6">
              <label for="lastName" class="form-label">ນາມສະກຸນ</label>
              <input class="form-control" type="text" id="lastName" v-model="form.lastName" placeholder="surname">
              <div v-if="formErrors.lastName" class="text-danger">{{ formErrors.lastName }}</div>
            </div>
            <div class="mb-3 col-md-6">
              <label for="gender" class="form-label">ເພດ</label>
              <select id="gender" class="form-select" v-model="form.gender">
                <option value="ຊາຍ">ຊາຍ</option>
                <option value="ຍິງ">ຍິງ</option>
                <option value="ອື່ນໆ">ອື່ນໆ</option>
              </select>
              <div v-if="formErrors.gender" class="text-danger">{{ formErrors.gender }}</div>
            </div>
            <div class="mb-3 col-md-6">
              <label for="phoneNumber" class="form-label">ເບີໂທ</label>
              <input class="form-control" type="text" id="phoneNumber" v-model="form.phoneNumber" placeholder="phone number">
              <div v-if="formErrors.phoneNumber" class="text-danger">{{ formErrors.phoneNumber }}</div>
            </div>
            <div class="mb-3 col-md-6">
              <label for="email" class="form-label">ອີເມວ໌</label>
              <input class="form-control" type="email" id="email" v-model="form.email" placeholder="email@example.com">
              <div v-if="formErrors.email" class="text-danger">{{ formErrors.email }}</div>
            </div>
            <div class="mb-3 col-md-6">
              <label for="password" class="form-label">ລະຫັດຜ່ານ</label>
              <input class="form-control" type="password" id="password" v-model="form.password" placeholder="********">
              <div v-if="formErrors.password" class="text-danger">{{ formErrors.password }}</div>
            </div>
          </div>
          <div class="mt-2">
            <button type="submit" class="btn btn-success me-2">ອັບເດດ</button>
            <button type="reset" class="btn btn-danger" @click="resetForm">ຍົກເລີກ</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  name: 'EditUser',
  data() {
    return {
      form: {
        user_id: '',
        firstName: '',
        lastName: '',
        gender: '',
        phoneNumber: '',
        email: '',
        password: '',
        profile_path: null // Store the file object directly
      },
      formErrors: {},
      uploadimg: '',
      defaultImage: '/path/to/default/image.jpg' // Set a default image path if no image is uploaded
    };
  },
  methods: {
    fetchUserData() {
      const userId = this.$route.params.id;
      axios.get(`/api/users/${userId}`)
        .then(response => {
          if (response.data.user) {
            this.form = response.data.user;
            this.uploadimg = `/storage/${this.form.profile_path}` || this.defaultImage;
          } else {
            alert('User not found.');
          }
        })
        .catch(error => {
          console.error('Error fetching user data:', error);
        });
    },
    onFileChange(event) {
      const file = event.target.files[0];
      if (file) {
        this.form.profile_path = file;
        const reader = new FileReader();
        reader.onload = (e) => {
          this.uploadimg = e.target.result;
        };
        reader.readAsDataURL(file);
      }
    },
    resetImage() {
      this.form.profile_path = null;
      this.uploadimg = this.defaultImage; // Reset to default image
    },
    saveChanges() {
      if (!this.validateForm()) {
        return;
      }

      const formData = new FormData();
      for (const key in this.form) {
        if (this.form[key] instanceof File) {
          formData.append(key, this.form[key]);
        } else {
          formData.append(key, this.form[key]);
        }
      }

      axios.put(`/api/users/${this.form.user_id}`, formData, {
        headers: {
          'Content-Type': 'multipart/form-data'
        }
      })
      .then(response => {
        if (response.data.success) {
          alert('User updated successfully!');
          this.$router.push('/Users');
        } else {
          alert('Failed to update user.');
          this.formErrors = response.data.errors || {};
        }
      })
      .catch(error => {
        console.error('Error updating user:', error.response.data);
        this.formErrors = error.response.data.errors || {};
        alert('Failed to update user. Please try again later.');
      });
    },
    validateForm() {
      let isValid = true;
      this.formErrors = {};

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
      if (!this.form.gender) {
        this.formErrors.gender = 'ກະລຸນາເລືອກເພດ';
        isValid = false;
      }
      if (!this.form.phoneNumber.trim()) {
        this.formErrors.phoneNumber = 'ກະລຸນາປ້ອນເບີໂທ';
        isValid = false;
      }
      if (!this.form.email.trim()) {
        this.formErrors.email = 'ກະລຸນາປ້ອນອີເມວ໌';
        isValid = false;
      }
      if (this.form.password.trim() === '') {
        this.formErrors.password = 'ກະລຸນາປ້ອນລະຫັດຜ່ານ';
        isValid = false;
      }

      return isValid;
    },
    resetForm() {
      this.form = {
        user_id: '',
        firstName: '',
        lastName: '',
        gender: '',
        phoneNumber: '',
        email: '',
        password: '',
        profile_path: null
      };
      this.uploadimg = this.defaultImage;
      this.formErrors = {};
      this.$router.push('/Users'); // Redirect to users list
    }
  },
  created() {
    this.fetchUserData();
  }
};
</script>

<style scoped>
/* Add your custom styles here */
form {
  max-width: 950px;
  margin: 0 auto;
  padding: 20px;
  background: #f8f9fa;
  border-radius: 5px;
}
</style>
