<?php

class UserModel extends Model {

    public function createUser($username, $plaintextPassword) {
        // ... (existing code for creating a user)
        $hashedPassword = password_hash($plaintextPassword, PASSWORD_DEFAULT);

        $sql = "INSERT INTO users (user_name, password) VALUES (?, ?)";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param('ss', $username, $hashedPassword);
        
        return $stmt->execute();
    }

    public function verifyUser($username, $plaintextPassword) {
        $sql = "SELECT password FROM users WHERE user_name = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param('s', 's', $username);
        $stmt->execute();
        
        $result = $stmt->get_result();
        
        if ($result->num_rows === 0) {
            return false;
        }

        $user = $result->fetch_assoc();
        $storedHash = $user['password'];

        return password_verify($plaintextPassword, $storedHash);
    }
    
    public function getUserById($userId) {
        $sql = "SELECT * FROM users WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param('i', $userId);
        $stmt->execute();
        
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    public function updateSpeakerApplication($userId, $linkedinUrl, $cvPath, $category) {
        $sql = "UPDATE users 
                SET 
                    role = 'speaker', 
                    linkedin_url = ?, 
                    cv_path = ?, 
                    speaker_category = ? 
                WHERE id = ?";
                
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param('sssi', $linkedinUrl, $cvPath, $category, $userId);
        return $stmt->execute();
    }

} 