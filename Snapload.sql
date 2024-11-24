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
  `name` varchar(255)
);

CREATE TABLE `likes_rel` (
  `id` integer PRIMARY KEY AUTO_INCREMENT,
  `user_id` integer,
  `offer_id` integer
);

ALTER TABLE `posts` ADD FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

ALTER TABLE `likes_rel` ADD FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

ALTER TABLE `likes_rel` ADD FOREIGN KEY (`offer_id`) REFERENCES `posts` (`id`);
