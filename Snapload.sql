CREATE TABLE `users` (
  `id` integer PRIMARY KEY AUTO_INCREMENT,
  `username` varchar(255),
  `passwd_hash` varchar(255),
  `avatar_guid` varchar(255),
  `email` varchar(255),
  `role` varchar(255)
);

CREATE TABLE `posts` (
  `id` integer PRIMARY KEY AUTO_INCREMENT,
  `user_id` integer,
  `guid` integer,
  `mini_guid` integer,
  `posted_date` datetime,
  `description` longtext
);

CREATE TABLE `comments` (
  `id` integer PRIMARY KEY AUTO_INCREMENT,
  `user_id` integer,
  `post_id` integer,
  `posted_date` datetime,
  `message` varchar(255)
);

ALTER TABLE `posts` ADD FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

ALTER TABLE `comments` ADD FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

ALTER TABLE `comments` ADD FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`);
