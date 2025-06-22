<?php

class GrowTogether extends Controller {

    public function grow() {
        $currentUserId = $_SESSION['user_id'] ?? 0;
        $userModel = $this->loadModel('UserModel');
        $currentUser = $userModel->getUserById($currentUserId);
        
        $this->loadView('growTogether.php', [
            'userRole' => $currentUser['role'] ?? 'user',
            'currentUserId' => $currentUserId,
            'currentUserName' => $currentUser['user_name'] ?? 'Guest',
        ]);
    }
    
    public function create() {
        if (!isset($_SESSION['user_id'])) {
            header('Location: ?c=Auth&m=index');
            exit();
        }
        
        $userId = $_SESSION['user_id'];
        $userModel = $this->loadModel('UserModel');
        $user = $userModel->getUserById($userId);

        if ($user && $user['role'] === 'speaker') {
            $this->loadView('createPost.php', [
                'user' => $user,
                'currentUserName' => $user['user_name'],
                'userRole' => $user['role']
            ]);
        } else {
            header('Location: ?c=GrowTogether&m=grow&error=access_denied');
            exit();
        }
    }

    public function store() {
        if (!isset($_SESSION['user_id'])) {
            header('Location: ?c=Auth&m=index');
            exit();
        }
        $userId = $_SESSION['user_id'];
        $userModel = $this->loadModel('UserModel');
        $eventCreatorUser = $userModel->getUserById($userId);
        
        $userNameForFile = 'unknown_user';
        if ($eventCreatorUser) {
            $userNameForFile = strtolower($eventCreatorUser['user_name']);
            $userNameForFile = preg_replace('/[^a-z0-9_-]+/', '-', $userNameForFile);
            $userNameForFile = trim($userNameForFile, '-');
        }

        $title = $_POST['title'] ?? '';
        $topic = $_POST['topic'] ?? 'General';
        $description = $_POST['description'] ?? '';
        $imageFile = $_FILES['image'] ?? null;
        $keySumFile = $_FILES['keySum'] ?? null;

        $uploadFile = function($file, $subDir, $baseNamePrefix = 'file') use ($userId, $userNameForFile) {
            if ($file && $file['error'] === UPLOAD_ERR_OK) {
                $baseUploadDir = 'uploads/'; 
                $uploadDir = $baseUploadDir . $subDir . '/'; 
                if (!is_dir($uploadDir)) mkdir($uploadDir, 0755, true);
                $fileExtension = pathinfo($file['name'], PATHINFO_EXTENSION);
                $timestamp = date('YmdHis');
                $uniqueComponent = uniqid();
                $newFilename = $baseNamePrefix . "_" . $userId . "_" . $userNameForFile . "_" . $timestamp . "_" . $uniqueComponent . "." . $fileExtension;
                $filePath = $uploadDir . $newFilename;
                if (move_uploaded_file($file['tmp_name'], $filePath)) return $filePath;
            }
            return '';
        };

        $imagePath = $uploadFile($imageFile, 'images', 'eventimg');
        $keySumPath = $uploadFile($keySumFile, 'pdfs', 'keysum');
        
        $eventModel = $this->loadModel('EventModel');
        $success = $eventModel->createEvent($userId, $title, $topic, $description, $imagePath, $keySumPath);
        
        header('Location: ?c=GrowTogether&m=grow&status=' . ($success ? 'event_created' : 'create_failed'));
        exit();
    }

    function signUp() {
        if (!$this->isLoggedIn()) {
            header('Location: ?c=Auth&m=index');
            exit();
        }

        $this->loadView('speakerSignUp.php', [
            'currentUserName' => $this->currentUserName,
            'userRole' => $this->userRole
        ]);
    }
    public function search() {
        $currentUserId = $_SESSION['user_id'] ?? 0;
        $userModel = $this->loadModel('UserModel');
        $currentUser = $userModel->getUserById($currentUserId);
        
        $query = $_POST['query'] ?? '';
        $eventModel = $this->loadModel('EventModel');
        $events = $eventModel->searchEvents($query);
        
        $this->loadView('searchResults.php', [
            'events' => $events,
            'currentUserName' => $currentUser['user_name'] ?? 'Guest',
            'userRole' => $currentUser['role'] ?? 'user'
        ]);
    }

    public function registered() {
        $currentUserId = $_SESSION['user_id'] ?? 0;
        if (!$currentUserId) { header('Location: ?c=Auth&m=index'); exit(); }
        
        $userModel = $this->loadModel('UserModel');
        $currentUser = $userModel->getUserById($currentUserId);
        
        $eventModel = $this->loadModel('EventModel');
        $registeredEvents = $eventModel->getRegisteredEventsForUser($currentUserId);
        $eventsNeedingReview = $eventModel->getEventsNeedingReview($currentUserId);

        $this->loadView('registered.php', [
            'username' => $currentUser['user_name'] ?? 'Guest',
            'currentUserName' => $currentUser['user_name'] ?? 'Guest',
            'registeredEvents' => $registeredEvents,
            'eventsNeedingReview' => $eventsNeedingReview,
            'userRole' => $currentUser['role'] ?? 'user',
            'currentUserId' => $currentUserId
        ]);
    }

