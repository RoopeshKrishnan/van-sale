<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card">

                <div class="card-header pb-0">
                    <div class="d-lg-flex">
                        <div>
                            <h5 class="mb-0">All Customer Order</h5>

                        </div>

                        <div class="ms-auto my-auto mt-lg-0 mt-4">
                            <div class="ms-auto my-auto">

                                <a href="<?= base_url() ?>order-taking" class="btn bg-gradient-primary btn-sm mb-0">+&nbsp; New Customer Order</a>

                                <button class="btn btn-outline-primary btn-sm export mb-0 mt-sm-0 mt-1" data-type="csv" type="button" name="button">Export</button>
                            </div>
                        </div>
                    </div>
                    <div class="d-lg-flex">
                        <div class="ms-lg-2 my-auto mt-lg-4 mt-4 col-8 col-sm-6 col-md-4 col-lg-3">
                            <select class="form-control " name=" " id="choices-area">
                                <option value="" selected>Area</option>
                                <option value="">12345678900</option>
                                <option value="">2</option>
                            </select>
                        </div>

                        <div class="ms-lg-2 my-auto mt-lg-4 mt-4 col-8 col-sm-6 col-md-4 col-lg-3">
                            <div class="input-group input-group-dynamic">
                                <label class="form-label bg-white pe-5" style="z-index: 1;">From Date </label>
                                <input class="  form-control" type="date" />
                            </div>
                        </div>
                        <div class="ms-lg-2 my-auto mt-lg-4 mt-4 col-8 col-sm-6 col-md-4 col-lg-3">
                            <div class="input-group input-group-dynamic">
                                <label class="form-label bg-white pe-5" style="z-index: 1;">To Date </label>
                                <input class="  form-control" type="date" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body px-0 pb-0">
                    <div class="table-responsive">
                        <table class="table table-flush" id="customer-order-list">
                            <thead class="thead-light">
                                <tr>
                                    <th class="  text-uppercase text-secondary text-xs font-weight-bolder ">sl/no</th>
                                    <th class="  text-uppercase text-secondary text-xs font-weight-bolder ">customer name</th>
                                    <th class="  text-uppercase text-secondary text-xs font-weight-bolder ">area</th>
                                    <th class=" text-center text-uppercase text-secondary text-xs font-weight-bolder ">last bill date</th>
                                    <th class="  text-uppercase text-secondary text-xs font-weight-bolder ">last bill amount</th>
                                    <th class=" text-center text-uppercase text-secondary text-xs font-weight-bolder ">last Receipt date</th>
                                    <th class="  text-uppercase text-secondary text-xs font-weight-bolder ">last Receipt Amount</th>
                                    <th class="  text-uppercase text-secondary text-xs font-weight-bolder ">ob</th>
                                    <th class="  text-uppercase text-secondary text-xs font-weight-bolder ">Order status</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php 
                                 $all_orders = $all_orders->result();
                                 $i = 0;
                                 foreach ($all_orders as $row) {
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
                                        <p class="text-sm font-weight-bold mb-0"><?= $row->area ?></p>
                                    </td>
                                    <td class="align-middle text-center">
                                        <span class="text-secondary text-sm font-weight-normal">00/00/0000</span>
                                    </td>
                                    <td>
                                        <p class="text-sm font-weight-bold mb-0">100</p>
                                    </td>
                                    <td class="align-middle text-center">
                                        <span class="text-secondary text-sm font-weight-normal">00/00/0000</span>
                                    </td>
                                    <td>
                                        <p class="text-sm font-weight-bold mb-0">100</p>
                                    </td>
                                    <td>
                                        <p class="text-sm font-weight-bold mb-0"><?= $row->ob ?></p>
                                    </td>
                                    <td class="align-middle text-center text-sm">
                                        <?php echo ($row->status == 1) ?  ' <span class="badge badge-sm badge-success">Confirmed</span>':  ' <span class="badge badge-sm badge-danger">Not confirmed</span>' ?>
                                   
                                    </td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="assets/js/plugins/datatables.js"></script>
<script src="assets/js/plugins/choices.min.js"></script>


<script>
    if (document.getElementById('customer-order-list')) {
        const dataTableSearch = new simpleDatatables.DataTable("#customer-order-list", {
            searchable: true,
            fixedHeight: false,
            perPage: 7
        });

        document.querySelectorAll(".export").forEach(function(el) {
            el.addEventListener("click", function(e) {
                var type = el.dataset.type;

                var data = {
                    type: type,
                    filename: "customer-order-list" + type,
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
</script>