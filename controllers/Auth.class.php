<?php

class Auth extends Controller {

    public function index() {
        if (isset($_SESSION['user_id'])) {
            session_unset();
            session_destroy();
        }
        $data = [];
        if (isset($_GET['error'])) {
            $data['error'] = 'Login failed. Please check your username and password.';
        }
        $this->loadView('login.php', $data);
    }

    public function handleLogin() {
        // --- PERBAIKAN DI SINI ---
        // Sebelumnya: $_POST['username']
        // Menjadi: $_POST['user_name'] agar cocok dengan form HTML
        $user_name = $_POST['user_name'] ?? '';
        // --- AKHIR PERBAIKAN ---

        $password = $_POST['password'] ?? '';

        $userModel = $this->loadModel('UserModel');
        $user = $userModel->verifyUserCredentials($user_name, $password);

        if ($user) {
            session_start();
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['user_name'];
            $_SESSION['role'] = $user['role'];
            header('Location: index.php?c=GrowTogether&m=grow');
            exit();
        } else {
            header('Location: index.php?c=Auth&m=index&error=invalid');
            exit();
        }
    }

    public function logout() {
        session_start();
        session_unset();
        session_destroy();
        header("Location: index.php?c=Auth&m=index&status=logged_out");
        exit();
    }
}
?>