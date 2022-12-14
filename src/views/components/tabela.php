<table class="tabela">
    <thead>
    <tr class="table-info text-dark text-center">
    <th scope="col">#</th>
    <?php foreach($titulos as $item):?>
    <th scope="col" class="text-center"><?=$item;?></th>
    <?php endforeach;?>
    <?php if($podeExcluir):?>
        <th scope="col">Ações</th>
    <?php else:?>
        <th></th>
    <?php endif;?>
    
    </tr>
    </thead>
    <tbody>
        <?php foreach($dados as $item):?>
        <tr><th scope="row"><?=$item['id']?></th>
        <?php foreach($names as $name):?>
        
        <?php if($name[1] === 'data'):?>
        <td class="text-center"><?=date( 'd/m/Y H:i' , strtotime($item[$name[0]]));?></td>
        <?php elseif($name[1] === 'data2'):?>
        <td class="text-center"><?=str_replace('.', '/', $item[$name[0]]);?></td>
        <?php elseif($name[1] === 'status'):?>
        <td class="text-center"><?=($item['ativo'] == 1) ? '<span class="badge bg-success text-white text-wrap">Ativo</span>' : '<span class="badge bg-danger text-white text-wrap">Inativo</span>' ;?></td>
        <?php else:?>
        <td class="text-center"><?=$item[$name[0]];?></td>
        <?php endif;?>

        <?php endforeach;?>
        <td class="text-center">
        <?php if($btnEditar):?>
        <a href="<?=$base;?>/admin/<?=$pagina;?>/form/<?=$item['id']?>" type="button" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> Editar </a>
        <?php endif;?>
        <?php if($btnStatus):?>
        <a href="<?=$base;?>/admin/<?=$pagina;?>/status/<?=$item['id']?>" type="button" class="btn btn-<?=($item['ativo'] == 1)? 'warning' : 'success' ;?> btn-sm"><i class="fas fa-plus"></i> <?=($item['ativo'] == 1)? 'Inativar' : 'Ativar' ;?> </a>
        <?php endif;?>
        <?php if($podeExcluir):?>
        <?php if($deleteP):?>
        <a href="#" type="button" onclick="certeza('<?=$base;?>/<?=$deleteP;?>/<?=$item['id']?>')" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> Excluir </a>
        <?php else:?>
        <a href="#" type="button" onclick="certeza('<?=$base;?>/admin/<?=$pagina;?>/delete/<?=$item['id']?>')" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> Excluir </a>
        <?php endif;?>
        <?php endif;?>
        </td></tr>
        <?php endforeach;?>
    </tbody>
</table>