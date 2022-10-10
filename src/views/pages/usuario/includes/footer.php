  <!-- ======= Footer ======= -->
  <footer>
    <div class="container">
      <div class="row">
        <div class="col-sm-12">
          <div class="copyright-box">
            <p class="copyright">&copy; Copyright <strong>iahgod</strong>. All Rights Reserved</p>
            <div class="credits">
              Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </footer><!-- End  Footer -->

  <div id="preloader"></div>
  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>


  <?php if(!empty($_SESSION['flash'])):?>
    <script>window.addEventListener('load', (event) => {toast('<?=$_SESSION['flash'];?>');});</script>
    <?=$_SESSION['flash']='';?>
  <?php endif;?>

  <script type="text/javascript" src="<?=$base;?>/assets/js/base.js"></script>
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <!-- Vendor JS Files -->
  <script src="<?=$base;?>/assets2/vendor/purecounter/purecounter_vanilla.js"></script>
  <script src="<?=$base;?>/assets2/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="<?=$base;?>/assets2/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="<?=$base;?>/assets2/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="<?=$base;?>/assets2/vendor/typed.js/typed.min.js"></script>
  

  <!-- Template Main JS File -->
  <script src="<?=$base;?>/assets2/js/main.js"></script>

</body>

</html>