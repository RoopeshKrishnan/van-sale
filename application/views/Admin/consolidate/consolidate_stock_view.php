<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card">

                <div class="card-header pb-0">
                    <div class="d-lg-flex ">
                        <div>
                            <h5 class="mb-0">Consolidate Stock View</h5>
                        </div>
                        <div class="ms-auto my-auto mt-lg-0 mt-4">
                            <div class="ms-auto my-auto">
                                <button class="btn btn-outline-primary btn-sm export mb-0 mt-sm-0 mt-1" data-type="csv" type="button" name="button">Export</button>
                            </div>
                        </div>
                    </div>

                    <div class="d-lg-flex mt-4">
                        <div>
                            <h4 class="mb-2">consolidate id </h4>
                        </div>

                        <div class="ms-lg-5">

                            <h4 class="mb-2">Date</h4>

                        </div>

                        <div class="ms-lg-5">

                            <h4 class="mb-2">exicutive</h4>

                        </div>

                        <div class="ms-lg-5">

                            <h4 class="mb-2">driver</h4>

                        </div>

                        <div class="ms-lg-5">

                            <h4 class="mb-2">Vehicle</h4>

                        </div>

                    </div>
                </div>
                <div class="card-body px-0 pb-0">
                    <div class="d-lg-flex ms-4 mt-4">
                        <div class="col-8 col-md-3 mb-2">
                            <select class="form-control " id="choices-category">
                                <option value="" selected disabled>Category</option>
                                <option value="">1</option>
                                <option value="">2</option>
                            </select>
                        </div>

                        <div class="col-8 col-md-3 ms-lg-5 mb-2">

                            <select class="form-control " id="choices-subcategory1">
                                <option value="" selected disabled>Sub category</option>
                                <option value="">1</option>
                                <option value="">2</option>
                            </select>

                        </div>

                        <div class="col-8 col-md-3 ms-lg-5 mb-2">

                            <select class="form-control " id="choices-subcategory2">
                                <option value="" selected disabled>Sub category</option>
                                <option value="">1</option>
                                <option value="">2</option>
                            </select>

                        </div>

                    </div>
                    <div class="table-responsive">
                        <table class="table table-flush" id="consolidate-stock-view">
                            <thead class="thead-light">
                                <tr>
                                    <th class="  text-uppercase text-secondary text-xs font-weight-bolder ">sl/no</th>
                                    <th class="  text-uppercase text-secondary text-xs font-weight-bolder ">item</th>
                                    <th class="  text-uppercase text-secondary text-xs font-weight-bolder ">stock</th>

                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <p class="text-xs font-weight-bold mb-0">1</p>
                                    </td>
                                    <td>
                                        <h6 class="mb-0 text-md">item 1</h6>
                                    </td>
                                    <td>
                                        <h6 class="mb-0 text-md">stock</h6>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <p class="text-xs font-weight-bold mb-0">2</p>
                                    </td>
                                    <td>
                                        <h6 class="mb-0 text-md">item 2</h6>
                                    </td>
                                    <td>
                                        <h6 class="mb-0 text-md">stock</h6>
                                    </td>
                                </tr>
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
    if (document.getElementById('consolidate-stock-view')) {
        const dataTableSearch = new simpleDatatables.DataTable("#consolidate-stock-view", {
            searchable: true,
            fixedHeight: false,
            perPage: 7
        });

        document.querySelectorAll(".export").forEach(function(el) {
            el.addEventListener("click", function(e) {
                var type = el.dataset.type;

                var data = {
                    type: type,
                    filename: "consolidate-stock-view" + type,
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
    if (document.getElementById('choices-subcategory1')) {
        var element = document.getElementById('choices-subcategory1');
        const example = new Choices(element, {
            searchEnabled: false
        });
    };
    if (document.getElementById('choices-subcategory2')) {
        var element = document.getElementById('choices-subcategory2');
        const example = new Choices(element, {
            searchEnabled: false
        });
    };
</script>