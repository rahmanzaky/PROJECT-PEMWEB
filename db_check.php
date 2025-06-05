<?php

$hostname = 'db';          
$username = 'growlink_user';
$password = 'root';        
$dbname = 'growlink_db';   
$port = 3306;              

$conn = new mysqli($hostname, $username, $password, $dbname, $port);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
} else {
    echo "Koneksi berhasil ke database GrowLink!";

    $sql = "SELECT id, username, password FROM users";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<br><br>Users Table Data:<br>";
        echo "<table border='1' cellpadding='5' cellspacing='0'>";
        echo "<tr><th>ID</th><th>Username</th><th>Hashed Password</th></tr>";
        while($row = $result->fetch_assoc()) {
            echo "<tr><td>" . htmlspecialchars($row["id"]). "</td><td>" . htmlspecialchars($row["username"]). "</td><td>" . htmlspecialchars($row["password"]). "</td></tr>";
        }
        echo "</table>";
    } else {
        echo "<br>0 results in users table.";
    }

    $conn->close();
}

?>
