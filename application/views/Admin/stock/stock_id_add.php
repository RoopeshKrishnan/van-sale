<div class="container-fluid py-4">
    <div class="row justify-content-center">
        <div class="col-10">
            <div class="card">
                <div class="card-body">
                    <form id="stock_id_form" >
                        <div class="button-row d-flex  ">
                            <h5 class="font-weight-bolder mb-0">Stock Open</h5>
                            <button class="px-sm-5 btn bg-gradient-success ms-auto mb-0" type="submit">Submit</button>
                        </div>

                        <div class=" ">
                            <div class="row mt-3">
                                <div class="col-12 col-sm-6">
                                    <div class="input-group input-group-dynamic">
                                        <label class="form-label bg-white pe-5" style="z-index: 1;">Date </label>
                                        <input class="  form-control" name="stock_date" type="date" />
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6 mt-3 mt-sm-0">
                                    <select class="form-control" name="user_id" id="choices-exicutive">
                                        <option value="" selected disabled>Executive</option>
                                        <?php
                                        foreach ($user as $row) {
                                            echo '<option value="' . $row->user_id . '">' . $row->user_name . '</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-12 col-sm-6">
                                    <select class="form-control" name="driver_id" id="choices-driver">
                                        <option value="" selected disabled>Driver</option>
                                        <?php
                                        foreach ($driver as $row) {
                                            echo '<option value="' . $row->driver_id . '">' . $row->driver_name . '</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-12 col-sm-6 mt-3 mt-sm-0">
                                    <select class="form-control" name="vehicle_id" id="choices-vehicle">
                                     <option value="" selected disabled>Vehicle</option>
                                        <?php
                                        foreach ($vehicle as $row) {
                                            echo '<option value="' . $row->vehicle_id . '">' . $row->vehicle_number . '</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="assets/js/plugins/choices.min.js"></script>




<script>
    if (document.getElementById('choices-exicutive')) {
        var element = document.getElementById('choices-exicutive');
        const example = new Choices(element, {
            searchEnabled: false
        });
    };
    if (document.getElementById('choices-driver')) {
        var element = document.getElementById('choices-driver');
        const example = new Choices(element, {
            searchEnabled: false
        });
    };
    if (document.getElementById('choices-vehicle')) {
        var element = document.getElementById('choices-vehicle');
        const example = new Choices(element, {
            searchEnabled: false
        });
    };
</script>