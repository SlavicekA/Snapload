<?php

namespace Models;

class User
{
    private $id;
    private $username;
    private $avatarGuid;
    private $email;
    private $role;

    public function __construct($id, $username, $avatarGuid, $email, $role){
        $this->id = $id;
        $this->username = $username;
        $this->avatarGuid = $avatarGuid;
        $this->email = $email;
        $this->role = $role;
    }

    public function getId(){
        return $this->id;
    }

    public function getUsername(){
        return $this->username;
    }

    public function getAvatarGuid(){
        return $this->avatarGuid;
    }

    public function getEmail(){
        return $this->email;
    }

    public function getRole(){
        return $this->role;
    }



}