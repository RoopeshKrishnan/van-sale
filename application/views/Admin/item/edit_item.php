<div class="container-fluid  ">
    <div class="row">
        <div class="col-12">

            <div class="row pt-4">
                <div class="col-12 col-lg-11 m-auto ">
                    <div class="card">
                        <div class="card-body">
                            <form class=" " id="item_edit_form">
                                <div class="  border-radius-xl bg-white ">
                                    <h5 class="font-weight-bolder mb-0">Edit Item </h5>
                                    <div class=" ">
                                        <input type="hidden" name="selected_item_id" value="<?= $item->item_id ?>">
                                        <input type="hidden" name="is_box_item" value="<?= $item->is_box_item ?>">

                                        <div class="row mt-3 px-2">
                                            <div class="col-12 col-sm-4 ">
                                                <div class="input-group input-group-dynamic  my-3">
                                                    <label class="form-label">Item Code</label>
                                                    <input type="text" class="form-control" name="item_code" id="item_code" value="<?= set_value('item_code', $item->item_code) ?>">
                                                </div>
                                            </div>
                                            <div class="col-12 col-sm-4 ">
                                                <div class="input-group input-group-dynamic  my-3">
                                                    <label class="form-label">Item Name</label>
                                                    <input type="text" class="form-control" name="item_name" id="item_name" value="<?= set_value('item_name', $item->item_name) ?>">
                                                </div>
                                            </div>
                                            <div class="col-12 col-sm-4  ">
                                                <div class="input-group input-group-dynamic  my-3">
                                                    <label class="form-label">Bar Code</label>
                                                    <input type="text" class="form-control" name="barcode" id="barcode" value="<?= set_value('barcode', $item->bar_code) ?>">
                                                </div>
                                            </div>
                                            <div class="col-12 col-sm-4 ">
                                                <div class="input-group input-group-dynamic  my-3">
                                                    <label class="form-label">HSN Code</label>
                                                    <input type="text" class="form-control" name="hsn_code" id="hsn_code" value="<?= set_value('hsn_code', $item->hsn_code) ?>">

                                                </div>
                                            </div>
                                            <div class="col-12 col-sm-4 ">
                                                <div class="form-group  my-3">
                                                    <select class="select-box form-control select2" name="tax_id" id="tax_id">
                                                        <option value="" selected disabled>Tax Percentage</option>
                                                        <?php
                                                        foreach ($tax as $row) {
                                                            echo '<option value="' . $row->tax_id . '" ';
                                                            if ($row->tax_id == $item->tax_id) {
                                                                echo "selected";
                                                            }
                                                            echo ' >' . $row->tax_name . '</option>';
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
                                                            echo '<option value="' . $row->category_id . '" ';
                                                            if ($row->category_id == $item->category_id) {
                                                                echo "selected";
                                                            }
                                                            echo ' >' . $row->category . '</option>';
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-12 col-sm-4 ">
                                                <div class="form-group  my-3">
                                                    <select class="select-box form-control select2" name="i_sub_category_id" id="i_sub_category_id">
                                                        <option value="" selected disabled>Sub category</option>
                                                        <?php
                                                        foreach ($sub_category as $row) {
                                                            echo '<option value="' . $row->sub_category_id . '" ';
                                                            if ($row->sub_category_id == $item->sub_category_id) {
                                                                echo "selected";
                                                            }
                                                            echo ' >' . $row->sub_category . '</option>';
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-12 col-sm-4 ">
                                                <div class="form-group  my-3">
                                                    <select class="select-box form-control select2" name="i_category_type_id" id="i_category_type_id">
                                                        <option value="" selected disabled> Category type</option>
                                                        <?php
                                                        foreach ($category_type as $row) {
                                                            echo '<option value="' . $row->category_type_id . '" ';
                                                            if ($row->category_type_id == $item->category_type_id) {
                                                                echo "selected";
                                                            }
                                                            echo ' >' . $row->category_type . '</option>';
                                                        }
                                                        ?>

                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-12 col-sm-4 ">
                                                <div class="input-group input-group-dynamic  my-3">
                                                    <label class="form-label">Alias Item Code</label>
                                                    <input type="text" class="form-control" name="alias_code" id="alias_code" value="<?= set_value('alias_code', $item->alias_item_code) ?>">

                                                </div>
                                            </div>

                                            <div class="col-12 col-sm-4 ">
                                                <div class="input-group input-group-dynamic  my-3">
                                                    <label class="form-label">Alias Name</label>
                                                    <input type="text" class="form-control" name="alias_name" id="alias_name" value="<?= set_value('alias_name', $item->alias_name) ?>">

                                                </div>
                                            </div>
                                            <div class="col-12 col-sm-4 ">
                                                <div class="input-group input-group-dynamic  my-3">
                                                    <label class="form-label">Minimum Sale unit Value</label>
                                                    <input type="text" class="form-control" name="item_value" id="item_value" value="<?= set_value('item_value', $item->minimum_sale_unit_value) ?>">

                                                </div>
                                            </div>
                                            <div class="col-12 col-sm-4 " id="item_unit_div">
                                                <div class="form-group  my-3">
                                                    <select class="select-box form-control select2" name="item_unit_id" id="item_unit_id">
                                                    <?php
                                                        foreach ($item_unit as $row) {
                                                            echo '<option value="' . $row->item_unit_id . '" ';
                                                            if ($row->item_unit_id == $item->minimum_sale_unit_id) {
                                                                echo "selected";
                                                            }
                                                            echo ' >' . $row->item_unit . '</option>';
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                                <!-- <button type="button" data-bs-toggle="modal" data-bs-target="#item_unit_model" class="ms-1 text-xs text-secondary font-weight-bold border border-secondary rounded-pill px-2 mt-n3">+ Create</button> -->
                                            </div>
                                            <div class="col-12 col-sm-4 ">
                                                <div class="input-group input-group-dynamic  my-3">
                                                    <label class="form-label">Net Weight(Kg)</label>
                                                    <input type="text" class="form-control" name="net_weight" id="net_weight" value="<?= set_value('net_weight', $item->net_weight) ?>">
                                                </div>
                                            </div>
                                            <?php if($item->is_box_item == 'Yes'){ ?>
                                               
                                            <div class="col-12 col-sm-4 ">
                                                <div class="input-group input-group-dynamic  my-3">
                                                    <label class="form-label">Number of item in box</label>
                                                    <input type="text" class="form-control" name="box_number_of_items" id="box_number_of_items" value="<?= set_value('box_number_of_items', $item->number_of_item_in_box) ?>">
                                                </div>
                                            </div>
                                            <div class="col-12 col-sm-4 ">
                                                <div class="input-group input-group-dynamic  my-3">
                                                    <label class="form-label">Total packed Weight(Kg)</label>
                                                    <input type="text" class="form-control" name="box_total_packed_weight" id="box_total_packed_weight" value="<?= set_value('net_weight', $item->box_total_packed_weight) ?>">
                                                </div>
                                            </div>
                                            <?php } ?>

                                            <br>
                                            <div class="col-12 mt-3 ">
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input" type="checkbox" id="status" name="status" <?= ($item->status == 1) ? 'checked' : '' ?>>
                                                    <label class="form-check-label" for="flexSwitchCheckDefault">Active Or Inactive</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="button-row d-flex mt-4">
                                            <button class=" px-6 btn bg-gradient-dark ms-auto mb-0" type="submit" title="submit">Submit</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
<script src="<?= base_url() ?>assets/js/plugins/choices.min.js"></script>

<script>
    if (document.getElementById('choices-state')) {
        var element = document.getElementById('choices-state');
        const example = new Choices(element, {
            searchEnabled: false
        });
    };
    if (document.getElementById('choices-district')) {
        var element = document.getElementById('choices-district');
        const example = new Choices(element, {
            searchEnabled: false
        });
    };
    if (document.getElementById('choices-price')) {
        var element = document.getElementById('choices-price');
        const example = new Choices(element, {
            searchEnabled: false
        });
    };
    if (document.getElementById('choices-area')) {
        var element = document.getElementById('choices-area');
        const example = new Choices(element, {
            searchEnabled: false
        });
    };
    if (document.getElementById('choices-group')) {
        var element = document.getElementById('choices-group');
        const example = new Choices(element, {
            searchEnabled: false
        });
    };
</script>