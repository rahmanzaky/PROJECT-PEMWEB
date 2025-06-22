<?php

class UserModel extends Model {

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

    public function verifyUserCredentials($username, $plaintextPassword) {
        $user = $this->getByUsername($username);

        if ($user) {
            if (password_verify($plaintextPassword, $user['password'])) {
                unset($user['password']);
                return $user;
            }
        }

        return false;
    }
    
    public function getUserById($userId) {
        $sql = "SELECT * FROM users WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param('i', $userId);
        $stmt->execute();
        
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    public function getByUsername($user_name) {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE user_name = ?");
        $stmt->bind_param("s", $user_name);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

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