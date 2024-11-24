<?php

namespace Common\Services;

class ImageService {
    public static function resizeAndSaveImage($file, $targetFile, $targetWidth, $targetHeight){
        $fileTmpName = $file['tmp_name'];
        $fileType = getimagesize($fileTmpName)['mime'];
        
        list($width, $height) = getimagesize($fileTmpName);

        if ($fileType == "image/png") {
            $imageResource = imagecreatefrompng($fileTmpName);
        } else if ($fileType == "image/jpg" || $fileType == "image/jpeg" ){
            $imageResource = imagecreatefromjpeg($fileTmpName);
        }

        $newImage = imagecreatetruecolor($targetWidth, $targetHeight);

        imagecopyresampled($newImage, $imageResource, 0, 0, 0, 0, $targetWidth, $targetHeight, $width, $height);

        if($fileType == "image/png"){
            imagepng($newImage, $targetFile, 90);
        } else if($fileType == "image/jpg" || $fileType == "image/jpeg"){
            imagejpeg($newImage, $targetFile, 90);
        }

        imagedestroy($imageResource);
        imagedestroy($newImage);
    }
}