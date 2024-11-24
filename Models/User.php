<?php

namespace Models;

class User
{
    private $id;
    private $username;
    private $avatar_guid;
    private $email;
    private $role;
    private $passwd_hash;

    public function __construct($id, $username, $avatarGuid, $email, $role, $passwd_hash){
        $this->id = $id;
        $this->username = $username;
        $this->avatar_guid = $avatarGuid;
        $this->email = $email;
        $this->role = $role;
        $this->passwd_hash = $passwd_hash;
    }

    public function getId(){
        return $this->id;
    }

    public function getUsername(){
        return $this->username;
    }

    public function getAvatarGuid(){
        return $this->avatar_guid;
    }

    public function getEmail(){
        return $this->email;
    }

    public function getRole(){
        return $this->role;
    }

    public function getPasswdHash(){
        return $this->passwd_hash;
    }



}