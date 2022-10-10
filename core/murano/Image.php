<?php
namespace core\murano;

class Image {

    public static function upload($name, $width = 500, $heigh = 500, $fileAntigo = []){

        $newFoto = $_FILES[$name];

        if(in_array($newFoto['type'], ['image/jpeg', 'image/jpg', 'image/png'])) {
            
            $fotoName = self::cutImage($newFoto, $width, $heigh, 'assets/uploads');

            if (file_exists('../assets/uploads/'.$fileAntigo)){
                unlink('../assets/uploads/'.$fileAntigo);  
            }

            return $fotoName;
        }

    }

    public static function cutImage($file, $w, $h, $folder) {
        list($widthOrig, $heightOrig) = getimagesize($file['tmp_name']);
        $ratio = $widthOrig / $heightOrig;

        $newWidth = $w;
        $newHeight = $newWidth / $ratio;

        if($newHeight < $h) {
            $newHeight = $h;
            $newWidth = $newHeight * $ratio;
        }

        $x = $w - $newWidth;
        $y = $h - $newHeight;
        $x = $x < 0 ? $x / 2 : $x;
        $y = $y < 0 ? $y / 2 : $y;

        $finalImage = imagecreatetruecolor($w, $h);
        
        switch($file['type']) {
            case 'image/jpeg':
            case 'image/jpg':
                $image = imagecreatefromjpeg($file['tmp_name']);
            break;
            case 'image/png':
                $image = imagecreatefrompng($file['tmp_name']);
            break;
        }

        imagecopyresampled(
            $finalImage, $image,
            $x, $y, 0, 0,
            $newWidth, $newHeight, $widthOrig, $heightOrig
        );

        $fileName = md5(time().rand(0,9999)).'.jpg';

        imagejpeg($finalImage, $folder.'/'.$fileName);

        return $fileName;
    }
    
}
