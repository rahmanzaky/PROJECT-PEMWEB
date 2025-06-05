<?php

class EventModel extends Model {
    function getAllEvents() {
    $sql = "SELECT 
                events.*, 
                users.user_name
            FROM events 
            JOIN users ON events.user_id = users.id 
            ORDER BY events.created_at DESC";
            
    $result = $this->db->query($sql);
    return $result->fetch_all(MYSQLI_ASSOC); 
}

    public function searchEvents($query) {
        $sql = "SELECT * FROM events WHERE title LIKE ? OR description LIKE ?";
        $stmt = $this->db->prepare($sql);

        $searchTerm = '%' . $query . '%';
        $stmt->bind_param('ss', $searchTerm, $searchTerm);

        $stmt->execute();
        
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getEventsByUserName($username) {
        $sql = "SELECT * FROM events WHERE user_name = ? ORDER BY created_at DESC";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param('s', $username);
        $stmt->execute();
        
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function registerUserForEvent($userId, $eventId) {
        $checkSql = "SELECT id FROM event_registrations WHERE user_id = ? AND event_id = ?";
        $checkStmt = $this->db->prepare($checkSql);
        $checkStmt->bind_param('ii', $userId, $eventId);
        $checkStmt->execute();
        $result = $checkStmt->get_result();

        if ($result->num_rows > 0) {
            return false;
        }

        $sql = "INSERT INTO event_registrations (user_id, event_id) VALUES (?, ?)";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param('ii', $userId, $eventId);
        
        return $stmt->execute();
    }

    public function getRegisteredEventsForUser($userId) {
        $sql = "SELECT 
                    events.*,
                    users.user_name
                FROM event_registrations
                JOIN events ON event_registrations.event_id = events.id
                JOIN users ON events.user_id = users.id -- Join to get the event creator's name
                WHERE event_registrations.user_id = ?
                ORDER BY events.created_at DESC";
        
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param('i', $userId);
        $stmt->execute();
        
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function createEvent($userId, $title, $topic, $description, $imageUrl, $keySumPath) {
        $sql = "INSERT INTO events (user_id, title, topic, description, image_url, key_summary_path) 
                VALUES (?, ?, ?, ?, ?, ?)";
                
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param('isssss', $userId, $title, $topic, $description, $imageUrl, $keySumPath);
        
        return $stmt->execute();
    }

        /**
     * @param int 
     * @return array
     */
    public function getRegisteredEventIdsForUser($userId) {
        $sql = "SELECT event_id FROM event_registrations WHERE user_id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param('i', $userId);
        $stmt->execute();
        
        $result = $stmt->get_result();
        $rows = $result->fetch_all(MYSQLI_ASSOC);
        

        return array_column($rows, 'event_id');
    }

}
