<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card">

                <div class="card-header pb-0">
                    <div class="d-lg-flex">
                        <div>
                            <h5 class="mb-0">Customer</h5>

                        </div>

                        <div class="ms-lg-auto my-auto mt-lg-0 mt-4 col-8 col-sm-6 col-md-4 col-lg-3">
                            <select class="form-control " name=" " id="choices-area">
                                <option value="" selected>Area</option>
                                <option value="">12345678900</option>
                                <option value="">2</option>
                            </select>
                        </div>

                        <div class="ms-lg-auto my-auto mt-lg-0 mt-4 col-8 col-sm-6 col-md-4 col-lg-3">
                            <select class="form-control " name=" " id="choices-price-list">
                                <option value="" selected>Price list</option>
                                <option value="">12345678900 </option>
                                <option value="">2</option>
                            </select>
                        </div>
                        <?php 
                            if(!$all_customers->num_rows()>0){

                            }else{
                        ?>


                        <div class="ms-auto my-auto mt-lg-0 mt-4">
                            <div class="ms-auto my-auto">

                                <a href="customer_creation" class="btn bg-gradient-primary btn-sm mb-0"  >+&nbsp; New Customer</a>

                                <button class="btn btn-outline-primary btn-sm export mb-0 mt-sm-0 mt-1" data-type="csv" type="button" name="button">Export</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body px-0 pb-0">
                    <div class="table-responsive">
                        <table class="table table-flush" id="customer-list">
                            <thead class="thead-light">
                                <tr>
                                    <th class="  text-uppercase text-secondary text-xs font-weight-bolder ">sl/no</th>
                                    <th class="  text-uppercase text-secondary text-xs font-weight-bolder ">customer name</th>
                                    <th class="  text-uppercase text-secondary text-xs font-weight-bolder ">mobile number</th>
                                    <th class="  text-uppercase text-secondary text-xs font-weight-bolder ">area</th>
                                    <th class="  text-uppercase text-secondary text-xs font-weight-bolder ">price list</th>
                                    <th class="  text-uppercase text-secondary text-xs font-weight-bolder ">ob</th>
                                    <th class=" text-center text-uppercase text-secondary text-xs font-weight-bolder ">alias_code</th>
                                    <th class=" text-center text-uppercase text-secondary text-xs font-weight-bolder ">created user</th>
                                    <th class=" text-center text-uppercase text-secondary text-xs font-weight-bolder ">customer status</th>
                                    <th class="  text-uppercase text-secondary text-xs font-weight-bolder ">view / edit / delete</th>

                                </tr>
                            </thead>
                            <tbody>
                            <?php 
                                 $all_customer_data = $all_customers->result();
                                 $i = 0;
                                 foreach ($all_customer_data as $row) {
                                    $i++;
                                ?>
                                <tr>
                                    <td>
                                        <p class="text-xs font-weight-bold mb-0"><?= $i ?></p>
                                    </td>
                                    <td>
                                    <h6 class="mb-0 text-md"><?= $row->customer_name ?></h6>
                                    </td>
                                    <td>
                                    <p class="text-sm font-weight-bold mb-0"><?= $row->phone ?></p>
                                    </td>
                                    <td>
                                    <p class="text-sm font-weight-bold mb-0"><?= $row->area ?></p>
                                    </td>
                                    <td>
                                    <p class="text-sm font-weight-bold mb-0"><?= $row->price_list ?></p>
                                    </td>
                                    <td>
                                    <p class="text-sm font-weight-bold mb-0"><?= $row->ob ?></p>
                                    </td>
                                    <td class="align-middle text-center">
                                    <span class="text-secondary text-sm font-weight-normal"><?= $row->alias_code ?></span>
                                    </td>
                                    <td class="align-middle text-center">
                                    <span class="text-secondary text-sm font-weight-normal"><?= $row->user_name ?></span>
                                    </td>
                                    <td class="align-middle text-center text-sm">
                                    <?php echo ($row->profile_status == 1) ?  ' <span class="badge badge-sm badge-success">active</span>':  ' <span class="badge badge-sm badge-danger">Inactive</span>' ?>
                                    </td>
                                    <td class="text-sm">
                                        <a href="javascript:;" data-bs-toggle="tooltip" data-bs-original-title="Preview product">
                                            <i class="material-icons text-primary position-relative text-lg">visibility</i>
                                        </a>
                                        <a href="<?=base_url('All-customers/edit/'.$row->customer_id)?>" value="" class="mx-3" data-bs-toggle="tooltip" data-bs-original-title="Edit product">
                                            <i class="material-icons text-success position-relative text-lg">drive_file_rename_outline</i>
                                        </a>
                                  
                                        <a href="javascript:;" data-bs-toggle="tooltip" data-bs-original-title="Delete product">
                                            <i class="material-icons text-danger position-relative text-lg">delete</i>
                                        </a>
                                    </td>
                                </tr>
                               
                                <?php } ?>
                            </tbody> 
                        </table>
                    </div>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>
</div>
<script src="assets/js/plugins/datatables.js"></script>
<script src="assets/js/plugins/choices.min.js"></script>


<script>
    if (document.getElementById('customer-list')) {
        const dataTableSearch = new simpleDatatables.DataTable("#customer-list", {
            searchable: true,
            fixedHeight: false,
            perPage: 7
        });

        document.querySelectorAll(".export").forEach(function(el) {
            el.addEventListener("click", function(e) {
                var type = el.dataset.type;

                var data = {
                    type: type,
                    filename: "customer list" + type,
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
    if (document.getElementById('choices-price-list')) {
        var element = document.getElementById('choices-price-list');
        const example = new Choices(element, {
            searchEnabled: false
        });
    };
</script>