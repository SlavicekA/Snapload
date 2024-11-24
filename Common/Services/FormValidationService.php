<?php

namespace Common\Services;

class FormValidationService{
    public static function checkEmpty($fields){
        foreach($fields as $field){
            if(empty($field)){
                return false;
            }
        }
        return true;
    }

    public static function checkFilesAmount($files){
        echo count($files);
        if(count($files) <= 1){
            return true;
        }
    }

    public static function checkFileExtension($fileType){
        if(in_array($fileType, ["image/jpg", "image/jpeg", "image/png"])){
            return true;
        }
    }
}

?>