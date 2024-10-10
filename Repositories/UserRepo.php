<?php

namespace App\Repositories;
use \db_context;
use \Models\user;

class userRepo{
    private $context;

    public function __construct(){
        $this->context = new db_context();
    }

    public function selectAll(){
        $results = $this->context::select(["x"], "users");

        $users = [];
        foreach($results as $result){
             $users[] = new $user($result["id"], $result["username"], $result["avatarGuid"], $result["email"], $result["role"]);
        }

        return $users;
    }

    public function selectById($id){
        $result = $this->context::select(["x"], "users", ["id=" . $id])[0];

        $user = new user($result["id"], $result["username"], $result["avatarGuid"], $result["email"], $result["role"]);
    }

    public function insert($user){
        $this->context::insert("users", array(
            "id" => $user->getId(),
            "username" => $user->getUsername(),
            "avatarGuid" => $user->getAvatarGuid(),
            "email" => $user->getEmail(),
            "role" => $iser->getRole(),
        ));

    }
}