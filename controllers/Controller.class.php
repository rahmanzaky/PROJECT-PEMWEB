<?php

class Controller {
    // Properti untuk menyimpan data pengguna yang login
    protected $currentUserId = 0;
    protected $currentUserName = 'Guest';
    protected $userRole = 'user';

    /**
     * Constructor ini akan berjalan OTOMATIS setiap kali
     * sebuah controller (GrowTogether, GrowHub, dll) dibuat.
     */
    public function __construct() {
        // Memulai session dengan aman, hanya jika belum ada
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        // Menyiapkan data pengguna dari session
        $this->setupUserSession();
    }

    /**
     * Helper method untuk mengambil data dari $_SESSION
     * dan menyimpannya ke dalam properti kelas.
     */
    private function setupUserSession() {
        if (isset($_SESSION['user_id'])) {
            $this->currentUserId = $_SESSION['user_id'];
            $this->currentUserName = $_SESSION['user_name'];
            $this->userRole = $_SESSION['role'];
        }
    }

    /**
     * Memuat file model yang dibutuhkan.
     */
    protected function loadModel($model) {
        // Catatan: models/Model.class.php sebaiknya di-include sekali di file index.php utama Anda
        require_once 'models/' . $model . '.class.php';
        return new $model();
    }

    /**
     * Memuat file view dan meneruskan data ke dalamnya.
     */
    protected function loadView($view, $data = []) {
        // extract() melakukan hal yang sama dengan loop foreach Anda, tetapi lebih ringkas.
        // Fungsi ini mengubah key dari array menjadi variabel.
        // Contoh: $data['events'] akan menjadi variabel $events di dalam view.
        extract($data);
        require_once 'views/' . $view;
    }

    /**
     * Helper method untuk memeriksa apakah pengguna sudah login.
     * @return bool
     */
    protected function isLoggedIn() {
        return $this->currentUserId > 0;
    }
}
?>