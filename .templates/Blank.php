<?=$render('partials/headerAdmin', ['loggedUser'=>$loggedUser, 'title' => $titulo]);?>

<?=$render('components/pagetittle', ['title'=>$titulo, 'breadcrumb'=>['']]);?>

<section class="section">
    <div class="row">

      <div class="col-lg-6">

          <div class="card">
            <div class="card-body p-3">
              
              

            </div>
          </div>

      </div>

      <div class="col-lg-6">
          <div class="card">
            <div class="card-body p-3">
                
            <table class="tabela">

              <thead>
                  <tr class="table-info text-dark">
                      <th scope="col" class="text-center">Campo</th>
                      <th scope="col" class="text-center">Data</th>
                      <th scope="col" class="text-center" style="width: 100px;">Ações</th>
                  </tr>
              </thead>

              <tbody>
                  
              <?php foreach ($lista as $key => $item):?>
                  <tr>
                      <td class="text-center"><?=$item['campo']?></td>
                      <td class="text-center"><?=\core\murano\Data::date($item['data'])?></td>
                      <td class="text-center">
                        <a href="#" type="button" onclick="certeza('<?=$base;?>/admin/paciente/vacina/delete/<?=$item['id']?>')" title="Excluir" class="btn btn-danger btn-sm"><i class="las la-trash-alt"></i></a>
                      </td>
                  </tr>

              <?php endforeach;?>
              </tbody>

            </table>

            </div>
          </div>

      </div>

    </div>

</section>
                        
                        
<?=$render('partials/footer', ['loggedUser'=>$loggedUser]);?>
