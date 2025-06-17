USE `growlink_db`;

CREATE TABLE `users` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `user_name` VARCHAR(255) NOT NULL UNIQUE,
    `password` VARCHAR(255) NOT NULL,
    `role` ENUM('user', 'speaker') NOT NULL DEFAULT 'user',
    `full_name` VARCHAR(255) NULL,
    `linkedin_url` VARCHAR(255) NULL,
    `cv_path` VARCHAR(255) NULL,
    `speaker_category` VARCHAR(100) NULL,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE `events` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `user_id` INT NOT NULL,
    `title` VARCHAR(255) NOT NULL,
    `topic` VARCHAR(100) DEFAULT 'General',
    `description` TEXT,
    `image_url` VARCHAR(255),
    `key_summary_path` VARCHAR(255) NULL,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE CASCADE
);

CREATE TABLE `event_registrations` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `user_id` INT NOT NULL,
    `event_id` INT NOT NULL,
    `registered_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE CASCADE,
    FOREIGN KEY (`event_id`) REFERENCES `events`(`id`) ON DELETE CASCADE,
    UNIQUE KEY `user_event_unique` (`user_id`, `event_id`)
);

CREATE TABLE `growhub` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `title` VARCHAR(255) NOT NULL,
    `category` VARCHAR(100), 
    `file_path` VARCHAR(255),
    `user_id` INT,
    FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE SET NULL -- <<< DITAMBAHKAN
);

CREATE TABLE `growforum` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `user_id` INT NOT NULL, 
    `content` TEXT NOT NULL,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE CASCADE
);

INSERT INTO `users` (`id`, `user_name`, `password`, `role`) VALUES
(1, 'Joe', '$2y$10$9OKi06A92l7jR.0iY1sZ2.p.q1Sg2l7F/b6x3w9C4jHk.U8d0e.5G', 'speaker'), -- password: Joe123
(2, 'Erza', '$2y$10$w1B2q.g5H8d7j/kL0m.nOpQrStUvWx.Y3z4A5s6B7c8D9e0F1gHjI', 'user'), -- password: Erza123
(3, 'Alice', '$2y$10$E.V2i1nF8k3lL4mN5o6p7q.r8S9t0u1V2w3x4Y5z6a7b8c9d0E1fG', 'speaker'), -- password: Alice123
(4, 'Bob', '$2y$10$I.J2k3l4mN5o6p7q.r8S9t0u1V2w3x4Y5z6a7b8c9d0E1fG2h3i4J', 'speaker'); -- password: Bob123

INSERT INTO `events` (`id`, `user_id`, `title`, `topic`, `description`, `image_url`) VALUES
(1, 3, 'Introduction to Docker', 'Technology', 'A beginner-friendly session on Docker by Alice.', 'uploads/images/mockup-poster-1.jpg'),       -- Created by Alice (speaker)
(2, 4, 'Advanced CSS Grid Techniques', 'Web Design', 'A deep dive into modern CSS for creating complex layouts.', 'uploads/images/mockup-poster-3.jpg'), -- Created by Alice (speaker)
(3, 4, 'Public Speaking Masterclass', 'Personal Development', 'Improve your confidence on stage.', 'uploads/images/mockup-poster-2.jpg'),
(4, 4, 'Effective Team Collaboration', 'Business', 'Learn how to work better in teams.', 'uploads/images/mockup-poster-1.jpg'),
(5, 3, 'AI in Everyday Life', 'Technology', 'Exploring the impact of AI on daily tasks.', 'uploads/images/mockup-poster-2.jpg'),
(6, 3, 'Building Resilient Systems', 'Technology', 'Strategies for creating robust systems.', 'uploads/images/mockup-poster-3.jpg');


INSERT INTO `event_registrations` (`user_id`, `event_id`) VALUES
(2, 6);

CREATE TABLE `comments` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `event_id` INT NOT NULL,
    `user_id` INT NOT NULL,
    `comment_text` TEXT NOT NULL,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (`event_id`) REFERENCES `events`(`id`) ON DELETE CASCADE,
    FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE CASCADE
);

INSERT INTO `comments` (`event_id`, `user_id`, `comment_text`) VALUES
(1, 2, 'This Docker session looks interesting! Can beginners really follow along?'), 
(1, 3, 'Absolutely, Joe! It is designed for beginners. Hope to see you there!'),     
(3, 1, 'I learned a lot from this masterclass!'),
(4, 2, 'Collaboration is key in any business! Looking forward to this event.'),
(2, 1, 'Great marketing tips!'); 

CREATE TABLE `event_reviews` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `event_id` INT NOT NULL,
    `user_id` INT NOT NULL,
    `rating` TINYINT NOT NULL,  -- Rating from 1 to 5
    `review_text` TEXT NULL, 
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (`event_id`) REFERENCES `events`(`id`) ON DELETE CASCADE,
    FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE CASCADE,
    UNIQUE KEY `user_event_review_unique` (`user_id`, `event_id`) 
);

INSERT INTO `event_reviews` (`event_id`, `user_id`, `rating`, `review_text`) VALUES
(1, 3, 5, 'Amazing Docker session! Very clear for beginners.'), 
(1, 1, 4, 'Good overview, looking forward to more advanced topics!'),
(3, 3, 4, 'Great public speaking tips, really helped my confidence.'),
(4, 4, 5, 'Excellent collaboration strategies, very practical!'),
(2, 1, 3, 'Interesting CSS techniques, but could use more examples.');