<style>
  .fw-semibold {
    font-weight: 600 !important;
  }
</style>

<div class="container-fluid pb-4">
  <div class="row px-3">
    <a href="profile_edit" type="button" class="w-100 w-sm-15 btn btn-primary btn-sm ms-auto">Edit Profile </a>
  </div>
  <div class="row">
    <div class="col-md-4 ">
      <div class="card card-profile">
        <img src="<?= base_url() ?>assets/img/bg-profile.jpg" alt="Image placeholder" class="card-img-top">
        <div class="row justify-content-center">
          <div class="col-4 col-lg-4 order-lg-2">
            <div class="mt-n4 mt-lg-n6 mb-4 mb-lg-0">
              <a href="javascript:;">
                <img src="<?= base_url() ?>assets/img/avatar/user.png" class="rounded-circle img-fluid border border-2 border-white">
              </a>
            </div>
          </div>
        </div>

        <div class="card-body pt-0">
          <div class="text-center mt-4">
            <h5> Mark Davis<span class="font-weight-light">, 35</span> </h5>
            <div class="h6 ">
              <i class="ni business_briefcase-24 mr-2"></i>Solution Manager - Officer
            </div>
            <div class="h6 mt-4 font-weight-300">
              <i class="ni location_pin mr-2"></i>join date
            </div>
          </div>
        </div>

        <!-- About User -->

        <div class="card-body">
          <p class="text-uppercase text-sm">About</p>
          <ul class="list-unstyled mb-5 ">

            <li class="d-flex align-items-center mb-3"><span class="fw-semibold mx-2">Status:</span> <span class="badge badge-success badge-sm my-auto   me-3">Active</span></li>
            <li class="d-flex align-items-center mb-3"><span class="fw-semibold mx-2">Role:</span> <span>Developer</span></li>
            <li class="d-flex align-items-center mb-3"><span class="fw-semibold mx-2">Country:</span> <span>USA</span></li>
            <li class="d-flex align-items-center mb-3"><span class="fw-semibold mx-2">Languages:</span> <span>English</span></li>
          </ul>
          <p class="text-uppercase text-sm">CONTACTS</p>
          <ul class="list-unstyled mb-5 ">
            <li class="d-flex align-items-center mb-3"><span class="fw-semibold mx-2">Contact:</span> <span>(123) 456-7890</span></li>
            <li class="d-flex align-items-center mb-3"><span class="fw-semibold mx-2">Skype:</span> <span>john.doe</span></li>
            <li class="d-flex align-items-center mb-3"><span class="fw-semibold mx-2">Email:</span> <span>john.doe@example.com</span></li>
          </ul>
          <p class="text-uppercase text-sm">Overview</p>

          <ul class="list-unstyled ">
            <li class="d-flex align-items-center mb-3"><i class="bx bx-check"></i><span class="fw-semibold mx-2">Task Compiled:</span> <span>13.5k</span></li>
            <li class="d-flex align-items-center mb-3"><i class='bx bx-customize'></i><span class="fw-semibold mx-2">Projects Compiled:</span> <span>146</span></li>
            <li class="d-flex align-items-center"><i class="bx bx-user"></i><span class="fw-semibold mx-2">Connections:</span> <span>897</span></li>
          </ul>
        </div>

        <!--/ About User -->

      </div>
    </div>

    <div class="col-md-8">

      <div class="card mb-3">
        <div class="col-lg-12 col-md-6 my-sm-auto ms-sm-auto me-sm-0 mx-auto mt-3 p-3">
          <div class="nav-wrapper position-relative end-0">
            <ul class="nav nav-pills nav-fill p-1" role="tablist">
              <li class="nav-item">
                <a class="nav-link active mb-0 px-0 py-1 d-flex align-items-center justify-content-center " data-bs-toggle="tab" href="#tabs-1" role="tab" aria-selected="true">
                  <i class="ni ni-app"></i>
                  <span class="ms-2">tab 1</span>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link mb-0 px-0 py-1 d-flex align-items-center justify-content-center " data-bs-toggle="tab" href="#tabs-2" role="tab" aria-selected="false">
                  <i class="ni ni-app"></i>
                  <span class="ms-2">tab 2</span>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link mb-0 px-0 py-1 d-flex align-items-center justify-content-center " data-bs-toggle="tab" href="javascript:;" role="tab" aria-selected="false">
                  <i class="ni ni-app"></i>
                  <span class="ms-2">tab 3</span>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link mb-0 px-0 py-1 d-flex align-items-center justify-content-center " data-bs-toggle="tab" href="javascript:;" role="tab" aria-selected="false">
                  <i class="ni ni-app"></i>
                  <span class="ms-2">tab 3</span>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link mb-0 px-0 py-1 d-flex align-items-center justify-content-center " data-bs-toggle="tab" href="javascript:;" role="tab" aria-selected="false">
                  <i class="ni ni-app"></i>
                  <span class="ms-2">tab 3</span>
                </a>
              </li>
            </ul>
          </div>
        </div>
      </div>



      <div class="card tab-content">
        <div class="card-body tab-pane fade show active" id="tabs-1" role="tabpanel" aria-labelledby="tab-1">
          <p class="font-weight-normal h6 mb-3">User Information</p>
          <div class="row">
            <div class="col-md-6">
              <p class=" text-xs m-0">Username</p>
              <h6 class="text-uppercase mb-4">
                Username
              </h6>
            </div>
            <div class="col-md-6">
              <p class=" text-xs m-0">Email address</p>
              <h6 class="text-uppercase mb-4">
                Email address
              </h6>
            </div>
            <div class="col-md-6">
              <p class=" text-xs m-0">First name</p>
              <h6 class="text-uppercase  mb-4">
                First name
              </h6>
            </div>
            <div class="col-md-6">
              <p class=" text-xs m-0">Last name</p>
              <h6 class="text-uppercase  mb-4">
                Last name
              </h6>
            </div>
          </div>
          <hr class="horizontal dark">
          <p class="font-weight-normal h6 mb-3">Contact Information</p>
          <div class="row">
            <div class="col-md-12">
              <p class=" text-xs m-0">Address</p>
              <h6 class="text-uppercase  mb-4">
                Address
              </h6> 
            </div>
            <div class="col-md-4">
            <p class=" text-xs m-0">City</p>
              <h6 class="text-uppercase  mb-4">
              City
              </h6>  
            </div>
            <div class="col-md-4">
            <p class=" text-xs m-0">Country</p>
              <h6 class="text-uppercase  mb-4">
              Country
              </h6>  
            </div>
            <div class="col-md-4">
            <p class=" text-xs m-0">Postal code</p>
              <h6 class="text-uppercase  mb-4">
              Postal code
              </h6>  
            </div>
          </div>
          <hr class="horizontal dark">
          <p class="font-weight-normal h6 mb-3">About me</p>
          <div class="row">
            <div class="col-md-12">
            <p class=" text-xs m-0">About me</p>
              <h6 class="text-uppercase  mb-4">
              About me
              </h6>  
            </div>
          </div>
        </div>

        <div class="card-body tab-pane fade" id="tabs-2" role="tabpanel" aria-labelledby="tab-2">
          <p class="text-uppercase h6 mb-3">tab-2</p>
          <div class="row">
            <div class="col-md-6">
              <div class="input-group input-group-dynamic mt-3  mb-4">
                <label for="example-text-input" class="form-label">Username</label>
                <input class="form-control" type="text" value="lucky.jesse">
              </div>
            </div>
            <div class="col-md-6">
              <div class="input-group input-group-dynamic mt-3  mb-4">
                <label for="example-text-input" class="form-label">Email address</label>
                <input class="form-control" type="email" value="jesse@example.com">
              </div>
            </div>
            <div class="col-md-6">
              <div class="input-group input-group-dynamic mt-3  mb-4">
                <label for="example-text-input" class="form-label">First name</label>
                <input class="form-control" type="text" value="Jesse">
              </div>
            </div>
            <div class="col-md-6">
              <div class="input-group input-group-dynamic mt-3  mb-4">
                <label for="example-text-input" class="form-label">Last name</label>
                <input class="form-control" type="text" value="Lucky">
              </div>
            </div>
          </div>
          <hr class="horizontal dark">
          <p class="text-uppercase h6 mb-3">Contact Information</p>
          <div class="row">
            <div class="col-md-12">
              <div class="input-group input-group-dynamic mt-3  mb-4">
                <label for="example-text-input" class="form-label">Address</label>
                <input class="form-control" type="text" value="Bld Mihail Kogalniceanu, nr. 8 Bl 1, Sc 1, Ap 09">
              </div>
            </div>
            <div class="col-md-4">
              <div class="input-group input-group-dynamic mt-3  mb-4">
                <label for="example-text-input" class="form-label">City</label>
                <input class="form-control" type="text" value="New York">
              </div>
            </div>
            <div class="col-md-4">
              <div class="input-group input-group-dynamic mt-3  mb-4">
                <label for="example-text-input" class="form-label">Country</label>
                <input class="form-control" type="text" value="United States">
              </div>
            </div>
            <div class="col-md-4">
              <div class="input-group input-group-dynamic mt-3  mb-4">
                <label for="example-text-input" class="form-label">Postal code</label>
                <input class="form-control" type="text" value="437300">
              </div>
            </div>
          </div>
          <hr class="horizontal dark">
          <p class="text-uppercase h6 mb-3">About me</p>
          <div class="row">
            <div class="col-md-12">
              <div class="input-group input-group-dynamic mt-3  mb-4">
                <label for="example-text-input" class="form-label">About me</label>
                <input class="form-control" type="text" value="">
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>
</div>