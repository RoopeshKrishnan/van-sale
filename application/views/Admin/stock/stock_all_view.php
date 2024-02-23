 <div class="container-fluid py-4">
     <div class="row">
         <div class="col-12">
             <div class="card">
                 <div class="card-header pb-0">
                     <div class="d-lg-flex ">
                         <div>
                             <h5 class="mb-0">All Stock </h5>
                         </div>
                         <div class="ms-auto my-auto mt-lg-0 mt-4">
                             <div class="ms-auto my-auto">
                                 <button class="btn btn-outline-primary btn-sm export mb-0 mt-sm-0 mt-1" data-type="csv" type="button" name="button">Export</button>
                             </div>
                         </div>
                     </div>
                 </div>
                 <?php 
                    if(!$all_stock->num_rows()>0){

                    }else{
                ?>
                <div class="mb-3">
    <input type="text" class="form-control" id="searchInput" placeholder="Search...">
</div>

                 <div class="card-body px-0 pb-0">
                     <div class="table-responsive">
                         <table class="table table-flush" id="all-stockid">
                             <thead class="thead-light">
                                 <tr>
                                     <th class="  text-uppercase text-secondary text-xs font-weight-bolder ">sl/no</th>
                                     <th class="  text-uppercase text-secondary text-xs font-weight-bolder ">Stock id</th>
                                     <th class="  text-center text-uppercase text-secondary text-xs font-weight-bolder  ">Date</th>
                                     <th class="  text-uppercase text-secondary text-xs font-weight-bolder  ">exicutive</th>
                                     <th class="  text-uppercase text-secondary text-xs font-weight-bolder ">driver</th>
                                     <th class="  text-uppercase text-secondary text-xs font-weight-bolder ">Vehicle</th>
                                     <th class="  text-center text-uppercase text-secondary text-xs font-weight-bolder ">status</th>
                                     <th class="  text-uppercase text-secondary "> </th>
                                 </tr>
                             </thead>
                             <tbody>
                             <?php 
                                 $all_stock_data = $all_stock->result();
                                 $i = 0;
                                 foreach ($all_stock_data as $row) {
                                    $i++;
                                ?>
                                 <tr>
                                     <td>
                                         <p class="text-xs font-weight-bold mb-0"><?= $i ?></p>
                                     </td>
                                     <td>
                                         <h6 class="mb-0 text-md"><?= $row->stock_id  ?></h6>
                                     </td>
                                     <td class="align-middle text-center">
                                         <span class="text-secondary text-sm font-weight-normal"><?= $row->stock_date ?></span>
                                     </td>
                                     <td>
                                         <p class="text-sm font-weight-bold mb-0"><?= $row->user_name ?></p>
                                     </td>
                                     <td>
                                         <p class="text-sm font-weight-bold mb-0"><?= $row->driver_name ?></p>
                                     </td>
                                     <td>
                                         <p class="text-sm font-weight-bold mb-0"><?= $row->vehicle_number ?></p>
                                     </td>
                                     <td class="align-middle text-center text-sm">
                                         <span class="badge badge-sm badge-success">close</span>
                                     </td>
                                     <td class="text-sm">
                                         <a href="<?=base_url('all-stock/view/'.$row->stock_id)?>" data-bs-toggle="tooltip" data-bs-original-title="View Stock">
                                             <i class="material-icons text-primary position-relative text-lg">visibility</i>
                                         </a>
                                         <a href="<?=base_url('all-stock/close-stock/'.$row->stock_id)?>" class="mx-3" data-bs-toggle="tooltip" data-bs-original-title="Edit Stock">
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
    //  if (document.getElementById('all-stockid')) {
    //      const dataTableSearch = new simpleDatatables.DataTable("#all-stockid", {
    //          searchable: true,
    //          fixedHeight: false,
    //          perPage: 7
    //      });

    //      document.querySelectorAll(".export").forEach(function(el) {
    //          el.addEventListener("click", function(e) {
    //              var type = el.dataset.type;

    //              var data = {
    //                  type: type,
    //                  filename: "all-stockid" + type,
    //              };

    //              if (type === "csv") {
    //                  // data.columnDelimiter = "|";
    //              }

    //              dataTableSearch.export(data);
    //          });
    //      });
    //  };
 </script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var searchInput = document.getElementById('searchInput');
        var tableRows = document.querySelectorAll('#all-stockid tbody tr');

        searchInput.addEventListener('input', function () {
            var searchTerm = searchInput.value.toLowerCase();

            tableRows.forEach(function (row) {
                var rowData = row.textContent.toLowerCase();
                if (rowData.includes(searchTerm)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });
    });
</script>
