-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 28 Bulan Mei 2023 pada 10.27
-- Versi server: 10.4.24-MariaDB
-- Versi PHP: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `elearn`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `assignments`
--

CREATE TABLE `assignments` (
  `assignment_id` int(11) NOT NULL,
  `assignment_name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `deadline` datetime DEFAULT NULL,
  `course_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `assignments`
--

INSERT INTO `assignments` (`assignment_id`, `assignment_name`, `description`, `deadline`, `course_id`, `created_at`, `updated_at`) VALUES
(1, 'Coba Tugas', 'awkdadm', '2023-06-01 09:00:00', 1, '2023-05-25 08:39:34', '2023-05-28 08:18:16'),
(2, 'hahah', 'awdad', '2023-05-31 12:03:00', 1, '2023-05-25 16:43:11', '2023-05-25 17:06:18'),
(3, 'Laprak 4', 'Kerjakan Laprak 4 Percobaan 1-4 ', '2023-06-08 23:59:00', 1, '2023-05-25 17:12:22', '2023-05-25 17:12:22');

-- --------------------------------------------------------

--
-- Struktur dari tabel `courses`
--

CREATE TABLE `courses` (
  `course_id` int(11) NOT NULL,
  `course_name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `instructor_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `courses`
--

INSERT INTO `courses` (`course_id`, `course_name`, `description`, `instructor_id`, `created_at`, `updated_at`) VALUES
(1, 'ASD', 'ASD', 2, '2023-05-25 08:37:59', '2023-05-25 08:37:59');

-- --------------------------------------------------------

--
-- Struktur dari tabel `enrollments`
--

CREATE TABLE `enrollments` (
  `enrollment_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `enrollments`
--

INSERT INTO `enrollments` (`enrollment_id`, `user_id`, `course_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '2023-05-25 08:38:41', '2023-05-25 08:38:41'),
(2, 4, 1, '2023-05-28 07:54:11', '2023-05-28 07:54:11'),
(3, 5, 1, '2023-05-28 07:54:20', '2023-05-28 07:54:20');

-- --------------------------------------------------------

--
-- Struktur dari tabel `lessons`
--

CREATE TABLE `lessons` (
  `lesson_id` int(11) NOT NULL,
  `lesson_name` varchar(255) NOT NULL,
  `content` text DEFAULT NULL,
  `attachment` varchar(255) DEFAULT NULL,
  `course_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `lessons`
--

INSERT INTO `lessons` (`lesson_id`, `lesson_name`, `content`, `attachment`, `course_id`, `created_at`, `updated_at`) VALUES
(5, 'adwadadawd', 'aawdad', '64730196e865a.pdf', 1, '2023-05-28 07:20:22', '2023-05-28 07:24:06');

-- --------------------------------------------------------

--
-- Struktur dari tabel `roles`
--

CREATE TABLE `roles` (
  `role_id` int(11) NOT NULL,
  `role_name` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `roles`
--

INSERT INTO `roles` (`role_id`, `role_name`, `created_at`, `updated_at`) VALUES
(1, 'dosen', '2023-05-13 13:38:10', '2023-05-13 13:38:10'),
(2, 'mahasiswa', '2023-05-13 13:38:20', '2023-05-13 13:38:20'),
(3, 'administrator', '2023-05-13 13:38:28', '2023-05-13 13:38:28');

-- --------------------------------------------------------

--
-- Struktur dari tabel `submissions`
--

CREATE TABLE `submissions` (
  `submission_id` int(11) NOT NULL,
  `assignment_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `submission_time` datetime DEFAULT NULL,
  `content` text DEFAULT NULL,
  `file` varchar(255) DEFAULT NULL,
  `nilai` float DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `submissions`
--

INSERT INTO `submissions` (`submission_id`, `assignment_id`, `user_id`, `submission_time`, `content`, `file`, `nilai`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '2023-05-25 22:49:53', 'wadad', '646f83a1e3033.png', 30, '2023-05-25 08:41:04', '2023-05-28 08:14:57'),
(2, 2, 1, '2023-05-25 23:59:00', '-', '646f93d4258c0.png', NULL, '2023-05-25 16:59:00', '2023-05-25 16:59:00'),
(3, 1, 4, '2023-05-28 15:16:17', 'dead', '64730dd1e21d7.pdf', 10, '2023-05-28 08:16:18', '2023-05-28 08:22:04');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `nrp` int(11) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(255) DEFAULT NULL,
  `role_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`user_id`, `nrp`, `name`, `email`, `password`, `remember_token`, `role_id`, `created_at`, `updated_at`) VALUES
(1, 123, 'mhs1', 'mhs1@gmail.com', '$2a$12$MabJZgxjfpmJr.rlvJY2FeBYHbT3TbH12NVJx92fApZqUeBcu39TC', '', 2, '2023-05-13 13:39:27', '2023-05-28 07:25:29'),
(2, NULL, 'dosen1', 'dosen1@gmail.com', '$2a$12$MabJZgxjfpmJr.rlvJY2FeBYHbT3TbH12NVJx92fApZqUeBcu39TC', '', 1, '2023-05-13 13:39:51', '2023-05-13 13:39:51'),
(3, NULL, 'admin', 'admin@gmail.com', '$2a$12$MabJZgxjfpmJr.rlvJY2FeBYHbT3TbH12NVJx92fApZqUeBcu39TC', '', 3, '2023-05-13 13:40:05', '2023-05-13 13:40:05'),
(4, 2, 'mhs2', 'mhs2@gmail.com', '$2y$10$1.QoUREKXzwW0boPm68tOu.2qs.nqdzId/40.5204tk8nC0mWmrnG', NULL, 2, '2023-05-28 07:53:38', '2023-05-28 07:53:38'),
(5, 3, 'mhs3', 'mhs3@gmail.com', '$2y$10$bvmDiURiWP/mjUpVlXiDlesSt.lWjD5Dep7qN6oLRukqgZJkQnXny', NULL, 2, '2023-05-28 07:53:58', '2023-05-28 07:53:58');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `assignments`
--
ALTER TABLE `assignments`
  ADD PRIMARY KEY (`assignment_id`),
  ADD KEY `course_id` (`course_id`);

--
-- Indeks untuk tabel `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`course_id`),
  ADD KEY `instructor_id` (`instructor_id`);

--
-- Indeks untuk tabel `enrollments`
--
ALTER TABLE `enrollments`
  ADD PRIMARY KEY (`enrollment_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `course_id` (`course_id`);

--
-- Indeks untuk tabel `lessons`
--
ALTER TABLE `lessons`
  ADD PRIMARY KEY (`lesson_id`),
  ADD KEY `course_id` (`course_id`);

--
-- Indeks untuk tabel `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`role_id`);

--
-- Indeks untuk tabel `submissions`
--
ALTER TABLE `submissions`
  ADD PRIMARY KEY (`submission_id`),
  ADD KEY `assignment_id` (`assignment_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `nrp` (`nrp`),
  ADD KEY `role_id` (`role_id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `assignments`
--
ALTER TABLE `assignments`
  MODIFY `assignment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `courses`
--
ALTER TABLE `courses`
  MODIFY `course_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `enrollments`
--
ALTER TABLE `enrollments`
  MODIFY `enrollment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `lessons`
--
ALTER TABLE `lessons`
  MODIFY `lesson_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `roles`
--
ALTER TABLE `roles`
  MODIFY `role_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `submissions`
--
ALTER TABLE `submissions`
  MODIFY `submission_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `assignments`
--
ALTER TABLE `assignments`
  ADD CONSTRAINT `assignments_ibfk_1` FOREIGN KEY (`course_id`) REFERENCES `courses` (`course_id`);

--
-- Ketidakleluasaan untuk tabel `courses`
--
ALTER TABLE `courses`
  ADD CONSTRAINT `courses_ibfk_1` FOREIGN KEY (`instructor_id`) REFERENCES `users` (`user_id`);

--
-- Ketidakleluasaan untuk tabel `enrollments`
--
ALTER TABLE `enrollments`
  ADD CONSTRAINT `enrollments_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `enrollments_ibfk_2` FOREIGN KEY (`course_id`) REFERENCES `courses` (`course_id`);

--
-- Ketidakleluasaan untuk tabel `lessons`
--
ALTER TABLE `lessons`
  ADD CONSTRAINT `lessons_ibfk_1` FOREIGN KEY (`course_id`) REFERENCES `courses` (`course_id`);

--
-- Ketidakleluasaan untuk tabel `submissions`
--
ALTER TABLE `submissions`
  ADD CONSTRAINT `submissions_ibfk_1` FOREIGN KEY (`assignment_id`) REFERENCES `assignments` (`assignment_id`),
  ADD CONSTRAINT `submissions_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Ketidakleluasaan untuk tabel `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `roles` (`role_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
