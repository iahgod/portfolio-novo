<?=$render('partials/headerAdmin', ['loggedUser'=>$loggedUser, 'title' => $titulo]);?>

<?=$render('components/pagetittle', ['title'=>$titulo, 'breadcrumb'=>['Admin', 'Contato']]);?>

<section class="section">
    <div class="row">

      <div class="col-lg-12">

          <div class="card">
            <div class="card-body p-3">
              
            <table class="tabela">

              <thead>
                  <tr class="table-info text-dark">
                      <th scope="col" class="text-center">Nome</th>
                      <th scope="col" class="text-center">Email</th>
                      <th scope="col" class="text-center">Telefone</th>
                      <th scope="col" class="text-center">Assunto</th>
                      <th scope="col" class="text-center">Mensagem</th>
                      <th scope="col" class="text-center">Data</th>
                      <th scope="col" class="text-center" style="width: 100px;">Ações</th>
                  </tr>
              </thead>

              <tbody>
                  
              <?php foreach ($lista as $key => $item):?>
                  <tr>
                      <td class="text-center"><?=$item['nome']?></td>
                      <td class="text-center"><?=$item['email']?></td>
                      <td class="text-center"><?=$item['telefone']?></td>
                      <td class="text-center"><?=$item['assunto']?></td>
                      <td class="text-center"><?=$item['mensagem']?></td>
                      <td class="text-center"><?=\core\murano\Data::date($item['data_mensagem'])?></td>
                      <td class="text-center" style="width:150px;">
                        <a href="mailto:<?=$item['email']?>" type="button" title="Enviar email" class="btn btn-primary btn-sm"><i class="las la-envelope"></i></a>
                        <a href="https://wa.me/55<?=str_replace([' ', '(', ')', '-'], '', $item['telefone'])?>" target="blank" type="button" title="Whatsapp" class="btn btn-success btn-sm"><i class="lab la-whatsapp"></i></a>
                        <a href="#" type="button" onclick="certeza('<?=$base;?>/admin/contato/delete/<?=$item['id']?>')" title="Excluir" class="btn btn-danger btn-sm"><i class="las la-trash-alt"></i></a>
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
