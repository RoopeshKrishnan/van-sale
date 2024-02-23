<div class="container-fluid py-4">
     <div class="row">
         <div class="col-12">
             <div class="card">
                 <div class="card-header pb-0">
                     <div class="d-lg-flex ">
                         <div>
                             <h5 class="mb-0">All Consolidated Stock </h5>
                         </div>
                         <div class="ms-auto my-auto mt-lg-0 mt-4">
                             <div class="ms-auto my-auto">
                                 <button class="btn btn-outline-primary btn-sm export mb-0 mt-sm-0 mt-1" data-type="csv" type="button" name="button">Export</button>
                             </div>
                         </div>
                     </div>
                 </div>
                 <?php 
                    if(!$all_consolidated_orders->num_rows()>0){

                    }else{
                ?>
                 <div class="card-body px-0 pb-0">
                     <div class="table-responsive">
                         <table class="table table-flush" id="all-stockid">
                             <thead class="thead-light">
                                 <tr>
                                     <th class="  text-uppercase text-secondary text-xs font-weight-bolder ">sl/no</th>
                                     <th class="  text-uppercase text-secondary text-xs font-weight-bolder ">Consolidated id</th>
                                     <th class="  text-center text-uppercase text-secondary text-xs font-weight-bolder  ">Area</th>
                                     <th class="  text-center text-uppercase text-secondary text-xs font-weight-bolder  ">Executive</th>
                                     <th class="  text-uppercase text-secondary text-xs font-weight-bolder  ">Date</th>
                                     <th class="  text-uppercase text-secondary "> </th>
                                 </tr>
                             </thead>
                             <tbody>
                             <?php 
                                 $all_consolidated_data = $all_consolidated_orders->result();
                                 $i = 0;
                                 foreach ($all_consolidated_data as $row) {
                                    $i++;
                                ?>
                                 <tr>
                                     <td>
                                         <p class="text-xs font-weight-bold mb-0"><?= $i ?></p>
                                     </td>
                                     <td>
                                         <h6 class="mb-0 text-md"><?= $row->consolidate_orders_id   ?></h6>
                                     </td>
                                     <td class="align-middle text-center">
                                         <span class="text-secondary text-sm font-weight-normal"><?= $row->area ?></span>
                                     </td>
                                     <td>
                                         <p class="text-sm font-weight-bold mb-0"><?= $row->user_name ?></p>
                                     </td>
                                     <td>
                                         <p class="text-sm font-weight-bold mb-0"><?= date('Y-m-d', strtotime($row->created_date)) ?></p>
                                     </td>
                       
                                     <td class="text-sm">
                                         <a href="<?=base_url('consolidated-stocks/view/'.$row->consolidate_orders_id .'/'. urlencode($row->area))?>" data-bs-toggle="tooltip" data-bs-original-title="View Stock">
                                             <i class="material-icons text-primary position-relative text-lg">visibility</i>
                                         </a>
                                         <a href="<?=base_url('all-stock/close-stock/'.$row->consolidate_orders_id)?>" class="mx-3" data-bs-toggle="tooltip" data-bs-original-title="Edit Stock">
                                             <i class="material-icons text-success position-relative text-lg">drive_file_rename_outline</i>
                                         </a>
                                     </td>
                                 </tr>
                                 <?php } ?>
                             </tbody>
                         </table>
                     </div>
                 </div>
             </div>
             <?php } ?>
         </div>
     </div>
 </div>
 <script src="assets/js/plugins/datatables.js"></script>
 <script src="assets/js/plugins/choices.min.js"></script>


 <script>
     if (document.getElementById('all-stockid')) {
         const dataTableSearch = new simpleDatatables.DataTable("#all-stockid", {
             searchable: true,
             fixedHeight: false,
             perPage: 7
         });

         document.querySelectorAll(".export").forEach(function(el) {
             el.addEventListener("click", function(e) {
                 var type = el.dataset.type;

                 var data = {
                     type: type,
                     filename: "all-stockid" + type,
                 };

                 if (type === "csv") {
                     // data.columnDelimiter = "|";
                 }

                 dataTableSearch.export(data);
             });
         });
     };
 </script>