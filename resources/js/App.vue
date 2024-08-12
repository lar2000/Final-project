<template>
  <div>
    <div class="layout-wrapper layout-content-navbar">
      <div class="layout-container">
        <MenuSidebar v-if="store.get_token" />

        <div class="layout-page">
          <nav v-if="store.get_token" class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme" id="layout-navbar">
            <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
              <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
                <i class="bx bx-menu bx-sm"></i>
              </a>
            </div>

            <div class="navbar-nav-right d-flex align-items-center">
              

              <ul class="navbar-nav flex-row align-items-center ms-auto">

                <li>
                  <a class="dropdown-item" href="javascript:void(0);" @click="Loguot()">
                    <i class='menu-icon bx bx-log-out' style="color: crimson;"></i>
                    <span class="align-middle"></span>
                  </a>
                </li>
              </ul>
            </div>
          </nav>

          <div class="content-wrapper">
            <div class="container-xxl flex-grow-1 container-p-y">
  
              <router-view></router-view>
            </div>

            <footer class="content-footer footer bg-footer-theme" v-if="store.get_token">
              <div class="container-xxl d-flex flex-wrap justify-content-between py-2 flex-md-row flex-column">
                <div class="mb-2 mb-md-0">
                  Made with ❤️ by <a href="https://themeselection.com" target="_blank" class="footer-link fw-medium">ThemeSelection</a>
                </div>
                <div class="d-none d-lg-inline-block">
                  <a href="https://themeselection.com/license/" class="footer-link me-4" target="_blank">License</a>
                  <a href="https://themeselection.com/" target="_blank" class="footer-link me-4">More Themes</a>
                  <a href="https://demos.themeselection.com/sneat-bootstrap-html-admin-template/documentation/" target="_blank" class="footer-link me-4">Documentation</a>
                  <a href="https://themeselection.com/support/" target="_blank" class="footer-link d-none d-sm-inline-block">Support</a>
                </div>
              </div>
            </footer>

            <div class="content-backdrop fade"></div>
          </div>
        </div>

        <div class="layout-overlay layout-menu-toggle"></div>
        <div class="drag-target"></div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from 'axios';
import { useStore } from './store/auth';

export default {
  name: 'LaravelVue3App',
  setup() {
    const store = useStore();
    return { store };
  },
  methods: {
    async Loguot() {
      try {
        const response = await axios.get('api/logout', {
          headers: {
            Authorization: 'Bearer ' + this.store.get_token
          }
        });
        if (response.data.success) {
          this.handleLogout();
        }
      } catch (error) {
        if (error.response && error.response.data.message === 'Token has already expired') {
          this.handleLogout();
        } else {
          console.error(error);
        }
      }
    },
    handleLogout() {
      localStorage.removeItem('web_token');
      localStorage.removeItem('user_token');
      this.store.remove_token();
      this.store.remove_user();
      this.$router.push('/Login');
    }
  }
};
</script>

<style lang="scss" scoped>
.layout-page {
  margin-left: 240px;
}

@media (max-width: 1199.98px) {
  .layout-page {
    margin-left: 0;
  }
  .layout-wrapper.collapsed .layout-page {
    margin-left: 0;
  }
}
.dashboard {
    padding: 20px;
    font-family: Arial, sans-serif;
  }
  
  .reports {
    display: flex;
    flex-wrap: wrap;
    gap: 20px;
  }
  
  .report-card {
    background: #ffffff;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    padding: 20px;
    flex: 1 1 calc(33.333% - 20px);
    max-width: calc(33.333% - 20px);
  }
  
  .report-card h2 {
    margin: 0 0 10px;
    font-size: 1.5em;
  }
  
  .report-card p {
    margin: 0;
    font-size: 1.2em;
  }
</style>
