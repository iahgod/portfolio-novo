<?php
namespace core\murano;

class Table {

    /**
     * Lista de dados
     * Campos da tabela
     * Titulo da tabela
     *
     * @var array
     * @var array
     * @var array
     */
    public static function tabela($title, $lista, $campos, $titulos, $acessar = true, $editar = true, $excluir = true){

        $base = \core\Controller::getBaseUrl();

        $html = '<table class="tabela">';
        $html .= '<thead>';

            $html .= '<tr class="table-info text-dark">';

            foreach($titulos as $titulo){
                $html .= '<th scope="col" class="text-center">'.$titulo.'</th>';
            }

            if($acessar){
                $html .= '<th scope="col" class="text-center">Acessar</th>';
            }
            if($editar){
                $html .= '<th scope="col" class="text-center">Editar</th>';
            }
            if($excluir){
                $html .= '<th scope="col" class="text-center">Excluir</th>';
            }

            $html .= '</tr>';

        $html .= '</thead>';
        $html .= '<tbody>';
        
        $html .= '';

        foreach($lista as $item){

            $html .= '<tr>';

            foreach($campos as $campo){
                
                $html .= '<td class="text-center">'.$item[$campo].'</td>';

            }

            if($acessar){
                
                $url = $base.'/admin/'.$title.'/form/'.$item['id'];

                $html .= '<th scope="col" class="text-center">';
                $html .= '<a href="'.$url.'" type="button" title="Excluir" class="btn btn-success btn-sm"><i class="las la-eye"></i></a>';
                $html .= '</th>';

            }
            if($editar){

                $url = $base.'/admin/'.$title.'/edit/'.$item['id'];

                $html .= '<th scope="col" class="text-center">';
                $html .= '<a href="'.$url.'" type="button" title="Excluir" class="btn btn-primary btn-sm"><i class="las la-edit"></i></a>';
                $html .= '</th>';

            }
            if($excluir){

                $url = $base.'/admin/'.$title.'/delete/'.$item['id'];

                $html .= '<th scope="col" class="text-center">';
                $html .= '<a href="#" onclick="certeza(`'.$url.'`)" type="button" title="Excluir" class="btn btn-danger btn-sm"><i class="las la-trash-alt"></i></a>';
                $html .= '</th>';

            }

            $html .= '</tr>';

        }

        $html .= '</tbody>';
        $html .= '</table>';

        return $html;

    }
    
}
