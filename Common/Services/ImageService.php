<?php

namespace Common\Services;

class ImageService {
    public static function saveProfilePicture($file, $targetFile, $targetWidth, $targetHeight){
        $fileTmpName = $file['tmp_name'];
        $fileType = getimagesize($fileTmpName)['mime'];

        list($width, $height) = getimagesize($fileTmpName);

        $imageResource = self::prepareImage($fileType, $fileTmpName, $width, $height);

        $newImage = imagecreatetruecolor($targetWidth, $targetHeight);

        $squareSize = min($width, $height);
        imagecopyresampled(
            $newImage, $imageResource,
            0, 0,
            0, 0,
            $targetWidth, $targetHeight,
            $squareSize, $squareSize
        );

        self::saveAnyPicture($fileType, $newImage, $targetFile);

        imagedestroy($imageResource);
        imagedestroy($newImage);
    }

    private static function prepareImage($fileType, $fileTmpName, $width, $height){
        

        if ($fileType == "image/png") {
            $imageResource = imagecreatefrompng($fileTmpName);
        } else if ($fileType == "image/jpg" || $fileType == "image/jpeg" ){
            $imageResource = imagecreatefromjpeg($fileTmpName);
        }


        $squareSize = min($width, $height);

        $xOffset = ($width > $height) ? (($width - $height) / 2) : 0;
        $yOffset = ($height > $width) ? (($height - $width) / 2) : 0;

        $croppedImage = imagecreatetruecolor($squareSize, $squareSize);

        imagecopy(
            $croppedImage, $imageResource,
            0, 0,               
            $xOffset, $yOffset,     
            $squareSize, $squareSize
        );

        return ($croppedImage);
    }


    private static function saveAnyPicture($fileType, $newImage, $targetFile){
        if($fileType == "image/png"){
            imagepng($newImage, $targetFile, 90);
        } else if($fileType == "image/jpg" || $fileType == "image/jpeg"){
            imagejpeg($newImage, $targetFile, 90);
        }
    }
}