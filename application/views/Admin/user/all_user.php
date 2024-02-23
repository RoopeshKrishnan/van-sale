<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card">

                <div class="card-header pb-0">
                    <div class="d-lg-flex">
                        <div>
                            <h5 class="mb-0">Users</h5>

                        </div>

                        <div class="ms-lg-auto my-auto mt-lg-0 mt-4 col-8 col-sm-6 col-md-4 col-lg-3">
                            <select class="form-control " name=" " id="choices-area">
                                <option value="" selected>Area</option>
                                <option value="">12345678900</option>
                                <option value="">2</option>
                            </select>
                        </div>

                        <div class="ms-lg-auto my-auto mt-lg-0 mt-4 col-8 col-sm-6 col-md-4 col-lg-3">
                            <select class="form-control " name=" " id="choices-scheme">
                                <option value="" selected>Scheme</option>
                                <option value="">12345678900 </option>
                                <option value="">2</option>
                            </select>
                        </div>
                        <?php 
                            if(!$all_users->num_rows()>0){

                            }else{
                        
                        
                        ?>

                        <div class="ms-auto my-auto mt-lg-0 mt-4">
                            <div class="ms-auto my-auto">

                                <a href="user_creation" class="btn bg-gradient-primary btn-sm mb-0" target="_blank">+&nbsp; New User</a>

                                <button class="btn btn-outline-primary btn-sm export mb-0 mt-sm-0 mt-1" data-type="csv" type="button" name="button">Export</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body px-0 pb-0">
                    <div class="table-responsive">
                        <table class="table table-flush" id="user-list">
                            <thead class="thead-light">
                                <tr>
                                    <th class="  text-uppercase text-secondary text-xs font-weight-bolder ">sl/no</th>
                                    <th class="  text-uppercase text-secondary text-xs font-weight-bolder ">exictive name</th>
                                    <th class="  text-uppercase text-secondary text-xs font-weight-bolder ">type of scheme</th>
                                    <th class="  text-uppercase text-secondary text-xs font-weight-bolder ">area</th>
                                    <th class="  text-uppercase text-secondary text-xs font-weight-bolder ">prefix</th>
                                    <th class=" text-center text-uppercase text-secondary text-xs font-weight-bolder ">last number</th>
                                    <th class=" text-center text-uppercase text-secondary text-xs font-weight-bolder ">user status</th>
                                    <th class="  text-uppercase text-secondary text-xs font-weight-bolder ">view / edit / delete</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                 $all_users_data = $all_users->result();
                                 $i = 0;
                                 foreach ($all_users_data as $row) {
                                    $i++;
                                ?>
                                <tr>
                                    <td>
                                        <p class="text-xs font-weight-bold mb-0"><?= $i ?></p>
                                    </td>
                                    <td>
                                    <h6 class="mb-0 text-md"><?= $row->user_name ?></h6>
                                    </td>
                                    <td>
                                    <p class="text-sm font-weight-bold mb-0"><?= $row->type_of_scheme ?></p>
                                    </td>
                                    <td>
                                    <p class="text-sm font-weight-bold mb-0"><?= $row->area ?></p>
                                    </td>
                                    <td>
                                    <p class="text-sm font-weight-bold mb-0"><?= $row->prefix ?></p>
                                    </td>
                                    <td class="align-middle text-center">
                                    <span class="text-secondary text-sm font-weight-normal"><?= $row->	last_bill_number ?></span>
                                    </td>
                                    <td class="align-middle text-center text-sm">
                                        <?php echo ($row->profile_status == 1) ?  ' <span class="badge badge-sm badge-success">active</span>':  ' <span class="badge badge-sm badge-danger">Inactive</span>' ?>
                                   
                                    </td>
                                    <td class="text-sm ">
                                        <div class="">
                                        <a href="<?=base_url()?>user/index" data-bs-toggle="tooltip" data-bs-original-title="Preview product">
                                            <i class="material-icons text-primary position-relative text-lg">visibility</i>
                                        </a>
                                        <a href="<?=base_url('All-user/edit/'.$row->user_id)?>" value="" class="mx-3" data-bs-toggle="tooltip" data-bs-original-title="Edit product">
                                            <i class="material-icons text-success position-relative text-lg">drive_file_rename_outline</i>
                                        </a>
                                  
                                        <a href="<?=base_url()?>user/index" data-bs-toggle="tooltip" data-bs-original-title="Delete product">
                                            <i class="material-icons text-danger position-relative text-lg">delete</i>
                                        </a>
                                        </div>
                                        
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
    if (document.getElementById('user-list')) {
        const dataTableSearch = new simpleDatatables.DataTable("#user-list", {
            searchable: true,
            fixedHeight: false,
            perPage: 7
        });

        document.querySelectorAll(".export").forEach(function(el) {
            el.addEventListener("click", function(e) {
                var type = el.dataset.type;

                var data = {
                    type: type,
                    filename: "user" + type,
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
    if (document.getElementById('choices-scheme')) {
        var element = document.getElementById('choices-scheme');
        const example = new Choices(element, {
            searchEnabled: false
        });
    };
</script>