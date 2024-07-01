<template>
    <div>
      <div class="card mb-4">
        <h5 class="card-header">Profile Details</h5>
        <!-- Account -->
        <div class="card-body">
          <div class="d-flex align-items-start align-items-sm-center gap-4">
            <img src="assets/img/avatars/1.png" alt="user-avatar" class="d-block rounded" height="100" width="100" id="uploadedAvatar">
            <div class="button-wrapper">
              <label for="upload" class="btn btn-primary me-2 mb-4" tabindex="0">
                <span class="d-none d-sm-block">Upload new photo</span>
                <i class="bx bx-upload d-block d-sm-none"></i>
                <input type="file" id="upload" class="account-file-input" hidden="" accept="image/png, image/jpeg">
              </label>
              <button type="button" class="btn btn-label-secondary account-image-reset mb-4">
                <i class="bx bx-reset d-block d-sm-none"></i>
                <span class="d-none d-sm-block">Reset</span>
              </button>
  
              <p class="text-muted mb-0">Allowed JPG, GIF or PNG. Max size of 800K</p>
            </div>
          </div>
        </div>
        <hr class="my-0">
        <div class="card-body">
          <form id="formAccountSettings" method="POST" onsubmit="return false">
            <div class="row">
              <div class="mb-3 col-md-6">
                <label for="firstName" class="form-label">ຊື່</label>
                <input class="form-control" type="text" id="firstName" name="firstName" placeholder="name" autofocus="">
              </div>
              <div class="mb-3 col-md-6">
                <label for="lastName" class="form-label">ນາມສະກຸນ</label>
                <input class="form-control" type="text" name="lastName" id="lastName" placeholder="Lastname">
              </div>
              <div class="mb-3 col-md-6">
                <label for="email" class="form-label">E-mail</label>
                <input class="form-control" type="text" id="email" name="email"  placeholder="john.doe@example.com">
              </div>
              <div class="mb-3 col-md-6">
                <label class="form-label" for="phoneNumber">Phone Number</label>
                <div class="input-group input-group-merge">
                
                  <input type="text" id="phoneNumber" name="phoneNumber" class="form-control" placeholder="020 xxxxxxxx">
                </div>
              </div>
              <div class="mb-3 col-md-6">
                <label for="address" class="form-label">ທີ່ຢູ່</label>
                <input type="text" class="form-control" id="address" name="address" placeholder="Address">
              </div>
              <div class="mb-3 col-md-6">
                <label for="state" class="form-label">State</label>
                <input class="form-control" type="text" id="state" name="state" placeholder="California">
              </div>
              <div class="mb-3 col-md-6">
                <label for="zipCode" class="form-label">Zip Code</label>
                <input type="text" class="form-control" id="zipCode" name="zipCode" placeholder="231465" maxlength="6">
              </div>
              <div class="mb-3 col-md-6">
                <label class="form-label" for="province">ແຂວງ</label>
                <select id="province" class="select2 form-select">
                  <option value="ct" placeholder="">ນະຄອນຫຼວງ</option>
                  <option value="phong">ຜົ້ງສາລີ</option>
                  <option value="luangnamtha">ຫຼວງນໍ້ທາ</option>
                  <option value="xay">ໄຊຍະບູລີ</option>
                  <option value="oud">ອຸດົມໄຊ</option>
                  <option value="hou">ຫົວພັນ</option>
                  <option value="luangprabang">ຫຼວງພະບາງ</option>
                  <option value="xieng">ຊຽງຂວາງ</option>
                  <option value="xaysom">ໄຊສົມບູນ</option>
                  <option value="vi">ວຽງຈັນ</option>
                  <option value="bor">ບໍລິຄຳໄຊ</option>
                  <option value="kham">ຄຳມ່ວນ</option>
                  <option value="xavan">ສະຫວັນນະເຂດ</option>
                  <option value="xaravan">ສາລະວັນ</option>
                  <option value="Korea">ອັດຕະປື</option>
                  <option value="xekong">ເຊກອງ</option>
                  <option value="champa">ຈຳປາສັກ</option>
                </select>
              </div>
              <div class="mb-3 col-md-6">
                <label for="ct" class="form-label">ເມືອງ</label>
                <select id="ct" class="select2 form-select">
                  <option value="ct">ຈັນທະບູລີ</option>
                  <option value="ct">ສີໂຄດຕະບອງ</option>
                  <option value="ct">ໄຊເສດຖາ</option>
                  <option value="ct">ສີສັດຕະນາກ</option>
                  <option value="ct">ນາຊາຍທອງ</option>
                  <option value="ct">ໄຊທານີ</option>
                  <option value="ct">ຫາດຊາຍຟອງ</option>
                  <option value="ct">ສັງທອງ</option>
                  <option value="ct">ປາກງື່ມ</option>

                  <option value="phong">ຜົ້ງສາລີ</option>
                  <option value="phong">ໃໝ່</option>
                  <option value="phong">ບຸນເໜືອ</option>
                  <option value="phong">ສຳພັນ</option>
                  <option value="phong">ຍອດອູ</option>
                  <option value="phong">ໄຊທານີ</option>
                  <option value="phong">ບຸນໃຕ້</option>
                </select>
              </div>
            
              <div class="mb-3 col-md-6">
                <label for="currency" class="form-label">ບ້ານ</label>
                <input type="text" class="form-control" id="zipCode" name="zipCode" placeholder="ບ້ານ" maxlength="6">
              </div>
            </div>
            <div class="mt-2">
              <button type="submit" class="btn btn-primary me-2">Save changes</button>
              <button type="reset" class="btn btn-label-secondary">Cancel</button>
            </div>
          </form>
        </div>
        <!-- /Account -->
      </div>
    </div>
  </template>
  
  <script>
  export default {
    name: 'LaravelVue3Account',
  
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
  
  <style scoped>
  
  </style>