<!-- ======= About Section ======= -->
<section id="about" class="about-mf sect-pt4 route">
      <div class="container">
        <div class="row">
          <div class="col-sm-12">
            <div class="box-shadow-full">
              <div class="row">
                <div class="col-md-6">
                  <div class="row">
                    <div class="col-sm-6 col-md-5">
                      <div class="about-img">
                        <img src="<?=$base;?>/assets/uploads/<?=$info['foto'];?>" height="150" width="150" class="img-fluid rounded b-shadow-a" alt="">
                      </div>
                    </div>
                    <div class="col-sm-6 col-md-7">
                      <div class="about-info">
                        <p><span class="title-s">Nome: </span> <span><?=$info['nome'];?></span></p>
                        <p><span class="title-s">Perfil: </span> <span><?=$info['perfil'];?></span></p>
                        <p><span class="title-s">E-mail: </span> <span><?=$info['email'];?></span></p>
                        <p><span class="title-s">Telefone: </span> <span><?=$info['telefone'];?></span></p>
                      </div>
                    </div>
                  </div>
                  <div class="skill-mf">
                    <p class="title-s">Habilidades</p>
                    <span>HTML</span> <span class="pull-right">85%</span>
                    <div class="progress">
                      <div class="progress-bar" role="progressbar" style="width: 85%;" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <span>CSS3</span> <span class="pull-right">75%</span>
                    <div class="progress">
                      <div class="progress-bar" role="progressbar" style="width: 75%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <span>PHP</span> <span class="pull-right">70%</span>
                    <div class="progress">
                      <div class="progress-bar" role="progressbar" style="width: 70%" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <span>JAVASCRIPT</span> <span class="pull-right">50%</span>
                    <div class="progress">
                      <div class="progress-bar" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="about-me pt-4 pt-md-0">
                    <div class="title-box-2">
                      <h5 class="title-left">
                        Sobre mim
                      </h5>
                    </div>
                    <p class="lead">
                    <?=$info['sobre'];?> 
                    </p>
                    <p class="lead">
                    <?=$info['sobre2'];?>
                    </p>
                    <p class="lead">
                    <?=$info['sobre3'];?>
                    </p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section><!-- End About Section -->