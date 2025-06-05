<?php

class Model {
    protected $db;

    function __construct() {
        $hostname = getenv('DB_HOST');
        $username = getenv('DB_USER');
        $password = getenv('DB_PASSWORD');
        $dbname = getenv('DB_NAME');

        $this->db = new mysqli($hostname, $username, $password, $dbname);
        
        if ($this->db->connect_error) {
            die('Database connection failed: ' . $this->db->connect_error);
        }
    }
}