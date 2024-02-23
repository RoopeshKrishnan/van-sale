<div class="container-fluid   py-4">

    <div class="row mb-5">
        <div class="col-12">
            <div class=" mb-5">
                <div class="row mt-n2">
                    <div class="col-12 col-lg-12 m-auto">
                        <form class="" id="item_form">
                            <div class="card mt-2 p-3 border-radius-xl bg-white js-active" data-animation="FadeIn">
                                <div>
                                    <h5 class="font-weight-bolder mb-0">add item</h5>
                                    <div class="button-row d-flex mt-n4 mb-4">
                                        <button class="col-4 btn bg-gradient-success ms-auto mb-0 js-btn-next p-3" type="submit" title="Submit">Submit</button>
                                    </div>
                                </div>
                                <div class="row mt-3 px-2">
                                    <div class="col-12 col-sm-4 ">
                                        <div class="input-group input-group-dynamic  my-3">
                                            <label class="form-label">Item Code</label>
                                            <input type="text" class="form-control" name="item_code" id="item_code">
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-4 ">
                                        <div class="input-group input-group-dynamic  my-3">
                                            <label class="form-label">Item Name</label>
                                            <input type="text" class="form-control" name="item_name" id="item_name">
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-4  ">
                                        <div class="input-group input-group-dynamic  my-3">
                                            <label class="form-label">Bar Code</label>
                                            <input type="text" class="form-control" name="barcode" id="barcode">
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-4 ">
                                        <div class="input-group input-group-dynamic  my-3">
                                            <label class="form-label">HSN Code</label>
                                            <input type="text" class="form-control" name="hsn_code" id="hsn_code">

                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-4 ">
                                        <label class="form-label ">Have Tax </label>
                                        <div class="row">
                                            <div class="col-12 col-sm-6">
                                                <div class="form-check mb-3">
                                                    <input class="form-check-input" type="radio" name="have_tax" id="tax_yes" value="yes">
                                                    <label class="custom-control-label" for="customRadio1">Yes</label>
                                                </div>
                                            </div>
                                            <div class="col-12 col-sm-6 mt-3 mt-sm-0">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="have_tax" id="tax_no" value="no">
                                                    <label class="custom-control-label" for="customRadio2">No</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-4 " id="tax_id_div" >
                                        <div class="form-group  my-3">
                                            <select class="select-box form-control select2" name="tax_id" id="tax_id">
                                                <option value="" selected disabled>Tax Percentage</option>
                                                <?php
                                                foreach ($tax as $row) {
                                                    echo '<option value="' . $row->tax_id . '">' . $row->tax_name . '</option>';
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-4 ">
                                        <div class="form-group  my-3">
                                            <select class="select-box form-control select2" name="i_category_id" id="i_category_id">
                                                <option value="" selected disabled>Category</option>
                                                <?php
                                                foreach ($category as $row) {
                                                    echo '<option value="' . $row->category_id . '">' . $row->category . '</option>';
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-12 col-sm-4 ">
                                        <div class="form-group  my-3">
                                            <select class="select-box form-control select2" name="i_sub_category_id" id="i_sub_category_id">
                                                <option value="" selected disabled>Sub category</option>

                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-12 col-sm-4 ">
                                        <div class="form-group  my-3">
                                            <select class="select-box form-control select2" name="i_category_type_id" id="i_category_type_id">
                                                <option value="" selected disabled> Category type</option>

                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-4 ">
                                        <div class="input-group input-group-dynamic  my-3">
                                            <label class="form-label">Alias Item Code</label>
                                            <input type="text" class="form-control" name="alias_code" id="alias_code">

                                        </div>
                                    </div>

                                    <div class="col-12 col-sm-4 ">
                                        <div class="input-group input-group-dynamic  my-3">
                                            <label class="form-label">Alias Name</label>
                                            <input type="text" class="form-control" name="alias_name" id="alias_name">

                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-4 ">
                                        <div class="input-group input-group-dynamic  my-3">
                                            <label class="form-label">Minimum Sale unit Value</label>
                                            <input type="text" class="form-control" name="item_value" id="item_value">

                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-4 " id="item_unit_div">
                                        <div class="form-group  my-3">
                                            <select class="select-box form-control select2" name="item_unit_id" id="item_unit_id">
                                                <option value="" selected disabled>Minimum Sale unit </option>
                                                <?php
                                                foreach ($item_unit as $row) {
                                                    echo '<option value="' . $row->item_unit_id . '">' . $row->item_unit . '</option>';
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <button type="button" data-bs-toggle="modal" data-bs-target="#item_unit_model" class="ms-1 text-xs text-secondary font-weight-bold border border-secondary rounded-pill px-2 mt-n3">+ Create</button>

                                    </div>

                                    <div class="col-12 col-sm-4 ">
                                        <div class="input-group input-group-dynamic  my-3">
                                            <label class="form-label">Net Weight(Kg)</label>
                                            <input type="text" class="form-control" name="net_weight" id="net_weight">

                                        </div>
                                    </div>

                                    <br>
                                    <div class="col-12 mt-3 ">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" id="status" name="status" checked="">
                                            <label class="form-check-label" for="flexSwitchCheckDefault">Active Or Inactive</label>
                                        </div>
                                    </div>
                                </div>
                            </div><br>
                            <!-- have box or not -->
                            <div class="col-12 col-sm-4 ">
                                <div class="form-check form-switch mt-4">
                                    <input class="form-check-input" type="checkbox" id="have_box" name="have_box" checked="">
                                    <label class="form-check-label" for="flexSwitchCheckDefault">Box item</label>
                                </div>
                            </div>
                            <br>
                            <!-- card box code -->
                            <div class="card mt-2 p-3 border-radius-xl bg-white js-active" id="box_view">
                                <div class="row mt-3 px-2">
                                    <div class="col-12 col-sm-4 ">
                                        <div class="input-group input-group-dynamic  my-3">
                                            <label class="form-label">Item Code</label>
                                            <input type="text" class="form-control" name="box_item_code" id="box_item_code">
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-4 ">
                                        <div class="input-group input-group-dynamic  my-3">
                                            <label class="form-label">Item Name</label>
                                            <input type="text" class="form-control" name="box_item_name" id="box_item_name">
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-4  ">
                                        <div class="input-group input-group-dynamic  my-3">
                                            <label class="form-label">Bar Code</label>
                                            <input type="text" class="form-control" name="box_barcode" id="box_barcode">
                                        </div>
                                    </div>

                                    <div class="col-12 col-sm-4 ">
                                        <div class="input-group input-group-dynamic  my-3">
                                            <label class="form-label">Alias Item Code</label>
                                            <input type="text" class="form-control" name="box_alias_code" id="box_alias_code">
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-4 ">
                                        <div class="input-group input-group-dynamic  my-3">
                                            <label class="form-label">Alias Name</label>
                                            <input type="text" class="form-control" name="box_alias_name" id="box_alias_name">
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-4 ">
                                        <div class="input-group input-group-static">
                                            <label>Minimum Sale unit Value</label>
                                            <input type="text" class="form-control " name="item_box_value" id="item_box_value">

                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-4 " id="box_unit_div">
                                        <div class="form-group  my-3">
                                            <select class="select-box form-control select2" name="box_item_unit_id" id="box_item_unit_id">
                                                <option value="" selected disabled>Box Sale unit </option>
                                                <?php
                                                foreach ($item_unit as $row) {
                                                    echo '<option value="' . $row->item_unit_id . '">' . $row->item_unit . '</option>';
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <button type="button" data-bs-toggle="modal" data-bs-target="#item_unit_model" class="ms-1 text-xs text-secondary font-weight-bold border border-secondary rounded-pill px-2 mt-n3">+ Create</button>
                                    </div>
                                    <div class="col-12 col-sm-4 ">
                                        <div class="input-group input-group-dynamic  my-3">
                                            <label class="form-label">Number of items </label>
                                            <input type="text" class="form-control" name="box_number_of_items" id="box_number_of_items">
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-4 ">
                                        <div class="input-group input-group-static ">
                                            <label>Net Weight(Kg)</label>
                                            <input type="text" class="form-control" name="box_net_weight" id="box_net_weight">

                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-4 ">
                                        <div class="input-group input-group-dynamic  my-3">
                                            <label class="form-label">Total packed weight(Kg)</label>
                                            <input type="text" class="form-control" name="box_total_packed_weight" id="box_total_packed_weight">
                                        </div>
                                    </div>

                                    <br>
                                    <div class="col-12 mt-3 ">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" id="box_status" name="box_status" checked="">
                                            <label class="form-check-label" for="flexSwitchCheckDefault">Active Or Inactive</label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--Item unit Modal -->
    <div class="modal fade" id="item_unit_model" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title font-weight-normal" id="exampleModalLabel">Create Item Unit </h5>
                    <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="item_unit_form" action="">
                        <div class="row mt-3">
                            <div class="col-12 ">
                                <div class="input-group input-group-dynamic">
                                    <label class="form-label">Item unit </label>
                                    <input class="  form-control" name="item_unit" id="item_unit" type="text" />
                                </div>
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn bg-gradient-secondary btn-sm" data-bs-dismiss="modal">Close</button>
                    <button type="button" id="item_unit_add_button" class="btn bg-gradient-primary btn-sm">Add</button>
                </div>
                </form>
            </div>
        </div>
    </div>

</div>

<script src="assets/js/plugins/choices.min.js"></script>

<script>
    if (document.getElementById('tax_id')) {
        var element = document.getElementById('tax_id');
        const example = new Choices(element, {
            searchEnabled: false
        });
    };

    if (document.getElementById('choices-tax-included')) {
        var element = document.getElementById('choices-tax-included');
        const example = new Choices(element, {
            searchEnabled: false
        });
    };
    if (document.getElementById('choices-box-available')) {
        var element = document.getElementById('choices-box-available');
        const example = new Choices(element, {
            searchEnabled: false
        });
    };
</script>