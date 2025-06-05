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
        $sql = "SELECT 
                    events.*, 
                    users.user_name 
                FROM events 
                JOIN users ON events.user_id = users.id 
                WHERE events.title LIKE ? OR events.description LIKE ? OR users.user_name LIKE ? OR events.topic LIKE ?
                ORDER BY events.created_at DESC";
        
        $stmt = $this->db->prepare($sql);
        $searchTerm = '%' . $query . '%';
        $stmt->bind_param('ssss', $searchTerm, $searchTerm, $searchTerm, $searchTerm);
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
                JOIN users ON events.user_id = users.id 
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

    public function getRegisteredEventIdsForUser($userId) {
        $sql = "SELECT event_id FROM event_registrations WHERE user_id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param('i', $userId);
        $stmt->execute();
        
        $result = $stmt->get_result();
        $rows = $result->fetch_all(MYSQLI_ASSOC);
        

        return array_column($rows, 'event_id');
    }

    public function getEventById($eventId) {
        $sql = "SELECT 
                    events.*, 
                    users.user_name
                FROM events 
                JOIN users ON events.user_id = users.id 
                WHERE events.id = ? 
                LIMIT 1";
                
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param('i', $eventId);
        $stmt->execute();
        
        $result = $stmt->get_result();
        if ($result->num_rows === 1) {
            return $result->fetch_assoc();
        }
        return null;
    }

    public function getCommentsByEventId($eventId) {
        $sql = "SELECT 
                    comments.*, 
                    users.user_name 
                FROM comments 
                JOIN users ON comments.user_id = users.id 
                WHERE comments.event_id = ? 
                ORDER BY comments.created_at ASC"; // Nunjukkin komen urut waktu buat
            
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param('i', $eventId);
        $stmt->execute();
        
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function addComment($eventId, $userId, $commentText) {
        $sql = "INSERT INTO comments (event_id, user_id, comment_text) VALUES (?, ?, ?)";
        $stmt = $this->db->prepare($sql);
        // 'iis' itu untuk integer, integer, dan string
        $stmt->bind_param('iis', $eventId, $userId, $commentText);
        
        return $stmt->execute();
    }

     public function addReview($eventId, $userId, $rating, $reviewText) {
        if ($this->hasUserReviewedEvent($userId, $eventId)) {
            return false; 
        }

        $sql = "INSERT INTO event_reviews (event_id, user_id, rating, review_text) VALUES (?, ?, ?, ?)";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param('iiis', $eventId, $userId, $rating, $reviewText);
        return $stmt->execute();
    }

    public function hasUserReviewedEvent($userId, $eventId) {
        $sql = "SELECT id FROM event_reviews WHERE user_id = ? AND event_id = ? LIMIT 1";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param('ii', $userId, $eventId);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->num_rows > 0;
    }

    public function getEventsNeedingReview($userId) {
        $sql = "SELECT e.*, u.user_name 
                FROM event_registrations er
                JOIN events e ON er.event_id = e.id
                JOIN users u ON e.user_id = u.id
                LEFT JOIN event_reviews rev ON er.event_id = rev.event_id AND er.user_id = rev.user_id
                WHERE er.user_id = ? AND rev.id IS NULL
                ORDER BY e.created_at DESC";
        
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param('i', $userId);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getReviewsByEventId($eventId) {
        $sql = "SELECT 
                    event_reviews.*, 
                    users.user_name 
                FROM event_reviews 
                JOIN users ON event_reviews.user_id = users.id 
                WHERE event_reviews.event_id = ? 
                ORDER BY event_reviews.created_at DESC"; 
            
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param('i', $eventId);
        $stmt->execute();
        
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }


}
