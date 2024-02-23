<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card">

                <div class="card-header pb-0">
                    <div class="d-lg-flex">
                        <div>
                            <h5 class="mb-0"> Vehicle</h5>

                        </div>



                        <div class="ms-auto my-auto mt-lg-0 mt-4">
                            <div class="ms-auto my-auto">

                                <button type="button" class="btn bg-gradient-primary btn-sm mb-0" data-bs-toggle="modal" data-bs-target="#vehicle_model">+&nbsp; Add Area</button> 

                                <div class="modal fade" id="vehicle_model" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog mt-lg-10">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="ModalLabel">Add Vehicle</h5>
                                                
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                        <form action="" id="vehicle_form" >
                                            <div class="row mt-3">
                                                <div class="col-12 ">
                                                    <div class="input-group input-group-dynamic">
                                                        <label class="form-label">Vehicle Name </label>
                                                        <input class="form-control" type="text" name="v_name" id="v_name" />
                                                    </div>
                                                </div>
                                                <div class="col-12  mt-3  ">
                                                    <div class="input-group input-group-dynamic">
                                                        <label class="form-label">Vehicle Number</label>
                                                        <input class="  form-control" type="text" name="v_number" id="v_number" />
                                                    </div>
                                                </div>
                                                <div class="col-12 mt-3 ">
                                                    <div class="form-check form-switch">
                                                        <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault" name="v_status" checked="">
                                                        <label class="form-check-label" for="flexSwitchCheckDefault">Active Or Inactive</label>
                                                    </div>
                                                </div>
                                            </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn bg-gradient-secondary btn-sm" data-bs-dismiss="modal">Close</button>
                                                <button type="button" id="vehicle_add_button" class="btn bg-gradient-primary btn-sm">Add</button>
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
                <?php if (!$fetch_vehicle->num_rows() > 0) {
                            echo '<p class="text-center font-weight-bold mb-0">No Vehicle added</p>';
                        } else { ?>
                <div class="card-body px-0 pb-0">
                    <div class="table-responsive">
                        <table class="table table-flush" id="vehicle-list">
                            <thead class="thead-light">
                                <tr>
                                    <th class="  text-uppercase text-secondary  ">sl/no</th>
                                    <th class="  text-uppercase text-secondary  ">Vehicle Name</th>
                                    <th class="  text-uppercase text-secondary  ">Vehicle Name</th>
                                    <th class="  text-uppercase text-secondary  ">status</th>
                                    <th class="  text-uppercase text-secondary  ">edit / delete</th>

                                </tr>
                            </thead>
                            <tbody>
                            <?php
                                    $vehicle = $fetch_vehicle->result();
                                    $i = 0;
                                    foreach ($vehicle as $row) {
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
                                       <p class="text-xs font-weight-bold mb-0"><?= $row->vehicle_name ?></p>
                                    </td>
                                    <td>
                                    <p class="text-xs font-weight-bold mb-0"><?= $row->vehicle_number ?></p>
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
                            </tbody>
                    <?php } } ?>
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
    if (document.getElementById('vehicle-list')) {
        const dataTableSearch = new simpleDatatables.DataTable("#vehicle-list", {
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

<script>
    if (document.getElementById('choices-area')) {
        var element = document.getElementById('choices-area');
        const example = new Choices(element, {
            searchEnabled: false
        });
    };
    if (document.getElementById('choices-scheme')) {
        var element = document.getElementById('choices-scheme');
        const example = new Choices(element, {
            searchEnabled: false
        });
    };
</script>