<?php

class ThreadModel extends Model {

    public function getAll() {
        $sql = "SELECT gf.*, u.user_name AS author 
                FROM growforum gf 
                JOIN users u ON gf.user_id = u.id 
                ORDER BY gf.created_at DESC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getById($id) {
        $sql = "SELECT gf.*, u.user_name AS author 
                FROM growforum gf 
                JOIN users u ON gf.user_id = u.id 
                WHERE gf.id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    public function insert($userId, $content) {
        $sql = "INSERT INTO growforum (user_id, content) VALUES (?, ?)";
        $stmt = $this->db->prepare($sql);
        // Tipe data 'is' -> integer, string
        $stmt->bind_param("is", $userId, $content);
        return $stmt->execute();
    }

    public function delete($id, $userId) {
        $sql = "DELETE FROM growforum WHERE id = ? AND user_id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("ii", $id, $userId);
        return $stmt->execute();
    }
}
?>