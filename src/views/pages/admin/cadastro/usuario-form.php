<?=$render('partials/headerAdmin', ['loggedUser'=>$loggedUser, 'title' => $titulo]);?>

<?=$render('components/pagetittle', ['title'=>$titulo, 'breadcrumb'=>['Cadastro', 'Usuário', 'Novo']]);?>

<section class="section">
    <div class="row">

      <div class="col-lg-12">

          <div class="card">
            <div class="card-body p-3">
              
              <form action="" method="post">

                <div class="row">

                  <div class="mb-3 col-sm-12 col-md-4">
                    <label for="nome" class="form-label">Nome</label>
                    <input type="text" class="form-control" name="nome" id="nome" aria-describedby="nome" placeholder="Nome do usuário" required>
                    <small id="nome" class="form-text text-muted">Nome do usuário</small>
                  </div>

                  <div class="mb-3 col-sm-12 col-md-4">
                    <label for="email" class="form-label">E-mail</label>
                    <input type="email" class="form-control" name="email" id="email" aria-describedby="email" placeholder="E-mail" required>
                    <small id="nome" class="form-text text-muted">E-mail</small>
                  </div>

                  <div class="mb-3 col-sm-12 col-md-4">
                    <label for="login" class="form-label">Usuário</label>
                    <input type="text" class="form-control" name="login" id="login" aria-describedby="login" placeholder="Usuário" required>
                    <small id="nome" class="form-text text-muted">Login</small>
                  </div>

                  <div class="mb-3 col-sm-12 col-md-4">
                    <label for="id_grupo" class="form-label">Grupo</label>
                    <select class="form-select select2" name="id_grupo" id="id_grupo" required>
                      <option value="" readonly>Selecione um grupo</option>
                      <?php foreach ($grupos as $item):?>
                      <option value="<?=strtoupper($item['id'])?>"><?=strtoupper($item['descricao'])?></option>
                      <?php endforeach;?>
                    </select>
                  </div>

                  <div class="mb-3 col-sm-12 col-md-4">
                    <label for="conselho1" class="form-label">Conselho</label>
                    <select class="form-select select2" name="conselho" id="conselho1">
                      <option value="" readonly>Selecione um conselho</option>
                      <?php foreach (['COREN', 'CRM', 'CRN', 'COFFITO', 'CRP', 'CRESS', 'CRF'] as $item):?>
                      <option value="<?=strtoupper($item)?>"><?=strtoupper($item)?></option>
                      <?php endforeach;?>
                    </select>
                  </div>

                  <div class="mb-3 col-sm-12 col-md-4">
                    <label for="conselho2" class="form-label">UF do conselho</label>
                    <select class="form-select select2" name="uf_conselho" id="conselho2">
                      <option value="" readonly>Selecione uma UF</option>
                      <?php foreach ($ufs as $item):?>
                      <option value="<?=strtoupper($item)?>"><?=strtoupper($item)?></option>
                      <?php endforeach;?>
                    </select>
                  </div>

                  <div class="mb-3 col-sm-12 col-md-4">
                    <label for="conselho3" class="form-label">Número do conselho</label>
                    <input type="text" class="form-control" name="registro_conselho" id="conselho3" placeholder="">
                  </div>

                </div>

                <p>Após cadastrar, é possível editar outras informações especificas do usuário, clicando em "editar" na lista de usuários.<br>Senha padrão é: 12345678</p>

                <div>
                  <button type="submit" class="btn btn-primary">Salvar</button>
                </div>

              </form>

            </div>
          </div>

      </div>
      

    </div>

</section>
                        
                        
<?=$render('partials/footer', ['loggedUser'=>$loggedUser]);?>
