-- +goose Up
-- SQL in section 'Up' is executed when this migration is applied
CREATE TABLE `posts` (
    `id` int(11) NOT NULL,
    `owner_id` int(11) NOT NULL,
    `category` enum(
        'pets',
        'devices',
        'documents',
        'clothes',
        'inventory',
        'preciousness',
        'toys',
        'office',
        'stationery',
        'details'
    ) DEFAULT NULL,
    `title` varchar(255) NOT NULL,
    `description` TEXT NOT NULL,
    `lat` decimal(7, 4) NOT NULL,
    `lng` decimal(7, 4) NOT NULL,
    `status` enum(
        'lost',
        'found', 
        'deactivated', 
        'deleted',
        'disabled'
        ) DEFAULT 'disabled',
    `reward` varchar(255) DEFAULT NULL,
    `created_at` datetime DEFAULT NULL,
    `updated_at` datetime DEFAULT NULL,
    `deleted_at` timestamp NULL DEFAULT NULL,

    INDEX post_id (id),
    INDEX owner_id (owner_id),

    PRIMARY KEY (id)

    ADD CONSTRAINT `FK_posts_owner_id` FOREIGN KEY (`owner_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;
-- +goose Down
-- SQL section 'Down' is executed when this migration is rolled back