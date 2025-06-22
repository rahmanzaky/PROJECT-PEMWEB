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
        $user_name = $_POST['user_name'] ?? '';
        $password = $_POST['password'] ?? '';

        $userModel = $this->loadModel('UserModel');
        $user = $userModel->verifyUserCredentials($user_name, $password);

        if ($user) {
            // TIDAK PERLU session_start() di sini
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['user_name'];
            $_SESSION['role'] = $user['role'];
            header('Location: index.php?c=Home&m=index');
            exit();
        } else {
            header('Location: index.php?c=Auth&m=index&error=invalid');
            exit();
        }
    }

    public function logout() {
        session_unset();
        session_destroy();
        header("Location: index.php?c=Auth&m=index&status=logged_out");
        exit();
    }

    public function register() {
        $this->loadView('register.php');
    }

    public function handleRegister() {
        $full_name = $_POST['full_name'] ?? '';
        $email = $_POST['email'] ?? ''; 
        $user_name = $_POST['user_name'] ?? '';
        $password = $_POST['password'] ?? '';

        if (!$full_name || !$email || !$user_name || !$password) {
            $this->loadView('register.php', ['error' => 'Semua field harus diisi.']);
            return;
        }

        $userModel = $this->loadModel('UserModel');

        if ($userModel->getByUsername($user_name)) {
            $this->loadView('register.php', ['error' => 'Username sudah digunakan.']);
            return;
        }

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $user_id = $userModel->createUser($user_name, $hashedPassword, $full_name, $email);

        if ($user_id) {
            $_SESSION['user_id'] = $user_id;
            $_SESSION['user_name'] = $user_name;
            $_SESSION['role'] = 'user'; // default role
            header("Location: index.php?c=Home&m=index");
            exit();
        } else {
            $this->loadView('register.php', ['error' => 'Registrasi gagal, silakan coba lagi.']);
            return;
        }
    }
}
?>