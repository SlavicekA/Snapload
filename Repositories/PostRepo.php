<?php

namespace Repositories;
use \DbContext;
use \Models\Post;

class PostRepo{
    private $context;

    public function __construct(){
        $this->context = new DbContext();
    }

    public function selectAll(){
        $results = $this->context::select(["*"], "posts");

        $posts = [];
        foreach($results as $result){
             $posts[] = new Post($result["id"], $result["user_id"], $result["guid"], $result["mini_guid"], $result["posted_date"], $result["name"]);
        }

        return $posts;
    }

    public function selectById($id){
        $result = $this->context::select(["*"], "posts", ["id=" . $id])[0] ?? null;

        $post = null;
        if($result){
            $post = new Post($result["id"], $result["user_id"], $result["guid"], $result["mini_guid"], $result["posted_date"], $result["name"]);
        }

        return $post;
    }

    public function insert($post){
        $this->context::insert("posts", array(
            "id" => $post->getId(),
            "user_id" => $post->getUserId(),
            "guid" => $post->getGuid(),
            "mini_guid" => $post->getMiniGuid(),
            "posted_date" => $post->getPostedDate(),
            "name" => $post->getName(),
        ));
    }

    public function update($post){
        $this->context::update("posts", array(
            "id" => $post->getId(),
            "user_id" => $post->getUserId(),
            "guid" => $post->getGuid(),
            "mini_guid" => $post->getMiniGuid(),
            "posted_date" => $post->getPostedDate(),
            "name" => $post->getName(),
        ), "id=" . $post->getId());
    }
}