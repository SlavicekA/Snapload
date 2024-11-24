<?php

namespace Controllers;

use Repositories\PostRepo;
use Common\Services\GuidService;
use Common\Services\FormValidationService;
use Common\Services\ImageService;
use Core\View;
use Models\Post;

class UploadController {

    public function index() {
        $id = $_GET["id"] ?? 0;
        $post = new Post(0, $_SESSION["user_id"], "", "", "", "");
        if ($id != 0) {
            $postRepo = new PostRepo();
            $post = $postRepo->selectById($id);
        }
        View::render("upload", ["post" => $post]);
    }

    public function handleRequest() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $id = $_POST["id"] ?? 0;
            $name = $_POST["name"] ?? null;
            $user_id = $_POST["user_id"] ?? null;
            $picture = $_FILES["picture"] ?? null;

            $error = false;

            if ( (!FormValidationService::checkEmpty([$name]))) {
                header('Content-Type: application/json', true, 400);
                echo json_encode([
                    'success' => false,
                    'errors' => [
                        'empty' => !FormValidationService::checkEmpty([$name]) ? 'The post title is required' : null
                    ]
                ]);
                $error = true;
                exit;
            }

            $picture_guid = GuidService::generateGUID();
            $target_file = null;
            if ($picture && $picture["error"] == UPLOAD_ERR_OK) {
                $fileType = str_replace("image/", "", getimagesize($picture["tmp_name"])["mime"]);

                if (!FormValidationService::checkFileExtension($fileType) and $picture != null) {
                    header('Content-Type: application/json', true, 400);
                    echo json_encode([
                        'success' => false,
                        'errors' => [
                            'wrong_file_type' => !FormValidationService::checkFileExtension($fileType) ? 'File has to be .jpg, .jpeg or .png' : null
                        ]
                    ]);
                }

                $target_dir = "Public/Images/Uploads/";
                $target_file = $target_dir . $picture_guid;


                ImageService::savePostPicture($picture, $target_file);
            } else {
                exit;
            }

            $post = new Post($id, $user_id, $picture_guid . "." . $fileType, $picture_guid . "_MINI" . "." . $fileType, date('Y-m-d H:i:s'), $name);

            if(!$error){
                if ($id != 0) {
                    $postRepo = new PostRepo();
                    $postRepo->update($post);
                } else {
                    $postRepo = new PostRepo();
                    $postRepo->insert($post);
                }
                header('Content-Type: application/json');
                echo json_encode(['success' => true]);
                header("Location: /");       
                exit;     
            }

        }
    }
}