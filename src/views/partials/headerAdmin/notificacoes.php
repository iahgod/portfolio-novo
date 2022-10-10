<li class="nav-item dropdown">

    <?php 

      $notificacao = $_SESSION['notificacao'];

    ?>

      <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
        <i class="bi bi-bell"></i>
        <span class="badge bg-primary badge-number"><?=count($notificacao);?></span>
      </a><!-- End Notification Icon -->

      <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow notifications" style="width: 300px;">
        <li class="dropdown-header">
          Você tem <?=count($notificacao);?> notificações
          <!-- <a href="#"><span class="badge rounded-pill bg-primary p-2 ms-2">View all</span></a> -->
        </li>
        <li>
          <hr class="dropdown-divider">
        </li>

        <?php foreach($notificacao as $item):?>

          <li class="notification-item">
          <i class="bi bi-info-circle text-primary"></i>
            <a href="<?=$base;?>/admin/notificacao/finalizar/<?=$item['id'];?>">
            <div>
              <h4><?=$item['titulo'];?></h4>
              <p><?=$item['mensagem'];?></p>
              <p><?=$item['nome'];?> - <?= \core\murano\Data::date($item['data']); ?></p>
            </div>
            </a>
          </li>

          <li>
            <hr class="dropdown-divider">
          </li>

        <?php endforeach;?>

        
        <!-- <li class="dropdown-footer">
          <a href="#">Show all notifications</a>
        </li> -->

      </ul><!-- End Notification Dropdown Items -->

    </li><!-- End Notification Nav -->