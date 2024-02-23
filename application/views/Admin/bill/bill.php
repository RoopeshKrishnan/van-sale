<div class="container-fluid py-1 mb-6">
    <div class="row">
        <div class="col-12">
            <div class="row ">
                <div class="col-12  m-auto ">
                    <div class="card">
                        <div class="card-body">
                            <form class=" ">
                                <div class="  border-radius-xl bg-white ">
                                    <h5 class="font-weight-bolder mb-3">Bill Info</h5>
                                    <div class="mt-2">
                                        <div class="row mt-3">
                                            <div class="col-12 col-sm-6 ">
                                                <h3 class="font-weight-bolder  ">Bill Number - 4251 5512</h3>
                                            </div>
                                            <div class="col-12 col-sm-6 mt-3 mt-sm-0">
                                                <div class="input-group input-group-dynamic">
                                                    <label class="form-label text-primary " style="top: -.8rem; font-size: .7rem;"> Date</label>
                                                    <input class="  form-control" type="date" value="<?php echo date('Y-m-d'); ?>"/>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="row mt-3">
                                            <div class="col-12 col-sm-6 ">
                                                <div class="input-group input-group-dynamic">
                                                    <label class="form-label text-primary " style="top: -.8rem; font-size: .7rem;">Type of Customer</label>
                                                    <select class="form-control " name="customer_type" id="customer_type">
                                                        <option value="" selected>Select Type of Customer</option>
                                                        <option value="b2b">b2b</option>
                                                           <option value="b2c">b2c</option> 
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-12 col-sm-6 mt-3 mt-sm-0">
                                                <div class="input-group input-group-dynamic">
                                                    <label class="form-label text-primary " style="top: -.8rem; font-size: .7rem;">Customer</label>
                                                    <select class="form-control " name=" " id="customers">
                                                        <option disabled selected>Select Customer</option>
                                                
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- <div class="row mt-3">
                                            <div class="col-12 col-sm-6">
                                                <div class="input-group input-group-dynamic">
                                                    <label class="form-label">  </label>
                                                    <input class="  form-control" type="text" />
                                                </div>

                                            </div>
                                            <div class="col-12 col-sm-6 mt-3 mt-sm-0">
                                                <div class="input-group input-group-dynamic">
                                                    <label class="form-label">Mobile</label>
                                                    <input class="  form-control" type="tel" />
                                                </div>
                                            </div>
                                        </div>  -->
                                        <div class="mt-4" id="customer_details_div">
                                          
                                        </div>
                                        <div class="mt-4 card bg-gradient-light px-3">
                                            <form action="">
                                                <div class="row my-3">
                                                    <div class="col-12 col-sm-10">
                                                        <div class="input-group input-group-dynamic">
                                                            <select class="form-control " name=" " id="choices-items">
                                                                <option value="" selected>Select Items</option>
                                                                <option value="12345678900">12345678900</option>
                                                                <option value="2">2</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-sm-2 mt-3 mt-sm-0 ">
                                                        <div class="text-center ">
                                                            <button type="button" class="btn bg-gradient-dark px-6">Add</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>

                                        <div class="mt-4 ">
                                            <div class="card-header p-0">
                                                <div class="d-lg-flex">
                                                    <div>
                                                        <h5 class="mb-0">Order item</h5>
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="card-body px-0 pb-0">
                                                <div class="table-responsive">
                                                    <table class="table table-striped  align-items-center mb-0">
                                                        <thead>
                                                            <tr>
                                                                <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7 ps-2 w-10">Sl no</th>
                                                                <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7 ps-2">item</th>
                                                                <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7 ps-2 text-center w-20">quantity</th>
                                                                <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7 text-center">price</th>
                                                                <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7 ps-2 text-center w-20">discount</th>
                                                                <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7 ps-4 text-center">total amount</th>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td class="align-middle ">
                                                                    <p class="text-xs  font-weight-bold mb-0 ps-2">1</p>
                                                                </td>
                                                                <td class="align-middle ">
                                                                    <p class="text-xs  font-weight-bold mb-0">item</p>
                                                                </td>
                                                                <td class="align-middle w-20 ">
                                                                    <div class="input-group input-group-outline ">
                                                                        <input class=" form-control" type="text" placeholder="Enter Qty" />
                                                                    </div>
                                                                </td>
                                                                <td class="align-middle text-center">
                                                                    <span class="text-secondary text-xs  ">10</span>
                                                                </td>
                                                                <td class="align-middle w-20 ">
                                                                    <div class="input-group input-group-outline ">
                                                                        <input class=" form-control" type="text" placeholder="Enter discount" />
                                                                    </div>
                                                                </td>
                                                                <td class="align-middle text-center">
                                                                    <span class="text-secondary text-xs p-0 "> 000</span>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td class="align-middle ">
                                                                    <p class="text-xs  font-weight-bold mb-0 ps-2">2</p>
                                                                </td>
                                                                <td class="align-middle ">
                                                                    <p class="text-xs  font-weight-bold mb-0">item</p>
                                                                </td>
                                                                <td class="align-middle w-20 ">
                                                                    <div class="input-group input-group-outline ">
                                                                        <input class=" form-control" type="text" placeholder="Enter Qty" />
                                                                    </div>
                                                                </td>
                                                                <td class="align-middle text-center">
                                                                    <span class="text-secondary text-xs  ">20</span>
                                                                </td>
                                                                <td class="align-middle w-20 ">
                                                                    <div class="input-group input-group-outline ">
                                                                        <input class=" form-control" type="text" placeholder="Enter discount" />
                                                                    </div>
                                                                </td>
                                                                <td class="align-middle text-center">
                                                                    <span class="text-secondary text-xs p-0 "> 000</span>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td class="align-middle ">
                                                                    <p class="text-xs  font-weight-bold mb-0 ps-2">3</p>
                                                                </td>
                                                                <td class="align-middle ">
                                                                    <p class="text-xs  font-weight-bold mb-0">item</p>
                                                                </td>
                                                                <td class="align-middle w-20 ">
                                                                    <div class="input-group input-group-outline ">
                                                                        <input class=" form-control" type="text" placeholder="Enter Qty" />
                                                                    </div>
                                                                </td>
                                                                <td class="align-middle text-center">
                                                                    <span class="text-secondary text-xs  ">30</span>
                                                                </td>
                                                                <td class="align-middle w-20 ">
                                                                    <div class="input-group input-group-outline ">
                                                                        <input class=" form-control" type="text" placeholder="Enter discount" />
                                                                    </div>
                                                                </td>
                                                                <td class="align-middle text-center">
                                                                    <span class="text-secondary text-xs p-0 "> 000</span>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                        <tfoot>
                                                            <tr>
                                                                <td class="align-middle ">
                                                                    <p class="text-xs  font-weight-bold mb-0"> </p>
                                                                </td>
                                                                <td class="align-middle ">
                                                                    <p class="text-md  font-weight-bold mb-0">Total</p>
                                                                </td>
                                                                <td class="align-middle ">
                                                                    <p class="text-xs  font-weight-bold mb-0"> </p>
                                                                </td>
                                                                <td class="align-middle ">
                                                                    <p class="text-xs  font-weight-bold mb-0"> </p>
                                                                </td>
                                                                <td class="align-middle ">
                                                                    <p class="text-xs  font-weight-bold mb-0"> </p>
                                                                </td>
                                                                <td class="align-middle text-center">
                                                                    <span class="text-secondary text-md  font-weight-bold "> 000</span>
                                                                </td>
                                                            </tr>
                                                        </tfoot>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-4 col-12 mt-4 ">
                                            <h6 class="mb-1 ps-3">Order Summary</h6>
                                            <div class="bg-gray-100 border-radius-lg p-4">

                                                <div class="d-flex justify-content-between">
                                                    <span class="mb-2 text-sm">
                                                        Total Amount  :
                                                    </span>
                                                    <span class="text-dark font-weight-bold ms-2">₹ 0000</span>
                                                </div>
                                                <div class="d-flex justify-content-between">
                                                    <span class="mb-2 text-sm">
                                                        CGST:
                                                    </span>
                                                    <span class="text-dark ms-2 font-weight-bold">₹ 0000</span>
                                                </div>
                                                <div class="d-flex justify-content-between">
                                                    <span class="mb-2 text-sm">
                                                        SGST:
                                                    </span>
                                                    <span class="text-dark ms-2 font-weight-bold">₹ 0000</span>
                                                </div>
                                                <div class="d-flex justify-content-between">
                                                    <span class="text-sm">
                                                        Discount:
                                                    </span>
                                                    <span class="text-dark ms-2 font-weight-bold">₹ 0000</span>
                                                </div>
                                                <div class="d-flex justify-content-between mt-4">
                                                    <span class="mb-2 text-lg">
                                                        Total:
                                                    </span>
                                                    <span class="text-dark text-lg ms-2 font-weight-bold">₹ 00000</span>
                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="button-row d-flex justify-content-evenly mt-4">
                                        <button class=" px-6 btn bg-gradient-success " type="button" title="submit">Save Bill</button> 
                                        <button class=" px-6 btn bg-gradient-danger " type="button" title="submit">cancel</button> 
                                        <a href="bill_print"> 
                                            <button class=" px-6 btn bg-gradient-light " type="button" title="submit">print</button> 
                                        </a>
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
    if (document.getElementById('choices-customer')) {
        var element = document.getElementById('choices-customer');
        const example = new Choices(element, {
            searchEnabled: true,
            shouldSort: false,
        });
    };
    if (document.getElementById('choices-type')) {
        var element = document.getElementById('choices-type');
        const example = new Choices(element, {
            searchEnabled: false,
            shouldSort: false,
        });
    };
    if (document.getElementById('choices-items')) {
        var element = document.getElementById('choices-items');
        const example = new Choices(element, {
            searchEnabled: false,
            shouldSort: false,
        });
    };
</script>