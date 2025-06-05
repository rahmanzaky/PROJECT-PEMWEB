<?php

class Todos extends Controller {
    function grow() {
        // di aplikasi aslinya akan mengambil user ID dari session
        $currentUserId = 2; // ini mensimulasikan 'Erza' (ID 2) yang mengakses halaman

        $userModel = $this->loadModel('UserModel');
        $currentUser = $userModel->getUserById($currentUserId);
        $userRole = $currentUser ? $currentUser['role'] : 'user'; 

        $eventModel = $this->loadModel('EventModel');
        
        $events = $eventModel->getAllEvents();

        $registeredEventIds = []; 
        if ($currentUserId && $eventModel) {
            $registeredEventIds = $eventModel->getRegisteredEventIdsForUser($currentUserId);
        }
        
        $this->loadView('growTogether.php', [
            'events' => $events,
            'userRole' => $userRole,
            'currentUserId' => $currentUserId,
            'registeredEventIds' => $registeredEventIds
        ]);
    }

    function create() {
        $userId = 2;

        $userModel = $this->loadModel('UserModel');
        $user = $userModel->getUserById($userId);

        if ($user && $user['role'] === 'speaker') {
            $this->loadView('createPost.php', ['user' => $user, 'userRole' => $user['role']]);
        } else {
            header('Location: ?c=Todos&m=grow&error=access_denied');
            exit();
        }
    }

    function store() {
        $userId = 2; 

        $userModelForFile = $this->loadModel('UserModel');
        $eventCreatorUser = $userModelForFile->getUserById($userId);
        
        $userNameForFile = 'unknown_user';
        if ($eventCreatorUser) {
            $userNameForFile = strtolower($eventCreatorUser['user_name']);
            $userNameForFile = preg_replace('/[^a-z0-9_-]+/', '-', $userNameForFile);
            $userNameForFile = trim($userNameForFile, '-');
        }
        $dateUploaded = date('Ymd');

        $title = $_POST['title'] ?? '';
        $topic = $_POST['topic'] ?? 'General';
        $description = $_POST['description'] ?? '';
        $imageFile = $_FILES['image'] ?? null;
        $keySumFile = $_FILES['keySum'] ?? null;

        $uploadFile = function($file, $subDir, $baseNamePrefix = 'file') use ($userId, $userNameForFile, $dateUploaded) {
            if ($file && $file['error'] === UPLOAD_ERR_OK) {
               
                $baseUploadDir = 'uploads/'; 
            
                
                $uploadDir = $baseUploadDir . $subDir . '/'; 

                if (!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0755, true);
                }
                
                $fileExtension = pathinfo($file['name'], PATHINFO_EXTENSION);
                
                $timestamp = date('YmdHis');
                $uniqueComponent = uniqid();
                $newFilename = $baseNamePrefix . "_" . $userId . "_" . $userNameForFile . "_" . $timestamp . "_" . $uniqueComponent . "." . $fileExtension;
                
                $filePath = $uploadDir . $newFilename;

                if (move_uploaded_file($file['tmp_name'], $filePath)) {
                    return $filePath;
                } else {
                    return ''; 
                }
            }
            return '';
        }; 

        $imagePath = $uploadFile($imageFile, 'images', 'eventimg'); // Will save to 'uploads/images/'
        $keySumPath = $uploadFile($keySumFile, 'pdfs', 'keysum');     // Will save to 'uploads/pdfs/'

        $eventModel = $this->loadModel('EventModel');
        $success = $eventModel->createEvent($userId, $title, $topic, $description, $imagePath, $keySumPath);

        if ($success) {
            header('Location: ?c=Todos&m=grow&status=event_created');
        } else {
            header('Location: ?c=Todos&m=create&error=create_failed');
        }
        exit();
    }

    function signUp() {
        $this->loadView('speakerSignUp.php');
    }

    function ulasan() {
        $this->loadView('ulasan.php');
    }

    function search() {
        $currentUserId = 2;
        $userModel = $this->loadModel('UserModel');
        $currentUser = $userModel->getUserById($currentUserId);
        $userRole = $currentUser ? $currentUser['role'] : 'user';

        $query = $_POST['query'] ?? '';
        $eventModel = $this->loadModel('EventModel');
        $events = $eventModel->searchEvents($query);

        $this->loadView('searchResults.php', [
            'events' => $events,
            'userRole' => $userRole,
            'currentUserId' => $currentUserId // If needed by the view
        ]);
    }

   function registered() {
        $currentUserId = 2; // Simulating 'Joe'

        $userModel = $this->loadModel('UserModel');
        $currentUser = $userModel->getUserById($currentUserId);

        $currentUsername = $currentUser ? $currentUser['user_name'] : 'Guest';
        $userRole = $currentUser ? $currentUser['role'] : 'user';

        $eventModel = $this->loadModel('EventModel');
        $registeredEvents = $eventModel->getRegisteredEventsForUser($currentUserId);

        $this->loadView('registered.php', [
            'username' => $currentUsername,
            'events' => $registeredEvents,
            'userRole' => $userRole,
            'currentUserId' => $currentUserId // For consistency if the footer needs it
        ]);
    }

    function joinEvent() {
        $userId = 2;
        $eventId = $_GET['id'] ?? 0;

        if ($userId > 0 && $eventId > 0) {
            $model = $this->loadModel('EventModel');
            $model->registerUserForEvent($userId, $eventId);
        }

        header('Location: ?c=Todos&m=grow&status=joined');
        exit();
    }
}
?>