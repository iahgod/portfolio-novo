<?=$render('partials/headerAdmin', ['loggedUser'=>$loggedUser, 'admin'=>true, 'title'=>$titulo.' grupo']);?>

<?=$render('components/pagetittle', ['title'=>'Grupos', 'breadcrumb'=>['Grupo', $titulo]]);?>

<section class="section">
    <div class="row">

    <div class="col-lg-12">

        <div class="card">
        <div class="card-body">
            <h5 class="card-title">Grupo - <?=$titulo;?></h5>
            <form id="form" method="post" action="<?=$base;?>/admin/grupos/form" enctype="multipart/form-data" autocomplete="off">

                <input type="hidden" name="id" value="<?=($grupo) ? $grupo['id'] : '' ;?>">

                <div class="row">

                    <div class="form-group col-sm-12 col-md-6">
                        <label for="Nome" class=" form-control-label">Nome</label>
                        <input type="text" id="Nome" value="<?=($grupo) ? $grupo['descricao'] : '' ;?>" name="descricao" placeholder="" class="form-control" required>
                    </div>

                    <?php if($grupo):?>

                    <div class="form-check col-sm-12 col-md-6 mb-3">
                        <input class="form-check-input" name="filtro" <?=($grupo['filtro'] == 1) ? 'checked' : '' ;?> type="checkbox" role="switch" id="filtro">
                        <label class="form-check-label" for="filtro">Mostrar no filtro de evoluções</label>
                    </div>
                    
                    <?php endif;?>
                    
                </div>
                <?php if($grupo):?>
                <h4 class="mb-1 mt-1">Permissões</h4>

                <div class="col-12">
                    <?php foreach($listaMenus['menus'] as $item):?>

                        <?php if(in_array($item['id'], $listaMenus['menusUser'])):?>

                            <div class="form-check">
                                <input class="form-check-input" name="<?=$item['id']?>" type="checkbox" checked role="switch" id="<?=$item['titulo']?><?=$item['id']?>">
                                <label class="form-check-label" for="<?=$item['titulo']?><?=$item['id']?>"><?=$item['titulo']?></label>
                            </div>

                        <?php else:?>

                            <div class="form-check">
                                <input class="form-check-input" name="<?=$item['id']?>" type="checkbox" role="switch" id="<?=$item['titulo']?><?=$item['id']?>">
                                <label class="form-check-label" for="<?=$item['titulo']?><?=$item['id']?>"><?=$item['titulo']?></label>
                            </div>

                        <?php endif;?>

                        <?php if($item['sub']):?>

                            <?php foreach($item['sub'] as $sub):?>

                                <?php if(in_array($sub['id'], $listaMenus['menusUser'])):?>

                                    <div class="form-check" style="margin-left: 25px;">
                                        <input class="form-check-input" name="<?=$sub['id']?>" type="checkbox" checked role="switch" id="<?=$sub['titulo']?><?=$sub['id']?>">
                                        <label class="form-check-label" for="<?=$sub['titulo']?><?=$sub['id']?>"><?=$sub['titulo']?></label>
                                    </div>

                                    <?php else:?>

                                    <div class="form-check" style="margin-left: 25px;">
                                        <input class="form-check-input" name="<?=$sub['id']?>" type="checkbox" role="switch" id="<?=$sub['titulo']?><?=$sub['id']?>">
                                        <label class="form-check-label" for="<?=$sub['titulo']?><?=$sub['id']?>"><?=$sub['titulo']?></label>
                                    </div>

                                <?php endif;?>

                            <?php endforeach;?>

                        <?php endif;?>

                    <?php endforeach;?>

                </div>
                <?php endif;?>
                
            </form>
        </div>
        <div class="card-footer">
            <button type="button" onclick="document.querySelector('#form').submit()" class="btn btn-primary btn-sm">
                <i class="fa fa-dot-circle-o"></i> Salvar
            </button>
            <button type="button" onclick="document.querySelector('#form').reset()" class="btn btn-danger btn-sm">
                <i class="fa fa-ban"></i> Resetar
            </button>
        </div>
        </div>

    </div>

</section>

<?=$render('partials/footer', ['loggedUser'=>$loggedUser]);?>