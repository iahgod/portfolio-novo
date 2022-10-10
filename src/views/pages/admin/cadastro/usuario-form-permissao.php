<div class="col-lg-6">

    <div class="card">
    <div class="card-body p-3">
    <h4>Permissões específicas</h4><hr>

    <form action="<?=$base;?>/admin/cadastro/usuario/form/permissao" method="post">

        <input type="hidden" name="id" value="<?=$usuario['id'];?>">

        <div class="form-check">
            <input class="form-check-input" name="admin" <?=($usuario['admin'] == 1)?'checked':'';?> type="checkbox" role="switch" id="admin">
            <label class="form-check-label" for="admin">Administrador</label>
        </div>

        <div class="form-check">
            <input class="form-check-input" name="editar_pct" <?=($usuario['editar_pct'] == 1)?'checked':'';?> type="checkbox" role="switch" id="editar_pct">
            <label class="form-check-label" for="editar_pct">Editar paciente / Nova vacina / Novo produto</label>
        </div>

        <div class="form-check">
            <input class="form-check-input" name="evoluir" <?=($usuario['evoluir'] == 1)?'checked':'';?> type="checkbox" role="switch" id="evoluir">
            <label class="form-check-label" for="evoluir">Evoluir</label>
        </div>

        <div class="form-check">
            <input class="form-check-input" name="evo_social" <?=($usuario['evo_social'] == 1)?'checked':'';?> type="checkbox" role="switch" id="evo_social">
            <label class="form-check-label" for="evo_social">Ver evolução social</label>
        </div>

        <div class="form-check">
            <input class="form-check-input" name="evo_psico" <?=($usuario['evo_psico'] == 1)?'checked':'';?> type="checkbox" role="switch" id="evo_psico">
            <label class="form-check-label" for="evo_psico">Ver evolução psicológica</label>
        </div>

        <div class="form-check">
            <input class="form-check-input" name="deletar_evo" <?=($usuario['deletar_evo'] == 1)?'checked':'';?> type="checkbox" role="switch" id="deletar_evo">
            <label class="form-check-label" for="deletar_evo">Deletar evolução</label>
        </div>

        <div class="form-check">
            <input class="form-check-input" name="ssvv" <?=($usuario['ssvv'] == 1)?'checked':'';?> type="checkbox" role="switch" id="ssvv">
            <label class="form-check-label" for="ssvv">Criar sinais vitais</label>
        </div>

        <div class="form-check">
            <input class="form-check-input" name="ficha_med" <?=($usuario['ficha_med'] == 1)?'checked':'';?> type="checkbox" role="switch" id="ficha_med">
            <label class="form-check-label" for="ficha_med">Criar medicamentos do paciente</label>
        </div>

        <div class="form-check">
            <input class="form-check-input" name="docs" <?=($usuario['docs'] == 1)?'checked':'';?> type="checkbox" role="switch" id="docs">
            <label class="form-check-label" for="docs">Documentos</label>
        </div>

        <hr>
        
        <div>
            <button type="submit" class="btn btn-primary">Salvar</button>
        </div>

    </form>

    </div>
    </div>

</div>