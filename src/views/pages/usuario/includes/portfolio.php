<!-- ======= Portfolio Section ======= -->
<section id="work" class="portfolio-mf sect-pt4 route">
      <div class="container">
        <div class="row">
          <div class="col-sm-12">
            <div class="title-box text-center">
              <h3 class="title-a">
                Portfolio
              </h3>
              <div class="line-mf"></div>
            </div>
          </div>
        </div>
        <div class="row">

        <?php foreach($portfolio as $item):?>

          <div class="col-md-4">
            <div class="work-box">
              <a href="<?=$base;?>/assets/uploads/<?=$item['imagem'];?>" data-gallery="portfolioGallery" class="portfolio-lightbox">
                <div class="work-img">
                  <img src="<?=$base;?>/assets/uploads/<?=$item['imagem'];?>" alt="" class="img-fluid">
                </div>
              </a>
              <div class="work-content">
                <div class="row">
                  <div class="col-sm-8">
                    <h2 class="w-title"><?=$item['titulo'];?></h2>
                    <div class="w-more">
                      <span class="w-ctegory"><?=$item['categoria'];?></span> | <span class="w-date"><?=$item['data'];?></span>
                    </div>
                  </div>
                  <div class="col-sm-4">
                    <div class="w-like">
                      <a href="<?=$item['url'];?>" target="blank"> <span class="bi bi-plus-circle"></span></a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

        <?php endforeach;?>

        </div>
      </div>
    </section><!-- End Portfolio Section -->