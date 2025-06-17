<?php

class GrowHub extends Controller {

    /**
     * Menampilkan halaman utama GrowHub dengan daftar semua template.
     */
    function list() {
        // Ambil info pengguna saat ini untuk menu hamburger
        $currentUserId = $_SESSION['user_id'] ?? 0;
        $userModel = $this->loadModel('UserModel');
        $currentUser = $userModel->getUserById($currentUserId);
        $currentUserName = $currentUser ? $currentUser['user_name'] : 'Guest';
        $userRole = $currentUser ? $currentUser['role'] : 'user';

        // Logika asli untuk mengambil template
        $templateModel = $this->loadModel('TemplateModel');
        $templates = $templateModel->getAllTemplates(); 
        
        $this->loadView('templates.php', [ // Asumsi nama view utama adalah templates.php
            'templates' => $templates,
            'currentUserName' => $currentUserName, // Untuk menu
            'userRole' => $userRole               // Untuk menu
        ]);
    }

    /**
     * Menampilkan halaman formulir untuk mengunggah template baru.
     */
    function submit() {
        // Pastikan pengguna sudah login sebelum mengunggah
        if (!isset($_SESSION['user_id'])) {
            header('Location: ?c=Auth&m=index');
            exit();
        }

        // Ambil info pengguna saat ini untuk menu hamburger
        $currentUserId = $_SESSION['user_id'];
        $userModel = $this->loadModel('UserModel');
        $currentUser = $userModel->getUserById($currentUserId);
        
        $this->loadView('upload.php', [
            'currentUserName' => $currentUser['user_name'] ?? 'Guest',
            'userRole' => $currentUser['role'] ?? 'user'
        ]);
    }

    /**
     * Memproses data dari formulir unggah template.
     */
    public function add() {
        if (!isset($_SESSION['user_id'])) {
            header('Location: ?c=Auth&m=index');
            exit();
        }
        $userId = $_SESSION['user_id'];
        $title = $_POST['title'] ?? '';
        $category = $_POST['category'] ?? '';
        $templateFile = $_FILES['template_file'] ?? null;

        if (empty($title) || empty($category) || !$templateFile || $templateFile['error'] !== UPLOAD_ERR_OK) {
            // Validasi dasar: jika data tidak lengkap atau ada error upload
            header("Location: ?c=GrowHub&m=submit&error=invalid_data");
            exit();
        }
        
        $uploadDir = 'uploads/templates/';
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }

        // Sanitasi nama file untuk keamanan
        $safeName = preg_replace('/[^A-Za-z0-9_\-\.]/', '_', basename($templateFile['name']));
        $filePath = $uploadDir . $safeName;

        if (!move_uploaded_file($templateFile['tmp_name'], $filePath)) {
            // Gagal memindahkan file
            header("Location: ?c=GrowHub&m=submit&error=upload_failed");
            exit();
        }

        $templateModel = $this->loadModel('TemplateModel');
        $templateModel->insert($title, $category, $filePath, $userId);
        
        // Arahkan ke halaman template milik pengguna setelah berhasil mengunggah
        header("Location: ?c=GrowHub&m=mytemplate&status=uploaded");
        exit();
    }

    /**
     * Menampilkan template yang diunggah oleh pengguna saat ini.
     */
    function mytemplate() {
        if (!isset($_SESSION['user_id'])) {
            header('Location: ?c=Auth&m=index');
            exit();
        }
        
        $currentUserId = $_SESSION['user_id'];
        $userModel = $this->loadModel('UserModel');
        $currentUser = $userModel->getUserById($currentUserId);
        $currentUserName = $currentUser ? $currentUser['user_name'] : 'Guest';
        $userRole = $currentUser ? $currentUser['role'] : 'user';

        $templateModel = $this->loadModel('TemplateModel');
        $templates = $templateModel->getTemplatesByUser($currentUserId); 
        
        $this->loadView('my_template.php', [
            'templates' => $templates,
            'currentUserName' => $currentUserName,
            'userRole' => $userRole
        ]);
    }

    /**
     * Menampilkan detail dari satu template.
     */
    function detail() {
        $id = intval($_GET['id'] ?? 0);
        if ($id <= 0) {
            die("ID template tidak valid.");
        }

        // Ambil info pengguna saat ini untuk menu hamburger
        $currentUserId = $_SESSION['user_id'] ?? 0;
        $userModel = $this->loadModel('UserModel');
        $currentUser = $userModel->getUserById($currentUserId);

        $templateModel = $this->loadModel('TemplateModel'); 
        $template = $templateModel->getTemplateById($id); 

        if (!$template) {
            die("Template tidak ditemukan.");
        }
        
        $this->loadView('detail_template.php', [
            'template' => $template,
            'currentUserName' => $currentUser['user_name'] ?? 'Guest',
            'userRole' => $currentUser['role'] ?? 'user'
        ]);
    }

    /**
     * Menghapus template milik pengguna.
     */
    function delete() {
        if (!isset($_SESSION['user_id'])) {
            header('Location: ?c=Auth&m=index');
            exit();
        }

        $id = $_GET['id'] ?? 0;
        $userId = $_SESSION['user_id'];
        
        // Sebaiknya ada validasi di model untuk memastikan hanya pemilik yang bisa menghapus
        $templateModel = $this->loadModel('TemplateModel');
        // File path juga bisa diambil dari sini untuk dihapus dari server
        // $template = $templateModel->getTemplateById($id);
        // if ($template && $template['user_id'] == $userId) { ... }
        $templateModel->delete($id, $userId);
        
        // Arahkan kembali ke halaman template milik pengguna
        header('location:?c=GrowHub&m=mytemplate&status=deleted'); 
        exit();
    }
}
?>