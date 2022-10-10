<?=$render('partials/headerAdmin', ['loggedUser'=>$loggedUser, 'title' => $titulo]);?>

<?=$render('components/pagetittle', ['title'=>$titulo, 'breadcrumb'=>['Dashboard']]);?>

<section class="section dashboard">

      <div class="row">

        <!-- Left side columns -->
        <div class="col-lg-8">
          <div class="row">

          <?=$render('pages/admin/painel/partial/cards', ['loggedUser'=>$loggedUser, 'cards' => $cards]);?>


          </div>
        </div><!-- End Left side columns -->

        <!-- Right side columns -->
        <div class="col-lg-4">
    

        </div><!-- End Right side columns -->

      </div>
    </section>

<?=$render('partials/footer', ['loggedUser'=>$loggedUser, 'title' => $titulo]);?>
