<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card">

                <div class="card-header pb-0">
                    <div class="d-lg-flex ">
                        <div>
                            <h5 class="mb-0">Add Stock</h5>
                        </div>
                        <div class="ms-auto my-auto mt-lg-0 mt-4">
                            <div class="ms-auto my-auto">
                                <button class="btn btn-outline-primary btn-sm export mb-0 mt-sm-0 mt-1" data-type="csv" type="button" name="button">Export</button>
                            </div>
                        </div>
                    </div>

                    <div class="d-lg-flex mt-4">
                        <div>
                            <h4 class="mb-2"><?= $stock->stock_id ?></h4>
                        </div>
                        <div class="ms-lg-5">
                            <h4 class="mb-2"><?= $stock->stock_date ?></h4>
                        </div>
                        <div class="ms-lg-5">
                            <h4 class="mb-2"><?= $stock->user_name ?></h4>
                        </div>
                        <div class="ms-lg-5">
                            <h4 class="mb-2"><?= $stock->driver_name ?></h4>
                        </div>
                        <div class="ms-lg-5">
                            <h4 class="mb-2"><?= $stock->vehicle_number ?></h4>
                        </div>

                    </div>
                </div>
                <div class="card-body px-0 pb-0">
                    <form id="item_filter_form">
                        <div class="d-lg-flex ms-4 mt-4">
                        <input type="hidden" name="stock_id" value="<?= $stock->stock_id ?>">
                            <div class="col-8 col-md-3 mb-2">
                                <select class="select-box form-control select2" name="s_category_id" id="s_category_id">
                                    <option value="" selected disabled>Category</option>
                                    <!-- <?php
                                    // foreach ($category as $row) {
                                    //     echo '<option value="' . $row->category_id . '">' . $row->category . '</option>';
                                    // }
                                    ?> -->
                                </select>
                            </div>
                            <div class="col-8 col-md-3 ms-lg-5 mb-2">
                                <select class="select-box form-control select2" name="s_sub_category_id" id="s_sub_category_id">
                                    <option value="" selected disabled>Sub category</option>
                                </select>
                            </div>
                            <div class="col-8 col-md-3 ms-lg-5 mb-2">
                                <select class="select-box form-control select2" name="s_category_type_id" id="s_category_type_id">
                                    <option value="" selected disabled> Category type</option>
                                </select>
                            </div>
                        </div>
                        <div class="button-row d-flex mt-4 me-3">
                            <button class="ms-auto mb-0 px-4 btn btn-outline-dark btn-sm" type="submit" title="submit">Submit</button>
                        </div>
                    </form>
                    <div id="">
                        <form id="stock_update_form">
                            <div class="table-responsive" id="">
                                <table class="table table-flush" id="add-stock">
                                    <thead class="thead-light">
                                        <tr>
                                            <th class="  text-uppercase text-secondary text-xs font-weight-bolder ">sl/no</th>
                                            <th class="  text-uppercase text-secondary text-xs font-weight-bolder w-50">Item</th>
                                            <th class="  text-uppercase text-secondary text-xs font-weight-bolder ">Add of stock</th>

                                        </tr>
                                    </thead>
                                    <tbody id="item_table_id">
                                        <?php
                                        $i = 0;
                                        foreach ($stock_item_data as $row) {
                                            $i++; ?>
                                            <tr>
                                                <td>
                                                    <p class="text-xs font-weight-bold mb-0"><?= $i ?></p>
                                                </td>
                                                <td>
                                                    <h6 class="mb-0 text-md"><?= $row->item_name ?></h6>
                                                </td>
                                                <td>
                                                    <div class="input-group input-group-outline">
                                                        <label class="form-label">Add of stock</label>
                                                        <input type="number" name="number_of_stock[]" value="<?= $row->number_of_stock ?>" class="form-control">
                                                        <input type="hidden" name="add_stock_id[]" value="<?= $row->add_stock_id ?>">
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php }
                                        ?>
                                    </tbody>
                                </table>
                                <div class="button-row d-flex">
                                    <button class="ms-auto mb-4 me-4 px-6 btn bg-gradient-dark w-25 px-5" type="submit" title="submit" data-bs-toggle="modal" data-bs-target="#stock-conformatiom">Next</button>
                                </div>
                            </div>
                        </form>
                        <!-- rendering div close -->
                    </div>
                    <!-- model -->
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
    if (document.getElementById('add-stock')) {
        const dataTableSearch = new simpleDatatables.DataTable("#add-stock", {
            searchable: true,
            fixedHeight: false,
            perPage: 7
        });

        document.querySelectorAll(".export").forEach(function(el) {
            el.addEventListener("click", function(e) {
                var type = el.dataset.type;

                var data = {
                    type: type,
                    filename: "add-stock" + type,
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
    if (document.getElementById('choices-category')) {
        var element = document.getElementById('choices-category');
        const example = new Choices(element, {
            searchEnabled: false
        });
    };
    if (document.getElementById('choices-subcategory1')) {
        var element = document.getElementById('choices-subcategory1');
        const example = new Choices(element, {
            searchEnabled: false
        });
    };
    if (document.getElementById('choices-subcategory2')) {
        var element = document.getElementById('choices-subcategory2');
        const example = new Choices(element, {
            searchEnabled: false
        });
    };
</script>