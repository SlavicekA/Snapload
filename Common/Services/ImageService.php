<?php

namespace Common\Services;

class ImageService {
    public static function saveProfilePicture($file, $targetFile, $targetWidth, $targetHeight){
        $fileTmpName = $file['tmp_name'];
        $fileType = str_replace("image/", "",  getimagesize($fileTmpName)['mime']);

        list($width, $height) = getimagesize($fileTmpName);

        $croppedImage = self::cropImage(self::prepareImage($fileType, $fileTmpName), $width, $height);

        $newImage = imagecreatetruecolor($targetWidth, $targetHeight);

        $squareSize = min($width, $height);
        imagecopyresampled(
            $newImage, $croppedImage,
            0, 0,
            0, 0,
            $targetWidth, $targetHeight,
            $squareSize, $squareSize
        );

        self::saveAnyPicture($fileType, $newImage, $targetFile . "." . $fileType);

        imagedestroy($croppedImage);
        imagedestroy($newImage);
    }

    public static function savePostPicture($file, $targetFile){
        $fileTmpName = $file['tmp_name'];
        $fileType = str_replace("image/", "",  getimagesize($fileTmpName)['mime']);

        list($width, $height) = getimagesize($fileTmpName);

        $imageResource = self::prepareImage($fileType, $fileTmpName);
        $croppedImage = self::cropImage($imageResource, $width, $height);

        $miniImage = imagecreatetruecolor(1000, 1000);

        $squareSize = min($width, $height);
        imagecopyresampled(
            $miniImage, $croppedImage,
            0, 0,
            0, 0,
            1000, 1000,
            $squareSize, $squareSize
        );

        self::saveAnyPicture($fileType, $imageResource, $targetFile . "." . $fileType);
        self::saveAnyPicture($fileType, $miniImage, $targetFile . "_MINI" . "." . $fileType);

        imagedestroy($imageResource);
        imagedestroy($miniImage);
    }

    private static function prepareImage($fileType, $fileTmpName){
        if ($fileType == "png") {
            $imageResource = imagecreatefrompng($fileTmpName);
        } else if ($fileType == "jpg" || $fileType == "jpeg" ){
            $imageResource = imagecreatefromjpeg($fileTmpName);
        }
        return $imageResource;
    }


    private static function cropImage($imageResource, $width, $height){

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
        if($fileType == "png"){
            imagepng($newImage, $targetFile, 90);
        } else if($fileType == "jpg" || $fileType == "jpeg"){
            imagejpeg($newImage, $targetFile, 90);
        }
    }
}