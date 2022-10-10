<?php
namespace core\murano;

class Upload {

    /**
     * Arquivo
     * Nome aleatorio
     * Caminho
     * Tamanho
     *
     * @var string
     * @var bool
     * @var string
     * @var int
     */
    public static function enviar($arquivo, $nomeAleatorio = false , $caminho = 'assets/uploads/documentos/', $tamanho = 1572864){

        $nomeDoArquivo = $arquivo['name'];

        if($nomeAleatorio){

            $nomeDoArquivo = $nomeDoArquivo . rand(1111111111, 9999999999);

        }

        if(basename($arquivo['size'] <= $tamanho)){

            if(move_uploaded_file($arquivo['tmp_name'], $caminho . $nomeDoArquivo)) {

                return [
                    'erro' => false,
                    'mensagem' => 'Enviado com sucesso.',
                    'nome' => $nomeDoArquivo
                ];

            }else{

                return [
                    'erro' => true,
                    'mensagem' => 'Aconteceu algum erro.'
                ];

            }

        }else{

            return [
                'erro' => true,
                'mensagem' => 'Tamanho maior que o permitido.'
            ];

        }

    }
    
}
