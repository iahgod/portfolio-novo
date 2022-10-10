<?=$render('partials/headerAdmin/head', ['title'=>$titulo]);?>

<main style="background-image:url('<?=$base;?><?=\src\Constant::IMAGEM_SITE_LOGIN_BACK?>');background-size: cover;background-position: center;">
    <div class="container">

      <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

              <div class="d-flex justify-content-center py-4">
                <a href="<?=$base;?>/admin" class="logo d-flex align-items-center w-auto">
                  <span class="d-none d-lg-block"><?=\src\Constant::TITULO_SITE?></span>
                </a>
              </div><!-- End Logo -->

              <div class="card mb-3">

                <div class="card-body">

                  <div class="pt-4 pb-2">
                    <h5 class="card-title text-center pb-0 fs-4"><?=$titulo?></h5>
                    <p class="text-center small">Por segurança, é necessário alterar a sua senha.</p>
                  </div>

                  <form action="" method="post" class="row g-3 needs-validation" novalidate>

                    <div class="col-12">
                      <div class="input-group has-validation">
                        <span class="input-group-text" id="inputGroupPrepend">Senha</span>
                        <input type="password" name="senha1" class="form-control" id="yourUsername" required>
                        <div class="invalid-feedback">Insira a senha</div>
                      </div>
                    </div>

                    <div class="col-12">
                      <div class="input-group has-validation">
                        <span class="input-group-text" id="inputGroupPrepend">Confirmação</span>
                        <input type="password" name="senha2" class="form-control" id="yourUsername" required>
                        <div class="invalid-feedback">Insira a confirmação</div>
                      </div>
                    </div>

                    <div class="col-12">
                      <button class="btn btn-primary w-100" type="submit">Alterar a senha</button>
                    </div>
                  </form>

                </div>
              </div>

              <div class="credits text-center">
                Desenvolvido por <strong><span><a href="https://www.iahgod.com.br" target="_blank" rel="noopener noreferrer">@iahgod</a></span></strong><br>
                
                <span style="font-size:12px;">Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a></span>
              </div>

            </div>
          </div>
        </div>

      </section>

    </div>
  </main><!-- End #main -->

<?=$render('partials/footer_end');?>