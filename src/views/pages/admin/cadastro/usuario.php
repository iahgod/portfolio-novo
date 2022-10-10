<?=$render('partials/headerAdmin', ['loggedUser'=>$loggedUser, 'title' => $titulo]);?>

<?=$render('components/pagetittle', ['title'=>$titulo, 'breadcrumb'=>['Cadastro', 'Usuários']]);?>

<section class="section">
    <div class="row">

      <div class="col-lg-12">

          <div class="card">
            <div class="card-body p-3">

            <a href="<?=$base;?>/admin/cadastro/usuario/form" class="btn btn-primary">Novo usuário</a>
            
            <hr>

            <table class="tabela">

              <thead>
                  <tr class="table-info text-dark">
                      <th scope="col">#</th>
                      <th scope="col" class="text-center">Nome</th>
                      <th scope="col" class="text-center">E-mail</th>
                      <th scope="col" class="text-center">Login</th>
                      <th scope="col" class="text-center">Grupo</th>
                      <th scope="col" class="text-center">Conselho</th>
                      <th scope="col" class="text-center">Criado em</th>
                      <th scope="col" class="text-center">Último acesso</th>
                      <th scope="col" class="text-center">Ações</th>
                  </tr>
              </thead>

              <tbody>
                  
              <?php foreach ($lista as $key => $item):?>
                  <tr>
                      <td><?=$item['id']?></td>
                      <td><?=$item['nome']?></td>
                      <td><?=$item['email']?></td>
                      <td><?=$item['login']?></td>
                      <td><?=$item['grupo']?></td>
                      <td><?=$item['conselho']?>/<?=$item['uf_conselho']?> - <?=$item['registro_conselho']?></td>
                      <td><?=\core\murano\Data::date($item['criado'], 'd/m/Y')?></td>
                      <td><?=\core\murano\Data::date($item['ultimo_login'])?></td>
                      <td class="text-center" style="width: 150px;">
                          <a href="<?=$base?>/admin/cadastro/usuario/form/<?=$item['id']?>" title="Editar" type="button" class="btn btn-primary btn-sm"><i class="las la-edit"></i></a>
                          <a href="#" type="button" title="Excluir" onclick="certeza('<?=$base;?>/admin/cadastro/usuario/delete/<?=$item['id']?>')" class="btn btn-danger btn-sm"><i class="las la-trash-alt"></i></a>
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
