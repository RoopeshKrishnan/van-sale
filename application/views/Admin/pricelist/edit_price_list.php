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
                <form id="price_list_form" method="POST">
                    <div class="card-header pb-0">
                        <div class="d-lg-flex">
                            <div>
                                <h5 class="mb-0">Edit Price List</h5>

                            </div>
                            <div class="ms-auto my-auto mt-lg-0 mt-4">
                                <div class="ms-auto my-auto">



                                    <button class="btn btn-primary mb-0 mt-sm-0 mt-1 px-5" type="submit" name="button">submit</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body px-0 pb-0">
                        <div class="table-responsive">
                            <table class="table table-flush" id="pricelist-edit">
                                <thead class="thead-light">
                                    <tr>
                                        <th class="  text-uppercase text-secondary text-xs font-weight-bolder ">sl/no</th>
                                        <th class="  text-uppercase text-secondary text-xs font-weight-bolder ">item</th>
                                        <th class="  text-uppercase text-secondary text-xs font-weight-bolder ">item tax </th>
                                        <th class="  text-uppercase text-secondary text-xs font-weight-bolder ">A</th>
                                        <th class="  text-uppercase text-secondary text-xs font-weight-bolder ">b</th>
                                        <th class="  text-uppercase text-secondary text-xs font-weight-bolder ">c</th>
                                        <th class="  text-uppercase text-secondary text-xs font-weight-bolder ">d</th>
                                        <th class="  text-uppercase text-secondary text-xs font-weight-bolder ">e</th>
                                        <th class="  text-uppercase text-secondary text-xs font-weight-bolder ">f</th>
                                        <th class="  text-uppercase text-secondary text-xs font-weight-bolder ">g</th>
                                        <th class="  text-uppercase text-secondary text-xs font-weight-bolder ">h</th>
                                        <th class="  text-uppercase text-secondary text-xs font-weight-bolder ">i</th>
                                        <th class="  text-uppercase text-secondary text-xs font-weight-bolder ">j</th>

                                    </tr>
                                    <tr>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <?php
                                        $j = 0;

                                        foreach ($pricelist_names as $row) {
                                        ?>
                                            <th>
                                                <input type="hidden" name="pricelist_name_ids[<?= $j ?>]" value="<?= $row->price_list_name_id ?>">
                                                <div class="form-check form-switch  ">
                                                    <input class="form-check-input " type="checkbox" id="flexSwitchCheckDefault" name="pricelist_status[<?= $j ?>]" <?php echo $row->status == 1 ? 'checked' : ''; ?>>
                                                    <label class="form-check-label mt-1 text-xxs" for="flexSwitchCheckDefault">status</label>
                                                </div>
                                                <div class="input-group input-group-outline ">
                                                    <label class="form-label"> Name</label>
                                                    <input type="text" name="price_list_alias_names[<?= $j ?>]" class="form-control" <?php echo $row->pricelist_alias_name ? 'value="' . $row->pricelist_alias_name . '"' : ''; ?>>
                                                </div>
                                                <div class="form-check form-switch  ">
                                                    <input class="form-check-input " type="checkbox" id="flexSwitchCheckDefault" name="pricelist_taxes[<?= $j ?>]" <?php echo $row->tax_included == 1 ? 'checked' : ''; ?>>
                                                    <label class="form-check-label mt-1 text-xxs" for="flexSwitchCheckDefault">Tax included</label>
                                                </div>
                                            </th>
                                        <?php $j++;
                                        } ?>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $sl_no = 0;
                                    $i = 0;
                                    foreach ($item as $row) {
                                        $sl_no++;
                                        $pricelist = $this->db->where('item_id', $row->item_id)->get('pricelist_item')->row();

                                    ?>
                                        <tr>
                                            <td>
                                                <p class="text-xs font-weight-bold mb-0"><?= $sl_no ?></p>
                                                <input type="hidden" name="item_id[<?= $i ?>]" value="<?= $row->item_id ?>">
                                            </td>
                                            <td>
                                                <h6 class="mb-0 text-md"><?= $row->item_name ?></h6>
                                            </td>
                                            <td>
                                                <h6 class="mb-0 text-md"><?= ($row->tax) ? $row->tax : 0 ?>%</h6>
                                            </td>
                                            <td>
                                              
                                                <div class="input-group input-group-outline">
                                                    <label class="form-label">Price List</label>
                                                    <input type="number" name="price_list_a[<?= $i ?>]" class="form-control" <?php echo $pricelist && $pricelist->pricelist_a_amount != 0 ? 'value="' . $pricelist->pricelist_a_amount . '"' : ''; ?>>
                                                </div>
                                                <input type="hidden" name="pname_id_a[<?= $i ?>]" value="1">

                                            </td>
                                            <td>
                                               

                                                <div class="input-group input-group-outline ">
                                                    <label class="form-label">Price List</label>
                                                    <input type="number" name="price_list_b[<?= $i ?>]" class="form-control" <?php echo $pricelist && $pricelist->pricelist_b_amount != 0 ? 'value="' . $pricelist->pricelist_b_amount . '"' : ''; ?> >
                                                </div>

                                                <input type="hidden" name="pname_id_b[<?= $i ?>]" value="2">

                                            </td>
                                            <td>
                                              

                                                <div class="input-group input-group-outline ">
                                                    <label class="form-label">Price List</label>
                                                    <input type="number" name="price_list_c[<?= $i ?>]" class="form-control" <?php echo $pricelist && $pricelist->pricelist_c_amount != 0 ? 'value="' . $pricelist->pricelist_c_amount . '"' : ''; ?>  >
                                                </div>

                                                <input type="hidden" name="pname_id_c[<?= $i ?>]" value="3">

                                            </td>
                                            <td>
                                               

                                                <div class="input-group input-group-outline ">
                                                    <label class="form-label">Price List</label>
                                                    <input type="number" name="price_list_d[<?= $i ?>]" class="form-control" <?php echo $pricelist && $pricelist->pricelist_d_amount != 0 ? 'value="' . $pricelist->pricelist_d_amount . '"' : ''; ?>  >
                                                </div>

                                                <input type="hidden" name="pname_id_d[<?= $i ?>]" value="4">

                                            </td>
                                            <td>
                                                

                                                <div class="input-group input-group-outline ">
                                                    <label class="form-label">Price List</label>
                                                    <input type="number" name="price_list_e[<?= $i ?>]" class="form-control" <?php echo $pricelist && $pricelist->pricelist_e_amount != 0 ? 'value="' . $pricelist->pricelist_e_amount . '"' : ''; ?>   >
                                                </div>

                                                <input type="hidden" name="pname_id_e[<?= $i ?>]" value="5">

                                            </td>
                                            <td>
                                                

                                                <div class="input-group input-group-outline ">
                                                    <label class="form-label">Price List</label>
                                                    <input type="number" name="price_list_f[<?= $i ?>]" class="form-control" <?php echo $pricelist && $pricelist->pricelist_f_amount != 0 ? 'value="' . $pricelist->pricelist_f_amount . '"' : ''; ?>  >
                                                </div>

                                                <input type="hidden" name="pname_id_f[<?= $i ?>]" value="6">

                                            </td>
                                            <td>
                                               

                                                <div class="input-group input-group-outline ">
                                                    <label class="form-label">Price List</label>
                                                    <input type="number" name="price_list_g[<?= $i ?>]" class="form-control" <?php echo $pricelist && $pricelist->pricelist_g_amount != 0 ? 'value="' . $pricelist->pricelist_g_amount . '"' : ''; ?>  >
                                                </div>

                                                <input type="hidden" name="pname_id_g[<?= $i ?>]" value="7">

                                            </td>
                                            <td>
                                               

                                                <div class="input-group input-group-outline ">
                                                    <label class="form-label">Price List</label>
                                                    <input type="number" name="price_list_h[<?= $i ?>]" class="form-control" <?php echo $pricelist && $pricelist->pricelist_h_amount != 0 ? 'value="' . $pricelist->pricelist_h_amount . '"' : ''; ?>  >
                                                </div>
                                                <input type="hidden" name="pname_id_h[<?= $i ?>]" value="8">


                                            </td>
                                            <td>
                                               

                                                <div class="input-group input-group-outline ">
                                                    <label class="form-label">Price List</label>
                                                    <input type="number" name="price_list_i[<?= $i ?>]" class="form-control" <?php echo $pricelist && $pricelist->pricelist_i_amount != 0 ? 'value="' . $pricelist->pricelist_i_amount . '"' : ''; ?>  >
                                                </div>

                                                <input type="hidden" name="pname_id_i[<?= $i ?>]" value="9">

                                            </td>
                                            <td>
                                               

                                                <div class="input-group input-group-outline ">
                                                    <label class="form-label">Price List</label>
                                                    <input type="number" name="price_list_j[<?= $i ?>]" class="form-control" <?php echo $pricelist && $pricelist->pricelist_j_amount != 0 ? 'value="' . $pricelist->pricelist_j_amount . '"' : ''; ?>  >
                                                </div>

                                                <input type="hidden" name="pname_id_j[<?= $i ?>]" value="10">

                                            </td>
                                        </tr>
                                    <?php $i++;
                                    } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- <script src="assets/js/plugins/datatables.js"></script> -->

<script>
    if (document.getElementById('pricelist-edit')) {
        const dataTableSearch = new simpleDatatables.DataTable("#pricelist-edit", {
            searchable: true,
            fixedHeight: false,
            perPage: 7
        });
    };
</script>