<?php

class ThreadModel extends Model {

    /**
     * Mengambil semua thread, digabungkan dengan nama penulisnya dari tabel users.
     */
    public function getAll() {
        // Query ini melakukan JOIN untuk mendapatkan nama penulis (user_name)
        $sql = "SELECT gf.*, u.user_name AS author 
                FROM growforum gf 
                JOIN users u ON gf.user_id = u.id 
                ORDER BY gf.created_at DESC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    /**
     * Mengambil detail satu thread berdasarkan ID, termasuk nama penulis.
     * Direvisi untuk menggunakan prepared statement dan JOIN.
     */
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

    /**
     * Menyimpan thread baru ke database berdasarkan user ID.
     * Direvisi untuk menerima userId, bukan nama author.
     */
    public function insert($userId, $content) {
        $sql = "INSERT INTO growforum (user_id, content) VALUES (?, ?)";
        $stmt = $this->db->prepare($sql);
        // Tipe data 'is' -> integer, string
        $stmt->bind_param("is", $userId, $content);
        return $stmt->execute();
    }

    /**
     * Menghapus thread berdasarkan ID, dengan validasi pemilik.
     * Direvisi total untuk keamanan.
     * @param int $id ID thread yang akan dihapus.
     * @param int $userId ID pengguna yang mencoba menghapus.
     */
    public function delete($id, $userId) {
        $sql = "DELETE FROM growforum WHERE id = ? AND user_id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("ii", $id, $userId);
        return $stmt->execute();
    }
}
?>