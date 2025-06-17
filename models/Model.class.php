<?php

class Model {
    protected $db;

    public function __construct() {
        // Menggunakan null coalescing operator (??) untuk nilai fallback
        $hostname = getenv('DB_HOST') ?? 'db'; // 'db' adalah nama service di docker-compose
        $username = getenv('DB_USER') ?? 'root';
        $password = getenv('DB_PASSWORD') ?? '';
        $dbname   = getenv('DB_NAME') ?? 'growlink_db';

        // Membuat koneksi baru
        $this->db = new mysqli($hostname, $username, $password, $dbname);
        
        // Memeriksa error koneksi
        if ($this->db->connect_error) {
            die('Database connection failed: ' . $this->db->connect_error);
        }

        // Menetapkan set karakter koneksi (Sangat direkomendasikan)
        $this->db->set_charset("utf8mb4");
    }
}
?>