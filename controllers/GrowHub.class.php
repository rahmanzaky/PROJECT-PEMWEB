<?php

class GrowHub extends Controller {

    function list() {
        $currentUserId = $_SESSION['user_id'] ?? 0;
        $userModel = $this->loadModel('UserModel');
        $currentUser = $userModel->getUserById($currentUserId);
        $currentUserName = $currentUser ? $currentUser['user_name'] : 'Guest';
        $userRole = $currentUser ? $currentUser['role'] : 'user';

        $templateModel = $this->loadModel('TemplateModel');
        $templates = $templateModel->getAllTemplates(); 
        
        $this->loadView('templates.php', [ 
            'templates' => $templates,
            'currentUserName' => $currentUserName,
            'userRole' => $userRole               
        ]);
    }

    function submit() {
        if (!isset($_SESSION['user_id'])) {
            header('Location: ?c=Auth&m=index');
            exit();
        }

        $currentUserId = $_SESSION['user_id'];
        $userModel = $this->loadModel('UserModel');
        $currentUser = $userModel->getUserById($currentUserId);
        
        $this->loadView('upload.php', [
            'currentUserName' => $currentUser['user_name'] ?? 'Guest',
            'userRole' => $currentUser['role'] ?? 'user'
        ]);
    }

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
            header("Location: ?c=GrowHub&m=submit&error=invalid_data");
            exit();
        }
        
        $uploadDir = 'uploads/templates/';
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }

        $safeName = preg_replace('/[^A-Za-z0-9_\-\.]/', '_', basename($templateFile['name']));
        $filePath = $uploadDir . $safeName;

        if (!move_uploaded_file($templateFile['tmp_name'], $filePath)) {
            header("Location: ?c=GrowHub&m=submit&error=upload_failed");
            exit();
        }

        $templateModel = $this->loadModel('TemplateModel');
        $templateModel->insert($title, $category, $filePath, $userId);
        
        header("Location: ?c=GrowHub&m=mytemplate&status=uploaded");
        exit();
    }
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

    function detail() {
        $id = intval($_GET['id'] ?? 0);
        if ($id <= 0) {
            die("ID template tidak valid.");
        }

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
    function delete() {
        if (!isset($_SESSION['user_id'])) {
            header('Location: ?c=Auth&m=index');
            exit();
        }

        $id = $_GET['id'] ?? 0;
        $userId = $_SESSION['user_id'];
        
        $templateModel = $this->loadModel('TemplateModel');
        $templateModel->delete($id, $userId);
        
        header('location:?c=GrowHub&m=mytemplate&status=deleted'); 
        exit();
    }
}
?>