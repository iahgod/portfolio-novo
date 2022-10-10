<?=$render('partials/headerAdmin', ['loggedUser'=>$loggedUser, 'title' => $titulo]);?>

<?=$render('components/pagetittle', ['title'=>$titulo, 'breadcrumb'=>['Cadastro', 'Usuário', 'Editar']]);?>

<section class="section">
    <div class="row">

      <div class="col-lg-6">

          <div class="card">
            <div class="card-body p-3">

            <h4>Informações básicas</h4><hr>
              
              <form action="<?=$base;?>/admin/cadastro/usuario/form" method="post">

                <div class="row">

                <input type="hidden" name="id" value="<?=$usuario['id'];?>">

                  <div class="mb-3 col-sm-12 col-md-4">
                    <label for="nome" class="form-label">Nome</label>
                    <input type="text" class="form-control" name="nome" value="<?=$usuario['nome'];?>" id="nome" aria-describedby="nome" placeholder="Nome do usuário" required>
                    <small id="nome" class="form-text text-muted">Nome do usuário</small>
                  </div>

                  <div class="mb-3 col-sm-12 col-md-4">
                    <label for="email" class="form-label">E-mail</label>
                    <input type="email" class="form-control" name="email" value="<?=$usuario['email'];?>" id="email" aria-describedby="email" placeholder="E-mail" required>
                    <small id="nome" class="form-text text-muted">E-mail</small>
                  </div>

                  <div class="mb-3 col-sm-12 col-md-4">
                    <label for="login" class="form-label">Usuário</label>
                    <input type="text" class="form-control" name="login" id="login" value="<?=$usuario['login'];?>" aria-describedby="login" placeholder="Usuário" required>
                    <small id="nome" class="form-text text-muted">Login</small>
                  </div>

                  <div class="mb-3 col-sm-12 col-md-4">
                    <label for="id_grupo" class="form-label">Grupo</label>
                    <select class="form-select select2" name="id_grupo" id="id_grupo" required>
                      <option value="<?=$usuario['id_grupo'];?>"><?=$usuario['grupo'];?></option>
                      <?php foreach ($grupos as $item):?>
                      <?php if($item['id'] != $usuario['id_grupo']):?>
                      <option value="<?=strtoupper($item['id'])?>"><?=strtoupper($item['descricao'])?></option>
                      <?php endif;?>
                      <?php endforeach;?>
                    </select>
                  </div>

                  <div class="mb-3 col-sm-12 col-md-4">
                    <label for="conselho1" class="form-label">Conselho</label>
                    <select class="form-select select2" name="conselho" id="conselho1">
                    <option value="<?=$usuario['conselho'];?>"><?=$usuario['conselho'];?></option>
                      <?php foreach (['', 'COREN', 'CRM', 'CRN', 'COFFITO', 'CRP', 'CRESS', 'CRF'] as $item):?>
                      <?php if($item != $usuario['conselho']):?>
                          <option value="<?=strtoupper($item)?>"><?=strtoupper($item)?></option>
                      <?php endif;?>
                      <?php endforeach;?>
                    </select>
                  </div>

                  <div class="mb-3 col-sm-12 col-md-4">
                    <label for="conselho2" class="form-label">UF do conselho</label>
                    <select class="form-select select2" name="uf_conselho" id="conselho2">
                    <option value="<?=$usuario['uf_conselho'];?>"><?=$usuario['uf_conselho'];?></option>
                      <?php foreach ($ufs as $item):?>
                        <?php if($item != $usuario['uf_conselho']):?>
                          <option value="<?=strtoupper($item)?>"><?=strtoupper($item)?></option>
                      <?php endif;?>
                      <?php endforeach;?>
                    </select>
                  </div>

                  <div class="mb-3 col-sm-12 col-md-4">
                    <label for="conselho3" class="form-label">Número do conselho</label>
                    <input type="text" class="form-control" value="<?=$usuario['registro_conselho'];?>" name="registro_conselho" id="conselho3" placeholder="">
                  </div>

                </div>

                <hr>

                <div>
                  <button type="submit" class="btn btn-primary">Salvar</button>
                </div>

              </form>

            </div>
          </div>

      </div>

      <?=$render('pages/admin/cadastro/usuario-form-permissao', ['loggedUser'=>$loggedUser, 'usuario' => $usuario]);?>

      <?=$render('pages/admin/cadastro/usuario-form-empregado1', ['loggedUser'=>$loggedUser, 'usuario' => $usuario]);?>

    </div>

</section>
                        
                        
<?=$render('partials/footer', ['loggedUser'=>$loggedUser]);?>
