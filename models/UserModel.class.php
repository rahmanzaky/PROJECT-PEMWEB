<?php

class UserModel extends Model {

    /**
     * Membuat pengguna baru dengan password yang sudah di-hash.
     * Metode ini sudah sempurna, tidak ada perubahan.
     */
    public function createUser($username, $hashedPassword, $fullName, $email) {
        $sql = "INSERT INTO users (user_name, password, full_name, email, role) VALUES (?, ?, ?, ?, 'user')";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param('ssss', $username, $hashedPassword, $fullName, $email);
        
        if ($stmt->execute()) {
            return $this->db->insert_id; 
        } else {
            return false;
        }
    }

    /**
     * Memverifikasi kredensial pengguna. Jika berhasil, kembalikan data pengguna.
     * Ini adalah versi perbaikan dan penyempurnaan dari 'verifyUser'.
     * @return array|false Data pengguna jika berhasil, false jika gagal.
     */
    public function verifyUserCredentials($username, $plaintextPassword) {
        // Menggunakan getByUsername untuk mengambil data pengguna, termasuk hash password.
        $user = $this->getByUsername($username);

        if ($user) {
            // Jika pengguna ditemukan, verifikasi password yang dikirim dengan hash yang ada di DB.
            if (password_verify($plaintextPassword, $user['password'])) {
                // Jika cocok, kembalikan data pengguna (tanpa password hash).
                unset($user['password']);
                return $user;
            }
        }

        // Jika pengguna tidak ditemukan atau password salah, kembalikan false.
        return false;
    }
    
    /**
     * Mengambil semua data pengguna berdasarkan ID.
     * Metode ini sudah sempurna, tidak ada perubahan.
     */
    public function getUserById($userId) {
        $sql = "SELECT * FROM users WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param('i', $userId);
        $stmt->execute();
        
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    /**
     * Mengambil semua data pengguna berdasarkan username.
     * Metode ini sudah bagus, tidak ada perubahan.
     */
    public function getByUsername($user_name) {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE user_name = ?");
        $stmt->bind_param("s", $user_name);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    /**
     * Memperbarui data pengguna setelah mendaftar sebagai pemateri.
     * Direvisi untuk menyertakan `full_name`.
     */
    public function updateSpeakerApplication($userId, $fullName, $linkedinUrl, $cvPath, $category) {
        $sql = "UPDATE users 
                SET 
                    role = 'speaker', 
                    full_name = ?, 
                    linkedin_url = ?, 
                    cv_path = ?, 
                    speaker_category = ? 
                WHERE id = ?";
                
        $stmt = $this->db->prepare($sql);
        // Tipe data 'ssssi' -> string, string, string, string, integer
        $stmt->bind_param('ssssi', $fullName, $linkedinUrl, $cvPath, $category, $userId);
        return $stmt->execute();
    }
    
}
?>