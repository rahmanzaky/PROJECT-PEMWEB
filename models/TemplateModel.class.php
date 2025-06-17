<?php

class TemplateModel extends Model {

    /**
     * Menyimpan data template baru ke database.
     * Metode ini sudah aman menggunakan prepared statement. Tidak ada perubahan.
     */
    public function insert($title, $category, $filePath, $userId) {
        $stmt = $this->db->prepare("INSERT INTO growhub (title, category, file_path, user_id) VALUES (?, ?, ?, ?)");
        // Tipe data 'sssi' -> string, string, string, integer
        $stmt->bind_param("sssi", $title, $category, $filePath, $userId);
        return $stmt->execute();
    }

    /**
     * Mengambil semua template, digabungkan dengan nama pengunggahnya.
     * Direvisi untuk konsistensi dan fungsionalitas.
     */
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

    /**
     * Mengambil semua template milik pengguna tertentu.
     * Direvisi untuk menggunakan prepared statement (keamanan).
     */
    public function getTemplatesByUser($userId) {
        $sql = "SELECT * FROM growhub WHERE user_id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    /**
     * Mengambil detail satu template berdasarkan ID, termasuk nama pengunggah.
     * Direvisi untuk menggunakan prepared statement (keamanan) dan JOIN.
     */
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

    /**
     * Menghapus template berdasarkan ID, dengan validasi pemilik.
     * Direvisi total untuk keamanan.
     * @param int $id ID template yang akan dihapus.
     * @param int $userId ID pengguna yang mencoba menghapus (untuk verifikasi kepemilikan).
     */
    public function delete($id, $userId) {
        $sql = "DELETE FROM growhub WHERE id = ? AND user_id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("ii", $id, $userId);
        return $stmt->execute();
    }
}
?>