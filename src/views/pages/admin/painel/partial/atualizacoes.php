<!-- News & Updates Traffic -->
<div class="card">
    <div class="filter">
      <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
      <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
        <li class="dropdown-header text-start">
          <h6>Filter</h6>
        </li>

        <li><a class="dropdown-item" href="#">Today</a></li>
        <li><a class="dropdown-item" href="#">This Month</a></li>
        <li><a class="dropdown-item" href="#">This Year</a></li>
      </ul>
    </div>

    <div class="card-body pb-0">
      <h5 class="card-title">Atualizações <span>| Últimas 5</span></h5>

      <div class="news">

        <?php foreach($atualizacoes as $item): ?>

          <div class="post-item clearfix">
            <img src="<?=$base;?>/assets/img/updated.png" style="padding: 5px;" alt="">
            <h4><?=$item['data'];?></h4>
            <p><?=$item['mensagem'];?></p>
          </div>

        <?php endforeach;?>



      </div><!-- End sidebar recent posts-->

    </div>
  </div><!-- End News & Updates -->