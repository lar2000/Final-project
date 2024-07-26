<template>
    <div>
        <!-- Layout Content -->
  <div class="layout-wrapper layout-content-navbar">
  <div class="layout-container">
    
    <MenuSidebar />

    <!-- Layout page -->
    <div class="layout-page">
      <!-- BEGIN: Navbar-->
            <!-- Navbar -->
      <nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme" id="layout-navbar">
    
      <!--  Brand demo (display only for navbar-full and hide on below xl) -->
      
      <!-- ! Not required for layout-without-menu -->
      <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0  d-xl-none ">
        <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
          <i class="bx bx-menu bx-sm"></i>
        </a>
      </div>
      
      <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
        <!-- Search -->
        <div class="navbar-nav align-items-center">
          <div class="nav-item d-flex align-items-center">
            <i class="bx bx-search fs-4 lh-0"></i>
            <input type="text" class="form-control border-0 shadow-none ps-1 ps-sm-2" placeholder="Search..." aria-label="Search...">
          </div>
        </div>
        <!-- /Search -->
        <ul class="navbar-nav flex-row align-items-center ms-auto">

          <!-- Place this tag where you want the button to render. -->
          <li class="menu-item ">
      <router-link to="/Notification" class="icon-link">
      <i class='menu-icon bx bx-bell' type='sold'></i>
            </router-link>
      </li>

          <!-- User -->
          <li class="nav-item navbar-dropdown dropdown-user dropdown">
            <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
              <div class="avatar avatar-online">
                <img src="assets/img/avatars/1.png" alt="" class="w-px-40 h-auto rounded-circle">
              </div>
            </a>
            <ul class="dropdown-menu dropdown-menu-end">
              <li>
                <router-link class="dropdown-item" to="/Account">
                  <div class="d-flex">
                    <div class="flex-shrink-0 me-3">
                      <div class="avatar avatar-online">
                        <img src="assets/img/avatars/1.png" alt="" class="w-px-40 h-auto rounded-circle">
                      </div>
                    </div>
                    <div class="flex-grow-1">
                      <span class="fw-medium d-block">John Doe</span>
                      <small class="text-muted">Admin</small>
                    </div>
                  </div>
                </router-link>
              </li>
              <li>
                <div class="dropdown-divider"></div>
              </li>
              <li>
                <a class="dropdown-item" href="javascript:void(0);">
                  <i class="bx bx-user me-2">
                  </i>
                  <span class="align-middle">My Profile</span>
                  
                </a>
              </li>
             
              <li>
                <div class="dropdown-divider"></div>
              </li>
              <li>
                <a class="dropdown-item" href="javascript:void(0);">
                  <i class='bx bx-power-off me-2'></i>
                  <span class="align-middle">Log Out</span>
                </a>
                
              </li>
            </ul>
          </li>
          <!--/ User -->
        </ul>
      </div>

        </nav>
      <!-- / Navbar -->
            <!-- END: Navbar-->
      <!-- Content wrapper -->
      <div class="content-wrapper">

        <!-- Content -->
          <div class="container-xxl flex-grow-1 container-p-y">
            <router-view></router-view>
          </div>
          <!-- / Content -->

          <!-- Footer -->
                    <!-- Footer-->

          <div class="content-backdrop fade"></div>
        </div>
        <!--/ Content wrapper -->
      </div>
      <!-- / Layout page -->
    </div>

        <!-- Overlay -->
    <div class="layout-overlay layout-menu-toggle"></div>
        <!-- Drag Target Area To SlideIn Menu On Small Screens -->
    <div class="drag-target"></div>
  </div>

  
 
    </div>
</template>

<script>
export default {
    name: 'LaravelVue3App',

    data() {
        return {
          
        };
    },

    mounted() {
        
    },

    methods: {
        
    },
};
</script>

<style lang="scss" scoped>
/* Adjust layout when sidebar is collapsed */
.layout-page {
  margin-left: 240px; /* Adjust to match sidebar width */
}

@media (max-width: 1199.98px) {
  .layout-page {
    margin-left: 0; /* Reset margin for smaller screens */
  }

  /* Hide sidebar when collapsed */
  .layout-wrapper.collapsed .layout-page {
    margin-left: 0;
  }
}
</style>