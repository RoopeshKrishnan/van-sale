<footer class="footer py-4  ">
        <div class="container-fluid">
          <div class="row align-items-center justify-content-lg-between">
            <div class="col-lg-6 mb-lg-0 mb-4">
              <div class="copyright text-center text-sm text-muted text-lg-start">
                ©
                <script>
                  document.write(new Date().getFullYear())
                </script>,
                
                <a href="" class="font-weight-bold" target="_blank">Grandlady</a> 
              </div>
            </div>
            <div class="col-lg-6">
              <ul class="nav nav-footer justify-content-center justify-content-lg-end">
                <li class="nav-item">
                  <a href=" " class="nav-link text-muted" target="_blank">one</a>
                </li>
                <li class="nav-item">
                  <a href=" " class="nav-link text-muted" target="_blank">two</a>
                </li>
                <li class="nav-item">
                  <a href=" " class="nav-link text-muted" target="_blank">three</a>
                </li>
                <li class="nav-item">
                  <a href=" " class="nav-link pe-0 text-muted" target="_blank">four</a>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </footer>
  </main>
  <!--  jquery   -->

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>

  <!--   Core JS Files   -->
  <script src="<?= base_url() ?>assets/js/core/popper.min.js"></script>
  <script src="<?= base_url() ?>assets/js/core/bootstrap.min.js"></script>
  <script src="<?= base_url() ?>assets/js/plugins/perfect-scrollbar.min.js"></script>
  <script src="<?= base_url() ?>assets/js/plugins/smooth-scrollbar.min.js"></script> 

  <input type="hidden" id="base" value="<?php echo base_url(); ?>">

  <script src="<?php echo base_url() ?>assets/js/Admin/area.js"></script>
  <script src="<?php echo base_url() ?>assets/js/Admin/driver.js"></script>
  <script src="<?php echo base_url() ?>assets/js/Admin/vehicle.js"></script>
  <script src="<?php echo base_url() ?>assets/js/Admin/user.js"></script>
  <script src="<?php echo base_url() ?>assets/js/Admin/customer.js"></script>
  <script src="<?php echo base_url() ?>assets/js/Admin/group.js"></script>
  <script src="<?php echo base_url() ?>assets/js/Admin/category.js"></script>
  <script src="<?php echo base_url() ?>assets/js/Admin/sub_category.js"></script>
  <script src="<?php echo base_url() ?>assets/js/Admin/category_type.js"></script>
  <script src="<?php echo base_url() ?>assets/js/Admin/tax_type.js"></script>
  <script src="<?php echo base_url() ?>assets/js/Admin/tax.js"></script>
  <script src="<?php echo base_url() ?>assets/js/Admin/item.js"></script>
  <script src="<?php echo base_url() ?>assets/js/Admin/stock.js"></script>
  <script src="<?php echo base_url() ?>assets/js/Admin/price_list.js"></script>
  <script src="<?php echo base_url() ?>assets/js/Admin/order.js"></script>
  <script src="<?php echo base_url() ?>assets/js/Admin/consolidate.js"></script>
  <script src="<?php echo base_url() ?>assets/js/Admin/bill.js"></script>



  <script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
      var options = {
        damping: '0.5'
      }
      Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
  </script>
  <!-- toaster js -->
<script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<!-- bootbox js -->
<script src="<?= base_url() ?>assets/js/bootbox/bootbox.min.js"></script>
<!-- select2 -->
<script src="<?php echo base_url(); ?>assets/select2/dist/js/select2.min.js"></script>
  <!-- Github buttons -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
  <!-- <script src="<?= base_url() ?>assets/js/material-dashboard.min.js?v=3.1.0"></script> -->
  <script src="<?= base_url() ?>assets/js/prog.js"></script>
</body>

</html>