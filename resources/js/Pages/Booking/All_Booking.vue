<template>
  <div>
    <div class="nk-content ">
                    <div class="container-fluid">
                        <div class="nk-content-inner">
                            <div class="nk-content-body">
                                <div class="nk-block-head nk-block-head-sm">
                                    <div class="nk-block-between">
                                        <div class="nk-block-head-content">
                                            <h3 class="nk-block-title page-title">Booking Lists</h3>
                                            <div class="nk-block-des text-soft">
                                                <p>You have total 2,595 booking's.</p>
                                            </div>
                                        </div>
                                        <div class="nk-block-head-content">
                                            <div class="toggle-wrap nk-block-tools-toggle"><a href="#"
                                                    class="btn btn-icon btn-trigger toggle-expand me-n1"
                                                    data-target="pageMenu"><em class="icon ni ni-menu-alt-r"></em></a>
                                                <div class="toggle-expand-content" data-content="pageMenu">
                                                    <ul class="nk-block-tools g-3">
                                                        <li class="nk-block-tools-opt">
                                                            <div class="drodown"><router-link to="/Add_Booking"
                                                                    class=" btn btn-icon btn-primary">
                                                                    <i class='bx bx-plus-medical'></i>
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
                                                <div class="nk-tb-list nk-tb-ulist">
                                                    <div class="nk-tb-item nk-tb-head">
                                                        <div class="nk-tb-col nk-tb-col-check">
                                                            <div
                                                                class="custom-control custom-control-sm custom-checkbox notext">
                                                                <input type="checkbox" class="custom-control-input"
                                                                    id="uid"><label class="custom-control-label"
                                                                    for="uid"></label></div>
                                                        </div>
                                                        <div class="nk-tb-col"><span class="sub-text">ID</span></div>
                                                        <div class="nk-tb-col"><span class="sub-text">Customer</span>
                                                        </div>
                                                        <div class="nk-tb-col tb-col-mb"><span
                                                                class="sub-text">Package</span></div>
                                                        <div class="nk-tb-col tb-col-md"><span
                                                                class="sub-text">Booking</span></div>
                                                        <div class="nk-tb-col tb-col-lg"><span class="sub-text">Room
                                                                Type</span></div>
                                                        <div class="nk-tb-col tb-col-xxl"><span
                                                                class="sub-text">Mobile</span></div>
                                                        <div class="nk-tb-col tb-col-lg"><span
                                                                class="sub-text">Arrive</span></div>
                                                        <div class="nk-tb-col tb-col-xxl"><span
                                                                class="sub-text">Depart</span></div>
                                                        <div class="nk-tb-col tb-col-md"><span
                                                                class="sub-text">Payment</span></div>
                                                        <div class="nk-tb-col nk-tb-col-tools text-end">
                                                            <div class="dropdown"><a href="#"
                                                                    class="btn btn-xs btn-outline-light btn-icon dropdown-toggle"
                                                                    data-bs-toggle="dropdown" data-offset="0,5"><em
                                                                        class="icon ni ni-plus"></em></a>
                                                                <div
                                                                    class="dropdown-menu dropdown-menu-xs dropdown-menu-end">
                                                                    <ul class="link-tidy sm no-bdr">
                                                                        <li>
                                                                            <div
                                                                                class="custom-control custom-control-sm custom-checkbox">
                                                                                <input type="checkbox"
                                                                                    class="custom-control-input"
                                                                                    checked="" id="bo"><label
                                                                                    class="custom-control-label"
                                                                                    for="bo">Booking</label></div>
                                                                        </li>
                                                                        <li>
                                                                            <div
                                                                                class="custom-control custom-control-sm custom-checkbox">
                                                                                <input type="checkbox"
                                                                                    class="custom-control-input"
                                                                                    checked="" id="ph"><label
                                                                                    class="custom-control-label"
                                                                                    for="ph">Phone</label></div>
                                                                        </li>
                                                                        <li>
                                                                            <div
                                                                                class="custom-control custom-control-sm custom-checkbox">
                                                                                <input type="checkbox"
                                                                                    class="custom-control-input"
                                                                                    id="pay"><label
                                                                                    class="custom-control-label"
                                                                                    for="pay">Payment</label></div>
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="nk-tb-item">
                                                        <div class="nk-tb-col nk-tb-col-check">
                                                            <div
                                                                class="custom-control custom-control-sm custom-checkbox notext">
                                                                <input type="checkbox" class="custom-control-input"
                                                                    id="uid1"><label class="custom-control-label"
                                                                    for="uid1"></label></div>
                                                        </div>
                                                        <div class="nk-tb-col"><span class="text-primary">AB-357</span>
                                                        </div>
                                                        <div class="nk-tb-col"><a href="#">
                                                                <div class="user-card">
                                                                    <div class="user-avatar bg-primary"><span>AB</span>
                                                                    </div>
                                                                    <div class="user-info"><span class="tb-lead">Abu Bin
                                                                            Ishtiyak <span
                                                                                class="dot dot-success d-md-none ms-1"></span></span><span>info@softnio.com</span>
                                                                    </div>
                                                                </div>
                                                            </a></div>
                                                        <div class="nk-tb-col tb-col-mb"><span>Continental</span></div>
                                                        <div class="nk-tb-col tb-col-md"><span
                                                                class="tb-status text-success">Active</span></div>
                                                        <div class="nk-tb-col tb-col-lg"><span>Super Delux</span></div>
                                                        <div class="nk-tb-col tb-col-xxl"><span>+811 847-4958</span>
                                                        </div>
                                                        <div class="nk-tb-col tb-col-lg"><span>10 Feb 2020</span></div>
                                                        <div class="nk-tb-col tb-col-xxl"><span>12 Feb 2020</span></div>
                                                        <div class="nk-tb-col tb-col-md"><span
                                                                class="tb-status text-success">Paid</span></div>
                                                        <div class="nk-tb-col nk-tb-col-tools">
                                                            <ul class="nk-tb-actions gx-1">
                                                                <li>
                                                                    <div class="drodown"><a href="#"
                                                                            class="dropdown-toggle btn btn-icon btn-trigger"
                                                                            data-bs-toggle="dropdown">
                                                                            <i class='bx bx-dots-horizontal' ></i></a>
                                                                        <div class="dropdown-menu dropdown-menu-end">
                                                                            <ul class="link-list-opt no-bdr">
                                                                                <li>
                                                                                    <router-link to="Edit_Booking">
                                                                                        <i class='menu-icon bx bxs-edit-alt'></i>
                                                                                        <span>ແກ້ໄຂ</span>
                                                                                        </router-link>
                                                                                </li>
                                                                                <li><a href="#"><i class='menu-icon bx bxs-trash' ></i>
                                                                                <span>ລຶບ</span></a></li>
                                                                            </ul>
                                                                        </div>
                                                                    </div>
                                                                </li>
                                                            </ul>
                                                        </div>
                                
                                                   
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-inner">
                                                <div class="nk-block-between-md g-3">
                                                    <div class="g">
                                                        <ul
                                                            class="pagination justify-content-center justify-content-md-start">
                                                            <li class="page-item"><a class="page-link" href="#">Prev</a>
                                                            </li>
                                                            <li class="page-item"><a class="page-link" href="#">1</a>
                                                            </li>
                                                            <li class="page-item"><a class="page-link" href="#">2</a>
                                                            </li>
                                                            <li class="page-item"><span class="page-link"><em
                                                                        class="icon ni ni-more-h"></em></span></li>
                                                            <li class="page-item"><a class="page-link" href="#">6</a>
                                                            </li>
                                                            <li class="page-item"><a class="page-link" href="#">7</a>
                                                            </li>
                                                            <li class="page-item"><a class="page-link" href="#">Next</a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <div class="g">
                                                        <div
                                                            class="pagination-goto d-flex justify-content-center justify-content-md-start gx-3">
                                                            <div>Page</div>
                                                            <div><select class="form-select js-select2" data-search="on"
                                                                    data-dropdown="xs center">
                                                                    <option value="page-1">1</option>
                                                                    <option value="page-2">2</option>
                                                                    <option value="page-4">4</option>
                                                                    <option value="page-5">5</option>
                                                                    <option value="page-6">6</option>
                                                                    <option value="page-7">7</option>
                                                                    <option value="page-8">8</option>
                                                                    <option value="page-9">9</option>
                                                                    <option value="page-10">10</option>
                                                                    <option value="page-11">11</option>
                                                                    <option value="page-12">12</option>
                                                                    <option value="page-13">13</option>
                                                                    <option value="page-14">14</option>
                                                                    <option value="page-15">15</option>
                                                                    <option value="page-16">16</option>
                                                                    <option value="page-17">17</option>
                                                                    <option value="page-18">18</option>
                                                                    <option value="page-19">19</option>
                                                                    <option value="page-20">20</option>
                                                                </select></div>
                                                            <div>OF 102</div>
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
  </div>
</template>

<script>
export default {
  name: 'FinalProjectAllBooking',

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