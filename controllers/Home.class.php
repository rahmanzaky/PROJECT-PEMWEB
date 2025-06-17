<?php

class Home extends Controller {

    /**
     * Menampilkan halaman utama aplikasi (home.php).
     */
    function index() {
        // Ambil info pengguna saat ini dari sesi untuk ditampilkan di menu
        $currentUserId = $_SESSION['user_id'] ?? 0;
        $userModel = $this->loadModel('UserModel');
        $currentUser = $userModel->getUserById($currentUserId);
        
        // Siapkan data untuk view
        $data = [
            'currentUserName' => $currentUser['user_name'] ?? 'Guest',
            'userRole' => $currentUser['role'] ?? 'user'
        ];
        
        // Muat view home.php dan kirimkan data pengguna
        $this->loadView('home.php', $data);
    }
}
?>