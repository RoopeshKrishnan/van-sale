<style>
    .form-switch .form-check-input:checked {
        border-color: #0d0de9;
        background-color: #1919e7;
    }
</style>

<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header pb-0">
                    <div class="d-lg-flex">
                        <div>
                            <h5 class="mb-0">Price List</h5>
                        </div>
                        <div class="ms-auto my-auto mt-lg-0 mt-4">
                            <div class="ms-auto my-auto">

                                <a href="<?= base_url() ?>edit-price-list" class="btn bg-gradient-primary btn-sm mb-0">+&nbsp; Edit Price List</a>

                                <button class="btn btn-outline-primary btn-sm export mb-0 mt-sm-0 mt-1" data-type="csv" type="button" name="button">Export</button>
                            </div>
                        </div>
                    </div>
                </div>
                <?php if (!$item_with_pricelist->num_rows() > 0) {
                    echo '<p class="text-center font-weight-bold mb-0">No Price Lists added</p>';
                } else { ?>
                    <div class="card-body px-0 pb-0">
                        <div class="table-responsive">
                            <table class="table table-flush" id="pricelist-list">
                                <thead class="thead-light">
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xs font-weight-bolder">sl/no</th>
                                        <th class="text-uppercase text-secondary text-xs font-weight-bolder">item</th>
                                        <th class="text-uppercase text-secondary text-xs font-weight-bolder">A</th>
                                        <th class="text-uppercase text-secondary text-xs font-weight-bolder">b</th>
                                        <th class="text-uppercase text-secondary text-xs font-weight-bolder">c</th>
                                        <th class="text-uppercase text-secondary text-xs font-weight-bolder">d</th>
                                        <th class="text-uppercase text-secondary text-xs font-weight-bolder">e</th>
                                        <th class="text-uppercase text-secondary text-xs font-weight-bolder">f</th>
                                        <th class="text-uppercase text-secondary text-xs font-weight-bolder">g</th>
                                        <th class="text-uppercase text-secondary text-xs font-weight-bolder">h</th>
                                        <th class="text-uppercase text-secondary text-xs font-weight-bolder">i</th>
                                        <th class="text-uppercase text-secondary text-xs font-weight-bolder">j</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $items_with_p = $item_with_pricelist->result();
                                    $i = 0;
                                    foreach ($items_with_p as $row) {
                                        $i++;
                                    ?>
                                        <tr>
                                            <td>
                                                <h6 class="mb-0 text-md"><?= $i ?></h6>
                                            </td>
                                            <td>
                                                <h6 class="mb-0 text-md"><?= $row->item_name ?></h6>
                                            </td>
                                            <td>
                                                <h6 class="mb-0 text-md"><?= ($row->pricelist_a_amount) ? $row->pricelist_a_amount : '--' ?></h6>
                                            </td>
                                            <td>
                                                <h6 class="mb-0 text-md"><?= ($row->pricelist_b_amount) ? $row->pricelist_b_amount : '--'  ?></h6>
                                            </td>
                                            <td>
                                                <h6 class="mb-0 text-md"><?= ($row->pricelist_c_amount) ? $row->pricelist_c_amount : '--'  ?></h6>
                                            </td>
                                            <td>
                                                <h6 class="mb-0 text-md"><?= ($row->pricelist_d_amount) ? $row->pricelist_d_amount : '--'  ?></h6>
                                            </td>
                                            <td>
                                                <h6 class="mb-0 text-md"><?= ($row->pricelist_e_amount) ? $row->pricelist_e_amount : '--'  ?></h6>
                                            </td>
                                            <td>
                                                <h6 class="mb-0 text-md"><?= ($row->pricelist_f_amount) ? $row->pricelist_f_amount : '--'  ?></h6>
                                            </td>
                                            <td>
                                                <h6 class="mb-0 text-md"><?= ($row->pricelist_g_amount) ? $row->pricelist_g_amount : '--' ?></h6>
                                            </td>
                                            <td>
                                                <h6 class="mb-0 text-md"><?= ($row->pricelist_h_amount) ? $row->pricelist_h_amount : '--'  ?></h6>
                                            </td>
                                            <td>
                                                <h6 class="mb-0 text-md"><?= ($row->pricelist_i_amount) ? $row->pricelist_i_amount : '--'  ?></h6>
                                            </td>
                                            <td>
                                                <h6 class="mb-0 text-md"><?= ($row->pricelist_j_amount) ? $row->pricelist_j_amount : '--'  ?></h6>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>

                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>
<script src="assets/js/plugins/datatables.js"></script>


<script>
    if (document.getElementById('pricelist-list')) {
        const dataTableSearch = new simpleDatatables.DataTable("#pricelist-list", {
            searchable: true,
            fixedHeight: false,
            perPage: 7
        });

        document.querySelectorAll(".export").forEach(function(el) {
            el.addEventListener("click", function(e) {
                var type = el.dataset.type;

                var data = {
                    type: type,
                    filename: "pricelist" + type,
                };

                if (type === "csv") {
                    // data.columnDelimiter = "|";
                }

                dataTableSearch.export(data);
            });
        });
    };
</script>