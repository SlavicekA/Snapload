<?php

namespace Controllers;

use Core\View;
use Models\User;
use Common\Services\AuthService;

    class LogInController
    {
        public function index(){
            View::render("log_in");
        }

        public function handleRequest()
        {
            session_start();

            echo "logging in";
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $email = $_POST['email'] ?? '';
                $password = $_POST['password'] ?? '';
                
                $user = AuthService::Verify($email, $password);
                if (!$user) {
                    header('Content-Type: application/json', true, 400);
                    $_SESSION['error'] = 'Invalid email or password.';
                        header('Location: /log_in');
                    exit;
                } else {
                    $_SESSION['user_id'] = $user->getId();
                    $_SESSION['username'] = $user->getUsername();
                    $_SESSION['email'] = $user->getEmail();
                    $_SESSION['avatar_guid'] = $user->getAvatarGuid();

                    header("Location: /home");
                }
            }
            /*SO YEAH IF YOU WANT TO CHECK IT WITH AJAX BEFORE ACTUALLY POSTING IT, THIS SPLITS THE ENDPOINT
            /*THE SCRIPT FOR IT IS READY IN THE log_in.js
            /*
            
                $contentType = $_SERVER['CONTENT_TYPE'] ?? '';
                $isJsonRequest = strpos($contentType, 'application/json') !== false;

                if ($isJsonRequest) {
                    $input = file_get_contents('php://input');
                    $data = json_decode($input, true);
                } else {
                    $data = $_POST;
                }

                $email = $data['email'] ?? '';
                $password = $data['password'] ?? '';
                
                $user = AuthService::Verify($email, $password);

                if (!$user) {

                    if ($isJsonRequest) {
                        http_response_code(401);
                        echo json_encode(['error' => 'Invalid email or password.']);
                    } else {
                        $_SESSION['error'] = 'Invalid email or password.';
                        header('Location: /log_in');
                    }
                } else {

                    if ($isJsonRequest) {
                        echo json_encode(['message' => 'ok']);
                    } else {
                        $_SESSION['user_id'] = $user->getId();
                        $_SESSION['username'] = $user->getUsername();
                        $_SESSION['email'] = $user->getEmail();
                        $_SESSION['avatar_guid'] = $user->getAvatarGuid();

                        header("Location: /home");
                    }
                exit;
            }*/
        }
    }

?>