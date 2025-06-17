<?php

class GrowForum extends Controller {

    /**
     * Menampilkan halaman utama GrowForum dengan daftar semua thread.
     */
    function index() {
        // Ambil info pengguna saat ini untuk menu hamburger
        $currentUserId = $_SESSION['user_id'] ?? 0;
        $userModel = $this->loadModel('UserModel');
        $currentUser = $userModel->getUserById($currentUserId);
        $currentUserName = $currentUser ? $currentUser['user_name'] : 'Guest';
        $userRole = $currentUser ? $currentUser['role'] : 'user';

        // Logika asli untuk mengambil threads
        $threadModel = $this->loadModel('ThreadModel');
        $threads = $threadModel->getAll(); 
        
        // Asumsi nama view utama adalah list.php
        $this->loadView('list.php', [ 
            'threads' => $threads,
            'currentUserName' => $currentUserName,
            'userRole' => $userRole
        ]);
    }

    /**
     * Menampilkan formulir untuk membuat thread baru.
     */
    function form() {
        if (!isset($_SESSION['user_id'])) {
            header('Location: ?c=Auth&m=index');
            exit();
        }

        // Ambil info pengguna saat ini untuk menu hamburger
        $currentUserId = $_SESSION['user_id'];
        $userModel = $this->loadModel('UserModel');
        $currentUser = $userModel->getUserById($currentUserId);
        
        $this->loadView('form.php', [
            'currentUserName' => $currentUser['user_name'] ?? 'Guest',
            'userRole' => $currentUser['role'] ?? 'user'
        ]);
    }

    /**
     * Memproses dan menyimpan thread baru dari formulir.
     */
    function add() {
        if (!isset($_SESSION['user_id'])) {
            header('Location: ?c=Auth&m=index');
            exit();
        }

        $content = trim($_POST['content'] ?? '');
        $userId = $_SESSION['user_id'];

        if (!empty($content)) {
            $threadModel = $this->loadModel('ThreadModel');
            // Pastikan model insert() Anda menerima userId, bukan nama author
            $threadModel->insert($userId, $content);
        }

        header("Location: ?c=GrowForum&m=index&status=thread_created");
        exit();
    }

    /**
     * Menampilkan detail dari satu thread.
     */
    function detail() {
        $id = intval($_GET['id'] ?? 0);
        if ($id <= 0) {
            header("Location: ?c=GrowForum&m=index&error=not_found");
            exit();
        }

        // Ambil info pengguna saat ini untuk menu
        $currentUserId = $_SESSION['user_id'] ?? 0;
        $userModel = $this->loadModel('UserModel');
        $currentUser = $userModel->getUserById($currentUserId);

        $threadModel = $this->loadModel('ThreadModel');
        $thread = $threadModel->getById($id);

        if ($thread) {
            $this->loadView('detail.php', [
                'thread' => $thread,
                'currentUserName' => $currentUser['user_name'] ?? 'Guest',
                'userRole' => $currentUser['role'] ?? 'user',
                'currentUserId' => $currentUserId // Untuk logika tombol hapus
            ]);
        } else {
            header("Location: ?c=GrowForum&m=index&error=not_found");
            exit();
        }
    }

    /**
     * Menghapus thread milik pengguna.
     */
    function delete() {
        if (!isset($_SESSION['user_id'])) {
            header('Location: ?c=Auth&m=index');
            exit();
        }

        $id = intval($_GET['id'] ?? 0);
        $userId = $_SESSION['user_id'];

        if ($id > 0) {
            $threadModel = $this->loadModel('ThreadModel');
            // Penting: Pastikan method delete() di model Anda memvalidasi userId
            // agar pengguna hanya bisa menghapus thread miliknya sendiri.
            $threadModel->delete($id, $userId);
        }

        header("Location: ?c=GrowForum&m=index&status=deleted");
        exit();
    }
}
?>