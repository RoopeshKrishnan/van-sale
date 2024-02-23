<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card">

                <div class="card-header pb-0">
                    <div class="d-lg-flex">
                        <div>
                            <h5 class="mb-0"> Driver</h5>
                        </div>

                        <div class="ms-auto my-auto mt-lg-0 mt-4">
                            <div class="ms-auto my-auto">

                                <button type="button" class="btn bg-gradient-primary btn-sm mb-0" data-bs-toggle="modal" data-bs-target="#driver_model">+&nbsp; Add Driver</button>

                                <button class="btn btn-outline-primary btn-sm export mb-0 mt-sm-0 mt-1" data-type="csv" type="button" name="button">Export</button>
                            </div>
                        </div>
                    </div>
                </div>
                <?php if (!$fetch_driver->num_rows() > 0) {
                    echo '<p class="text-center font-weight-bold mb-0">No Driver added</p>';
                } else { ?>
                    <div class="card-body px-0 pb-0">
                        <div class="table-responsive">
                            <table class="table table-flush" id="driver-list">
                                <thead class="thead-light">
                                    <tr>
                                        <th class="  text-uppercase text-secondary  ">sl/no</th>
                                        <th class="  text-uppercase text-secondary  ">Driver name</th>
                                        <th class="  text-uppercase text-secondary  ">code</th>
                                        <th class="  text-uppercase text-secondary  ">status</th>
                                        <th class="  text-uppercase text-secondary  ">edit / delete</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $driver = $fetch_driver->result();
                                    $i = 0;
                                    foreach ($driver as $row) {
                                        $i++;
                                        if ($row->status == 1) {
                                            $status = 'Active';
                                        } else {
                                            $status = 'Inactive';
                                        }
                                    ?>
                                        <tr>


                                            <td>
                                                <p class="text-xs font-weight-bold mb-0"><?= $i ?></p>
                                            </td>
                                            <td>
                                                <p class="text-xs font-weight-bold mb-0"><?= $row->driver_name ?></p>
                                            </td>
                                            <td>
                                                <p class="text-xs font-weight-bold mb-0"><?= $row->driver_code ?></p>
                                            </td>
                                            <td>
                                                <p class="text-xs font-weight-bold mb-0"><?= $status ?></p>
                                            </td>
                                            <td class="text-sm">
                                                <a class="mx-3" type="button" data-bs-toggle="modal" data-bs-target="#driver_add" data-bs-original-title="Edit Driver">
                                                    <i class="material-icons text-success position-relative text-lg">drive_file_rename_outline</i>
                                                </a>
                                                <a href="javascript:;" data-bs-toggle="tooltip" data-bs-original-title="Delete Driver">
                                                    <i class="material-icons text-danger position-relative text-lg">delete</i>
                                                </a>
                                            </td>
                                        </tr>
                                <?php }
                                } ?>
                                </tbody>

                            </table>
                        </div>
                    </div>
                    <div class="modal fade" id="driver_model" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-md">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="ModalLabel">Add Driver</h5>

                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form id="driver_form" action="">
                                        <div class="row mt-3">
                                            <div class="col-12 ">
                                                <div class="input-group input-group-dynamic">
                                                    <label class="form-label">Driver Name </label>
                                                    <input class="  form-control" type="text" name="name" id="name" />
                                                </div>
                                            </div>
                                            <div class="col-12  mt-3  ">
                                                <div class="input-group input-group-dynamic">
                                                    <label class="form-label">Driver Code</label>
                                                    <input class="  form-control" type="text" name="d_code" id="d_code" />
                                                </div>
                                            </div>
                                            <div class="col-12  mt-3  ">
                                                <div class="input-group input-group-dynamic">
                                                    <label class="form-label bg-white " style="z-index: 1;">Driver Expery Date</label>
                                                    <input class="  form-control" type="date" name="driver_expiry_date" id="driver_expiry_date" />
                                                </div>
                                            </div>
                                            <div class="col-12  mt-3  ">
                                                <div class="input-group input-group-dynamic">
                                                    <label class="form-label">Email</label>
                                                    <input class="  form-control" type="email" name="email" id="email" />
                                                </div>
                                            </div>
                                            <div class="col-12  mt-3  ">
                                                <div class="input-group input-group-dynamic">
                                                    <label class="form-label bg-white " style="z-index: 1;">Date Of Birth</label>
                                                    <input class="  form-control" type="date" name="dob" id="dob" />
                                                </div>
                                            </div>
                                            <div class="col-12  mt-3  ">
                                                <div class="input-group input-group-dynamic">
                                                    <label class="form-label">Mobile Number</label>
                                                    <input class="  form-control" type="tel" name="phone" name="phone" />
                                                </div>
                                            </div>
                                            <div class="col-12  mt-3  ">
                                                <div class="input-group input-group-dynamic">
                                                    <label class="form-label">Other Contact Mobile Number</label>
                                                    <input class="  form-control" type="tel" name="o_phone" id="o_phone" />
                                                </div>
                                            </div>
                                            <div class="col-12  mt-3  ">
                                                <div class="input-group input-group-dynamic">
                                                    <label class="form-label">Address</label>
                                                    <input class=" form-control" type="text" name="address" id="address" />
                                                </div>
                                            </div>
                                            <div class="col-12  mt-3  ">
                                                <div class="input-group input-group-dynamic">
                                                    <label class="form-label">Pincode</label>
                                                    <input class="  form-control" type="number" name="pincode" id="pincode" />
                                                </div>
                                            </div>
                                            <div class="col-12 mt-3 ">
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault" name="d_status" checked="">
                                                    <label class="form-check-label" for="flexSwitchCheckDefault">Active Or Inactive</label>
                                                </div>
                                            </div>
                                        </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn bg-gradient-secondary btn-sm" data-bs-dismiss="modal">Close</button>
                                    <button id="driver_add_button" type="button" class="btn bg-gradient-primary btn-sm">Add</button>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
    </div>
</div>
<script src="assets/js/plugins/datatables.js"></script>
<script src="assets/js/plugins/choices.min.js"></script>


<script>
    if (document.getElementById('driver-list')) {
        const dataTableSearch = new simpleDatatables.DataTable("#driver-list", {
            searchable: true,
            fixedHeight: false,
            perPage: 7
        });

        document.querySelectorAll(".export").forEach(function(el) {
            el.addEventListener("click", function(e) {
                var type = el.dataset.type;

                var data = {
                    type: type,
                    filename: "material-" + type,
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