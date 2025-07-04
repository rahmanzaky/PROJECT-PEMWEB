<?php

class User extends Controller {

    function applyAsSpeaker() {
        if (!$this->isLoggedIn()) {
            header('Location: ?c=Login&m=index'); 
            exit();
        }
        $userId = $this->currentUserId;

        $fullName = $_POST['user-fullname'] ?? '';
        $linkedinUrl = $_POST['linkedin-url'] ?? '';
        $category = $_POST['category'] ?? '';
        $cvFile = $_FILES['cv'] ?? null;
        $cvPath = '';

        $userNameForFile = 'unknown_user';
        if ($this->currentUserName !== 'Guest') {
            $userNameForFile = strtolower($this->currentUserName);
            $userNameForFile = preg_replace('/[^a-z0-9_-]+/', '-', $userNameForFile);
            $userNameForFile = trim($userNameForFile, '-');
        }

        if ($cvFile && $cvFile['error'] === UPLOAD_ERR_OK) {
            $uploadDir = 'uploads/cvs/';
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0755, true);
            }

            $fileExtension = pathinfo($cvFile['name'], PATHINFO_EXTENSION);
            $dateUploaded = date('Ymd'); 

            $newFilename = "cv_" . $userId . "_" . $userNameForFile . "_" . $dateUploaded . "." . $fileExtension;
            $cvPath = $uploadDir . $newFilename;

            if (!move_uploaded_file($cvFile['tmp_name'], $cvPath)) {
                $cvPath = ''; // Reset path jika gagal
            }
        }

        $userModel = $this->loadModel('UserModel');
        $success = $userModel->updateSpeakerApplication(
            $userId, 
            $fullName, 
            $linkedinUrl, 
            $cvPath, 
            $category
        );

        if ($success) {
            header('Location: ?c=GrowTogether&m=grow&status=speaker_signup_success');
        } else {
            header('Location: ?c=GrowTogether&m=signUp&error=speaker_apply_failed'); 
        }
        exit();
    }
}
?>