    public function joinEvent() {
        if (!isset($_SESSION['user_id'])) {
            header('Location: ?c=Auth&m=index');
            exit();
        }
        $userId = $_SESSION['user_id'];
        
        $eventId = intval($_GET['id'] ?? 0);

        if ($userId > 0 && $eventId > 0) {
            $eventModel = $this->loadModel('EventModel');
            
            $eventModel->registerUserForEvent($userId, $eventId);
        }
        
        header('Location: ?c=GrowTogether&m=grow&status=joined');
        exit();
    }

    public function showEvent() {
        $eventId = $_GET['id'] ?? 0;
        if ($eventId <= 0) { header('Location: ?c=GrowTogether&m=grow&error=invalid_event'); exit(); }

        $currentUserId = $_SESSION['user_id'] ?? 0;
        $userModel = $this->loadModel('UserModel');
        $currentUser = $userModel->getUserById($currentUserId);
        
        $eventModel = $this->loadModel('EventModel');
        $eventDetails = $eventModel->getEventById($eventId);
        if (!$eventDetails) { header('Location: ?c=GrowTogether&m=grow&error=not_found'); exit(); }

        $this->loadView('eventDetail.php', [
            'event' => $eventDetails,
            'currentUserName' => $currentUser['user_name'] ?? 'Guest',
            'userRole' => $currentUser['role'] ?? 'user',
            'currentUserId' => $currentUserId,
            'registeredEventIds' => $currentUserId ? $eventModel->getRegisteredEventIdsForUser($currentUserId) : []
        ]);
    }

    public function showReviewForm() {
        $eventId = $_GET['event_id'] ?? 0;
        if ($eventId <= 0) { header('Location: ?c=GrowTogether&m=grow&error=invalid_event'); exit(); }

        $currentUserId = $_SESSION['user_id'] ?? 0;
        if (!$currentUserId) { header('Location: ?c=Auth&m=index'); exit(); }

        $userModel = $this->loadModel('UserModel');
        $currentUser = $userModel->getUserById($currentUserId);

        $eventModel = $this->loadModel('EventModel');
        $eventDetails = $eventModel->getEventById($eventId);
        if (!$eventDetails) { header('Location: ?c=GrowTogether&m=grow&error=not_found'); exit(); }

        $this->loadView('reviewForm.php', [
            'event' => $eventDetails,
            'currentUserName' => $currentUser['user_name'] ?? 'Guest',
            'userRole' => $currentUser['role'] ?? 'user',
            'currentUserId' => $currentUserId,
            'hasReviewed' => $eventModel->hasUserReviewedEvent($currentUserId, $eventId),
            'reviews' => $eventModel->getReviewsByEventId($eventId)
        ]);
    }

    public function storeReview() {
        if (!isset($_SESSION['user_id'])) { header('Location: ?c=Auth&m=index'); exit(); }
        
        $userId = $_SESSION['user_id'];
        $eventId = $_POST['event_id'] ?? 0;
        $rating = $_POST['rating'] ?? null;
        $reviewText = trim($_POST['review_text'] ?? '');

        if ($eventId <= 0 || $rating === null || $rating < 1 || $rating > 5) {
            header('Location: ?c=GrowTogether&m=showReviewForm&event_id=' . $eventId . '&error=invalid_data');
            exit();
        }

        $eventModel = $this->loadModel('EventModel');
        $success = $eventModel->addReview($eventId, $userId, $rating, $reviewText);
        
        header('Location: ?c=GrowTogether&m=showEvent&id=' . $eventId . '&status=' . ($success ? 'review_added' : 'review_failed'));
        exit();
    }

    public function showComments() {
        $eventId = $_GET['event_id'] ?? 0;
        if ($eventId <= 0) { header('Location: ?c=GrowTogether&m=grow&error=invalid_event'); exit(); }

        $currentUserId = $_SESSION['user_id'] ?? 0;
        $userModel = $this->loadModel('UserModel');
        $currentUser = $userModel->getUserById($currentUserId);

        $eventModel = $this->loadModel('EventModel');
        $eventDetails = $eventModel->getEventById($eventId);
        if (!$eventDetails) { header('Location: ?c=GrowTogether&m=grow&error=not_found'); exit(); }

        $this->loadView('eventComments.php', [
            'event' => $eventDetails,        
            'comments' => $eventModel->getCommentsByEventId($eventId),
            'currentUserName' => $currentUser['user_name'] ?? 'Guest',
            'userRole' => $currentUser['role'] ?? 'user',
            'currentUserId' => $currentUserId
        ]);
    }

    public function storeComment() {
        if (!isset($_SESSION['user_id'])) { header('Location: ?c=Auth&m=index'); exit(); }

        $userId = $_SESSION['user_id'];
        $eventId = $_POST['event_id'] ?? 0;
        $commentText = trim($_POST['comment_text'] ?? '');

        if ($eventId > 0 && !empty($commentText)) {
            $eventModel = $this->loadModel('EventModel');
            $eventModel->addComment($eventId, $userId, $commentText);
        }
        
        header('Location: ?c=GrowTogether&m=showComments&event_id=' . $eventId . '&status=comment_added');
        exit();
    }
}
?>