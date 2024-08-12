<template>
  <div class="menu-sidebar-container">
  <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
      <router-link to="" class="app-brand-link">
        <span class="app-brand-text demo menu-text fw-bold ms-2" style="color:cornflowerblue">AMS ຈີເມັ່ງທໍ່</span>
      </router-link>
    </div>
    <div>
      <ul class="menu-inner py-1"> 
        <li class="menu-item" :class="[MainMenu1, MainM1]">
          <a href="javascript:void(0);" class="menu-link menu-toggle" @click="toggleMenu('MainMenu1')">
            <i class='menu-icon bx bx-list-ul'></i>
            <div>ຈັດການຂໍ້ມູນພື້ນຖານ</div>
          </a>
          <ul class="menu-sub" v-show="MainMenu1 === 'open'">
            <li class="menu-item" :class="SubM1_01">
              <router-link to="/Users" class="menu-link" @click="activateSubmenu('MainM1', 1)">
                <div>ຈັດການຂໍ້ມູນຜູ້ໃຊ້</div>
              </router-link>
            </li>
            <li class="menu-item" :class="SubM1_02">
              <router-link to="/Customers" class="menu-link" @click="activateSubmenu('MainM1', 2)">
                <div>ຈັດການຂໍ້ມູນລູກຄ້າ</div>
              </router-link>
            </li>
            <li class="menu-item" :class="SubM1_03">
              <router-link to="/Rooms" class="menu-link" @click="activateSubmenu('MainM1', 3)">
                <div>ຈັດການຂໍ້ມູນຫ້ອງ</div>
              </router-link>
            </li>
            <li class="menu-item" :class="SubM1_04">
              <router-link to="/RoomType" class="menu-link" @click="activateSubmenu('MainM1', 4)">
                <div class="text-truncate">ປະເພດຫ້ອງ ແລະ ລາຄາ</div>
              </router-link>
            </li>
          </ul>
        </li>
        <li class="menu-item" :class="[MainMenu3]">
          <router-link to="/All_Booking" class="menu-link">
            <i class='menu-icon bx bx-bookmark-alt-plus'></i>
            <div>ຈອງຫ້ອງພັກ</div>
          </router-link>
        </li>
        <li class="menu-item" :class="[MainMenu2, MainM2]">
          <a href="javascript:void(0);" class="menu-link menu-toggle" @click="toggleMenu('MainMenu2')">
            <i class='menu-icon bx bx-archive-in'></i>
            <div>ແຈ້ງເຂົ້າ</div>
          </a>
          <ul class="menu-sub" v-show="MainMenu2 === 'open'">
            <li class="menu-item" :class="SubM2_01">
              <router-link to="/checkin" class="menu-link" @click="activateSubmenu('MainM2', 5)">
                <div>ແຈ້ງເຂົ້າ</div>
              </router-link>
            </li>
            <li class="menu-item"  :class="SubM2_02">
              <router-link to="/Payment" class="menu-link" @click="activateSubmenu('MainM2', 6)">
                <div>ຊຳລະຄ່າເຊົ່າ</div>
              </router-link>
            </li>
          </ul>
        </li>
        <li class="menu-item"  :class="[MainMenu6]">
              <router-link to="/checkout" class="menu-link">
                <i class='menu-icon bx bx-archive-out'></i>
                <div>ແຈ້ງອອກ</div>
              </router-link>
            </li>
        <li class="menu-item" :class="[MainMenu4]">
          <router-link to="/Expenses" class="menu-link">
            <i class='menu-icon bx bx-credit-card'></i>
            <div>ຈ່າຍຄ່າອຸປະກອນຕ່າງໆ</div>
          </router-link>
        </li>
        <li class="menu-item" :class="[MainMenu5]">
          <router-link to="/Report" class="menu-link">
            <i class='menu-icon bx bx-spreadsheet'></i>
            <div>ລາຍງານ</div>
          </router-link>
        </li>
      </ul>
    </div>
  </aside>
</div>
</template>

<script>
export default {
  name: 'LaravelVue3MenuSidebar',

  data() {
    return {
      MainMenu1: '',
      MainMenu2: '',
      MainMenu3: '',
      MainMenu4: '',
      MainMenu5: '',
      MainMenu6: '',
      MainM1: '',
      MainM2: '',
      SubM1_01: '',
      SubM1_02: '',
      SubM1_03: '',
      SubM1_04: '',
      SubM2_01: '',
      SubM2_02: '',
    };
  },

  methods: {
    toggleMenu(menu) {
      if (menu === 'MainMenu1') {
        this.MainMenu1 = this.MainMenu1 === 'open' ? '' : 'open';
        this.MainMenu2 = ''; // Close MainMenu2
      } else if (menu === 'MainMenu2') {
        this.MainMenu2 = this.MainMenu2 === 'open' ? '' : 'open';
        this.MainMenu1 = ''; // Close MainMenu1
      }
    },
    activateSubmenu(mainMenu, id) {
      this.MainM1 = '';
      this.MainM2 = '';
      this[mainMenu] = '';
      
      this.SubM1_01 = '';
      this.SubM1_02 = '';
      this.SubM1_03 = '';
      this.SubM1_04 = '';
      this.SubM2_01 = '';
      this.SubM2_02 = '';

      switch (id) {
        case 1:
          this.SubM1_01 = 'active';
          break;
        case 2:
          this.SubM1_02 = 'active';
          break;
        case 3:
          this.SubM1_03 = 'active';
          break;
        case 4:
          this.SubM1_04 = 'active';
          break;
        case 5:
          this.SubM2_01 = 'active';
          break;
        case 6:
          this.SubM2_02 = 'active';
          break;
      }
    }
  }
};
</script>

<style lang="scss" scoped>
.menu-sidebar-container {
  position: fixed;
  top: 0;
  left: 0;
  bottom: 0;
  width: 245px; /* Adjust width as needed */
  overflow-y: auto; /* Enable scrolling if content exceeds height */
}

.layout-menu {
  height: 100%;
}

.menu-inner {
  list-style: none;
  padding-left: 0;
  margin-top: 30px; /* Optional: Adjust top margin */
}

/* Adjust styles for active and hover states as needed */
.menu-item.active {
  background-color: #f0f0f0; /* Active menu item background color */
}


</style>

