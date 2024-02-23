 <div class="container-fluid py-4">
     <div class="row">
         <div class="col-12">
             <div class="card min-vh-75">
                 <div class="card-header pb-0">
                     <div class="d-flex ">
                         <div>
                             <h5 class="mb-0">Customer Order</h5>
                         </div>
                         <div class="ms-auto my-auto mt-lg-0 " id="customer_order_confirmation_button_div" >
                             <div class="ms-auto my-auto me-3">
                                 <button id="customer_order_confirmation_button" class="btn btn-success btn-md   mb-0 mt-sm-0 mt-1 px-sm-7" type="button" name="button">submit</button>
                             </div>
                         </div>
                     </div>

                     <div class="d-lg-flex ms-4 mt-2">
                         <div class="col-8 col-md-6 col-lg-4 mt-3 mb-2">
                             <select class="form-control " name="order_area_id" id="order_area_id">
                                 <option value="" selected disabled>area</option>
                                 <?php
                                    foreach ($area as $row) {
                                        echo '<option value="' . $row->area_id . '">' . $row->area . '</option>';
                                    }
                                    ?>
                             </select>
                         </div>

                         <div class="col-8 col-md-6 col-lg-4 ms-lg-5 mt-3 mb-2">
                             <div class="col-8 col-md-3 ms-lg-5 mb-2">
                                 <select class="select-box form-control select2" name="order_customer_id" id="order_customer_id">
                                     <option value="" selected disabled>Customer</option>
                                 </select>
                             </div>
                         </div>

                     </div>

                     <div class="d-lg-flex ms-md-1 mt-5" id="customer_details_div">

                     </div>
                 </div>
                 <div class="card-body mt-4">




                     <div class="  border-radius-xl bg-white" id="order_details_div">
                         <div class="d-lg-flex ">
                             <div>
                                 <h5 class="mb-0"> Order Details</h5>
                             </div>
                         </div>
                         <div class=" ">
                             <form id="customer_order_from" method="post">
                                 <div class="row mt-3">
                                     <div class="col-12 col-sm-6">
                                         <div class="input-group input-group-dynamic">
                                             <label class="form-label bg-white pe-2" style="z-index: 1;">Order Date</label>
                                             <input class="form-control" name="order_date" type="date" value="<?php echo date('Y-m-d'); ?>" />
                                         </div>
                                     </div>
                                     <div class="col-12 col-sm-6 mt-3 mt-sm-0">
                                         <div class="input-group input-group-dynamic">
                                             <label class="form-label bg-white " style="z-index: 1;">Delivery Date</label>
                                             <input class="form-control" name="delivery_date" type="date" />
                                         </div>
                                     </div>
                                 </div>
                                 <div class="row mt-3">
                                     <div class="col-12 col-sm-6">
                                         <select class="form-control " name="order_type_id" id="order_type_id">
                                             <option value="" selected disabled>Order type</option>
                                             <?php
                                                foreach ($order_type as $row) {
                                                    echo '<option value="' . $row->order_type_id . '">' . $row->order_type . '</option>';
                                                }
                                                ?>
                                         </select>
                                     </div>
                                     <div class="col-12 col-sm-6 mt-3 mt-sm-0">
                                         <div class="input-group input-group-dynamic">
                                             <label class="form-label">Remark</label>
                                             <input class=" form-control" name="order_remark" type="text" />
                                         </div>
                                     </div>
                                 </div>
                         </div>
                     </div>
                     <!-- <input type="hidden" name="customer_id" value=" " > -->

                     <div class="d-flex mt-5 "  >
                         <div id="customer_order_confirmation_div1">
                             <h5 class="mb-0">Ordered item</h5>
                         </div>
                         <div class="ms-auto my-auto mt-lg-0  ">
                             <div class="ms-auto my-auto me-3">
                                 <button type="submit" class="btn bg-gradient-primary btn-sm mb-0" data-bs-toggle="modal" data-bs-target="#add-itemm">+&nbsp; Add item </button>
                             </div>
                         </div>
                     </div>
                     </form>

                     <div class="card-body p-0 my-3 " id="customer_order_confirmation_div" >

                         <div class="table-responsive">
                             <table class="table table-flush" id="add-item-view">
                                 <thead class="thead-light">
                                     <tr>
                                         <th class="text-uppercase text-secondary text-xs font-weight-bolder ">sl/no</th>
                                         <th class="text-uppercase text-dark text-xs font-weight-bolder opacity-7 ">item</th>
                                         <th class="text-uppercase text-dark text-xs font-weight-bolder opacity-7  ">Ordered item</th>
                                         <th class="text-secondary opacity-7 ">remove item</th>
                                     </tr>
                                 </thead>
                                 <tbody>

                                     <tr>
                                         <td>
                                             <p class="text-xs font-weight-bold mb-0">3</p>
                                         </td>
                                         <td class="">
                                             <h6 class="mb-0 text-md">item item item</h6>
                                         </td>
                                         <td>
                                             <h6 class="mb-0 text-md"> Ordered item</h6>
                                             <p class="text-xs text-secondary mb-0">unit</p>
                                         </td>
                                         <td>
                                             <a class="mx-3" type="button" data-bs-toggle="modal" data-bs-target="#add-item-edit" data-bs-original-title="Edit item">
                                                 <i class="material-icons text-success position-relative text-lg">drive_file_rename_outline</i>
                                             </a>
                                             <a href="javascript:;" data-bs-toggle="tooltip" data-bs-original-title="Delete item ">
                                                 <i class="material-icons text-danger position-relative text-lg">delete</i>
                                             </a>
                                         </td>
                                     </tr>
                                 </tbody>
                             </table>
                         </div>
                     </div>

                     <!-- modal -->
                     <div class=" modal fade" id="customer_order_add_item" tabindex="-1" aria-hidden="true">
                         <div class="modal-dialog modal-dialog-centered modal-lg ">
                             <div class="modal-content ">
                                 <form id="customer_item_order_form">
                                     <div class="modal-header">
                                         <h5 class="modal-title" id="ModalLabel">item add</h5>

                                         <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                     </div>
                                     <div class="modal-body">
                                         <div class="table-responsive">
                                             <table class="table table-flush" id="item-add">
                                                 <thead class="thead-light">
                                                     <tr>
                                                         <th class="text-uppercase text-secondary text-xs font-weight-bolder ">sl/no</th>
                                                         <th class="text-uppercase text-dark text-xs font-weight-bolder opacity-7 ">item</th>
                                                         <th class="text-uppercase text-dark text-xs font-weight-bolder opacity-7  ">Add item</th>

                                                     </tr>
                                                 </thead>
                                                 <tbody>
                                                     <?php
                                                        $i = 0;
                                                        foreach ($item as $row) {
                                                            $i++; ?>
                                                         <tr>
                                                             <td>
                                                                 <p class="text-xs font-weight-bold mb-0"><?= $i ?></p>
                                                             </td>
                                                             <td class="">
                                                                 <h6 class="mb-0 text-md"><?= $row->item_name ?></h6>
                                                             </td>
                                                             <td>
                                                                 <div class="input-group input-group-outline">
                                                                     <label class="form-label">Add of stock</label>
                                                                     <input type="number" name="customer_item_order[]" class="form-control">
                                                                     <input type="hidden" name="item_id[]" value="<?= $row->item_id ?>">

                                                                 </div>
                                                             </td>
                                                         </tr>
                                                     <?php }
                                                        ?>
                                                 </tbody>
                                             </table>
                                         </div>
                                     </div>
                                     <div class="modal-footer">
                                         <button type="button" class="btn bg-gradient-secondary btn-sm" data-bs-dismiss="modal">Close</button>
                                         <button type="submit" id="customer_item_order_model_button" class="btn bg-gradient-primary btn-sm">Add</button>
                                     </div>
                                 </form>
                             </div>
                         </div>
                     </div>
                     <!-- //modal -->

                     <!-- modal -->
                     <div class=" modal fade" id="add-item-edit" tabindex="-1" aria-hidden="true">
                         <div class="modal-dialog modal-dialog-centered modal-lg ">
                             <div class="modal-content ">
                                 <form action="">
                                     <div class="modal-header">
                                         <h5 class="modal-title" id="ModalLabel">item add</h5>

                                         <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                     </div>
                                     <div class="modal-body">
                                         <div class="table-responsive">
                                             <table class="table table-flush">
                                                 <thead class="thead-light">
                                                     <tr>
                                                         <th class="text-uppercase text-dark text-xs font-weight-bolder opacity-7 ">item</th>
                                                         <th class="text-uppercase text-dark text-xs font-weight-bolder opacity-7  ">item stock</th>
                                                         <th class="text-uppercase text-dark text-xs font-weight-bolder opacity-7  ">Add item</th>

                                                     </tr>
                                                 </thead>
                                                 <tbody>
                                                     <tr>
                                                         <td class="">
                                                             <h6 class="mb-0 text-md"> item</h6>
                                                         </td>
                                                         <td>
                                                             <h6 class="mb-0 text-md"> item stock</h6>
                                                             <p class="text-xs text-secondary mb-0">unit</p>
                                                         </td>
                                                         <td>
                                                             <div class="input-group input-group-outline">
                                                                 <label class="form-label">Add of stock</label>
                                                                 <input type="number" class="form-control">
                                                             </div>
                                                         </td>
                                                     </tr>
                                                 </tbody>
                                             </table>
                                         </div>
                                     </div>
                                     <div class="modal-footer">
                                         <button type="button" class="btn bg-gradient-secondary btn-sm" data-bs-dismiss="modal">Close</button>
                                         <button type="button" class="btn bg-gradient-primary btn-sm">Add</button>
                                     </div>
                                 </form>
                             </div>
                         </div>
                     </div>
                     <!-- //modal -->
                 </div>
             </div>
         </div>
     </div>
 </div>
 <script src="assets/js/plugins/datatables.js"></script>
 <script src="assets/js/plugins/choices.min.js"></script>


 <script>
     if (document.getElementById('add-item-view')) {
         const dataTableSearch = new simpleDatatables.DataTable("#add-item-view", {
             searchable: true,
             fixedHeight: false,
             perPage: 7
         });
     };

     if (document.getElementById('item-add')) {
         const dataTableSearch = new simpleDatatables.DataTable("#item-add", {
             searchable: true,
             fixedHeight: false,
             perPage: 7
         });
     };
 </script>


 <script>
     if (document.getElementById('choices-area')) {
         var element = document.getElementById('choices-area');
         const example = new Choices(element, {
             searchEnabled: true,
             shouldSort: false
         });
     };

     if (document.getElementById('choices-customer')) {
         var element = document.getElementById('choices-customer');
         const example = new Choices(element, {
             searchEnabled: true,
             shouldSort: false
         });
     };

     if (document.getElementById('choices-ordertype')) {
         var element = document.getElementById('choices-ordertype');
         const example = new Choices(element, {
             searchEnabled: true,
             shouldSort: false
         });
     };
 </script>