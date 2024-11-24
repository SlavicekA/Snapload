<?php

namespace Repositories;
use \DbContext;
use \Models\User;

class UserRepo{
    private $context;

    public function __construct(){
        $this->context = new DbContext();
    }

    public function selectAll(){
        $results = $this->context::select(["*"], "users");

        $users = [];
        foreach($results as $result){
             $users[] = new User($result["id"], $result["username"], $result["avatar_guid"], $result["email"], $result["role"], $result["passwd_hash"]);
        }

        return $users;
    }

    public function selectById($id){
        $result = $this->context::select(["*"], "users", ["id=" . $id])[0] ?? null;

        $user = null;
        if($result){
            $user = new User($result["id"], $result["username"], $result["avatar_guid"], $result["email"], $result["role"], $result["passwd_hash"]);

        }

        return $user;
    }

    public function selectByName($username){
        $result = $this->context::select(["*"], "users", ["username='" . $username . "'"])[0] ?? null;

        $user = null;

        if($result){
            $user = new User($result["id"], $result["username"], $result["avatar_guid"], $result["email"], $result["role"], $result["passwd_hash"]);
        }

        return $user;
    }

    public function selectByEmail($email){
        $result = $this->context::select(["*"], "users", ["email='" . $email . "'"])[0] ?? null;

        $user = null;

        if($result){
            $user = new User($result["id"], $result["username"], $result["avatar_guid"], $result["email"], $result["role"], $result["passwd_hash"]);
        }

        return $user;
    }

    public function insert($user){
        $this->context::insert("users", array(
            "id" => $user->getId(),
            "username" => $user->getUsername(),
            "avatar_guid" => $user->getAvatarGuid(),
            "email" => $user->getEmail(),
            "role" => $user->getRole(),
            "passwd_hash" => $user->getPasswdHash(),
        ));

    }

    public function update($user){
        $this->context::update("users", array(
            "username" => $user->getUsername(),
            "avatar_guid" => $user->getAvatarGuid(),
            "email" => $user->getEmail(),
            "role" => $user->getRole(),
            "passwd_hash" => $user->getPasswdHash(),
        ), "id=" . $user->getId());
    }
}