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

        $imagePath = $uploadFile($imageFile, 'images', 'eventimg'); // Save ke 'uploads/images/'
        $keySumPath = $uploadFile($keySumFile, 'pdfs', 'keysum');     // Save ke 'uploads/pdfs/'

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
            'currentUserId' => $currentUserId 
        ]);
    }

    function registered() {
        $currentUserId = 2;
        $userModel = $this->loadModel('UserModel');
        $currentUser = $userModel->getUserById($currentUserId);
        $currentUsername = $currentUser ? $currentUser['user_name'] : 'Guest';
        $userRole = $currentUser ? $currentUser['role'] : 'user';

        $eventModel = $this->loadModel('EventModel');
        $registeredEvents = $eventModel->getRegisteredEventsForUser($currentUserId);
                
        $eventsNeedingReview = $eventModel->getEventsNeedingReview($currentUserId);

        $this->loadView('registered.php', [
            'username' => $currentUsername,
            'registeredEvents' => $registeredEvents, 
            'eventsNeedingReview' => $eventsNeedingReview,
            'userRole' => $userRole,
            'currentUserId' => $currentUserId
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

    function showEvent() {
        $eventId = $_GET['id'] ?? 0;
        if ($eventId <= 0) {
            header('Location: ?c=Todos&m=grow&error=invalid_event_id');
            exit();
        }

        $currentUserId = 2; 
        $userModel = $this->loadModel('UserModel');
        $currentUser = $userModel->getUserById($currentUserId);
        $userRole = $currentUser ? $currentUser['role'] : 'user';

        $eventModel = $this->loadModel('EventModel');
        $eventDetails = $eventModel->getEventById($eventId);

        if (!$eventDetails) {
            header('Location: ?c=Todos&m=grow&error=event_not_found');
            exit();
        }

        $registeredEventIds = [];
        if ($currentUserId && $eventModel) {
            $registeredEventIds = $eventModel->getRegisteredEventIdsForUser($currentUserId);
        }

        $this->loadView('eventDetail.php', [
            'event' => $eventDetails,   
            'userRole' => $userRole,    
            'currentUserId' => $currentUserId,
            'registeredEventIds' => $registeredEventIds 
        ]);
    }

    function showReviewForm() {
        $eventId = $_GET['event_id'] ?? 0;
        if ($eventId <= 0) {
            header('Location: ?c=Todos&m=grow&error=invalid_event_for_review');
            exit();
        }

        $currentUserId = 2;
        $userModel = $this->loadModel('UserModel');
        $currentUser = $userModel->getUserById($currentUserId);
        $userRole = $currentUser ? $currentUser['role'] : 'user';

        $eventModel = $this->loadModel('EventModel');
        $eventDetails = $eventModel->getEventById($eventId);

        if (!$eventDetails) {
            header('Location: ?c=Todos&m=grow&error=event_not_found_for_review');
            exit();
        }

        $hasReviewed = $eventModel->hasUserReviewedEvent($currentUserId, $eventId);

        $reviews = $eventModel->getReviewsByEventId($eventId);

        $this->loadView('reviewForm.php', [
            'event' => $eventDetails,
            'userRole' => $userRole,
            'currentUserId' => $currentUserId,
            'hasReviewed' => $hasReviewed,
            'reviews' => $reviews 
        ]);
    }

    function storeReview() {
        $userId = $_POST['user_id'] ?? 0;
        $eventId = $_POST['event_id'] ?? 0;
        $rating = $_POST['rating'] ?? null;
        $reviewText = trim($_POST['review_text'] ?? '');

        if ($userId <= 0 || $eventId <= 0 || $rating === null || $rating < 1 || $rating > 5) {
            header('Location: ?c=Todos&m=showReviewForm&event_id=' . $eventId . '&error=invalid_review_data');
            exit();
        }

        $eventModel = $this->loadModel('EventModel');
        $success = $eventModel->addReview($eventId, $userId, $rating, $reviewText);

        if ($success) {
            header('Location: ?c=Todos&m=showEvent&id=' . $eventId . '&status=review_added');
        } else {
            header('Location: ?c=Todos&m=showReviewForm&event_id=' . $eventId . '&error=review_failed_or_exists');
        }
        exit();
    }

    function showComments() {
        $eventId = $_GET['event_id'] ?? 0;
        if ($eventId <= 0) {
            header('Location: ?c=Todos&m=grow&error=invalid_event_id_for_comments');
            exit();
        }


        $currentUserId = 2; // Simulasiin user, pada kasus demo adalah user 'Erza' (ID 2)
        $userModel = $this->loadModel('UserModel');
        $currentUser = $userModel->getUserById($currentUserId);
        $userRole = $currentUser ? $currentUser['role'] : 'user';
        
        $currentUserName = $currentUser ? $currentUser['user_name'] : 'Guest';

        $eventModel = $this->loadModel('EventModel');

        $eventDetails = $eventModel->getEventById($eventId);
        if (!$eventDetails) {
            header('Location: ?c=Todos&m=grow&error=event_not_found_for_comments');
            exit();
        }

        $comments = $eventModel->getCommentsByEventId($eventId);

        $this->loadView('eventComments.php', [
            'event' => $eventDetails,        
            'comments' => $comments,         
            'userRole' => $userRole,         
            'currentUserId' => $currentUserId,   
            'currentUserName' => $currentUserName 
        ]);
    }

    function storeComment() {
        $userId = 2;

        $eventId = $_POST['event_id'] ?? 0;
        $commentText = $_POST['comment_text'] ?? '';

        if ($userId > 0 && $eventId > 0 && !empty(trim($commentText))) {
            $eventModel = $this->loadModel('EventModel');
            $success = $eventModel->addComment($eventId, $userId, trim($commentText));

            if ($success) {
                header('Location: ?c=Todos&m=showComments&event_id=' . $eventId . '&status=comment_added');
                exit();
            }
        }

        header('Location: ?c=Todos&m=showComments&event_id=' . $eventId . '&error=comment_failed');
        exit();
    }
}