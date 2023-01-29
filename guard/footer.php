<footer class="text-center text-lg-start bg-light text-muted">
        <div class="text-center p-4" style="background-color: rgba(0, 0, 0, 0.05);">
          © 2022 Copyright:
          <a class="text-reset fw-bold" href="#">Design by BSIT-4b, Team-Bitcode</a>
        </div>
      </footer>
      </div>
    </div>

    <script src="../assets/js/sweetAlert.js"></script>
    <script src="../assets/vendors/jquery/dist/jquery.min.js"></script>
    <script src="../assets/vendors/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/vendors/fastclick/lib/fastclick.js"></script>
    <script src="../assets/vendors/nprogress/nprogress.js"></script>
    <script src="../assets/vendors/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js"></script>
    <script src="../assets/js/custom.min.js"></script>
    <script src="../assets/qrGenerator/qrcode-with-logo.min.js"></script>

    <script>
      let page = '<?php echo isset($_GET['page']) ? $_GET['page'] : '' ?>';

      let navbar = document.querySelector('#sidebar-menu li');
      let items  = document.querySelector('#sidebar-menu li.nav-'+page);

      if(page != '') {
        navbar.classList.remove('active');
        items.classList.add('active');
      } 
    </script>
  </body>
</html>