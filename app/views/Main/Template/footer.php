<?php
/*
  Mirarus MVC Dns System for everyone
  Copyright (C) 2019 by Mirarus

  This program is free software
  it under the terms of the GNU General Public License as published by
  the Free Software Foundation, either version 3 of the License, or
  any later version.

  This program is distributed in the hope that it will be useful,
  but WITHOUT ANY WARRANTY; without even the implied warranty of
  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
  GNU General Public License for more details.

  You should have received a copy of the GNU General Public License
  along with this program.  If not, see <http://www.gnu.org/licenses/>.
    
  for help look https://mirarus.com/mvc-ts3-dns-system
*/
?>
        </div>
        <!-- content-wrapper ends -->
        <!-- partial:partials/_footer.html -->
        <footer class="footer">
          <div class="d-sm-flex justify-content-center justify-content-sm-between">
            <span class="text-muted text-center text-sm-left d-block d-sm-inline-block"><?php echo $Site_Footer; ?></span>
            <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Made By <i class="mdi mdi-heart text-danger"></i>Mirarus</span>
          </div>
        </footer>
        <!-- partial -->
      </div>
      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->

  <!-- plugins:js -->
  <script src="<?php echo VMADIR; ?>/assets/vendors/js/vendor.bundle.base.min.js"></script>
  <script src="<?php echo VMADIR; ?>/assets/vendors/js/vendor.bundle.addons.js"></script>
  <!-- endinject -->
  <!-- Plugin js for this page-->
  <!-- End plugin js for this page-->
  <!-- inject:js -->
  <script src="<?php echo VMADIR; ?>/assets/js/off-canvas.js"></script>
  <script src="<?php echo VMADIR; ?>/assets/js/hoverable-collapse.js"></script>
  <script src="<?php echo VMADIR; ?>/assets/js/misc.js"></script>
  <!-- endinject -->
  <!-- Custom js for this page-->
  <script src="<?php echo VMADIR; ?>/assets/js/password.js"></script>
  <?php echo $_GET['url'] == 'dns' || $_GET['url'] == 'dns/create' ? '<script src="'.VMADIR.'/assets/js/dns.js"></script>' : ''; ?>
  <?php echo $_GET['url'] == 'support' || $_GET['url'] == 'support/create' || explode('/', $_GET['url'])['0'] == 'support' ? '<script src="'.VMADIR.'/assets/js/support.js"></script>' : ''; ?>
  
<!-- End custom js for this page-->
</body>

</html>