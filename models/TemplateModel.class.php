<?php

class TemplateModel extends Model {

    public function insert($title, $category, $filePath, $userId) {
        $stmt = $this->db->prepare("INSERT INTO growhub (title, category, file_path, user_id) VALUES (?, ?, ?, ?)");
        // Tipe data 'sssi' -> string, string, string, integer
        $stmt->bind_param("sssi", $title, $category, $filePath, $userId);
        return $stmt->execute();
    }

    public function getAllTemplates() {
        $sql = "SELECT gh.*, u.user_name 
                FROM growhub gh 
                JOIN users u ON gh.user_id = u.id 
                ORDER BY gh.id DESC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getTemplatesByUser($userId) {
        $sql = "SELECT * FROM growhub WHERE user_id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getTemplateById($id) {
        $sql = "SELECT gh.*, u.user_name 
                FROM growhub gh 
                JOIN users u ON gh.user_id = u.id 
                WHERE gh.id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    public function delete($id, $userId) {
        $sql = "DELETE FROM growhub WHERE id = ? AND user_id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("ii", $id, $userId);
        return $stmt->execute();
    }
}
?>