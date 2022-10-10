<!-- Reports -->
<div class="col-12">
  <div class="card">

    <div class="card-body">
      <h5 class="card-title">Pacientes</h5>

      <div class="row d-flex justify-content-center">

        <?php foreach($pacientes as $item):?>

          <?php
              switch ($item['grau']) {
                  case 0:
                      $status = '<span class="badge bg-light text-dark text-wrap">?</span>';
                      break;
                  case 1:
                      $status = '<span class="badge bg-info text-wrap">1</span>';
                      break;
                  case 2:
                      $status = '<span class="badge bg-warning text-wrap">2</span>';
                      break;
                  case 3:
                      $status = '<span class="badge bg-danger text-wrap">3</span>';
                      break;
              }
          ?>

          <a class="d-flex flex-wrap m-2 text-center" style="width: 100px;text-decoration: none;color:#000;" href="<?=$base;?>/admin/pacientes/form/<?=$item['id']?>">

            <div class="d-flex flex-wrap m-2 text-center" style="width: 100px;">
              <img src="<?=$base;?>/assets/uploads/<?=$item['img'];?>" height="80px" width="80px" style="border-radius: 40px;" title="<?=$item['nome'];?>" alt="<?=$item['nome'];?>">
              <h6 class="text-center mt-1" style="width: 100%; font-size:14px;"><?=explode(' ', $item['nome'])[0]?></h6>
              <div class="text-center" style="width: 100%; font-size:14px;"><?=\core\murano\Data::diferenca($item['nascimento'], 3)?> - <?=$status?></div>
            </div>

          </a>
          

        <?php endforeach;?>

      </div>

    </div>

  </div>
</div><!-- End Reports -->