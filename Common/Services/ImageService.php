<?php

namespace Common\Services;

class ImageService {
    public static function saveProfilePicture($file, $targetFile, $targetWidth, $targetHeight){

        $croppedImage = self::cropImage(self::prepareImage($file), $file);

        $newImage = self::resizeImage(200, 200, $croppedImage, $file);

        self::saveAnyPicture($newImage, $targetFile);

        imagedestroy($croppedImage);
        imagedestroy($newImage);
    }

    public static function savePostPicture($file, $targetFile){

        $imageResource = self::prepareImage($file);
        $croppedImage = self::cropImage($imageResource, $file);

        $miniImage = self::resizeImage(1000, 1000, $croppedImage, $file);

        self::saveAnyPicture($imageResource, $targetFile);
        self::saveAnyPicture($miniImage, $targetFile . "_MINI");

        imagedestroy($imageResource);
        imagedestroy($miniImage);
    }

    #resize square image (non-square images will be distorted)
    private static function resizeImage($targetWidth, $targetHeight, $imageResource, $file){
        $fileTmpName = $file['tmp_name'];

        list($width, $height) = getimagesize($fileTmpName);
        $currentDimension = min($width, $height);

        $resizedImage = imagecreatetruecolor($targetWidth, $targetHeight);
        imagecopyresampled(
            $resizedImage, $imageResource,
            0, 0,
            0, 0,
            $targetWidth, $targetHeight,
            $currentDimension, $currentDimension
        );

        return $resizedImage;
    }


    #prepare image as a resource so that i can work with it
    private static function prepareImage($file){
        $fileTmpName = $file['tmp_name'];
        $fileType = str_replace("image/", "",  getimagesize($fileTmpName)['mime']);

        if ($fileType == "png") {
            $imageResource = imagecreatefrompng($fileTmpName);
        } else if ($fileType == "jpg" || $fileType == "jpeg" ){
            $imageResource = imagecreatefromjpeg($fileTmpName);
        }
        return $imageResource;
    }

    #crop the image to square (shorter dimension stays the same)
    private static function cropImage($imageResource, $file){
        $fileTmpName = $file['tmp_name'];

        list($width, $height) = getimagesize($fileTmpName);
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

    #Save as webp cause its cool and i dont have to save the filetype to db
    private static function saveAnyPicture($newImage, $targetFile){
        imagewebp($newImage, $targetFile . ".webp", 90);
    }
}