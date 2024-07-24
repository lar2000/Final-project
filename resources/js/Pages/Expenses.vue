<template>
  <div>
    <div class="nk-content">
            <div class="container-fluid">
              <div class="nk-content-inner">
                <div class="nk-content-body">
                  <div class="nk-block-head nk-block-head-sm">
                    <div class="nk-block-between g-3">
                      <div class="nk-block-head-content">
                        <h3 class="nk-block-title page-title">Expenses List</h3>
                        <div class="nk-block-des text-soft">
                          <p>Here is our verious expenses list.</p>
                        </div>
                      </div>
                      <div class="nk-block-head-content">
                        <ul class="nk-block-tools g-3">
                          <li>
                            <div class="drodown">
                              <a
                                data-bs-toggle="modal" href="#add-expenses"
                                class="dropdown-toggle btn btn-icon btn-primary">
                                <i class='bx bx-plus-medical'></i>
                                </a>
                              </div>
                          </li>
                        </ul>
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
                                  class="custom-control custom-control-sm custom-checkbox notext"
                                >
                                  <input
                                    type="checkbox"
                                    class="custom-control-input"
                                    id="uid"
                                  /><label
                                    class="custom-control-label"
                                    for="uid"
                                  ></label>
                                </div>
                              </div>
                              <div class="nk-tb-col">
                                <span class="sub-text">ID</span>
                              </div>
                              <div class="nk-tb-col tb-col-mb">
                                <span class="sub-text">Supplier Name</span>
                              </div>
                              <div class="nk-tb-col tb-col-md">
                                <span class="sub-text">Description</span>
                              </div>
                              <div class="nk-tb-col tb-col-md">
                                <span class="sub-text">Date</span>
                              </div>
                              <div class="nk-tb-col">
                                <span class="sub-text">Amount</span>
                              </div>
                              <div class="nk-tb-col nk-tb-col-tools text-end">
                                <div class="dropdown">
                                  <a
                                    href="#"
                                    class="btn btn-xs btn-outline-light btn-icon dropdown-toggle"
                                    data-bs-toggle="dropdown"
                                    data-offset="0,5"
                                    ><em class="icon ni ni-plus"></em
                                  ></a>
                                  <div
                                    class="dropdown-menu dropdown-menu-xs dropdown-menu-end"
                                  >
                                    <ul class="link-tidy sm no-bdr">
                                      <li>
                                        <div
                                          class="custom-control custom-control-sm custom-checkbox"
                                        >
                                          <input
                                            type="checkbox"
                                            class="custom-control-input"
                                            checked=""
                                            id="xyz"
                                          /><label
                                            class="custom-control-label"
                                            for="xyz"
                                            >XYY Enter</label
                                          >
                                        </div>
                                      </li>
                                      <li>
                                        <div
                                          class="custom-control custom-control-sm custom-checkbox"
                                        >
                                          <input
                                            type="checkbox"
                                            class="custom-control-input"
                                            checked=""
                                            id="easy"
                                          /><label
                                            class="custom-control-label"
                                            for="easy"
                                            >Easy Fix</label
                                          >
                                        </div>
                                      </li>
                                    </ul>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="nk-tb-item">

                            </div>
                            <div class="nk-tb-item">
                              <div class="nk-tb-col nk-tb-col-check">
                                <div
                                  class="custom-control custom-control-sm custom-checkbox notext"
                                >
                                  <input
                                    type="checkbox"
                                    class="custom-control-input"
                                    id="uid11"
                                  /><label
                                    class="custom-control-label"
                                    for="uid11"
                                  ></label>
                                </div>
                              </div>
                              <div class="nk-tb-col">
                                <span class="text-primary">#103482</span>
                              </div>
                              <div class="nk-tb-col tb-col-mb">
                                <span>Buy Best</span>
                              </div>
                              <div class="nk-tb-col tb-col-md">
                                <span>Chai Cover Bill</span>
                              </div>
                              <div class="nk-tb-col tb-col-md">
                                <span>02 Fab 2021</span>
                              </div>
                              <div class="nk-tb-col" data-order="720.20">
                                <span class="tb-amount"
                                  >720.20<span class="currency">USD</span></span
                                >
                              </div>
                              <div class="nk-tb-col nk-tb-col-tools">
                                <ul class="nk-tb-actions gx-1">
                                  <li>
                                    <div class="drodown">
                                      <a
                                        href="#"
                                        class="dropdown-toggle btn btn-icon btn-trigger"
                                        data-bs-toggle="dropdown"
                                        ><i class='bx bx-dots-horizontal' ></i></a>
                                      <div class="dropdown-menu dropdown-menu-end">
                                         <ul class="link-list-opt no-bdr">
                                            <li>
                                              <router-link to="Edit_Booking">
                                                <i class='menu-icon bx bxs-edit-alt'></i>
                                                  <span>ແກ້ໄຂ</span>
                                              </router-link>
                                            </li>
                                          <li><a href="#"><i class='menu-icon bx bxs-trash' >
                                            </i><span>ລຶບ</span></a></li>
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
                                class="pagination justify-content-center justify-content-md-start"
                              >
                                <li class="page-item">
                                  <a class="page-link" href="#">Prev</a>
                                </li>
                                <li class="page-item">
                                  <a class="page-link" href="#">1</a>
                                </li>
                                <li class="page-item">
                                  <a class="page-link" href="#">2</a>
                                </li>
                                <li class="page-item">
                                  <span class="page-link"
                                    ><em class="icon ni ni-more-h"></em
                                  ></span>
                                </li>
                                <li class="page-item">
                                  <a class="page-link" href="#">6</a>
                                </li>
                                <li class="page-item">
                                  <a class="page-link" href="#">7</a>
                                </li>
                                <li class="page-item">
                                  <a class="page-link" href="#">Next</a>
                                </li>
                              </ul>
                            </div>
                            <div class="g">
                              <div
                                class="pagination-goto d-flex justify-content-center justify-content-md-start gx-3"
                              >
                                <div>Page</div>
                                <div>
                                  <select
                                    class="form-select js-select2"
                                    data-search="on"
                                    data-dropdown="xs center"
                                  >
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
                                  </select>
                                </div>
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
      <div class="modal fade" tabindex="-1" role="dialog" id="add-expenses">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <a href="#" class="close" data-bs-dismiss="modal"
            ><em class="icon ni ni-cross-sm"></em
          ></a>
          <div class="modal-body modal-body-md">
            <h5 class="modal-title">Add Expenses</h5>
            <form action="#" class="mt-2">
              <div class="row g-gs">
                <div class="col-md-6">
                  <div class="form-group">
                    <label class="form-label" for="supplier-name">ລະຫັດຜູ້ໃຊ້</label>
                      <select class="form-select js-select2" data-placeholder="Select multiple options">
                        <option value="default_option">Seclect</option>
                        <option value="option_select_gender">ຈອງແລ້ວ</option>
                        <option value="option_select_gender">ຫວ່າງ</option>
                        <option value="option_select_gender">ບໍ່ຫວ່າງ</option>
                      </select>
                 </div>
              </div>         
              <div class="col-md-6">
                <div class="form-group">
                  <label class="form-label" for="supplier-name">ວັນທີເດືອນປີ</label>
                    <div class="form-icon form-icon-right">
                      <em class="icon ni ni-calendar"></em>
              </div>
            <vuejs-datepicker
                v-model="selectedDate" 
                :format="formatDate" 
                input-class="form-control date-picker" 
                placeholder="yyyy-mm-dd">
                </vuejs-datepicker>
              </div>
             </div>
    
                <div class="col-md-6">
                  <div class="form-group">
                    <label class="form-label" for="description"
                      >Description</label
                    ><input
                      type="text"
                      class="form-control"
                      id="description"
                      placeholder="Description"
                    />
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label class="form-label">Date</label>
                    <div class="form-control-wrap">
                      <div class="form-icon form-icon-right">
                        <em class="icon ni ni-calendar"></em>
                      </div>
                      <input
                        type="text"
                        class="form-control date-picker"
                        data-date-format="yyyy-mm-dd"
                        placeholder="yyyy-mm-dd"
                      />
                    </div>
                  </div>
                </div>
                <div class="col-md-12">
                            <div class="form-group">
                              <label class="form-label" for="default-textarea"
                              >ລາຍລະອຽດ</label
                              >
                              <div class="form-control-wrap">
                                <textarea
                                  class="form-control no-resize"
                                  id="default-textarea"
                                >
                             Large text area content</textarea
                                >
                              </div>
                            </div>
                          </div>
                <div class="col-12">
                  <ul class="align-center flex-wrap flex-sm-nowrap gx-4 gy-2">
                    <li>
                      <button class="btn btn-primary">Add Expenses</button>
                    </li>
                    <li>
                      <a href="#" class="link" data-bs-dismiss="modal"
                        >Cancel</a
                      >
                    </li>
                  </ul>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
</template>

<script>

import DatePicker from '@vuepic/vue-datepicker';
import '@vuepic/vue-datepicker/dist/main.css'

export default {
  name: 'FinalProjectExpenese',

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
.form-icon-right .ni-calendar {
  position: absolute;
  right: 10px;
  top: 50%;
  transform: translateY(-50%);
  pointer-events: none;
}
</style>