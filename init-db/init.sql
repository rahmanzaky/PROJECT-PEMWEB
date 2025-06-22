USE `growlink_db`;

CREATE TABLE `users` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `user_name` VARCHAR(255) NOT NULL UNIQUE,
    `password` VARCHAR(255) NOT NULL,
    `role` ENUM('user', 'speaker') NOT NULL DEFAULT 'user',
    `full_name` VARCHAR(255) NULL,
    `email` VARCHAR(255) NULL UNIQUE,
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
    `image_url` VARCHAR(255) NULL,
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

CREATE TABLE `comments` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `event_id` INT NOT NULL,
    `user_id` INT NOT NULL,
    `comment_text` TEXT NOT NULL,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (`event_id`) REFERENCES `events`(`id`) ON DELETE CASCADE,
    FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE CASCADE
);

CREATE TABLE `event_reviews` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `event_id` INT NOT NULL,
    `user_id` INT NOT NULL,
    `rating` TINYINT NOT NULL,
    `review_text` TEXT NULL,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (`event_id`) REFERENCES `events`(`id`) ON DELETE CASCADE,
    FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE CASCADE,
    UNIQUE KEY `user_event_review_unique` (`user_id`, `event_id`)
);

CREATE TABLE `growhub` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `title` VARCHAR(255) NOT NULL,
    `category` VARCHAR(100),
    `file_path` VARCHAR(255),
    `user_id` INT,
    FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE SET NULL
);

CREATE TABLE `growforum` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `user_id` INT NOT NULL, 
    `content` TEXT NOT NULL,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE CASCADE
);

INSERT INTO `users` (`id`, `user_name`, `password`, `role`) VALUES
(1, 'Joe', '$2y$10$9OKi06A92l7jR.0iY1sZ2.p.q1Sg2l7F/b6x3w9C4jHk.U8d0e.5G', 'speaker'),
(2, 'Erza', '$2y$10$w1B2q.g5H8d7j/kL0m.nOpQrStUvWx.Y3z4A5s6B7c8D9e0F1gHjI', 'user'),
(3, 'Alice', '$2y$10$E.V2i1nF8k3lL4mN5o6p7q.r8S9t0u1V2w3x4Y5z6a7b8c9d0E1fG', 'speaker'),
(4, 'Bob', '$2y$10$I.J2k3l4mN5o6p7q.r8S9t0u1V2w3x4Y5z6a7b8c9d0E1fG2h3i4J', 'speaker');

INSERT INTO `events` (`id`, `user_id`, `title`, `topic`, `description`, `image_url`, `key_summary_path`, `created_at`) VALUES
(1, 3, 'Introduction to Docker', 'Technology', 'A beginner-friendly session on Docker by Alice.', 'uploads/images/mockup-poster-1.jpg', 'uploads/pdfs/keysum_2_erza_20250605103236_6841724407c08.pdf', '2025-05-21 15:30:00'),
(2, 4, 'Advanced CSS Grid Techniques', 'Web Design', 'A deep dive into modern CSS for creating complex layouts.', 'uploads/images/mockup-poster-3.jpg', 'uploads/pdfs/keysum_2_erza_20250605141657_6841a6d9379b8.pdf', '2025-05-22 11:00:00'),
(3, 4, 'Public Speaking Masterclass', 'Personal Development', 'Improve your confidence on stage.', 'uploads/images/mockup-poster-2.jpg', NULL, '2025-05-22 14:00:00'),
(4, 4, 'Effective Team Collaboration', 'Business', 'Learn how to work better in teams.', 'uploads/images/mockup-poster-1.jpg', NULL, '2025-06-15 10:00:00'),
(5, 3, 'AI in Everyday Life', 'Technology', 'Exploring the impact of AI on daily tasks.', 'uploads/images/mockup-poster-2.jpg', NULL, '2025-06-18 14:00:00'),
(6, 3, 'Building Resilient Systems', 'Technology', 'Strategies for creating robust systems.', 'uploads/images/mockup-poster-3.jpg', NULL, '2025-06-19 10:00:00');

INSERT INTO `event_registrations` (`user_id`, `event_id`) VALUES (2, 6);

INSERT INTO `comments` (`event_id`, `user_id`, `comment_text`) VALUES
(1, 2, 'This Docker session looks interesting! Can beginners really follow along?'), 
(1, 3, 'Absolutely! It is designed for beginners. Hope to see you there!');

INSERT INTO `event_reviews` (`event_id`, `user_id`, `rating`, `review_text`) VALUES
(1, 2, 5, 'Amazing Docker session! Very clear for beginners.');

INSERT INTO `growhub` (title, category, file_path, user_id) VALUES
('Contoh Proposal', 'Business', 'uploads/templates/proposal1.png', 1), 
('Template Sertif', 'Career', 'uploads/templates/sertif.png', 3),
('Undangan Kegiatan', 'Project Management', 'uploads/templates/undangan.png', 4);

INSERT INTO `growforum` (user_id, content) VALUES
(2, 'Halo semua, ini thread pertama saya di GrowForum!'),
(3, 'Selamat datang di GrowForum! Saya senang bisa berbagi pengetahuan di sini.'),
(4, 'Apa topik yang paling kalian minati untuk dibahas di forum ini?');

INSERT INTO `templates` (`id`, `user_id`, `template_name`, `category`, `description`, `file_path`, `thumbnail_path`, `created_at`) VALUES
(1, 1, 'Modern Business Proposal', 'Business', 'A sleek and professional proposal template for business pitches.', 'uploads/templates/proposal1.png', 'uploads/templates/proposal1.png', '2025-05-20 10:00:00'),
(2, 2, 'Creative Design Portfolio', 'Design', 'A vibrant and creative template to showcase your design portfolio.', 'uploads/templates/sertif.png', 'uploads/templates/sertif.png', '2025-05-21 11:30:00'),
(3, 3, 'Academic Research Poster', 'Education', 'A template for presenting academic research findings at conferences.', 'uploads/templates/lpj.png', 'uploads/templates/lpj.png', '2025-05-22 13:00:00'),
(4, 1, 'Event Invitation', 'Events', 'An elegant invitation template for corporate or personal events.', 'uploads/templates/undangan.png', 'uploads/templates/undangan.png', '2025-06-12 09:00:00');

COMMIT;