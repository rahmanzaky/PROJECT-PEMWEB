<?php

class GrowForum extends Controller {

    function index() {
        $currentUserId = $_SESSION['user_id'] ?? 0;
        $userModel = $this->loadModel('UserModel');
        $currentUser = $userModel->getUserById($currentUserId);
        $currentUserName = $currentUser ? $currentUser['user_name'] : 'Guest';
        $userRole = $currentUser ? $currentUser['role'] : 'user';

        $threadModel = $this->loadModel('ThreadModel');
        $threads = $threadModel->getAll(); 
        
        $this->loadView('list.php', [ 
            'threads' => $threads,
            'currentUserName' => $currentUserName,
            'userRole' => $userRole
        ]);
    }

    function form() {
        if (!isset($_SESSION['user_id'])) {
            header('Location: ?c=Auth&m=index');
            exit();
        }

        $currentUserId = $_SESSION['user_id'];
        $userModel = $this->loadModel('UserModel');
        $currentUser = $userModel->getUserById($currentUserId);
        
        $this->loadView('form.php', [
            'currentUserName' => $currentUser['user_name'] ?? 'Guest',
            'userRole' => $currentUser['role'] ?? 'user'
        ]);
    }

    function add() {
        if (!isset($_SESSION['user_id'])) {
            header('Location: ?c=Auth&m=index');
            exit();
        }

        $content = trim($_POST['content'] ?? '');
        $userId = $_SESSION['user_id'];

        if (!empty($content)) {
            $threadModel = $this->loadModel('ThreadModel');
            $threadModel->insert($userId, $content);
        }

        header("Location: ?c=GrowForum&m=index&status=thread_created");
        exit();
    }

    function detail() {
        $id = intval($_GET['id'] ?? 0);
        if ($id <= 0) {
            header("Location: ?c=GrowForum&m=index&error=not_found");
            exit();
        }

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

    function delete() {
        if (!isset($_SESSION['user_id'])) {
            header('Location: ?c=Auth&m=index');
            exit();
        }

        $id = intval($_GET['id'] ?? 0);
        $userId = $_SESSION['user_id'];

        if ($id > 0) {
            $threadModel = $this->loadModel('ThreadModel');
            $threadModel->delete($id, $userId);
        }

        header("Location: ?c=GrowForum&m=index&status=deleted");
        exit();
    }
}
?>