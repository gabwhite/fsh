
--
-- Dumping data for table `countries`
--

DELETE FROM countries;

ALTER TABLE countries AUTO_INCREMENT = 1;

INSERT INTO `countries` (`id`, `name`, `active`, `created_at`, `updated_at`) VALUES
(1, 'Canada', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 'USA', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00');

--
-- Dumping data for table `stateprovinces`
--

DELETE FROM stateprovinces;

ALTER TABLE stateprovinces AUTO_INCREMENT = 1;

INSERT INTO `stateprovinces` (`id`, `name`, `country_id`, `active`, `created_at`, `updated_at`) VALUES
(1, 'AB', 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 'BC', 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 'MB', 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(4, 'NB', 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(5, 'NL', 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(6, 'NS', 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(7, 'NT', 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(8, 'NU', 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(9, 'ON', 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(10, 'PE', 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(11, 'QC', 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(12, 'SK', 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(13, 'YT', 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(14, 'AL', 2, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(15, 'AK', 2, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(16, 'AZ', 2, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(17, 'AR', 2, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(18, 'CA', 2, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(19, 'CO', 2, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(20, 'CT', 2, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(21, 'DE', 2, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(22, 'DC', 2, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(23, 'FL', 2, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(24, 'GA', 2, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(25, 'HI', 2, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(26, 'ID', 2, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(27, 'IL', 2, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(28, 'IN', 2, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(29, 'IA', 2, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(30, 'KS', 2, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(31, 'KY', 2, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(32, 'LA', 2, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(33, 'ME', 2, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(34, 'MD', 2, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(35, 'MA', 2, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(36, 'MI', 2, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(37, 'MN', 2, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(38, 'MS', 2, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(39, 'MO', 2, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(40, 'MT', 2, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(41, 'NE', 2, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(42, 'NV', 2, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(43, 'NH', 2, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(44, 'NJ', 2, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(45, 'NM', 2, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(46, 'NY', 2, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(47, 'NC', 2, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(48, 'ND', 2, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(49, 'OH', 2, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(50, 'OK', 2, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(51, 'OR', 2, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(52, 'PA', 2, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(53, 'RI', 2, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(54, 'SC', 2, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(55, 'SD', 2, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(56, 'TN', 2, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(57, 'TX', 2, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(58, 'UT', 2, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(59, 'VT', 2, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(60, 'VA', 2, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(61, 'WA', 2, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(62, 'WV', 2, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(63, 'WI', 2, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(64, 'WY', 2, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00');

--
-- Dumping data for table `users`
--

DELETE FROM users;

ALTER TABLE users AUTO_INCREMENT = 1;


INSERT INTO `users` (`id`, `name`, `email`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin@admin.com', '$2y$10$nxAd89s3fhkDHYY0VGq4N.30wyMRARe1NVDitiWg9GgJkSqTh4g7S', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00');
(2, 'breen', 'breen.young@gmail.com', '$2y$10$YrQRnwAXZWLwP1TbsRDnquV9t2.RjcMN7MblNcEvv.57Zx79XurRG', 'HXEJI0vqtgPi1FvN0nsLFDkkWH2G7XxR3UTwzRQk1OPFdopwLFvHFC6iE5No', '2015-10-31 17:37:11', '2015-11-25 06:45:10'),

--
-- Dumping data for table `roles`
--

DELETE FROM roles;

ALTER TABLE roles AUTO_INCREMENT = 1;

INSERT INTO `roles` (`id`, `name`, `display_name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'admin', NULL, NULL, '2015-10-31 20:22:02', '2015-10-31 20:22:02'),
(2, 'vendor', NULL, NULL, '2015-11-01 07:24:22', '2015-11-01 07:24:22'),
(3, 'user', NULL, NULL, '2015-11-08 23:46:58', '2015-11-08 23:46:58');

--
-- Dumping data for table `permissions`
--

DELETE FROM permissions;

ALTER TABLE permissions AUTO_INCREMENT = 1;

INSERT INTO `permissions` (`id`, `name`, `display_name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'import-products', 'Import Products', 'Use the admin import tool', '2015-10-31 21:00:48', '2015-10-31 21:28:28'),
(2, 'public-view-products', 'View Products (Public)', 'Able to view products on public site', '2015-10-31 21:40:38', '2015-10-31 21:40:38'),
(3, 'delete-own-product', 'Delete Owned Products', 'Able to delete owned products', '2015-11-08 23:46:10', '2015-11-23 06:54:56'),
(4, 'edit-own-product', 'Edit Owned Product', 'Able to edit products you own', '2015-11-23 06:53:33', '2015-11-23 06:54:28'),
(5, 'edit-any-product', 'Edit Any Product', 'Edit any product regardless of owner', '2015-11-23 06:54:04', '2015-11-23 06:54:36'),
(6, 'delete-any-product', 'Delete Any Product', 'Able to delete any product', '2015-11-23 06:55:24', '2015-11-23 06:55:24');

--
-- Dumping data for table `permission_role`
--

DELETE FROM permission_role;

INSERT INTO `permission_role` (`permission_id`, `role_id`) VALUES
(1, 1),
(2, 1),
(5, 1),
(6, 1),
(2, 2),
(3, 2),
(4, 2)
;

--
-- Dumping data for table `role_user`
--

DELETE FROM role_user;

INSERT INTO `role_user` (`user_id`, `role_id`) VALUES
(1, 1);
INSERT INTO `role_user` (`user_id`, `role_id`) VALUES
(2, 1);


--
-- Dumping data for table `allergens`
--

DELETE FROM allergens;

INSERT INTO `allergens` (`id`, `name`, `active`, `created_at`, `updated_at`) VALUES
(1, 'Eggs', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 'Fish', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 'Gluten', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(4, 'Lactose', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(5, 'Milk', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(6, 'Peanuts', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(7, 'Shellfish', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(8, 'Soy', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(9, 'Tree Nuts', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00');

