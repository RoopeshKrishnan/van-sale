<div class="container-fluid py-4">
    <div class="row justify-content-center">
        <div class="col-10">
            <div class="card">
                <div class="card-body">
                    <form id="consolidate_stock_form">
                        <div class="button-row d-flex  ">
                            <h5 class="font-weight-bolder mb-0">consolidate </h5>
                            <button class="px-sm-5 btn bg-gradient-success ms-auto mb-0  " type="submit">Submit</button>
                        </div>
                        <div class=" ">
                            <div class="row mt-3">
                                <div class="col-12 col-sm-6">
                                    <div class="input-group input-group-dynamic">
                                        <label class="form-label bg-white pe-5" style="z-index: 1;">Date </label>
                                        <input class="  form-control" type="date" name="consolidate_stock_date" />
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6 mt-3 mt-sm-0">
                                    <select class="form-control" name="user_id" id="choices-exicutive">
                                        <option value="" selected disabled>Executive</option>
                                        <?php
                                        foreach ($user as $row) {
                                            echo '<option value="' . $row->user_id . '">' . $row->user_name . '</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-12 col-sm-6">
                                    <select class="form-control" name="driver_id" id="choices-driver">
                                        <option value="" selected disabled>Driver</option>
                                        <?php
                                        foreach ($driver as $row) {
                                            echo '<option value="' . $row->driver_id . '">' . $row->driver_name . '</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-12 col-sm-6 mt-3 mt-sm-0">
                                    <select class="form-control" name="vehicle_id" id="choices-vehicle">
                                        <option value="" selected disabled>Vehicle</option>
                                        <?php
                                        foreach ($vehicle as $row) {
                                            echo '<option value="' . $row->vehicle_id . '">' . $row->vehicle_number . '</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>

                        </div>
                </div>
            </div>
        </div>

        <div class="col-12 mt-4">
            <div class="card">
                <div class="card-header pb-0">
                    <div class="d-lg-flex">
                        <div>
                            <h5 class="mb-0"><?=  $area_name ?> Orders</h5>
                        </div>
                        <div class="ms-auto my-auto mt-lg-0 mt-4">
                            <div class="ms-auto my-auto">
                                <button class="btn btn-outline-primary btn-sm export mb-0 mt-sm-0 mt-1" data-type="csv" type="button" name="button">Export</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-flush" id="consolidate-order-convert">
                            <thead class="thead-light">
                                <tr>
                                    <th class="  text-uppercase text-secondary text-xs font-weight-bolder ">sl/no</th>
                                    <th class="  text-uppercase text-secondary text-xs font-weight-bolder ">item</th>
                                    <th class="  text-uppercase text-secondary text-xs font-weight-bolder ">item Stock</th>
                                    <th class="  text-uppercase text-secondary text-xs font-weight-bolder ">Extra Added stock</th>
                                    <th class="  text-uppercase text-secondary text-xs font-weight-bolder ">Total</th>
                                    <th class="  text-uppercase text-secondary text-xs font-weight-bolder "> </th>

                                </tr>
                            </thead>
                            <tbody>
                                <?= $item_rows ?>

                            </tbody>

                        </table>
                    </div>
                    </form>

                    <!-- modal -->
                    <div class="modal fade" id="add-item-stock" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-lg">
                            <div class="modal-content">
                                <form action="">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="ModalLabel">Item Add</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="table-responsive">
                                            <table class="table table-flush">
                                                <thead class="thead-light">
                                                    <tr>
                                                        <th class="text-uppercase text-dark text-xs font-weight-bolder opacity-7 ">Item</th>
                                                        <th class="text-uppercase text-dark text-xs font-weight-bolder opacity-7  ">Item Stock</th>
                                                        <th class="text-uppercase text-dark text-xs font-weight-bolder opacity-7  ">Add Item Stock</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>
                                                            <h6 class="mb-0 text-md" id="item-name"></h6>
                                                        </td>
                                                        <td>
                                                            <h6 class="mb-0 text-md" id="item-stock"></h6>
                                                            <p class="text-xs text-secondary mb-0">unit</p>
                                                        </td>
                                                        <td>
                                                            <div class="input-group input-group-outline">
                                                                <label class="form-label">Add of stock</label>
                                                                <input type="number" class="form-control" id="extra-stock-input">
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn bg-gradient-secondary btn-sm" data-bs-dismiss="modal">Close</button>
                                        <button type="button" class="btn bg-gradient-primary btn-sm" id="add-stock-btn">Add</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- //modal -->

                    <!-- stock cofirmation model -->
                    <div class="modal fade" id="stock_conformation_model" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-md">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="ModalLabel">Stock Conformation</h5>

                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="table-responsive">
                                        <table class="table align-items-center mb-0">
                                            <thead>
                                                <tr>
                                                    <th class="text-uppercase text-dark text-xs font-weight-bolder opacity-7">item</th>
                                                    <th class="text-uppercase text-dark text-xs font-weight-bolder opacity-7">item stock</th>
                                                    <th class="text-uppercase text-dark text-xs font-weight-bolder opacity-7">Net Weight</th>
                                                    <th class="text-secondary opacity-7 "></th>
                                                </tr>
                                            </thead>
                                           <tbody class="tbody">

                                           </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button"  class="btn bg-gradient-secondary btn-sm" data-bs-dismiss="modal">Close</button>
                                    <button type="button" id="stock_conformation_model_button" class="btn bg-gradient-primary btn-sm">Add</button>
                                </div>
                            </div>
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
    if (document.getElementById('consolidate-order-convert')) {
        const dataTableSearch = new simpleDatatables.DataTable("#consolidate-order-convert", {
            searchable: true,
            fixedHeight: false,
            perPage: 7
        });

        document.querySelectorAll(".export").forEach(function(el) {
            el.addEventListener("click", function(e) {
                var type = el.dataset.type;

                var data = {
                    type: type,
                    filename: "consolidate-order-convert" + type,
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
    if (document.getElementById('choices-exicutive')) {
        var element = document.getElementById('choices-exicutive');
        const example = new Choices(element, {
            searchEnabled: false
        });
    };
    if (document.getElementById('choices-driver')) {
        var element = document.getElementById('choices-driver');
        const example = new Choices(element, {
            searchEnabled: false
        });
    };
    if (document.getElementById('choices-vehicle')) {
        var element = document.getElementById('choices-vehicle');
        const example = new Choices(element, {
            searchEnabled: false
        });
    };
</script>