<?php

namespace Controllers;

use Repositories\UserRepo;
use Models\User;
use Common\Services\GuidService;
use Common\Services\FormValidationService;
use Common\Services\UserEditValidationService;
use Common\Services\ImageService;
use Core\View;

class UserEditController {

    public function index() {
        $id = $_GET["id"] ?? 0;
        $user = new User(0, "", "", "", "", "");
        if ($id != 0) {
            $userRepo = new UserRepo();
            $user = $userRepo->selectById($id);
        }
        View::render("user_edit", ["user" => $user]);
    }

    public function handleRequest() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $id = $_POST["id"] ?? 0;
            $email = $_POST["email"] ?? null;
            $username = $_POST["username"] ?? null;
            $password = $_POST["password"] ?? null;
            $profile_picture = $_FILES["profile_picture"] ?? null;

            $error = false;

            if ( (!FormValidationService::checkEmpty([$email, $username, $password])) || !UserEditValidationService::checkNameLength($username) || !UserEditValidationService::checkNameExists($username) ||!UserEditValidationService::checkEmail($email) || !UserEditValidationService::checkPassword($password)) {
                header('Content-Type: application/json', true, 400);
                echo json_encode([
                    'success' => false,
                    'errors' => [
                        'empty' => !FormValidationService::checkEmpty([$email, $username, $password]) ? 'Email, Username and Password are required' : null,
                        'email' => !UserEditValidationService::checkEmail($email) ? 'Invalid email' : null,
                        'username_length' => !UserEditValidationService::checkNameLength($username) ? 'Username has to be 3-15 characters long' : null,
                        'username_exists' => !UserEditValidationService::checkNameExists($username) ? 'Username already exists' : null,
                        'password' => !UserEditValidationService::checkPassword($password) ? 'Password must be at least 8 characters long' : null,
                    ]
                ]);
                $error = true;
                exit;
            }

            
            $passwd_hash = password_hash($password, PASSWORD_DEFAULT);

            $picture_guid = null;
            $target_file = null;
            if ($profile_picture && $profile_picture["error"] == UPLOAD_ERR_OK) {
                $fileType = str_replace("image/", "", getimagesize($profile_picture["tmp_name"])["mime"]);

                if (!FormValidationService::checkFileExtension($fileType) and $profile_picture != null) {
                    header('Content-Type: application/json', true, 400);
                    echo json_encode([
                        'success' => false,
                        'errors' => [
                            'wrong_file_type' => !FormValidationService::checkFileExtension($fileType) ? 'File has to be .jpg, .jpeg or .png' : null
                        ]
                    ]);
                }

                $target_dir = "Public/Images/Uploads/";
                $picture_guid = GuidService::generateGUID();
                $target_file = $target_dir . $picture_guid;


                ImageService::saveProfilePicture($profile_picture, $target_file, 200, 200);
            } else {
                $picture_guid = "default_profile_picture.svg";
            }

            $user = new User($id, $username, $picture_guid . "." . $fileType, $email, "user", $passwd_hash);

            if(!$error){
                if ($id != 0) {
                    $userRepo = new UserRepo();
                    $userRepo->update($user);
                } else {
                    $userRepo = new UserRepo();
                    $userRepo->insert($user);
                }
                header('Content-Type: application/json');
                echo json_encode(['success' => true]);
                header("Location: /");       
                exit;     
            }

        }
    }
}