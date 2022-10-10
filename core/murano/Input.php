<?php
namespace core\murano;

class Input {

    public static function formInicio($action = ''){

        $html = '<form action="'.$action.'" method="post" enctype="multipart/form-data">';
        $html .= '<div class="row">';

        return $html;

    }

    public static function formFim(){

        $html = '<div>
                    <button type="submit" class="btn btn-primary">Salvar</button>
                </div></form>';

        return $html;

    }


    public static function text($title, $name, $placeholder, $col, $value, $class = '', $type = 'text'){

        $base = \core\Controller::getBaseUrl();

        $html = '<div class="mb-3 col-sm-12 col-md-'.$col.'">';
        $html .= '<label for="'.$name.'" class="form-label">'.$title.'</label>';
        $html .= '<input type="'.$type.'"';
        if($value){
            $html .= 'class="form-control '.$class.'" name="'.$name.'" value="'.$value.'" id="'.$name.'" placeholder="'.$placeholder.'">';
        }else{
            $html .= 'class="form-control '.$class.'" name="'.$name.'" id="'.$name.'" placeholder="'.$placeholder.'">';
        }
        $html .= '</div>';

        return $html;

    }

    public static function file($title, $name, $placeholder, $col, $class = ''){

        $html = '<div class="mb-3 col-sm-12 col-md-'.$col.'">
            <label for="'.$name.'" class="form-label">'.$title.'</label>
            <input type="file" class="form-control '.$class.'" name="'.$name.'" id="'.$name.'" placeholder="'.$placeholder.'">
        </div>';

        return $html;

    }

    public static function select($title, $name, $dados = [], $col, $class = ''){

        $html = '<div class="mb-3 col-sm-12 col-md-'.$col.'">
                    <label for="'.$name.'" class="form-label">'.$title.'</label>
                    <select class="form-select  '.$class.'" name="'.$name.'" id="'.$name.'">';

        foreach($dados as $item){

            $html .= '<option value="'.$item.'">'.$item.'</option>';

        }

        $html .= '</select></div>';
                        
        return $html;
    }
    
}
