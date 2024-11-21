<?php

namespace App\Repositories;
use \DbContext;
use \Models\User;

class userRepo{
    private $context;

    public function __construct(){
        $this->context = new DbContext();
    }

    public function selectAll(){
        $results = $this->context::select(["*"], "users");

        $users = [];
        foreach($results as $result){
             $users[] = new User($result["id"], $result["username"], $result["avatarGuid"], $result["email"], $result["role"]);
        }

        return $users;
    }

    public function selectById($id){
        $result = $this->context::select(["*"], "users", ["id=" . $id])[0];

        $user = new User($result["id"], $result["username"], $result["avatarGuid"], $result["email"], $result["role"]);

        return $user;
    }

    public function insert($user){
        $this->context::insert("users", array(
            "id" => $user->getId(),
            "username" => $user->getUsername(),
            "avatarGuid" => $user->getAvatarGuid(),
            "email" => $user->getEmail(),
            "role" => $user->getRole(),
        ));

    }
}