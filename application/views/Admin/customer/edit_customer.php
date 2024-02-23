<div class="container-fluid  ">
    <div class="row">
        <div class="col-12">

            <div class="row pt-4">
                <div class="col-12 col-lg-11 m-auto ">
                    <div class="card">
                        <div class="card-body">
                            <form class=" " id="customer_edit_form">

                                <div class="  border-radius-xl bg-white ">
                                    <h5 class="font-weight-bolder mb-0">Customer Info</h5>
                                    <p class="mb-0 text-sm">Mandatory informations</p>
                                    <div class=" ">
                                        <input type="hidden" name="selected_customer_id" value="<?= $edit_customer->customer_id ?>">
                                        <div class="row mt-3">
                                            <div class="col-12 col-sm-6">
                                                <div class="input-group input-group-dynamic">
                                                    <label class="form-label"> Name</label>
                                                    <input class="  form-control" type="text" name="name" id="name" value="<?= set_value('name', $edit_customer->customer_name) ?>" />
                                                </div>
                                            </div>
                                            <div class="col-12 col-sm-6">
                                                <div class="input-group input-group-dynamic">
                                                    <label class="form-label">Email Address</label>
                                                    <input class="  form-control" type="text" name="email" id="email" value="<?= set_value('email', $edit_customer->email) ?>" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mt-3">

                                            <div class="col-12 col-sm-6 mt-3 mt-sm-0">
                                                <div class="input-group input-group-dynamic">
                                                    <label class="form-label">Mobile Number</label>
                                                    <input class="  form-control" type="tel" name="phone" id="phone" value="<?= set_value('phone', $edit_customer->phone) ?>" />
                                                </div>
                                            </div>
                                            <div class="col-12 col-sm-6">
                                                <div class="input-group input-group-dynamic">
                                                    <label class="form-label bg-white " style="z-index: 1;">Date Of Birth</label>
                                                    <input class="  form-control" type="date" name="dob" id="dob" value="<?= set_value('dob', $edit_customer->dob) ?>" />
                                                </div>
                                            </div>
                                            <div class="row mt-3">
                                                <div class="col-12 col-sm-6 mt-3 mt-sm-0">
                                                    <div class="input-group input-group-dynamic">
                                                        <label class="form-label">Other Contact Mobile Number</label>
                                                        <input class="  form-control" type="tel" name="o_phone" id="o_phone" value="<?= set_value('o_phone', $edit_customer->secondary_phone) ?>" />
                                                    </div>
                                                </div>
                                                <div class="col-12 col-sm-6 mt-3 mt-sm-0">
                                                    <div class="input-group input-group-dynamic">
                                                        <label class="form-label">Other Name</label>
                                                        <input class="  form-control" type="tel" name="o_name" id="o_name" value="<?= set_value('name', $edit_customer->customer_other_name) ?>" />
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="row mt-3">
                                            <div class="col">
                                                <div class="input-group input-group-dynamic">
                                                    <label class="form-label">Primary Address </label>
                                                    <input class="  form-control" type="text" name="address" id="address" value="<?= set_value('address', $edit_customer->address) ?>" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mt-3">
                                            <div class="col">
                                                <div class="input-group input-group-dynamic">
                                                    <label class="form-label">Secondary Address </label>
                                                    <input class="  form-control" type="text" name="s_address" id="s_address" value="<?= set_value('s_address', $edit_customer->secondary_address) ?>" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mt-3">
                                            <div class="col-6 col-sm-2 mt-3 mt-sm-0">
                                                <div class="input-group input-group-dynamic">
                                                    <label class="form-label">Pincode</label>
                                                    <input class="  form-control" type="number" name="pincode" id="pincode" value="<?= set_value('pincode', $edit_customer->pincode) ?>" />
                                                </div>
                                            </div>
                                            <div class="col-6 col-sm-4 mt-3 mt-sm-0">
                                                <select class="form-control " name="state" id="choices-state">
                                                    <option value="" selected disabled>State</option>
                                                    <option value="Kerala" <?= ($edit_customer->state == 'Kerala') ? 'selected' : '' ?>>Kerala</option>
                                                    <option value="Tamil Nadu" <?= ($edit_customer->state == 'Tamil Nadu') ? 'selected' : '' ?>>Tamil Nadu</option>
                                                </select>
                                            </div>
                                            <div class="col-6 col-sm-4 mt-3 mt-sm-0">
                                                <select class="form-control " name="district" id="choices-district">
                                                    <option value="" selected disabled>District</option>
                                                    <option value="Ernakulam" <?= ($edit_customer->district == 'Ernakulam') ? 'selected' : '' ?>>Ernakulam</option>
                                                    <option value="Thrissur" <?= ($edit_customer->district == 'Thrissur') ? 'selected' : '' ?>>Thrissur</option>
                                                    <option value="Kottayam" <?= ($edit_customer->district == 'Kottayam') ? 'selected' : '' ?>>Kottayam</option>
                                                </select>
                                            </div>
                                            <div class="col-6 col-sm-4 mt-3 mt-sm-0">
                                                <div class="input-group input-group-dynamic">
                                                    <label class="form-label">City</label>
                                                    <input class="  form-control" type="text" name="city" id="city" value="<?= set_value('city', $edit_customer->city) ?>" />
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>

                                <div class="mt-5 border-radius-xl bg-white">
                                    <h5 class="font-weight-bold mb-0">Company</h5>
                                    <div class=" ">
                                        <div class="row mt-3">
                                            <div class="col-12 col-sm-6">
                                                <div class="input-group input-group-dynamic">
                                                    <label class="form-label">Customer Code</label>
                                                    <input class="  form-control" type="text" name="c_code" id="c_code" value="<?= set_value('c_code', $edit_customer->customer_code) ?>" />
                                                </div>
                                            </div>
                                            <div class="col-12 col-sm-6 mt-3 mt-sm-0">
                                                <div class="input-group input-group-dynamic">
                                                    <label class="form-label">Alias Customer Code</label>
                                                    <input class="  form-control" type="text" name="alias_code" id="alias_code" value="<?= set_value('alias_code', $edit_customer->alias_code) ?>" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mt-3">
                                            <div class="col-12 col-sm-6">
                                                <div class="input-group input-group-dynamic">
                                                    <label class="form-label">OB</label>
                                                    <input class="  form-control" type="text" name="ob" value="<?= set_value('ob', $edit_customer->ob) ?>" id="ob" />
                                                </div>
                                            </div>
                                            <div class="col-12 col-sm-6 mt-3 mt-sm-0">
                                                <div class="input-group input-group-dynamic">
                                                    <label class="form-label">GST number </label>
                                                    <input class=" form-control" name="gst_number" type="text" value="<?= set_value('gst_number', $edit_customer->gst_number) ?>" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mt-3">
                                            <div class="col-12 col-sm-6">
                                                <div class="input-group input-group-dynamic">
                                                    <select class="form-control " name="bill_type" id="choices-group">
                                                        <option value="b2b" <?= ($edit_customer->bill_type == 'b2b') ? 'selected' : '' ?>>b2b</option>
                                                        <option value="b2c" <?= ($edit_customer->bill_type == 'b2c') ? 'selected' : '' ?>>b2c</option>
                                                    </select>
                                                </div>

                                            </div>
                                            <div class="col-12 col-sm-6 mt-3 mt-sm-0">
                                                <div class="input-group input-group-dynamic">
                                                    <label class="form-label">Credit Limit </label>
                                                    <input class=" form-control" name="credit_limit" value="<?= set_value('credit_limit', $edit_customer->credit_limit) ?>" type="text" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mt-3">
                                            <div class="col-12 col-sm-6">
                                                <div class="input-group input-group-dynamic">
                                                    <select class="form-control " name="group_id" id="choices-group">
                                                        <option value="" selected disabled>Group</option>
                                                        <?php
                                                        foreach ($groups as $row) {
                                                            echo '<option value="' . $row->customer_group_id . '" ';
                                                            if ($row->customer_group_id == $edit_customer->customer_group_id) {
                                                                echo "selected";
                                                            }
                                                            echo ' >' . $row->customer_group_name . '</option>';
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-12 col-sm-6 mt-3 mt-sm-0">
                                                <div class="input-group input-group-dynamic">
                                                    <select class="form-control " name="area_id" id="choices-area">
                                                        <option value="" selected disabled>area</option>
                                                        <?php
                                                        foreach ($area as $row) {
                                                            echo '<option value="' . $row->area_id . '" ';
                                                            if ($row->area_id == $edit_customer->area_id) {
                                                                echo "selected";
                                                            }
                                                            echo ' >' . $row->area . '</option>';
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mt-3">
                                            <div class="col-12 col-sm-6">
                                                <select class="form-control" name="price_list_id" id="choices-price">
                                                <option value="" selected disabled>pricelist</option>
                                                        <?php
                                                        foreach ($pricelist as $row) {
                                                            echo '<option value="' . $row->price_list_name_id . '" ';
                                                            if ($row->price_list_name_id == $edit_customer->price_list) {
                                                                echo "selected";
                                                            }
                                                            echo ' >' . $row->price_list_name . '</option>';
                                                        }
                                                        ?>
                                                </select>
                                            </div>
                                            <div class="col-12 col-sm-6 mt-3 mt-sm-0">
                                                <div class="input-group input-group-dynamic">
                                                    <label class="form-label">App Customer name</label>
                                                    <input class="  form-control" type="text" name="app_customer_name" id="app_customer_name" value="<?= set_value('app_customer_name', $edit_customer->app_customer_name) ?>" />
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <div class="mt-5 border-radius-xl bg-white">
                                    <h5 class="font-weight-bold mb-0">Customer Shop Details</h5>
                                    <div class=" ">
                                        <div class="row mt-3">
                                            <div class="col-12 col-sm-6">
                                                <div class="form-check mb-3">
                                                    <input class="form-check-input" type="radio" name="shop_opening" id="customRadio1" value="regular" <?= ($edit_customer->shop_opening === 'regular') ? 'checked' : '' ?>>
                                                    <label class="custom-control-label" for="customRadio1">Regular</label>
                                                </div>
                                            </div>
                                            <div class="col-12 col-sm-6 mt-3 mt-sm-0">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="shop_opening" id="customRadio2" value="sunday_open" <?= ($edit_customer->shop_opening === 'sunday_open') ? 'checked' : '' ?>>
                                                    <label class="custom-control-label" for="customRadio2">Or With Sunday Open</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mt-3">
                                            <h6 class="font-weight-normal mb-3">Any Leave In Week</h6>
                                            <div class="d-md-flex justify-content-between">
                                                <div class="form-check">
                                                    <?php
                                                    $selectedDays = explode(',', $edit_customer->any_leave_in_week);

                                                    foreach ($days as $row) {
                                                        $checkboxId = strtolower($row->day_name);
                                                        $isChecked = in_array($row->week_day_id, $selectedDays);
                                                    ?>

                                                        <input class="form-check-input" type="checkbox" name="leave_in_week[]" value="<?= $row->week_day_id ?>" id="<?= $checkboxId ?>" <?= $isChecked ? 'checked' : '' ?>>
                                                        <label class="custom-control-label" for="<?= $checkboxId ?>"><?= $row->day_name ?></label>

                                                    <?php }
                                                    ?>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class=" mt-5 border-radius-xl bg-white ">
                                    <h5 class="font-weight-bolder mb-0">Profile Status</h5>

                                    <div class="   ">
                                    <div class="row mt-3">
                                            <div class="col-12 col-sm-6">
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input" type="checkbox" id="profile_status" name="profile_status" <?= ($edit_customer->profile_status == 1) ? 'checked' : '' ?> >
                                                    <label class="form-check-label" for="active-inactive">Active Or Inactive</label>
                                                </div>
                                            </div>
                                            <div class="col-12 col-sm-6 mt-3 mt-sm-0">
                                                <div class="input-group input-group-dynamic">
                                                    <div class="form-check form-switch">
                                                        <input class="form-check-input" type="checkbox" name="login_or_logout" id="login_or_logout" <?= ($edit_customer->login_or_not == 1) ? 'checked' : '' ?>>
                                                        <label class="form-check-label" for="login-logout">Login Or Logout</label>
                                                    </div>
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