<?php

namespace Models;

class Post
{
    private $id;
    private $user_id;
    private $guid;
    private $mini_guid;
    private $posted_date;
    private $name;

    public function __construct($id, $user_id, $guid, $mini_guid, $posted_date, $name){
        $this->id = $id;
        $this->user_id = $user_id;
        $this->guid = $guid;
        $this->mini_guid = $mini_guid;
        $this->posted_date = $posted_date;
        $this->name = $name;
    }

    public function getId(){
        return $this->id;
    }

    public function getUserId(){
        return $this->user_id;
    }

    public function getGuid(){
        return $this->guid;
    }

    public function getMiniGuid(){
        return $this->mini_guid;
    }

    public function getPostedDate(){
        return $this->posted_date;
    }

    public function getName(){
        return $this->name;
    }
}