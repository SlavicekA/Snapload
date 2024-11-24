<?php 

namespace Common\Services;
use Repositories\UserRepo;

class UserEditValidationService{

    public static function checkEmail($email)
    {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return true;
        } else {
            return false;
        }
    }

    public static function checkPassword($password)
    {
        if (strlen($password) >= 8) {
            return true;
        } else {
            return false;
        }
    }

    public static function checkNameLength($name)
    {
        if (strlen($name) >= 3 && strlen($name) <= 15) {
            return true;
        } else {
            return false;
        }
    }

    public static function checkNameExists($name)
    {
        $userRepo = new UserRepo();
        $user = $userRepo->selectByName($name);
        if ($user) {
            return false;
        } else {
            return true;
        }
    }
}

?>