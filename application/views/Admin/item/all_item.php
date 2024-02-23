<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card">

                <div class="card-header pb-0">
                    <div class="d-lg-flex">
                        <div>
                            <h5 class="mb-0">All item</h5>

                        </div>

                        <div class="ms-lg-auto my-auto mt-lg-0 mt-4 col-8 col-sm-6 col-md-4 col-lg-3">
                            <select class="form-control " name=" " id="choices-category">
                                <option value="" selected>Category</option>
                                <option value="">12345678900</option>
                                <option value="">2</option>
                            </select>
                        </div>

                        <div class="ms-lg-auto my-auto mt-lg-0 mt-4 col-8 col-sm-6 col-md-4 col-lg-3">
                            <select class="form-control " name=" " id="choices-sub-category">
                                <option value="" selected>Sub Category</option>
                                <option value="">12345678900 </option>
                                <option value="">2</option>
                            </select>
                        </div>
                        <?php 
                            if(!$all_items->num_rows()>0){

                            }else{
                        ?>


                        <div class="ms-auto my-auto mt-lg-0 mt-4">
                            <div class="ms-auto my-auto">

                                <a href="add_item" class="btn bg-gradient-primary btn-sm mb-0">+&nbsp; New item</a>

                                <button class="btn btn-outline-primary btn-sm export mb-0 mt-sm-0 mt-1" data-type="csv" type="button" name="button">Export</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body px-0 pb-0">
                    <div class="table-responsive">
                        <table class="table table-flush" id="all-item-list">
                            <thead class="thead-light">
                                <tr>
                                    <th class="  text-uppercase text-secondary text-xs font-weight-bolder ">sl/no</th>
                                    <th class="  text-uppercase text-secondary text-xs font-weight-bolder ">item </th>
                                    <th class="  text-uppercase text-secondary text-xs font-weight-bolder ">item code</th>
                                    <th class="  text-uppercase text-secondary text-xs font-weight-bolder ">HSN Code</th>
                                    <th class="  text-uppercase text-secondary text-xs font-weight-bolder ">Tax percentage</th>
                                    <th class="  text-uppercase text-secondary text-xs font-weight-bolder ">Category</th>
                                    <th class="  text-uppercase text-secondary text-xs font-weight-bolder ">sub Category</th>
                                    <th class="  text-uppercase text-secondary text-xs font-weight-bolder ">Category Type</th>
                                    <th class=" text-center text-uppercase text-secondary text-xs font-weight-bolder "> status</th>
                                    <th class="  text-uppercase text-secondary text-xs font-weight-bolder "> edit / delete</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php 
                                 $all_items_data = $all_items->result();
                                 $i = 0;
                                 foreach ($all_items_data as $row) {
                                    $i++;
                                ?>
                                <tr>
                                    <td>
                                        <p class="text-xs font-weight-bold mb-0"><?= $i ?></p>
                                    </td>
                                    <td>
                                        <h6 class="mb-0 text-md"><?= $row->item_name ?></h6>
                                    </td>
                                    <td>
                                        <h6 class="mb-0 text-md"><?= $row->item_code ?></h6>
                                    </td>
                                    <td>
                                        <p class="text-sm font-weight-bold mb-0"><?= $row->hsn_code ?></p>
                                    </td>
                                    <td>
                                        <p class="text-sm font-weight-bold mb-0"><?= $row->tax_name ?> </p>
                                    </td>
                                    <td>
                                        <p class="text-sm font-weight-bold mb-0"><?= $row->category ?></p>
                                    </td>
                                    <td>
                                        <p class="text-sm font-weight-bold mb-0"><?= $row->sub_category ?></p>
                                    </td>
                                    <td>
                                        <p class="text-sm font-weight-bold mb-0"><?= $row->category_type ?></p>
                                    </td>
                                    <td class="align-middle text-center text-sm">
                                    <?php echo ($row->status == 1) ?  ' <span class="badge badge-sm badge-success">active</span>':  ' <span class="badge badge-sm badge-danger">Inactive</span>' ?>
                                    </td>
                                    <td class="text-sm">
                                        <a href="<?=base_url('All-items/edit/'.$row->item_id)?>" class="mx-3" data-bs-toggle="tooltip" data-bs-original-title="Edit product">
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
    if (document.getElementById('all-item-list')) {
        const dataTableSearch = new simpleDatatables.DataTable("#all-item-list", {
            searchable: true,
            fixedHeight: false,
            perPage: 7
        });

        document.querySelectorAll(".export").forEach(function(el) {
            el.addEventListener("click", function(e) {
                var type = el.dataset.type;

                var data = {
                    type: type,
                    filename: "all-item-list" + type,
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
    if (document.getElementById('choices-sub-category')) {
        var element = document.getElementById('choices-sub-category');
        const example = new Choices(element, {
            searchEnabled: false
        });
    };
</script>