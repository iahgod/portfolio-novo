<?=$render('partials/headerAdmin', ['loggedUser'=>$loggedUser, 'title' => $titulo]);?>

<?=$render('components/pagetittle', ['title'=>$titulo, 'breadcrumb'=>['Configuração', 'Informações da empresa']]);?>

<section class="section">
    <div class="row">

      <div class="col-lg-12">

          <div class="card">
            <div class="card-body p-3">
              
              <form action="" method="post">

                <div class="row">

                  <h5><b>Dados</b></h5>

                  <div class="mb-3 col-sm-12 col-md-4">
                    <label for="title" class="form-label">Nome da empresa</label>
                    <input type="text" class="form-control" value="<?=$config['title'];?>" required name="title" id="title" aria-describedby="title" placeholder="Nome da empresa">
                    <small id="title" class="form-text text-muted">Nome fictício</small>
                  </div>

                  <div class="mb-3 col-sm-12 col-md-4">
                    <label for="razao" class="form-label">Razão Social</label>
                    <input type="text" class="form-control" value="<?=$config['razao'];?>" required name="razao" id="razao" aria-describedby="razao" placeholder="Razão Social">
                    <small id="razao" class="form-text text-muted">Razão Social da empresa</small>
                  </div>

                  <div class="mb-3 col-sm-12 col-md-4">
                    <label for="cnpj" class="form-label">CNPJ</label>
                    <input type="text" class="form-control cnpj" value="<?=$config['cnpj'];?>" required name="cnpj" id="cnpj" aria-describedby="cnpj" placeholder="CNPJ">
                    <small id="cnpj" class="form-text text-muted">CNPJ da empresa</small>
                  </div>

                  <hr>

                  <h5><b>Endereço</b></h5>

                  <div class="mb-3 col-sm-12 col-md-4">
                    <label for="rua" class="form-label">Rua</label>
                    <input type="text" class="form-control" value="<?=$config['rua'];?>" required name="rua" id="rua" aria-describedby="rua" placeholder="Rua">
                    <small id="rua" class="form-text text-muted">Nome da rua</small>
                  </div>

                  <div class="mb-3 col-sm-6 col-md-2">
                    <label for="numero" class="form-label">Número</label>
                    <input type="number" min="0" class="form-control" value="<?=$config['numero'];?>" required name="numero" id="numero" aria-describedby="numero" placeholder="N°">
                    <small id="numero" class="form-text text-muted">N°</small>
                  </div>

                  <div class="mb-3 col-sm-6 col-md-2">
                    <label for="cidade" class="form-label">Cidade</label>
                    <input type="text" class="form-control" value="<?=$config['cidade'];?>" required name="cidade" id="cidade" aria-describedby="cidade" placeholder="Cidade">
                    <small id="cidade" class="form-text text-muted">Cidade</small>
                  </div>

                  <div class="mb-3 col-sm-6 col-md-2">
                    <label for="estado" class="form-label">UF</label>
                    <input type="text" maxlength="2" class="form-control" value="<?=$config['estado'];?>" required name="estado" id="estado" aria-describedby="estado" placeholder="UF">
                    <small id="estado" class="form-text text-muted">UF</small>
                  </div>

                  <div class="mb-3 col-sm-6 col-md-2">
                    <label for="cep" class="form-label">CEP</label>
                    <input type="text" class="form-control cep" value="<?=$config['cep'];?>" required name="cep" id="cep" aria-describedby="cep" placeholder="00000-000">
                    <small id="cep" class="form-text text-muted">CEP</small>
                  </div>

                  <hr>

                  <h5><b>Contato</b></h5>

                  <div class="mb-3 col-sm-12 col-md-4">
                    <label for="telefone" class="form-label">Telefone</label>
                    <input type="text" class="form-control telefone" value="<?=$config['telefone'];?>" required name="telefone" id="telefone" aria-describedby="telefone" placeholder="(00) 0000-0000">
                    <small id="telefone" class="form-text text-muted">Telefone</small>
                  </div>

                  <div class="mb-3 col-sm-12 col-md-4">
                    <label for="celular" class="form-label">Celular</label>
                    <input type="text" class="form-control celular" value="<?=$config['celular'];?>" required name="celular" id="celular" aria-describedby="celular" placeholder="(00) 9 0000-0000">
                    <small id="celular" class="form-text text-muted">Celular</small>
                  </div>

                  <div class="mb-3 col-sm-12 col-md-4">
                    <label for="email" class="form-label">E-mail</label>
                    <input type="email" class="form-control" value="<?=$config['email'];?>" required name="email" id="email" aria-describedby="email" placeholder="E-mail">
                    <small id="email" class="form-text text-muted">E-mail da empresa</small>
                  </div>

                  <hr>

                  <h5><b>Complementar</b></h5>

                  <div class="mb-3 col-sm-12 col-md-4">
                    <label for="logo" class="form-label">Url da logotipo</label>
                    <input type="url" class="form-control" value="<?=$config['logo'];?>" required name="logo" id="logo" aria-describedby="url" placeholder="URL">
                    <small id="url" class="form-text text-muted">Endereço da imagem de logotipo</small>
                  </div>

                  <div class="mb-3 col-sm-12 col-md-4">
                    <label for="leitos" class="form-label">Leitos</label>
                    <input type="number" min="0" max="500" class="form-control" value="<?=$config['leitos'];?>" required name="leitos" id="leitos" aria-describedby="leitos" placeholder="Leitos">
                    <small id="leitos" class="form-text text-muted">Quantidade de leitos da propriedade</small>
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

    </div>

</section>
                        
                        
<?=$render('partials/footer', ['loggedUser'=>$loggedUser]);?>
