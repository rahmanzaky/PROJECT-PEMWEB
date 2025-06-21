<?php

class GrowTogether extends Controller {

    /**
     * Menampilkan halaman utama dengan semua event.
     */
    public function grow() {
        $currentUserId = $_SESSION['user_id'] ?? 0;
        $userModel = $this->loadModel('UserModel');
        $currentUser = $userModel->getUserById($currentUserId);
        
        $this->loadView('growTogether.php', [
            'events' => $this->loadModel('EventModel')->getAllEvents(),
            'userRole' => $currentUser['role'] ?? 'user',
            'currentUserId' => $currentUserId,
            'currentUserName' => $currentUser['user_name'] ?? 'Guest',
            'registeredEventIds' => $currentUserId ? $this->loadModel('EventModel')->getRegisteredEventIdsForUser($currentUserId) : []
        ]);
    }

    /**
     * Menampilkan halaman untuk membuat event baru (hanya untuk speaker).
     */
    public function create() {
        if (!isset($_SESSION['user_id'])) {
            header('Location: ?c=Auth&m=index');
            exit();
        }
        
        $userId = $_SESSION['user_id'];
        $userModel = $this->loadModel('UserModel');
        $user = $userModel->getUserById($userId);

        if ($user && $user['role'] === 'speaker') {
            // Teruskan semua info pengguna yang relevan ke view
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

    /**
     * Menyimpan event baru ke database.
     */
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

    /**
     * Menampilkan halaman pendaftaran sebagai speaker.
     */
    function signUp() {
        // Pengecekan Keamanan: Apakah pengguna sudah login?
        // Menggunakan helper method isLoggedIn() dari Controller parent.
        if (!$this->isLoggedIn()) {
            // Jika tidak, paksa arahkan ke halaman login.
            header('Location: ?c=Auth&m=index');
            exit();
        }

        // Jika sudah login, lanjutkan untuk menampilkan halaman.
        // Data pengguna ($currentUserName dan $userRole) sudah disiapkan oleh
        // constructor dari Controller parent, jadi kita bisa langsung meneruskannya
        // ke view untuk digunakan oleh menu hamburger.
        $this->loadView('speakerSignUp.php', [
            'currentUserName' => $this->currentUserName,
            'userRole' => $this->userRole
        ]);
    }
    /**
     * Menampilkan halaman hasil pencarian.
     */
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

    /**
     * Menampilkan halaman "Aktivitas Saya".
     */
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
        // 1. Lindungi route: pastikan pengguna sudah login
        if (!isset($_SESSION['user_id'])) {
            header('Location: ?c=Auth&m=index');
            exit();
        }
        $userId = $_SESSION['user_id'];
        
        // 2. Ambil ID event dari URL
        $eventId = intval($_GET['id'] ?? 0);

        // 3. Validasi dasar
        if ($userId > 0 && $eventId > 0) {
            $eventModel = $this->loadModel('EventModel');
            
            // Panggil model untuk mendaftarkan pengguna ke event
            $eventModel->registerUserForEvent($userId, $eventId);
        }
        
        // 4. Arahkan pengguna kembali ke halaman utama dengan status sukses
        //    agar notifikasi pop-up bisa muncul.
        header('Location: ?c=GrowTogether&m=grow&status=joined');
        exit();
    }

    /**
     * Menampilkan halaman detail event.
     */
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

    /**
     * Menampilkan halaman ulasan/review untuk suatu event.
     */
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

    /**
     * Menyimpan ulasan baru.
     */
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

    /**
     * Menampilkan halaman komentar untuk suatu event.
     */
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

    /**
     * Menyimpan komentar baru.
     */
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