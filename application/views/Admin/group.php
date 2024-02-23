<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card">

                <div class="card-header pb-0">
                    <div class="d-lg-flex">
                        <div>
                            <h5 class="mb-0">  Group</h5>

                        </div>



                        <div class="ms-auto my-auto mt-lg-0 mt-4">
                            <div class="ms-auto my-auto">

                                <button type="button" class="btn bg-gradient-primary btn-sm mb-0" data-bs-toggle="modal" data-bs-target="#group_model">+&nbsp; Add Group</button> 

                                <div class="modal fade" id="group_model" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-md">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="ModalLabel">Add Group</h5>
                                                
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                            <form id="group_form" action="">
                                                <div class="row mt-3">
                                                    <div class="col-12 ">
                                                        <div class="input-group input-group-dynamic">
                                                            <label class="form-label">Group Name </label>
                                                            <input class="  form-control" name="g_name" id="g_name" type="text" />
                                                        </div>
                                                    </div>
                                                    <div class="col-12  mt-3  ">
                                                        <div class="input-group input-group-dynamic">
                                                            <label class="form-label"> Group Code</label>
                                                            <input class=" form-control" name="g_code" id="g_code" type="text" />
                                                        </div>
                                                    </div>
                                                    <div class="col-12 mt-3 ">
                                                        <div class="form-check form-switch">
                                                            <input class="form-check-input" type="checkbox" id="g_status" name="g_status" checked="">
                                                            <label class="form-check-label" for="flexSwitchCheckDefault">Active Or Inactive</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                </div>  
                                                <div class="modal-footer">
                                                <button type="button" class="btn bg-gradient-secondary btn-sm" data-bs-dismiss="modal">Close</button>
                                                <button type="button" id="group_add_button" class="btn bg-gradient-primary btn-sm">Add</button>
                                                </div>       
                                            </form>
                                            
                                          
                                        </div>
                                    </div>
                                </div>

                                <button class="btn btn-outline-primary btn-sm export mb-0 mt-sm-0 mt-1" data-type="csv" type="button" name="button">Export</button>
                            </div>
                        </div>
                    </div>
                </div>
                <?php if (!$fetch_group->num_rows() > 0) {
                            echo '<p class="text-center font-weight-bold mb-0">No Groups added</p>';
                        } else { ?>
                <div class="card-body px-0 pb-0">
                    <div class="table-responsive">
                        <table class="table table-flush" id="group-list">
                            <thead class="thead-light">
                                <tr>
                                    <th class="  text-uppercase text-secondary  ">sl/no</th>
                                    <th class="  text-uppercase text-secondary  ">Group name</th>
                                    <th class="  text-uppercase text-secondary  ">Group code</th>
                                    <th class="  text-uppercase text-secondary  ">status</th>
                                    <th class="  text-uppercase text-secondary  ">edit / delete</th>

                                </tr>
                            </thead>
                            <tbody>
                                  <?php
                                    $group = $fetch_group->result();
                                    $i = 0;
                                    foreach ($group as $row) {
                                        $i++;
                                        if($row->status == 1){
                                            $status = 'Active';
                                        }else{
                                            $status = 'Inactive';
                                        }
                                    ?>
                                <tr>

                                    <td>
                                      <p class="text-xs font-weight-bold mb-0"><?= $i ?></p>
                                    </td>
                                    <td>
                                       <p class="text-xs font-weight-bold mb-0"><?= $row->customer_group_name ?></p>
                                    </td>
                                    <td>
                                    <p class="text-xs font-weight-bold mb-0"><?= $row->customer_group_code ?></p>
                                    </td>
                                    <td>
                                    <p class="text-xs font-weight-bold mb-0"><?= $status ?></p>
                                    </td>
                                    <td class="text-sm"> 
                                        <a href="javascript:;" class="mx-3" data-bs-toggle="tooltip" data-bs-original-title="Edit product">
                                            <i class="material-icons text-success position-relative text-lg">drive_file_rename_outline</i>
                                        </a>
                                        <a href="javascript:;" data-bs-toggle="tooltip" data-bs-original-title="Delete product">
                                            <i class="material-icons text-danger position-relative text-lg">delete</i>
                                        </a>
                                    </td>
                                </tr>
                                <?php } } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="assets/js/plugins/datatables.js"></script>
<script src="assets/js/plugins/choices.min.js"></script>


<script>
    if (document.getElementById('group-list')) {
        const dataTableSearch = new simpleDatatables.DataTable("#group-list", {
            searchable: true,
            fixedHeight: false,
            perPage: 7
        });

        document.querySelectorAll(".export").forEach(function(el) {
            el.addEventListener("click", function(e) {
                var type = el.dataset.type;

                var data = {
                    type: type,
                    filename: "area" + type,
                };

                if (type === "csv") {
                    // data.columnDelimiter = "|";
                }

                dataTableSearch.export(data);
            });
        });
    };
</script> 