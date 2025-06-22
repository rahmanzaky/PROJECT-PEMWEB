<?php

class Controller {
    protected $currentUserId = 0;
    protected $currentUserName = 'Guest';
    protected $userRole = 'user';

    public function __construct() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $this->setupUserSession();
    }

    private function setupUserSession() {
        if (isset($_SESSION['user_id'])) {
            $this->currentUserId = $_SESSION['user_id'];
            $this->currentUserName = $_SESSION['user_name'];
            $this->userRole = $_SESSION['role'];
        }
    }

    protected function loadModel($model) {
        require_once 'models/' . $model . '.class.php';
        return new $model();
    }

    protected function loadView($view, $data = []) {
        extract($data);
        require_once 'views/' . $view;
    }

    protected function isLoggedIn() {
        return $this->currentUserId > 0;
    }
}
?>