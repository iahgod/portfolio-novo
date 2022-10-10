<!-- ======= Contact Section ======= -->
<section id="contact" class="paralax-mf footer-paralax bg-image sect-mt4 route" style="background-image: url(<?=$base;?>/assets2/img/overlay-bg.jpg)">
      <div class="overlay-mf"></div>
      <div class="container">
        <div class="row">
          <div class="col-sm-12">
            <div class="contact-mf">
              <div id="contact" class="box-shadow-full">
                <div class="row">
                  <div class="col-md-6">
                    <div class="title-box-2">
                      <h5 class="title-left">
                        Me mande uma mensagem
                      </h5>
                    </div>
                    <div>
                      <form action="<?=$base;?>/contato" method="post"  class="php-email-form">
                        <div class="row">
                          <div class="col-md-12 mb-3">
                            <div class="form-group">
                              <input type="text" name="nome" class="form-control" id="name" placeholder="Seu nome" required>
                            </div>
                          </div>
                          <div class="col-md-12 mb-3">
                            <div class="form-group">
                              <input type="email" class="form-control" name="email" id="email" placeholder="Seu Email" required>
                            </div>
                          </div>
                          <div class="col-md-12 mb-3">
                            <div class="form-group">
                              <input type="text" class="form-control" name="assunto" id="subject" placeholder="Assunto" required>
                            </div>
                          </div>
                          <div class="col-md-12">
                            <div class="form-group">
                              <textarea class="form-control" name="mensagem" rows="5" placeholder="Mensagem" required></textarea>
                            </div>
                          </div>
                          <div class="col-md-12 text-center">
                            <button type="submit" class="button mt-3 button-rouded">Enviar mensagem</button>
                          </div>
                        </div>
                      </form>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="title-box-2 pt-4 pt-md-0">
                      <h5 class="title-left">
                        Get in Touch
                      </h5>
                    </div>
                    <div class="more-info">
                      <p class="lead">
                        Me mande uma mensagem para tirar uma dúvida ou quem sabe perguntar sobre algum projeto.
                      </p>
                      <ul class="list-ico">
                        <li><span class="bi bi-geo-alt"></span> Indaial / SC - Brazil</li>
                        <li><span class="bi bi-phone"></span> <?=$info['telefone'];?></li>
                        <li><span class="bi bi-envelope"></span> <?=$info['email'];?></li>
                      </ul>
                    </div>
                    <div class="socials">
                      <ul>
                        <li><a href="<?=$info['facebook'];?>" target="blank"><span class="ico-circle"><i style="font-size: 30px;" class="lab la-facebook"></i></span></a></li>
                        <li><a href="<?=$info['instagram'];?>" target="blank"><span class="ico-circle"><i style="font-size: 30px;" class="lab la-instagram"></i></span></a></li>
                        <li><a href="<?=$info['github'];?>" target="blank"><span class="ico-circle"><i style="font-size: 30px;" class="lab la-github"></i></span></a></li>
                        <li><a href="<?=$info['linkedin'];?>" target="blank"><span class="ico-circle"><i style="font-size: 30px;" class="lab la-linkedin"></i></span></a></li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section><!-- End Contact Section -->

  </main><!-- End #main -->