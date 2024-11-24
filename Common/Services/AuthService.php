<?php 
namespace Common\Services;
use Repositories\UserRepo;


class AuthService{

    public static function Verify($email, $password)
    {
        $userRepo = new UserRepo();
        $user = $userRepo->selectByEmail($email);
        if ($user && password_verify($password, $user->getPasswdHash())) {
            return $user;
        } else {
            return null;
        }
    }
}

?>