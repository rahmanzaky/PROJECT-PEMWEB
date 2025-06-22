<?php

class Model {
    protected $db;

    public function __construct() {
        $hostname = getenv('DB_HOST') ?? 'db'; // 'db' adalah nama service di docker-compose
        $username = getenv('DB_USER') ?? 'root';
        $password = getenv('DB_PASSWORD') ?? '';
        $dbname   = getenv('DB_NAME') ?? 'growlink_db';

        $this->db = new mysqli($hostname, $username, $password, $dbname);
        
        if ($this->db->connect_error) {
            die('Database connection failed: ' . $this->db->connect_error);
        }
        
        $this->db->set_charset("utf8mb4");
    }
}
?>