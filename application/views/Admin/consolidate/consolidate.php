<div class="container-fluid py-4">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form action="" id="consolidate_filter_form">
                        <div class="button-row d-flex  ">
                            <h5 class="font-weight-bolder mb-0">Consolidate</h5>
                            <button class="px-sm-5 btn bg-gradient-success ms-auto mb-0  " type="submit">Submit</button>
                        </div>

                        <div class=" ">
                            <div class="row mt-3">
                                <div class="col-12 col-sm-6">
                                    <div class="input-group input-group-dynamic">
                                        <label class="form-label bg-white pe-5" style="z-index: 1;">From Date </label>
                                        <input class="  form-control" type="date" name="consolidate_from_date" />
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6 mt-3 mt-sm-0">
                                    <div class="input-group input-group-dynamic">
                                        <label class="form-label bg-white pe-5" style="z-index: 1;">To Date </label>
                                        <input class="  form-control" type="date" name="consolidate_to_date" />
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-12 col-sm-6">
                                    <select class="form-control " name="consolidate_area_id" id="consolidate_area_id">
                                        <option value="" selected disabled>area</option>
                                        <?php
                                        foreach ($area as $row) {
                                            echo '<option value="' . $row->area_id . '">' . $row->area . '</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-12 col-sm-6 mt-3 mt-sm-0">

                                </div>
                            </div>

                        </div>
                    </form>

                    <form id="convert_to_van_stock_form_id">
                    <div class="card-header px-0 pb-0">
                        <div class="d-lg-flex">
                            <div>
                                <h5 class="mb-0">Customer Item List</h5>
                            </div>
                            <div class="ms-auto my-auto mt-lg-0 mt-4">
                                <div class="ms-auto my-auto">
                                    <button id="consolidate_order_confirm_button_id" class="px-sm-5 btn bg-gradient-warning ms-auto mb-0" type="button">order convert to van stock</button>

                                    <div class="modal fade" id="convert_to_van_stock_success" tabindex="-1" role="dialog" aria-labelledby="modal-notification" aria-hidden="true">
                                        <div class="modal-dialog modal-danger modal-dialog-centered modal-" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h6 class="modal-title font-weight-normal" id="modal-title-notification">Confirmation</h6>
                                                    <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">×</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="py-3 text-center">
                                                        <i class="material-symbols-outlined text-secondary " style="font-size: 4rem;">check_circle</i>
                                                        <h4 class="text-gradient text-danger mt-4">Confirmation</h4>
                                                        <p>order convert to van stock.</p>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button  type="submit" class="btn btn-secondary">Yes </a>
                                                    <button type="button" class="btn btn-outline-info ml-auto" data-bs-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <button class="btn btn-outline-primary btn-sm export mb-0 mt-sm-0 mt-1" data-type="csv" type="button" name="button">Export</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-flush" id="customer-item-list">
                            <thead class="thead-light">
                                <tr>
                                    <th class="  text-uppercase text-secondary text-xs font-weight-bolder ">sl/no</th>
                                    <th class="  text-uppercase text-secondary text-xs font-weight-bolder ">Customer</th>
                                    <th class="  text-uppercase text-secondary text-xs font-weight-bolder ">ob</th>
                                    <?php
                                        foreach ($items as $row) {
                                        ?>
                                    <th class="  text-uppercase text-secondary text-xs font-weight-bolder "><?= $row->item_name ?></th>
                                        <?php } ?>
                                        <th class="  text-uppercase text-secondary text-xs font-weight-bolder ">delete</th>
                                </tr>
                            </thead>
                            <tbody id="consolidate_div" >
                                
                        </table>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<script src="assets/js/plugins/datatables.js"></script>
<script src="assets/js/plugins/choices.min.js"></script>

<script>
    // if (document.getElementById('customer-item-list')) {
    //     const dataTableSearch = new simpleDatatables.DataTable("#customer-item-list", {
    //         searchable: true,
    //         fixedHeight: false,
    //         perPage: 7
    //     });

    //     document.querySelectorAll(".export").forEach(function(el) {
    //         el.addEventListener("click", function(e) {
    //             var type = el.dataset.type;

    //             var data = {
    //                 type: type,
    //                 filename: "user" + type,
    //             };

    //             if (type === "csv") {
    //                 // data.columnDelimiter = "|";
    //             }

    //             dataTableSearch.export(data);
    //         });
    //     });
    // };
</script>


<script>
    if (document.getElementById('choices-area')) {
        var element = document.getElementById('choices-area');
        const example = new Choices(element, {
            searchEnabled: false
        });
    };
</script>