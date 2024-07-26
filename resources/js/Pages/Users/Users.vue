<template>
  <div>
    <div class="nk-content">
      <div class="container-fluid">
        <div class="nk-content-inner">
          <div class="nk-content-body">
            <div class="nk-block-head nk-block-head-sm">
              <div class="nk-block-between">
                <div class="nk-block-head-content">
                  <h3 class="nk-block-title page-title">
                    User's Lists
                  </h3>
                </div>
                <div class="nk-block-head-content" v-if="!ShowForm">
                  <div class="toggle-wrap nk-block-tools-toggle">
                    <a href="#" class="btn btn-icon btn-trigger toggle-expand me-n1" data-target="pageMenu">
                      <em class="icon ni ni-menu-alt-r"></em>
                    </a>
                    <div class="toggle-expand-content" data-content="pageMenu">
                      <ul class="nk-block-tools g-3">
                        <li class="nk-block-tools-opt">
                          <div class="d-flex">
                            <input type="text" class="form-control me-2" v-model="Search" @keyup.enter="fetchUsers()" placeholder="Search...">
                            <router-link to="/Add_User" class="btn btn-icon btn-primary">
                              <i class="bx bx-plus-medical"></i>
                            </router-link>
                          </div>
                        </li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="nk-block">
              <div class="card card-bordered card-stretch">
                <div class="card-inner-group">
                  <div class="card-inner p-0">
                    <table class="nk-tb-list nk-tb-ulist">
                      <thead>
                        <tr class="nk-tb-item nk-tb-head">
                          <th class="nk-tb-col">ID</th>
                          <th class="nk-tb-col">ຮູບ</th>
                          <th class="nk-tb-col">ຊື່</th>
                          <th class="nk-tb-col">ນາມສະກຸນ</th>
                          <th class="nk-tb-col">ເພດ</th>
                          <th class="nk-tb-col">ເບີໂທ</th>
                          <th class="nk-tb-col">ອີເມວ໌</th>
                          <th class="nk-tb-col">ຈັດການ</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr v-for="user in users" :key="user.id" class="nk-tb-item">
                          <td class="nk-tb-col">{{ user.user_id }}</td>
                          <td class="nk-tb-col">
                            <img :src="getImageUrl(user.profile_path)" alt="Avatar" class="rounded-circle" height="50" width="50">
                          </td>
                          <td class="nk-tb-col">{{ user.firstName }}</td>
                          <td class="nk-tb-col">{{ user.lastName }}</td>
                          <td class="nk-tb-col">{{ user.gender }}</td>
                          <td class="nk-tb-col">{{ user.phoneNumber }}</td>
                          <td class="nk-tb-col">{{ user.email }}</td>
                          <td class="nk-tb-col">
                            <div class="nk-tb-col nk-tb-col-tools">
                              <ul class="nk-tb-actions gx-1">
                                <li>
                                  <div class="drodown">
                                    <a href="#"
                                       class="dropdown-toggle btn btn-icon btn-trigger"
                                       data-bs-toggle="dropdown">
                                      <i class='bx bx-dots-horizontal'></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-end">
                                      <ul class="link-list-opt no-bdr">
                                        <li>
                                          <router-link :to="`/Edit_User/${user.id}`">
                                            <i class='menu-icon bx bxs-edit-alt'></i>
                                            <span>ແກ້ໄຂ</span>
                                          </router-link>
                                        </li>
                                        <li>
                                          <a @click="deleteUser(user.id)">
                                            <i class='menu-icon bx bxs-trash'></i>
                                            <span>ລຶບ</span>
                                          </a>
                                        </li>
                                      </ul>
                                    </div>
                                  </div>
                                </li>
                              </ul>
                            </div>
                          </td>
                        </tr>
                        <tr v-if="users.length === 0">
                          <td colspan="8" class="text-center">No users found</td>
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
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  name: 'UserList',
  data() {
    return {
      users: [],
      Search: ''
    };
  },
  methods: {
    getImageUrl(imagePath) {
      return `/storage/${imagePath}`;
    },
    fetchUsers() {
      axios.get('/api/users', {
        params: { search: this.Search }
      })
      .then(response => {
        this.users = response.data.users;
      })
      .catch(error => {
        console.error('Error fetching users:', error);
      });
    },
    deleteUser(userId) {
      if (confirm('Are you sure you want to delete this user?')) {
        axios.delete(`/api/users/${userId}`)
          .then(response => {
            if (response.data.message) {
              this.users = this.users.filter(user => user.id !== userId);
              alert('User deleted successfully!');
            } else {
              alert('Failed to delete user.');
            }
          })
          .catch(error => {
            console.error('Error deleting user:', error);
            alert('Failed to delete user.');
          });
      }
    }
  },
  mounted() {
    this.fetchUsers();
  }
};
</script>

<style scoped>
/* Add any scoped styles here */
@media (max-width: 768px) {
  .nk-tb-col {
    font-size: 14px;
    padding: 8px;
  }
}
</style>
