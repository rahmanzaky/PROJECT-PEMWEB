<?php

class User extends Controller {

    /**
     * Memproses formulir pendaftaran sebagai pemateri.
     * Menggunakan data dari sesi untuk identifikasi pengguna.
     */
    function applyAsSpeaker() {
        // 1. Lindungi route ini dan dapatkan ID pengguna dari sesi
        //    menggunakan properti yang diwarisi dari Controller parent.
        if (!$this->isLoggedIn()) {
            header('Location: ?c=Login&m=index'); // Arahkan ke login jika belum masuk
            exit();
        }
        $userId = $this->currentUserId;

        // 2. Ambil data dari formulir
        $fullName = $_POST['user-fullname'] ?? '';
        $linkedinUrl = $_POST['linkedin-url'] ?? '';
        $category = $_POST['category'] ?? '';
        $cvFile = $_FILES['cv'] ?? null;
        $cvPath = '';

        // 3. Siapkan nama file menggunakan username dari sesi
        $userNameForFile = 'unknown_user';
        if ($this->currentUserName !== 'Guest') {
            $userNameForFile = strtolower($this->currentUserName);
            $userNameForFile = preg_replace('/[^a-z0-9_-]+/', '-', $userNameForFile);
            $userNameForFile = trim($userNameForFile, '-');
        }

        // 4. Proses unggahan file CV
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

        // 5. Perbarui database melalui Model
        $userModel = $this->loadModel('UserModel');
        $success = $userModel->updateSpeakerApplication(
            $userId, 
            $fullName, 
            $linkedinUrl, 
            $cvPath, 
            $category
        );

        // 6. Arahkan pengguna dengan URL yang sudah diperbarui
        if ($success) {
            // Arahkan ke halaman utama GrowTogether
            header('Location: ?c=GrowTogether&m=grow&status=speaker_signup_success');
        } else {
            // Arahkan kembali ke formulir pendaftaran speaker (di-handle oleh GrowTogether controller)
            header('Location: ?c=GrowTogether&m=signUp&error=speaker_apply_failed'); 
        }
        exit();
    }
}
?>