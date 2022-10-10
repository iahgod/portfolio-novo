<?php
namespace core\murano;

use Mpdf\Mpdf;
use \src\models\Config;
class pdf {

    private static function header (){

        $config = \core\Controller::config();

        return '
        <table width="100%" style="border-bottom: 1px solid #000000;padding-bottom:5px; vertical-align: bottom; font-family: serif; font-size: 9pt; color: #000;"><tr>
        <td width="13%" align="left"><img src="'.$config['logo'].'" width="56px" /></td>
        <td width="87%"><b>'.$config['title'].'</b><br>'.$_SESSION['Usuario']['nome'].'<br>'.date('d/m/Y H:i').'<br>SmarterLar</td>
        </tr></table>';

    }

    public static function modelo($modelo, $titulo, $paciente, $gerar = false){

        $nomeArquivo = $paciente.' - '.$titulo.' - '.date('d_m_Y_H_i_s').'.pdf';

        $nomeModelo = 'assets/uploads/documentos/'.$nomeArquivo;

        $mpdf = new \Mpdf\Mpdf(['tempDir' => __DIR__ . '/custom/temp/dir/path']);
       
        $mpdf = new \Mpdf\Mpdf([
            'mode' => 'c',
            'margin_left' => 25,
            'margin_right' => 25,
            'margin_top' =>30,
            'margin_bottom' => 47,
            'margin_header' => 10,
            'margin_footer' => 10
        ]);

        $mpdf->SetTitle($titulo.' - '.$paciente);
        
        $mpdf->SetHTMLHeader(self::header());
        
        
        $html = '
        <h3>'.$titulo.'</h3>
        '.$modelo;
        
        $mpdf->WriteHTML($html);
        
        if($gerar){
            $mpdf->Output();
        }else{
            $mpdf->Output($nomeModelo);
        }
        

        return $nomeArquivo;

    }

    

}