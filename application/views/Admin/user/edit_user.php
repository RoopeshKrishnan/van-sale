<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12"> 

                <div class="row  ">
                    <div class="col-12 col-lg-11 m-auto ">
                        <div class="card"> 
                            <div class="card-body">
                                <form class=" " id="user_edit_form" >
                                    <div class="  border-radius-xl bg-white">
                                        <h5 class="font-weight-bolder mb-0">User Info </h5>
                                        <p class="mb-0 text-sm">Mandatory informations</p>
                                        <div class=" ">
                                            <input type="hidden" name="selected_user_id" value="<?= $edit_user->user_id ?>" >
                                            <div class="row mt-3">
                                                <div class="col-12 col-sm-6">
                                                    <div class="input-group input-group-dynamic">
                                                        <label class="form-label"> Name</label>
                                                        <input class="  form-control" type="text" value="<?= set_value('name',$edit_user->user_name) ?>" name="name" id="name" />
                                                    </div>
                                                </div>
                                                <div class="col-12 col-sm-6">
                                                    <div class="input-group input-group-dynamic">
                                                        <label class="form-label">Email Address</label>
                                                        <input class="  form-control" type="text" name="email" id="email" value="<?= set_value('email',$edit_user->email) ?>" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mt-3">
                                               
                                                <div class="col-12 col-sm-6 mt-3 mt-sm-0">
                                                    <div class="input-group input-group-dynamic">
                                                        <label class="form-label">Mobile Number</label>
                                                        <input class="  form-control" type="tel" name="phone" id="phone" value="<?= set_value('phone',$edit_user->phone) ?>" />
                                                    </div>
                                                </div>
                                                <div class="col-12 col-sm-6">
                                                    <div class="input-group input-group-dynamic">
                                                        <label class="form-label bg-white " style="z-index: 1;">Date Of Birth</label>
                                                        <input class="  form-control"  type="date" name="dob" id="dob" value="<?= set_value('dob',$edit_user->dob) ?>" />
                                                    </div>
                                            </div>
                                            <div class="row mt-3">
                                                
                                                </div>
                                                <div class="col-12 col-sm-6 mt-3 mt-sm-0">
                                                    <div class="input-group input-group-dynamic">
                                                        <label class="form-label">Other Contact Mobile Number</label>
                                                        <input class="  form-control" type="tel" name="o_phone" id="o_phone" value="<?= set_value('o_phone',$edit_user->secondary_phone) ?>" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mt-3">
                                                <div class="col">
                                                    <div class="input-group input-group-dynamic">
                                                        <label class="form-label">Primary Address </label>
                                                        <input class="  form-control" type="text" name="address" id="address" value="<?= set_value('address',$edit_user->address) ?>" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mt-3">
                                                <div class="col">
                                                    <div class="input-group input-group-dynamic">
                                                        <label class="form-label">Secondary Address </label>
                                                        <input class="  form-control" type="text" name="s_address" id="s_address" value="<?= set_value('s_address',$edit_user->secondary_address) ?>" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mt-3">
                                               
                                                <div class="col-6 col-sm-4 mt-3 mt-sm-0">
                                                    <select class="form-control " name="state" id="choices-state">
                                                        <option value="" selected disabled>State</option>
                                                        <option value="Kerala" <?= ($edit_user->state == 'Kerala') ? 'selected' : '' ?>>Kerala</option>
                                                        <option value="Tamil Nadu" <?= ($edit_user->state == 'Tamil Nadu') ? 'selected' : '' ?> >Tamil Nadu</option>
                                                    </select>
                                                </div>
                                                <div class="col-6 col-sm-4 mt-3 mt-sm-0">
                                                    <select class="form-control " name="district" id="choices-district">
                                                        <option value="" selected disabled>District</option>
                                                        <option value="Ernakulam" <?= ($edit_user->district == 'Ernakulam') ? 'selected' : '' ?>>Ernakulam</option>
                                                        <option value="Thrissur" <?= ($edit_user->district == 'Thrissur') ? 'selected' : '' ?>>Thrissur</option>
                                                        <option value="Kottayam" <?= ($edit_user->district == 'Kottayam') ? 'selected' : '' ?>>Kottayam</option>
                                                    </select>
                                                </div>
                                               
                                       
                                            </div> 

                                            <div class="row mt-3">
                                            <div class="col-6 col-sm-4 mt-3 mt-sm-0">
                                                    <div class="input-group input-group-dynamic">
                                                        <label class="form-label">City</label>
                                                        <input class="  form-control" type="text" name="city" id="city" value="<?= set_value('pincode',$edit_user->city) ?>" />
                                                    </div>
                                                </div>
                                            <div class="col-6 col-sm-2 mt-3 mt-sm-0">
                                                    <div class="input-group input-group-dynamic">
                                                        <label class="form-label">Pincode</label>
                                                        <input class="  form-control" type="number" name="pincode" id="pincode" value="<?= set_value('pincode',$edit_user->pincode) ?>" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class=" mt-5 border-radius-xl bg-white "  >
                                        <h5 class="font-weight-bold mb-0">Company</h5>
                                        <div class=" ">
                                            <div class="row mt-3">
                                                <div class="col-12 col-sm-6">
                                                    <div class="input-group input-group-dynamic">
                                                        <label class="form-label">Executive Code</label>
                                                        <input class="  form-control" type="text" name="e_code" id="e_code" value="<?= set_value('e_code',$edit_user->executive_code) ?>" />
                                                    </div>
                                                </div>
                                                <div class="col-12 col-sm-6 mt-3 mt-sm-0">
                                                    <div class="input-group input-group-dynamic">
                                                        <select class="form-control " name="area_id" id="area_id">
                                                        <option value="" selected disabled>area</option>
                                                        <?php
                                                            foreach ($area as $row) {
                                                                echo '<option value="' . $row->area_id . '" ';if($row->area_id == $edit_user->area_id) {echo "selected";} echo ' >' . $row->area . '</option>';
                                                                // echo '<option value="' . $row->area_id . '">' . $row->area . '</option>';
                                                            }
                                                            ?>
                                                        </select>  
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mt-3">
                                                <div class="col-12 col-sm-6">
                                                    <div class="input-group input-group-dynamic">
                                                        <label class="form-label">Type of scheme</label>
                                                        <input class="  form-control" type="text" name="type_of_scheme" id="type_of_scheme" value="<?= set_value('type_of_scheme',$edit_user->type_of_scheme) ?>" />
                                                    </div>
                                                </div>
                                                <div class="col-12 col-sm-6 mt-3 mt-sm-0">
                                                    <div class="input-group input-group-dynamic">
                                                        <label class="form-label">App user name</label>
                                                        <input class="  form-control" type="text" name="app_username" id="app_username" value="<?= set_value('app_username',$edit_user->app_username) ?>" />
                                                    </div>
                                                </div>
                                            </div>
                                      
                                        </div>
                                    </div>

                                    <div class=" mt-5 border-radius-xl bg-white"  >
                                        <h5 class="font-weight-bolder mb-0">Bill Data</h5>

                                        <div class=" ">
                                            <div class="row mt-3">
                                                <div class="col-12 col-sm-6">
                                                <label class="form-label">Prefix</label>
                                                        <input class="  form-control" type="text" name="prefix" id="prefix" value="<?= set_value('prefix',$edit_user->prefix) ?>"/>
                                                </div>
                                                <div class="col-12 col-sm-6 mt-3 mt-sm-0">
                                                    <div class="input-group input-group-dynamic">
                                                        <label class="form-label">Starting bill number</label>
                                                        <input class="  form-control" type="text" name="starting_bill_no" id="starting_bill_no" value="<?= set_value('starting_bill_no',$edit_user->starting_bill_number) ?>" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mt-3">
                                                <div class="col-12 col-sm-6">
                                                    <div class="input-group input-group-dynamic">
                                                        <label class="form-label">Last bill number</label>
                                                        <input class="  form-control" type="text" name="last_bill_no" id="last_bill_no" value="<?= set_value('last_bill_no',$edit_user->last_bill_number) ?>" />
                                                    </div>
                                                </div>
                                                <div class="col-12 col-sm-6 mt-3 mt-sm-0">
                                                    <div class="input-group input-group-dynamic">

                                                    </div>
                                                </div>
                                            </div> 
                                        </div>
                                    </div>

                                    <div class="mt-5 border-radius-xl bg-white "  >
                                        <h5 class="font-weight-bolder mb-0">Profile Status</h5>

                                        <div class="  mt-3">
                                            <div class="row mt-3">
                                            <div class="col-12 col-sm-6">
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input" type="checkbox" id="profile_status" name="profile_status" <?= ($edit_user->profile_status == 1) ? 'checked' : '' ?> >
                                                    <label class="form-check-label" for="active-inactive">Active Or Inactive</label>
                                                </div>
                                            </div>
                                            <div class="col-12 col-sm-6 mt-3 mt-sm-0">
                                                <div class="input-group input-group-dynamic">
                                                    <div class="form-check form-switch">
                                                        <input class="form-check-input" type="checkbox" name="login_or_logout" id="login_or_logout" <?= ($edit_user->login_or_not == 1) ? 'checked' : '' ?>>
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
    if (document.getElementById('choices-prefix')) {
        var element = document.getElementById('choices-prefix');
        const example = new Choices(element, {
            searchEnabled: false
        });
    };
    if (document.getElementById('area_id')) {
        var element = document.getElementById('area_id');
        const example = new Choices(element, {
            searchEnabled: false
        });
    };
</script>