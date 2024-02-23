<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12"> 

                <div class="row  ">
                    <div class="col-12 col-lg-11 m-auto ">
                        <div class="card"> 
                            <div class="card-body">
                                <form class=" " id="user_creation_form" >
                                    <div class="  border-radius-xl bg-white">
                                        <h5 class="font-weight-bolder mb-0">User Info</h5>
                                        <p class="mb-0 text-sm">Mandatory informations</p>
                                        <div class=" ">
                                            <div class="row mt-3">
                                                <div class="col-12 col-sm-6">
                                                    <div class="input-group input-group-dynamic">
                                                        <label class="form-label"> Name</label>
                                                        <input class="  form-control" type="text" name="name" id="name" />
                                                    </div>
                                                </div>
                                                <div class="col-12 col-sm-6 mt-3 mt-sm-0">
                                                    <div class="input-group input-group-dynamic">
                                                        <label class="form-label">Email Address</label>
                                                        <input class="  form-control" type="text" name="email" id="email" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mt-3">
                                               
                                                <div class="col-12 col-sm-6 ">
                                                    <div class="input-group input-group-dynamic">
                                                        <label class="form-label">Mobile Number</label>
                                                        <input class="  form-control" type="tel" name="phone" id="phone" />
                                                    </div>
                                                </div>
                                                <div class="col-12 col-sm-6 mt-3 mt-sm-0">
                                                    <div class="input-group input-group-dynamic">
                                                        <label class="form-label bg-white " style="z-index: 1;">Date Of Birth</label>
                                                        <input class="  form-control"  type="date" name="dob" id="dob" />
                                                    </div>
                                            </div>
                                            <div class="row mt-3">
                                                
                                                </div>
                                                <div class="col-12 col-sm-6">
                                                    <div class="input-group input-group-dynamic">
                                                        <label class="form-label">Other Contact Mobile Number</label>
                                                        <input class="  form-control" type="tel" name="o_phone" id="o_phone" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mt-3">
                                                <div class="col">
                                                    <div class="input-group input-group-dynamic">
                                                        <label class="form-label">Primary Address </label>
                                                        <input class="  form-control" type="text" name="address" id="address" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mt-3">
                                                <div class="col">
                                                    <div class="input-group input-group-dynamic">
                                                        <label class="form-label">Secondary Address </label>
                                                        <input class="  form-control" type="text" name="s_address" id="s_address" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mt-3">
                                               
                                                
                                                <div class="ccol-12 col-sm-6">
                                                    <select class="form-control " name="district" id="choices-district">
                                                        <option value="" selected disabled>District</option>
                                                        <option value="Ernakulam">Ernakulam</option>
                                                        <option value="Thrissur">Thrissur</option>
                                                        <option value="Kottayam">Kottayam</option>
                                                    </select>
                                                </div>
                                                <div class="col-12 col-sm-6 mt-3 mt-sm-0">
                                                    <select class="form-control " name="state" id="choices-state">
                                                        <option value="" selected disabled>State</option>
                                                        <option value="Kerala">Kerala</option>
                                                        <option value="Tamil Nadu">Tamil Nadu</option>
                                                    </select>
                                                </div> 
                                            </div> 
                                                <div class="row mt-3">
                                                <div class="col-12 col-sm-6">
                                                    <div class="input-group input-group-dynamic">
                                                        <label class="form-label">City</label>
                                                        <input class="  form-control" type="text" name="city" id="city" />
                                                    </div>
                                                </div>
                                                <div class="col-12 col-sm-6 mt-3 mt-sm-0">
                                                    <div class="input-group input-group-dynamic">
                                                        <label class="form-label">Pincode</label>
                                                        <input class="  form-control" type="number" name="pincode" id="pincode" />
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
                                                        <input class="  form-control" type="text" name="e_code" id="e_code" />
                                                    </div>
                                                </div>
                                                <div class="col-12 col-sm-6 mt-3 mt-sm-0">
                                                    <div class="input-group input-group-dynamic">
                                                        <select class="form-control " name="area_id" id="choices-area">
                                                        <option value="" selected disabled>area</option>
                                                        <?php
                                                            foreach ($area as $row) {
                                                                echo '<option value="' . $row->area_id . '">' . $row->area . '</option>';
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
                                                        <input class="  form-control" type="text" name="type_of_scheme" id="type_of_scheme" />
                                                    </div>
                                                </div>
                                                <div class="col-12 col-sm-6 mt-3 mt-sm-0">
                                                    <div class="input-group input-group-dynamic">
                                                        <label class="form-label">App user name</label>
                                                        <input class="  form-control" type="text" name="app_username" id="app_username" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mt-3">
                                                <div class="col-12 col-sm-6">
                                                    <div class="input-group input-group-dynamic">
                                                        <label class="form-label">Password</label>
                                                        <input class="  form-control" type="password" name="password" id="password" />
                                                    </div>
                                                </div>
                                                <div class="col-12 col-sm-6 mt-3 mt-sm-0">
                                                    <div class="input-group input-group-dynamic">
                                                        <label class="form-label">Conform Password</label>
                                                        <input class="  form-control" type="password" name="cpassword" id="cpassword" />
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
                                                <div class="input-group input-group-dynamic">
                                                        <label class="form-label">Prefix</label>
                                                        <input class="  form-control" type="text" name="prefix" id="prefix" />
                                                    </div>
                                                </div>
                                                <div class="col-12 col-sm-6 mt-3 mt-sm-0">
                                                    <div class="input-group input-group-dynamic">
                                                        <label class="form-label">Starting bill number</label>
                                                        <input class="  form-control" type="text" name="starting_bill_no" id="starting_bill_no" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mt-3">
                                                <div class="col-12 col-sm-6">
                                                    <div class="input-group input-group-dynamic">
                                                        <label class="form-label">Last bill number</label>
                                                        <input class="  form-control" type="text" name="last_bill_no" id="last_bill_no" />
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
                                                    <input class="form-check-input" type="checkbox" id="profile_status" name="profile_status" checked="">
                                                    <label class="form-check-label" for="active-inactive">Active Or Inactive</label>
                                                </div>
                                            </div>
                                            <div class="col-12 col-sm-6 mt-3 mt-sm-0">
                                                <div class="input-group input-group-dynamic">
                                                    <div class="form-check form-switch">
                                                        <input class="form-check-input" type="checkbox" name="login_or_logout" id="login_or_logout" checked="">
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
<script src="assets/js/plugins/choices.min.js"></script> 

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
    if (document.getElementById('choices-area')) {
        var element = document.getElementById('choices-area');
        const example = new Choices(element, {
            searchEnabled: false
        });
    };
</script>