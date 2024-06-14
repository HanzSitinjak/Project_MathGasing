-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Waktu pembuatan: 14 Jun 2024 pada 09.23
-- Versi server: 8.0.37-cll-lve
-- Versi PHP: 8.1.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mathgasi_MathGasing`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `badge`
--

CREATE TABLE `badge` (
  `id_bagde` int NOT NULL,
  `image` varchar(225) NOT NULL,
  `title` varchar(50) NOT NULL,
  `explanation` text NOT NULL,
  `imageUrl` varchar(100) NOT NULL,
  `id_penggunaWeb` int NOT NULL,
  `id_materi` int NOT NULL,
  `id_posttest` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `badge`
--

INSERT INTO `badge` (`id_bagde`, `image`, `title`, `explanation`, `imageUrl`, `id_penggunaWeb`, `id_materi`, `id_posttest`) VALUES
(7, 'public/images/DZ701T1uNozIymGAKiHOXxcW7jdwu3rSbT1Lmtqz.png', 'Pemula Pengurangan', 'Pengurangan', 'https://mathgasing.cloud/storage/images/DZ701T1uNozIymGAKiHOXxcW7jdwu3rSbT1Lmtqz.png', 1, 1, 9),
(8, 'public/images/LcDfAFzPDiV3R8LqiACsVfLKxDM3ia8uqoSdJrx9.png', 'Penjumlahan yang Hebat', 'Sang Jago Penjumlahan', 'https://mathgasing.cloud/storage/images/LcDfAFzPDiV3R8LqiACsVfLKxDM3ia8uqoSdJrx9.png', 5, 2, 10),
(11, 'public/images/uu1mB3v8aKI9HfMdopT6obaxmX1f8NKojlaCqZTr.png', 'Pembagian Hebat', 'Pembagian', 'https://mathgasing.cloud/storage/images/uu1mB3v8aKI9HfMdopT6obaxmX1f8NKojlaCqZTr.png', 1, 4, 13);

-- --------------------------------------------------------

--
-- Struktur dari tabel `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `lencana_pengguna`
--

CREATE TABLE `lencana_pengguna` (
  `id_LencanaPengguna` int NOT NULL,
  `id_bagde` int NOT NULL,
  `id_user` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `lencana_pengguna`
--

INSERT INTO `lencana_pengguna` (`id_LencanaPengguna`, `id_bagde`, `id_user`) VALUES
(14, 7, 3),
(15, 7, 4),
(16, 8, 6),
(17, 7, 5),
(18, 7, 11),
(19, 11, 11),
(20, 7, 13),
(21, 7, 15);

-- --------------------------------------------------------

--
-- Struktur dari tabel `level`
--

CREATE TABLE `level` (
  `id_level` int NOT NULL,
  `id_materi` int NOT NULL,
  `level_number` int NOT NULL,
  `id_unit` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `level_bonus`
--

CREATE TABLE `level_bonus` (
  `id_level_bonus` int NOT NULL,
  `level_number` int NOT NULL,
  `id_unit_Bonus` int NOT NULL,
  `deskripsi` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `level_bonus`
--

INSERT INTO `level_bonus` (`id_level_bonus`, `level_number`, `id_unit_Bonus`, `deskripsi`) VALUES
(5, 1, 7, 'Berlatih Penjumlahan'),
(7, 1, 9, 'Level Bonus Pengurangan Bonus'),
(8, 1, 10, 'Level Bonus Pembagian 1');

-- --------------------------------------------------------

--
-- Struktur dari tabel `materi`
--

CREATE TABLE `materi` (
  `id_materi` int NOT NULL,
  `id_penggunaWeb` int NOT NULL,
  `title` varchar(225) NOT NULL,
  `imageCard` varchar(225) NOT NULL,
  `imageBackground` varchar(225) NOT NULL,
  `imageCardAdmin` varchar(225) NOT NULL,
  `imageStatistic` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `materi`
--

INSERT INTO `materi` (`id_materi`, `id_penggunaWeb`, `title`, `imageCard`, `imageBackground`, `imageCardAdmin`, `imageStatistic`) VALUES
(1, 1, 'Pengurangan', '/storage/images/dcOfTwn5NqEOFPtXyEx7EqCaOlfXUpnvw5oErap3.png', '/storage/images/zcUcuBIlAIjRh471fIP2Et6PwsnUifLsD974K49I.png', '/storage/images/nMRtA1dFXiphbV2gRpMBqVS4cqxLOvvYjSS2lXoz.png', '/storage/images/cR9gLFe2XicyMGAm5s0piiEAnYnpQThtDP8YNlO3.png'),
(2, 5, 'Penjumlahan', '/storage/images/9B60Md4LZm27uiHFJS755fduDuuYwXd7lrOOjK6r.png', '/storage/images/hj4aWqhL9DSMGnx4AEHjSRte13orWG1m1tsdGzqD.png', '/storage/images/WKILLHAYGZEInebjAYnm17ZkYRJ7fOoOvSrK2IO6.png', '/storage/images/tTXydrEVwpqxudQ5o36wF1NbBnSheVG9doVSzbkK.png'),
(4, 1, 'Pembagian', '/storage/images/btNmGo6oKAsdPWGbyWqNjqukTIDnqnRzbyqaIO7j.png', '/storage/images/xwswwfTQ379Wb5m8rxsqOgfDr9xogffGfaG9gHPA.png', '/storage/images/cwQBobQdmCzejAAmaQhgD51ajGvqZHmCffdXRRbv.png', '/storage/images/jczvekWFdFgICcKs76kXQo6yjqbyWErPMSEFJ9UU.png'),
(11, 1, 'Perkalian', '/storage/images/qpdIstLcvEcPlv47ZAtqjYGVNpGZJorQW15Jbhad.png', '/storage/images/3Qq7r9YL6DPAiQ5pk0Svom5pTzvCtDznL5Tuo3JV.png', '/storage/images/HVLkxke9WqGk9iBvzRzEK8DNYwEFmX2q4nvq1nuz.png', '/storage/images/15nnOKsIlfIxw1a2TgCTzKVuwpTRkS1uSaF1omih.png');

-- --------------------------------------------------------

--
-- Struktur dari tabel `material_video`
--

CREATE TABLE `material_video` (
  `id_material_video` int NOT NULL,
  `video_Url` varchar(225) NOT NULL,
  `title` varchar(225) NOT NULL,
  `explanation` text NOT NULL,
  `id_unit` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `material_video`
--

INSERT INTO `material_video` (`id_material_video`, `video_Url`, `title`, `explanation`, `id_unit`) VALUES
(12, 'https://youtu.be/vVDZvHk6zdc?si=6I8zadkFtk0D413a', 'Materi Pengurangan Dasar 1', 'Pengurangan adalah salah satu operasi aritmatika dasar yang digunakan untuk menghitung selisih antara dua angka. Operasi ini dilambangkan dengan tanda minus (-). Dalam pengurangan, angka pertama disebut minuend dan angka kedua disebut subtrahend. Hasil dari pengurangan disebut selisih atau diferensial.', 11),
(13, 'https://youtu.be/kXdo-lRha4U?si=IzM2057dZe8jwmy3', 'Penjumlahan Banyak Bilangan 1 Digit', 'Video ini membahas cara menghitung penjumlahan banyak bilangan 1 digit dengan metode GASING.', 12),
(15, 'https://www.youtube.com/watch?v=ao6GgbBp8QU&list=RDao6GgbBp8QU&start_radio=1&ab_channel=larissalambert', 'Materi Pembagian 1', 'Ini Pembagian tingkat 1', 15);

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `penggunaweb`
--

CREATE TABLE `penggunaweb` (
  `id_penggunaWeb` int NOT NULL,
  `role_id` enum('1','2') NOT NULL,
  `name` varchar(225) NOT NULL,
  `email` varchar(225) NOT NULL,
  `kontak` varchar(20) NOT NULL,
  `password` varchar(225) NOT NULL,
  `status` enum('active','non-active') NOT NULL,
  `is_approved` enum('1','2') NOT NULL,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `penggunaweb`
--

INSERT INTO `penggunaweb` (`id_penggunaWeb`, `role_id`, `name`, `email`, `kontak`, `password`, `status`, `is_approved`, `updated_at`, `created_at`) VALUES
(1, '2', 'Admin MathPlay Gasing', 'admin@gmail.com', '0893747583827', '$2y$12$1rCRaVoJJeqHArTzqUph3eIv9.h94q/JzE7Nqv6Tq9YW1eaesBaKq', 'active', '1', '2024-06-07 13:31:31', '2024-06-07 13:31:31'),
(2, '1', 'Rini Agustina', 'rini11@gmail.com', '089495869449', '$2y$12$V/QibfuDWmRoADEYP8Xp0.3HXrMtbk97CSi/.5On/HfzWISqToEuK', 'active', '1', '2024-05-31 07:53:10', '2024-05-31 14:53:11'),
(3, '1', 'Hans Agung', 'hansagg11@gmail.com', '084663783384', '$2y$12$Jw6UVVlxcTbjxKvaMGHWQO6KmnceNzDOgXa6DX9BcssGVoZs3KPzC', 'active', '1', '2024-06-13 14:21:40', '2024-06-13 21:21:40'),
(4, '1', 'Dini Reyna', 'dini11@gmail.com', '08947788599', '$2y$12$oKk1qkl5tsFmBbWZHbKyXuP/iwyOWgipmk1PYo7KpCXfuBC.JrNZW', 'active', '1', '2024-06-03 02:53:53', '2024-06-03 09:53:53'),
(5, '1', 'Dini Sipahutar', 'dinisipahutar2017@gmail.com', '081265855377', '$2y$12$cpGGbYDWfa.ZH0Pg6htpm.x8GwXB.aSUMUBUWRC08JcCKQIjd1gJe', 'active', '1', '2024-06-13 02:45:26', '2024-06-13 09:45:26'),
(6, '1', 'Heri', 'herisipahutar2017@gmail.com', '1234567890', '$2y$12$YhLqhv5hA97P5KrdMw/JBOuR73Rtzk6YGRoiK36Jw32Zh3n.Tth/i', 'active', '1', '2024-06-07 06:34:15', '2024-06-07 13:34:15'),
(7, '1', 'Roi', 'roisipahutar2017@gmail.com', '0987654321', '$2y$12$8HjLh3P/myT2zZkPebr.OeH24IQarUkM.jBb0tErUE4hJezQkNq5G', 'active', '1', '2024-06-07 06:35:40', '2024-06-07 13:35:40'),
(8, '1', 'Budi Hartono', 'budi12@gmail.com', '089786855433', '$2y$12$SnBZf8Qdg0QoS3P1D62zueyVks.zEAYLb0jvMyYkpFNIudqgtxPdu', 'active', '1', '2024-06-12 04:40:26', '2024-06-12 11:40:26');

-- --------------------------------------------------------

--
-- Struktur dari tabel `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint NOT NULL,
  `tokenable_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `personal_access_tokens`
--

INSERT INTO `personal_access_tokens` (`id`, `tokenable_type`, `tokenable_id`, `name`, `token`, `abilities`, `last_used_at`, `expires_at`, `created_at`, `updated_at`) VALUES
(315, 'App\\Models\\User', 24, 'auth_token', '02b77e21b7ccedc2ab5c0fa2f60906c0421d93315306c04cfa42b7874e7fd769', '[\"*\"]', NULL, NULL, '2024-05-31 00:10:03', '2024-05-31 00:10:03'),
(316, 'App\\Models\\User', 24, 'auth_token', '1264d3027bd5c71660aef4cf1852150a0087b908d452a1e19143afdd4c54a047', '[\"*\"]', '2024-05-31 00:10:15', NULL, '2024-05-31 00:10:14', '2024-05-31 00:10:15'),
(318, 'App\\Models\\Pengelola', 13, 'authToken', 'f8267ece98f6bf7e32c3fb8c5eb07ec50002860f59fa7a6dc72d414908103e17', '[\"*\"]', NULL, NULL, '2024-05-31 00:10:38', '2024-05-31 00:10:38'),
(319, 'App\\Models\\Pengelola', 13, 'authToken', 'e6fe5dcb716a6df3f9614f3429c5647c29a04ddbe22b20d501219def607f29d0', '[\"*\"]', NULL, NULL, '2024-05-31 00:14:04', '2024-05-31 00:14:04'),
(320, 'App\\Models\\User', 24, 'auth_token', 'a4186809bafd59cfe63ed3d1ea8c72c568192b63a9cbfe4effdea5a64d1bcf16', '[\"*\"]', '2024-05-31 00:15:57', NULL, '2024-05-31 00:14:48', '2024-05-31 00:15:57'),
(321, 'App\\Models\\Pengelola', 14, 'authToken', 'b6f2475438ec1be6eabee61f3af68f75d57d9bae0f40997aab32c9a4764f6553', '[\"*\"]', NULL, NULL, '2024-05-31 00:16:28', '2024-05-31 00:16:28'),
(322, 'App\\Models\\Pengelola', 13, 'authToken', '5b5f9f5cd466b8c6199282d403fa79f3040a57f5c9666c1217712f7a6b72ec23', '[\"*\"]', NULL, NULL, '2024-05-31 00:17:19', '2024-05-31 00:17:19'),
(323, 'App\\Models\\Pengelola', 15, 'authToken', '572ae19c8b72a2fd19fd26309b25f07674d8b70caab2a92f5363defde5869b99', '[\"*\"]', NULL, NULL, '2024-05-31 00:24:53', '2024-05-31 00:24:53'),
(324, 'App\\Models\\Pengelola', 15, 'authToken', '580df2ea40c634f4003813fd220ca67dd655cee8ca0f4cc8f35afe86987500f8', '[\"*\"]', NULL, NULL, '2024-05-31 00:27:06', '2024-05-31 00:27:06'),
(325, 'App\\Models\\Pengelola', 13, 'authToken', '083bf57d8868dfa99e5a08254c43bb57357ce35d486f25c0be5dd07987c5cfb6', '[\"*\"]', NULL, NULL, '2024-05-31 00:27:17', '2024-05-31 00:27:17'),
(326, 'App\\Models\\Pengelola', 15, 'authToken', 'ef0a717814012abb2c41aaddfc81d42f193704ca06c9fe24e21fa0338a99e44a', '[\"*\"]', NULL, NULL, '2024-05-31 00:27:40', '2024-05-31 00:27:40'),
(327, 'App\\Models\\Pengelola', 13, 'authToken', '05d57142664c9b3aa8939c2c0d37bb253be0cf2cc4edbee6cb0934e2c24fe6e0', '[\"*\"]', NULL, NULL, '2024-05-31 00:27:51', '2024-05-31 00:27:51'),
(328, 'App\\Models\\Pengelola', 1, 'authToken', '8449aabb5dd4379e459734eed41dfde8d6a785ca965ac77dfa67260838eaf489', '[\"*\"]', NULL, NULL, '2024-05-31 00:33:51', '2024-05-31 00:33:51'),
(329, 'App\\Models\\User', 2, 'auth_token', '17155367b2b92aff93daee071b0fa149690a3894b2f4f4ed19bea76b682609d5', '[\"*\"]', NULL, NULL, '2024-05-31 00:37:25', '2024-05-31 00:37:25'),
(331, 'App\\Models\\User', 3, 'auth_token', '9debc34feed04a3384526b5103367feef318865c3b6245a5df4ff1c91e3c1929', '[\"*\"]', NULL, NULL, '2024-05-31 00:44:32', '2024-05-31 00:44:32'),
(333, 'App\\Models\\Pengelola', 1, 'authToken', '53b6e7ceb0efd68f192182cfff676d2e2b2c6aa22d1c0eba6cc53e9c5664ab4f', '[\"*\"]', NULL, NULL, '2024-05-31 00:52:14', '2024-05-31 00:52:14'),
(334, 'App\\Models\\User', 4, 'auth_token', '67755349f6fa2b9ee3ed95bf039cce22bd993fd8cc76f8c0411d970677bb629e', '[\"*\"]', NULL, NULL, '2024-05-31 00:59:04', '2024-05-31 00:59:04'),
(335, 'App\\Models\\User', 4, 'auth_token', 'e8ab5b0da1f725e2314bfdcdc875ac37f4acfd7163d46a61f9b34dfaa9934659', '[\"*\"]', '2024-06-02 17:58:30', NULL, '2024-05-31 00:59:12', '2024-06-02 17:58:30'),
(336, 'App\\Models\\Pengelola', 1, 'authToken', 'f5fc1a62f93d49e10ef94445c0f24f0bcea24655374b709fa80e8c09f04e52e2', '[\"*\"]', NULL, NULL, '2024-05-31 01:02:32', '2024-05-31 01:02:32'),
(337, 'App\\Models\\Pengelola', 1, 'authToken', '814f99e969e3db951cf938c31bd0ecae461b7e9271e7b2ed5a0400b2d99ff6e6', '[\"*\"]', NULL, NULL, '2024-05-31 01:10:14', '2024-05-31 01:10:14'),
(338, 'App\\Models\\User', 5, 'auth_token', '2f7d67338113ef8613ef1de3548e2d817b27d651f3c06dfb6e78eb667f838572', '[\"*\"]', NULL, NULL, '2024-05-31 03:47:56', '2024-05-31 03:47:56'),
(340, 'App\\Models\\Pengelola', 3, 'authToken', '960fb0524cad90e6f6ce63e0833beed2b0cd37610ba44fccd62dee9fbdad1996', '[\"*\"]', NULL, NULL, '2024-05-31 19:37:59', '2024-05-31 19:37:59'),
(341, 'App\\Models\\Pengelola', 1, 'authToken', '8e670b726afc049c5b5f25152516e1be72b2d2d34e86de2771a933317818496b', '[\"*\"]', NULL, NULL, '2024-05-31 19:38:16', '2024-05-31 19:38:16'),
(342, 'App\\Models\\Pengelola', 1, 'authToken', 'c3cfa326812ffe4e4f2ac118fd2f47d1003f7e0bc8894c06e2d859294c89f7a4', '[\"*\"]', NULL, NULL, '2024-06-01 01:09:44', '2024-06-01 01:09:44'),
(343, 'App\\Models\\User', 6, 'auth_token', 'e7f36ec2a8bd5873f80b75a3d87699b1eeb5e8bed6d1b1e75c39912f3e884232', '[\"*\"]', NULL, NULL, '2024-06-01 04:46:21', '2024-06-01 04:46:21'),
(345, 'App\\Models\\Pengelola', 5, 'authToken', '4ebc82541fa934485f6db0e6d29367b5da3af1912cd0628f6ad15185841bef82', '[\"*\"]', NULL, NULL, '2024-06-01 06:44:14', '2024-06-01 06:44:14'),
(346, 'App\\Models\\Pengelola', 5, 'authToken', 'c20b1f482c4682c2fe3a5e8b9252d0c25987a39866404e7d1f40ffd02326f21b', '[\"*\"]', NULL, NULL, '2024-06-01 06:47:19', '2024-06-01 06:47:19'),
(347, 'App\\Models\\Pengelola', 1, 'authToken', '38060781c6ae037f3cc6925e234bc65273f05ea7b72287153c82550c95c27be7', '[\"*\"]', NULL, NULL, '2024-06-01 10:02:14', '2024-06-01 10:02:14'),
(348, 'App\\Models\\Pengelola', 5, 'authToken', 'b5f6c04b05da85ca06da8047d548eb78e92b046986ba3a2101cfff1eaefb8e15', '[\"*\"]', NULL, NULL, '2024-06-01 23:13:30', '2024-06-01 23:13:30'),
(349, 'App\\Models\\Pengelola', 1, 'authToken', '46670c1d81b48885acceeabf604a2b23a36c5946cd26da6166e690767992e10c', '[\"*\"]', NULL, NULL, '2024-06-02 01:22:44', '2024-06-02 01:22:44'),
(350, 'App\\Models\\Pengelola', 1, 'authToken', '9639294dddf2915b8387f33742faa4bd98b9c8e6ba41c969a7928fa8d1aaf4a6', '[\"*\"]', NULL, NULL, '2024-06-02 01:49:06', '2024-06-02 01:49:06'),
(353, 'App\\Models\\Pengelola', 1, 'authToken', 'f1185c1a0aba778072745c7cb331d91f8a08a086f2990c92dd22bf878f092a3c', '[\"*\"]', NULL, NULL, '2024-06-02 02:07:48', '2024-06-02 02:07:48'),
(354, 'App\\Models\\User', 7, 'auth_token', '3b104035ebfe8bee2c4e7e85afbf52545808a7bcc16bdf0cb9f96c7e4e831457', '[\"*\"]', NULL, NULL, '2024-06-02 05:16:49', '2024-06-02 05:16:49'),
(355, 'App\\Models\\User', 7, 'auth_token', '5cbc2e5cebaf464edd28540394cab3548a3000e719f6cdeca70a47a97e7c885a', '[\"*\"]', '2024-06-02 05:32:21', NULL, '2024-06-02 05:17:01', '2024-06-02 05:32:21'),
(356, 'App\\Models\\Pengelola', 1, 'authToken', '075e1b3216b8a5debcc5cd77afcab897c5f0cdf189fb160f5ecd4b61d858a0c0', '[\"*\"]', NULL, NULL, '2024-06-02 05:17:19', '2024-06-02 05:17:19'),
(357, 'App\\Models\\User', 2, 'auth_token', '6136f36a9cdcd6646a43fe2a7403f9230b9e54acd9648c6c55ecac3fa3353d77', '[\"*\"]', '2024-06-02 05:17:30', NULL, '2024-06-02 05:17:30', '2024-06-02 05:17:30'),
(358, 'App\\Models\\User', 2, 'auth_token', 'c5184a846df7c5bed35ddf14ca342cef6e8a5256b2ea4037758d83108b27bf36', '[\"*\"]', '2024-06-02 08:33:23', NULL, '2024-06-02 05:17:31', '2024-06-02 08:33:23'),
(359, 'App\\Models\\User', 2, 'auth_token', '0b7f4e5f55e919408c73d1fbf10420f5ecde7b0695b713fa2512e6066a0fb1f7', '[\"*\"]', '2024-06-02 05:28:13', NULL, '2024-06-02 05:25:37', '2024-06-02 05:28:13'),
(360, 'App\\Models\\User', 7, 'auth_token', '83728b4701d792b6fb21c1b14240e4632a8b02e40a2ca187cf25c2bd47ba57db', '[\"*\"]', '2024-06-02 05:38:40', NULL, '2024-06-02 05:37:23', '2024-06-02 05:38:40'),
(361, 'App\\Models\\User', 7, 'auth_token', '9f6b1b1c36c1f6fd0fcba6593a0e275ae5260c3c1b51c5116beee95753dc2b5b', '[\"*\"]', NULL, NULL, '2024-06-02 06:22:53', '2024-06-02 06:22:53'),
(363, 'App\\Models\\Pengelola', 1, 'authToken', '90c62c4edd14d23f980acd516f756f03237944045b4ae96382cd2327c8f4763f', '[\"*\"]', NULL, NULL, '2024-06-02 06:27:41', '2024-06-02 06:27:41'),
(364, 'App\\Models\\Pengelola', 1, 'authToken', '021f8785435832f60a09b4f0d34614d02f7aaa0f914cb31b690f8381d7e55ef3', '[\"*\"]', NULL, NULL, '2024-06-02 06:29:21', '2024-06-02 06:29:21'),
(367, 'App\\Models\\Pengelola', 1, 'authToken', 'f46f20e20e494bef858efab4a354faafc89ade0ff53f27d53ccd0d70d5b94f2c', '[\"*\"]', NULL, NULL, '2024-06-02 14:48:09', '2024-06-02 14:48:09'),
(368, 'App\\Models\\Pengelola', 1, 'authToken', 'ad020bde94abefe8ef2cae9eb70fa0161791a61d49e6f7bdfd1e86f0bd9d7d96', '[\"*\"]', NULL, NULL, '2024-06-02 15:21:19', '2024-06-02 15:21:19'),
(369, 'App\\Models\\Pengelola', 3, 'authToken', '0fab8f886539f0f48ce5f1a5b2ef9d727116d142123e93ed53a1e7184f2d8e90', '[\"*\"]', NULL, NULL, '2024-06-02 17:51:00', '2024-06-02 17:51:00'),
(370, 'App\\Models\\Pengelola', 1, 'authToken', '9a3ba3d35cc763cf3adf1326dd00b42b8115e519d5771205f51844ad7dc406e0', '[\"*\"]', NULL, NULL, '2024-06-02 17:51:14', '2024-06-02 17:51:14'),
(371, 'App\\Models\\Pengelola', 3, 'authToken', '39112c778a76545d0f2c24fb6f8c570f8b378e2eb2e5ec1246d4f688e243f742', '[\"*\"]', NULL, NULL, '2024-06-02 17:51:36', '2024-06-02 17:51:36'),
(372, 'App\\Models\\Pengelola', 3, 'authToken', '0ad2b8a9c29c340f8244b8e44056219ab7545f380e9216e380f332fc330cedc6', '[\"*\"]', NULL, NULL, '2024-06-02 18:09:19', '2024-06-02 18:09:19'),
(374, 'App\\Models\\User', 1, 'auth_token', 'a31060a9bd499e8f5fadf97af89bed58b6f25d36ce45113c6935e8067d57369e', '[\"*\"]', NULL, NULL, '2024-06-02 18:58:39', '2024-06-02 18:58:39'),
(375, 'App\\Models\\User', 4, 'auth_token', '094e39adbae511a114cfcf5537fed78e348022c3e1e2caea3d87ae2d4a087b89', '[\"*\"]', '2024-06-02 18:59:51', NULL, '2024-06-02 18:59:49', '2024-06-02 18:59:51'),
(376, 'App\\Models\\Pengelola', 3, 'authToken', '95f376462d395b17e9b0ec2a64375e2cca312fab25576c6f83fe428c9f31a08a', '[\"*\"]', NULL, NULL, '2024-06-02 19:20:05', '2024-06-02 19:20:05'),
(377, 'App\\Models\\User', 4, 'auth_token', '6be7cfb2faee3e1cad4ea103483b719aa97edafaec555c686069519baa16443c', '[\"*\"]', NULL, NULL, '2024-06-02 19:34:46', '2024-06-02 19:34:46'),
(379, 'App\\Models\\Pengelola', 1, 'authToken', '6d1308ab2376eaf94ec740a268bf6557c21c1209de21ec323db9739851200a15', '[\"*\"]', NULL, NULL, '2024-06-02 19:52:04', '2024-06-02 19:52:04'),
(381, 'App\\Models\\Pengelola', 1, 'authToken', 'f5beb026d2a6d8d96e79c44ed5d6768d20afbec3bb824b7007ee5ec55ce194b6', '[\"*\"]', NULL, NULL, '2024-06-03 00:33:48', '2024-06-03 00:33:48'),
(382, 'App\\Models\\Pengelola', 1, 'authToken', '35343c38f6d3a592af24c9a1bf16621c0b91c0737141b9ff69fcbc8ad0f2003d', '[\"*\"]', NULL, NULL, '2024-06-03 00:34:22', '2024-06-03 00:34:22'),
(383, 'App\\Models\\User', 8, 'auth_token', '93dbc2d05e5738b22803289296de5e4fd656887a680fba6eae2835895fa10876', '[\"*\"]', NULL, NULL, '2024-06-03 02:52:53', '2024-06-03 02:52:53'),
(384, 'App\\Models\\User', 9, 'auth_token', '590d4a3db49693cfa0d16bd53101be44d6e53f249b84bb35f0afb4561d60f145', '[\"*\"]', NULL, NULL, '2024-06-05 20:52:35', '2024-06-05 20:52:35'),
(385, 'App\\Models\\User', 10, 'auth_token', '7a16a509efdc35e6d634ed9d94d71f388c9cc93c88a1dc78f8ff2c9eaf235c24', '[\"*\"]', NULL, NULL, '2024-06-05 20:52:35', '2024-06-05 20:52:35'),
(386, 'App\\Models\\User', 9, 'auth_token', '9ee7466e8500a846f20e54c52e6ccc2b0660b5ece961092967b821d73b3be995', '[\"*\"]', '2024-06-09 19:36:24', NULL, '2024-06-05 20:52:50', '2024-06-09 19:36:24'),
(387, 'App\\Models\\Pengelola', 5, 'authToken', 'a34ead3830a4830c06df4969787fa8bfd174d974f246489bb8224a015e7b7f3e', '[\"*\"]', NULL, NULL, '2024-06-06 23:01:23', '2024-06-06 23:01:23'),
(388, 'App\\Models\\Pengelola', 1, 'authToken', '0d67673930e4698aa3a61922927c5bfc66312050e7ded31369a10c7c26d52a2f', '[\"*\"]', NULL, NULL, '2024-06-06 23:01:50', '2024-06-06 23:01:50'),
(389, 'App\\Models\\Pengelola', 1, 'authToken', '00124171f54a0e8c110c56b682690f524d678560c203b2cbb6c4217fbbf2984b', '[\"*\"]', NULL, NULL, '2024-06-06 23:11:31', '2024-06-06 23:11:31'),
(390, 'App\\Models\\Pengelola', 1, 'authToken', '6523851836ce487f83123298ea32f753d484b1747524c4592e1948e4f408325a', '[\"*\"]', NULL, NULL, '2024-06-06 23:11:40', '2024-06-06 23:11:40'),
(391, 'App\\Models\\Pengelola', 1, 'authToken', '6e63112d90b1a70d5e04a7a4477ebe31f1904ca46fe16ea2d531df2d933b924c', '[\"*\"]', NULL, NULL, '2024-06-06 23:12:30', '2024-06-06 23:12:30'),
(392, 'App\\Models\\Pengelola', 5, 'authToken', 'c85b7a8cd528115521dd2ec2fc4d1a43a6baa7bb44cd3ce70d1275e0e47bea97', '[\"*\"]', NULL, NULL, '2024-06-06 23:20:26', '2024-06-06 23:20:26'),
(393, 'App\\Models\\Pengelola', 1, 'authToken', '53d8ff2db7a0dad807db149c8715e9b0f94f79d27db7dbd5713b7bda5a15a53b', '[\"*\"]', NULL, NULL, '2024-06-06 23:20:39', '2024-06-06 23:20:39'),
(394, 'App\\Models\\Pengelola', 6, 'authToken', 'b743cab5e8489084b7c030f4e5cff4988d95099df7af217b8dc060fc34aee880', '[\"*\"]', NULL, NULL, '2024-06-06 23:20:49', '2024-06-06 23:20:49'),
(395, 'App\\Models\\Pengelola', 1, 'authToken', 'fa1db8bd0a259d59f8f75d9ec8822e3db0aa6717546d43c4c71f365e08fe5994', '[\"*\"]', NULL, NULL, '2024-06-06 23:31:37', '2024-06-06 23:31:37'),
(396, 'App\\Models\\User', 11, 'auth_token', 'b23a2ad6aa5733acda118b762357213b62094916bdd31711b58b9f872240503f', '[\"*\"]', NULL, NULL, '2024-06-06 23:32:17', '2024-06-06 23:32:17'),
(397, 'App\\Models\\User', 11, 'auth_token', '82772625fe386f81284b33325b44dc91fdbc37fcf7a879fd5b2ff5f9fc2c22ba', '[\"*\"]', '2024-06-09 19:56:54', NULL, '2024-06-06 23:32:32', '2024-06-09 19:56:54'),
(398, 'App\\Models\\Pengelola', 1, 'authToken', '93b42e051a26f4c3469d90f9b57e5006aff9142231fb08b00fbaf12e2f6113be', '[\"*\"]', NULL, NULL, '2024-06-06 23:45:45', '2024-06-06 23:45:45'),
(399, 'App\\Models\\Pengelola', 1, 'authToken', '78d7a85e2a64d03d5868922429ca04c7865afe45f6c370ba509e05f8179b0f4b', '[\"*\"]', NULL, NULL, '2024-06-07 00:00:22', '2024-06-07 00:00:22'),
(400, 'App\\Models\\Pengelola', 1, 'authToken', '8efdaeb354936fce1135cd5d8786f827090ca74cede65e9ae252b4c628648919', '[\"*\"]', NULL, NULL, '2024-06-07 00:00:24', '2024-06-07 00:00:24'),
(401, 'App\\Models\\Pengelola', 1, 'authToken', '275c428b6d523876a09d01222201f0ac5c66ccf9ac6506df7220f5f52b5242a9', '[\"*\"]', NULL, NULL, '2024-06-07 00:27:17', '2024-06-07 00:27:17'),
(402, 'App\\Models\\Pengelola', 1, 'authToken', '9aee01814ad1ca9d8a634aa1be6870979309bb4382c26ab6e344a99b7a1ce5ff', '[\"*\"]', NULL, NULL, '2024-06-07 06:52:24', '2024-06-07 06:52:24'),
(403, 'App\\Models\\User', 4, 'auth_token', 'b1abccd2bf64236e2bfd128dc33c787a512196e22727a0d3a02810d3ae9146db', '[\"*\"]', NULL, NULL, '2024-06-09 09:40:13', '2024-06-09 09:40:13'),
(404, 'App\\Models\\User', 4, 'auth_token', '282cc6f6505ef6f916086527a7324f672336adcb293008bf21e66734d0a812a7', '[\"*\"]', NULL, NULL, '2024-06-09 09:40:13', '2024-06-09 09:40:13'),
(405, 'App\\Models\\User', 4, 'auth_token', '062958accb8238d99fd18501b0a0700c30b5633df41ce57c2d8d7643f4c90a7b', '[\"*\"]', NULL, NULL, '2024-06-09 09:43:40', '2024-06-09 09:43:40'),
(406, 'App\\Models\\User', 4, 'auth_token', '2dad194cf05480405f4a3026160e0d7173c31e5eb23229e90b4d2daeb2b701fa', '[\"*\"]', NULL, NULL, '2024-06-09 09:43:51', '2024-06-09 09:43:51'),
(407, 'App\\Models\\User', 4, 'auth_token', '10a07c27120b0897a9bf71bb6ed17204d100a6d0abe262da1000638d1768531b', '[\"*\"]', NULL, NULL, '2024-06-09 09:43:51', '2024-06-09 09:43:51'),
(408, 'App\\Models\\Pengelola', 2, 'authToken', '2cfc1e4a5f049f406a48978dbf888b4e626b186bdfb1e7528a4b5e06d3cb57f6', '[\"*\"]', NULL, NULL, '2024-06-09 10:03:21', '2024-06-09 10:03:21'),
(409, 'App\\Models\\Pengelola', 1, 'authToken', '60dfcfebb8c5fce8f04042dcaa864b4018f94cf810b833e64ce673333200c808', '[\"*\"]', NULL, NULL, '2024-06-09 18:45:56', '2024-06-09 18:45:56'),
(410, 'App\\Models\\Pengelola', 1, 'authToken', '8539fa40d55d9685d1a5742bc178ed073454baf389faeee6004e68ff1f0fd214', '[\"*\"]', NULL, NULL, '2024-06-09 19:32:34', '2024-06-09 19:32:34'),
(411, 'App\\Models\\User', 9, 'auth_token', 'aa66c7c1df902cc589f0f6bb7da95cdaafe53b55ea471a00fdacd5008311e596', '[\"*\"]', NULL, NULL, '2024-06-10 23:16:42', '2024-06-10 23:16:42'),
(412, 'App\\Models\\User', 9, 'auth_token', '772a1c5702004a9f5bfa38d2647cd878436a8106b40af9435d1270502e5087ce', '[\"*\"]', '2024-06-10 23:16:45', NULL, '2024-06-10 23:16:42', '2024-06-10 23:16:45'),
(413, 'App\\Models\\User', 9, 'auth_token', 'e8384d13e4a97b0b8f5d943cbd6a92a49afa6a5433b649883b3457e8ac374214', '[\"*\"]', '2024-06-11 01:15:16', NULL, '2024-06-10 23:16:44', '2024-06-11 01:15:16'),
(414, 'App\\Models\\User', 12, 'auth_token', '6aab54403566bf5b5e109a47092334dcd8afc66775431ed2d6ee3d99c50eaaf7', '[\"*\"]', NULL, NULL, '2024-06-11 01:17:21', '2024-06-11 01:17:21'),
(416, 'App\\Models\\User', 13, 'auth_token', '488f8370bd2374c198c791838ff795913dd096de822724bc9d2f16c0fd76a5dc', '[\"*\"]', NULL, NULL, '2024-06-11 01:24:01', '2024-06-11 01:24:01'),
(418, 'App\\Models\\User', 14, 'auth_token', '00f271c1e59dc7f37e954a611e5c4ba94f6c6eab3da7878c1b2e1330c1652fcd', '[\"*\"]', NULL, NULL, '2024-06-11 01:51:31', '2024-06-11 01:51:31'),
(419, 'App\\Models\\User', 14, 'auth_token', '94a2b514b91fa481420120ad2d108d1183f2b425bb0c39174925761207573ffc', '[\"*\"]', '2024-06-11 02:54:17', NULL, '2024-06-11 01:52:04', '2024-06-11 02:54:17'),
(420, 'App\\Models\\Pengelola', 1, 'authToken', '26547bf10376be1f679401fea90326eebb1d21126af18ef7f22568016dda3846', '[\"*\"]', NULL, NULL, '2024-06-11 16:41:32', '2024-06-11 16:41:32'),
(421, 'App\\Models\\User', 15, 'auth_token', '0d05c0e09642c43d0280b07a3684efb441b321c508d463a6e1f5cd92bb077003', '[\"*\"]', NULL, NULL, '2024-06-11 17:57:46', '2024-06-11 17:57:46'),
(423, 'App\\Models\\Pengelola', 3, 'authToken', '2a523de14411c3786b19c4fc422946805aa58f9987a9ce5a2aaa1efefb9af32b', '[\"*\"]', NULL, NULL, '2024-06-11 18:04:54', '2024-06-11 18:04:54'),
(424, 'App\\Models\\User', 6, 'auth_token', 'fce33ec23646545712efd46585d13aea3d8e8eaf1d9b38cf65d0ca6278fbcaff', '[\"*\"]', NULL, NULL, '2024-06-11 18:45:42', '2024-06-11 18:45:42'),
(425, 'App\\Models\\User', 6, 'auth_token', '7fed57286ba9553b84c5d1d494f14dcd2c4b6f9260058b50fd9d85b79b37b2bb', '[\"*\"]', NULL, NULL, '2024-06-11 18:45:43', '2024-06-11 18:45:43'),
(429, 'App\\Models\\User', 16, 'auth_token', 'ac406de22be297d01ee879de262b201e0ddf6f5d250b3c852fd3c84b8ea7ea37', '[\"*\"]', NULL, NULL, '2024-06-11 19:35:19', '2024-06-11 19:35:19'),
(431, 'App\\Models\\User', 17, 'auth_token', 'ae0b9f9e634e950e2b2bf3f4386f1c5c747de9feb612e24f639479c669f54312', '[\"*\"]', NULL, NULL, '2024-06-11 19:39:11', '2024-06-11 19:39:11'),
(432, 'App\\Models\\User', 17, 'auth_token', '07ef27fdb4fa9d5637b66c8656e2be6975d5bb82d2d12735e41381014bfeb2b5', '[\"*\"]', '2024-06-11 19:39:27', NULL, '2024-06-11 19:39:26', '2024-06-11 19:39:27'),
(433, 'App\\Models\\User', 17, 'auth_token', 'e9c7033ff9c41ea246a0f16dda0a4eacbe855b3bad15a66c33ba05fed2d76c2f', '[\"*\"]', '2024-06-11 19:39:27', NULL, '2024-06-11 19:39:26', '2024-06-11 19:39:27'),
(435, 'App\\Models\\User', 18, 'auth_token', '74725ad8ee19fb116cf64748133544fce98350e7f5efadaef05687b56b879b69', '[\"*\"]', NULL, NULL, '2024-06-11 19:52:01', '2024-06-11 19:52:01'),
(436, 'App\\Models\\User', 19, 'auth_token', '64d5d3ed112adbacbac83d997da4e2815781c7fb708f9ed5977c3f52ade71b7b', '[\"*\"]', NULL, NULL, '2024-06-11 19:52:02', '2024-06-11 19:52:02'),
(437, 'App\\Models\\User', 18, 'auth_token', '7cc45dc23a37f3b74c05d306c260610142e2fe534b4e0a932bfcef1358a62dfa', '[\"*\"]', '2024-06-11 19:52:11', NULL, '2024-06-11 19:52:11', '2024-06-11 19:52:11'),
(439, 'App\\Models\\User', 20, 'auth_token', '7a61238c2814c24ac5ec3e252503e5e5fc473dd90a03c5cf2b958f11de59f318', '[\"*\"]', NULL, NULL, '2024-06-11 20:04:24', '2024-06-11 20:04:24'),
(441, 'App\\Models\\User', 6, 'auth_token', 'c74fc3a44a20e252921b71b7a6f93acea52f44fe1ff1d90f7ce701495696a2ab', '[\"*\"]', '2024-06-11 20:10:19', NULL, '2024-06-11 20:10:18', '2024-06-11 20:10:19'),
(444, 'App\\Models\\User', 21, 'auth_token', 'ef64dc65d3532fc0cfd0d65dc8b71a88763fee8d6cc558ee5836e05fb81c5e8c', '[\"*\"]', NULL, NULL, '2024-06-11 20:38:33', '2024-06-11 20:38:33'),
(446, 'App\\Models\\User', 6, 'auth_token', 'ae29b01bc930faf74a358c142481f8341c5fe96677df4d38cee7eebac155f28b', '[\"*\"]', '2024-06-12 02:09:38', NULL, '2024-06-11 20:56:06', '2024-06-12 02:09:38'),
(447, 'App\\Models\\User', 22, 'auth_token', 'b41884fbcf7da48995fc0ab18c255bb18c19eac6c2f1323e53b17e472a86fadb', '[\"*\"]', NULL, NULL, '2024-06-11 21:05:32', '2024-06-11 21:05:32'),
(448, 'App\\Models\\User', 22, 'auth_token', '58d4925772b2f73a360b9185b4cc9a28e830a95df17cc1707ba32a76467464dd', '[\"*\"]', '2024-06-11 21:05:49', NULL, '2024-06-11 21:05:48', '2024-06-11 21:05:49'),
(450, 'App\\Models\\User', 1, 'auth_token', '7f9aa2ec7c4dbec3641867885785bd0f6def52e56960d1eee47083413ee2d841', '[\"*\"]', '2024-06-12 02:11:41', NULL, '2024-06-11 21:13:51', '2024-06-12 02:11:41'),
(451, 'App\\Models\\User', 9, 'auth_token', 'ce001dc664935f7dfe140b6b54c9541a09853936277cab5cba66b0a18434fd0e', '[\"*\"]', '2024-06-11 21:25:05', NULL, '2024-06-11 21:25:05', '2024-06-11 21:25:05'),
(453, 'App\\Models\\Pengelola', 1, 'authToken', '242bf035fbb8efd3d7c6e50283f71fd85906cb3d2f0ae548b802e36ba172acaf', '[\"*\"]', NULL, NULL, '2024-06-11 21:31:19', '2024-06-11 21:31:19'),
(454, 'App\\Models\\Pengelola', 8, 'authToken', '4911183e4095efec9fe419baeff551de2d24d1490400166f147e2c1bc57c6541', '[\"*\"]', NULL, NULL, '2024-06-11 21:39:03', '2024-06-11 21:39:03'),
(455, 'App\\Models\\Pengelola', 1, 'authToken', '42c0c6e71fb5a7debb11b1c22044152ea7ee313afe62c1c147fe6c3617692c4a', '[\"*\"]', NULL, NULL, '2024-06-11 21:39:37', '2024-06-11 21:39:37'),
(456, 'App\\Models\\Pengelola', 1, 'authToken', '1de0f746d870d1076bbd27e937e3d098e0ec84391fb7a99aa9a158b0997604fb', '[\"*\"]', NULL, NULL, '2024-06-11 21:47:06', '2024-06-11 21:47:06'),
(457, 'App\\Models\\Pengelola', 3, 'authToken', 'd86575d51c400a5ef0d7c3f0f3e1cd6c5bf97137f8e71c2c70bc4524b2f8a034', '[\"*\"]', NULL, NULL, '2024-06-11 21:47:40', '2024-06-11 21:47:40'),
(458, 'App\\Models\\Pengelola', 1, 'authToken', '343eb92b64c6a42f00b83fc581c78bb580daaa3cac010aec9ab9a208f2e36f71', '[\"*\"]', NULL, NULL, '2024-06-11 22:06:56', '2024-06-11 22:06:56'),
(459, 'App\\Models\\Pengelola', 1, 'authToken', '83709032bf3cd249ce9e0db8df6e95bff3055d3b292c93e817d775c3ae04729b', '[\"*\"]', NULL, NULL, '2024-06-11 22:15:41', '2024-06-11 22:15:41'),
(460, 'App\\Models\\Pengelola', 1, 'authToken', '8883b9e8a9e2488b887cd3e7330ce03c81b371e916497c387c9fd8cf5804eb3c', '[\"*\"]', NULL, NULL, '2024-06-11 22:51:03', '2024-06-11 22:51:03'),
(461, 'App\\Models\\Pengelola', 1, 'authToken', '69fd26886b7d045eb2d66e3ef191a28e67f5f619934264bdc7460cac050d4df9', '[\"*\"]', NULL, NULL, '2024-06-11 23:02:38', '2024-06-11 23:02:38'),
(462, 'App\\Models\\Pengelola', 1, 'authToken', '441eea23a971ee31b90f51d853a959672d01893af04ed94e67b0325758e5ab4a', '[\"*\"]', NULL, NULL, '2024-06-11 23:32:56', '2024-06-11 23:32:56'),
(463, 'App\\Models\\Pengelola', 1, 'authToken', 'ed6f185f9abacc272358cbff4dc4ff93233ae7398f38233884b1238965fd95c5', '[\"*\"]', NULL, NULL, '2024-06-11 23:56:54', '2024-06-11 23:56:54'),
(464, 'App\\Models\\User', 23, 'auth_token', '13f979343612f88ed3b342f8857a25dbf94cb6797520f39ee534a072443d2525', '[\"*\"]', NULL, NULL, '2024-06-12 01:19:13', '2024-06-12 01:19:13'),
(465, 'App\\Models\\User', 23, 'auth_token', '1173e289b48fcb1eb9d4bb03f12677875d103448831ad4caa116f2fe61a9ff21', '[\"*\"]', '2024-06-13 07:26:02', NULL, '2024-06-12 01:19:26', '2024-06-13 07:26:02'),
(466, 'App\\Models\\Pengelola', 1, 'authToken', '599927f3a4a8719dab1003e3d6d8ca81ec10f6383d170880ed35fffc526b2405', '[\"*\"]', NULL, NULL, '2024-06-12 19:34:46', '2024-06-12 19:34:46'),
(467, 'App\\Models\\Pengelola', 1, 'authToken', '93bf65ee4b87ac5ce39abf419a6f1a7012a5a756a84c639cd8acc54cf1e91eba', '[\"*\"]', NULL, NULL, '2024-06-12 19:34:54', '2024-06-12 19:34:54'),
(468, 'App\\Models\\Pengelola', 5, 'authToken', 'c88d8381bfb68f51ad936aa895df0b752e69718644ab18083f913d1860871d60', '[\"*\"]', NULL, NULL, '2024-06-12 19:44:36', '2024-06-12 19:44:36'),
(469, 'App\\Models\\Pengelola', 1, 'authToken', 'b6f0739a2d14d9b186841b36ff32ec2956d50cbbe794b4f0df79cec74dc3eb13', '[\"*\"]', NULL, NULL, '2024-06-12 19:44:46', '2024-06-12 19:44:46'),
(470, 'App\\Models\\Pengelola', 5, 'authToken', 'd34977cee1e982f65724786c79c22c7f53b988c9ad88d789948221360ba045ba', '[\"*\"]', NULL, NULL, '2024-06-12 19:45:33', '2024-06-12 19:45:33'),
(471, 'App\\Models\\Pengelola', 1, 'authToken', '12ebe09d3bf6799e7ef849d04bd2e377d0523a9d640e00f55f9a65b1f8d993fc', '[\"*\"]', NULL, NULL, '2024-06-12 19:45:55', '2024-06-12 19:45:55'),
(472, 'App\\Models\\Pengelola', 1, 'authToken', '3ea950959cfcff4dd98bb0e8ce79f7134dc50740a43459b36b5f7a071e2f1f51', '[\"*\"]', NULL, NULL, '2024-06-12 19:51:48', '2024-06-12 19:51:48'),
(473, 'App\\Models\\Pengelola', 1, 'authToken', '2dbf6ecd00322faac7ce694ece712806a468ca6778e445858606474e64fd8e0c', '[\"*\"]', NULL, NULL, '2024-06-12 19:52:00', '2024-06-12 19:52:00'),
(474, 'App\\Models\\User', 24, 'auth_token', 'a991139ce003c1859700b44051f9ccd1995803deaefebb99c52edf3409012891', '[\"*\"]', NULL, NULL, '2024-06-12 19:52:12', '2024-06-12 19:52:12'),
(475, 'App\\Models\\Pengelola', 3, 'authToken', '205d697de3b08a32302de4287c5065641e2445588b4dfb5a410f967be59fadd7', '[\"*\"]', NULL, NULL, '2024-06-12 20:30:21', '2024-06-12 20:30:21'),
(476, 'App\\Models\\Pengelola', 1, 'authToken', 'cdc390fd6053b04bb560d7d04c838669550af073eb1662a6a0c06600c6d7e56e', '[\"*\"]', NULL, NULL, '2024-06-12 20:30:50', '2024-06-12 20:30:50'),
(477, 'App\\Models\\Pengelola', 1, 'authToken', '513639a3000e82203f0436a09d3327c8a850a7d18b03eba4f4c7bdbd78955be8', '[\"*\"]', NULL, NULL, '2024-06-12 20:35:15', '2024-06-12 20:35:15'),
(479, 'App\\Models\\User', 1, 'auth_token', '11fd610672c83de4c1e17937b77d05bd297c4c4b10187435b67285195351633a', '[\"*\"]', '2024-06-12 21:54:29', NULL, '2024-06-12 21:54:24', '2024-06-12 21:54:29'),
(481, 'App\\Models\\Pengelola', 1, 'authToken', '65c68136a529c8610f003d80b6c7ac3a6b7b7b07c3255df73f6a1be9d3c7fcb9', '[\"*\"]', NULL, NULL, '2024-06-12 23:03:33', '2024-06-12 23:03:33'),
(482, 'App\\Models\\Pengelola', 1, 'authToken', '38492f5008b80ea0d04a49d49142997b055f7d060adfdde509882c8153c2798a', '[\"*\"]', NULL, NULL, '2024-06-12 23:52:22', '2024-06-12 23:52:22'),
(484, 'App\\Models\\Pengelola', 3, 'authToken', 'dde556432765236c2fb53d6ef40d9ed358ed66264e3c0bc0a6bc11746ac11eba', '[\"*\"]', NULL, NULL, '2024-06-13 00:21:06', '2024-06-13 00:21:06'),
(485, 'App\\Models\\Pengelola', 1, 'authToken', '4b39bc72ab74e15a32e043978a8f8e6d6d69dc346bfb1b5ff19c603ae2661989', '[\"*\"]', NULL, NULL, '2024-06-13 01:10:27', '2024-06-13 01:10:27'),
(486, 'App\\Models\\Pengelola', 5, 'authToken', '7926a82259d3e5f881a39a43235269c72c509a6d7fcb83ec2e05928565fdc271', '[\"*\"]', NULL, NULL, '2024-06-13 01:10:38', '2024-06-13 01:10:38'),
(487, 'App\\Models\\Pengelola', 3, 'authToken', '7756a7ef34e9da8971a903013c876a52a769be77cd59c6f2b55864fac240e251', '[\"*\"]', NULL, NULL, '2024-06-13 02:12:40', '2024-06-13 02:12:40'),
(488, 'App\\Models\\Pengelola', 3, 'authToken', '765a3094c6244eef6535bbcfee706131c335883cc6b2a06abbe10500098521f3', '[\"*\"]', NULL, NULL, '2024-06-13 02:13:06', '2024-06-13 02:13:06'),
(489, 'App\\Models\\Pengelola', 3, 'authToken', 'd9de208cba5da7d69764feee9579807c103b009615b9cb4c1c08e855534a6fe2', '[\"*\"]', NULL, NULL, '2024-06-13 03:13:47', '2024-06-13 03:13:47'),
(490, 'App\\Models\\Pengelola', 1, 'authToken', 'fe8f2615256f9aa9d43f80a4f3ecb93c8328b3ef42cebf70abc6430917857329', '[\"*\"]', NULL, NULL, '2024-06-13 03:14:00', '2024-06-13 03:14:00'),
(491, 'App\\Models\\Pengelola', 3, 'authToken', 'a37fac6c5023792221b86911efe8f9a9a7085482e4cd0b10da14360b6e148372', '[\"*\"]', NULL, NULL, '2024-06-13 03:35:20', '2024-06-13 03:35:20'),
(492, 'App\\Models\\Pengelola', 1, 'authToken', 'faf0fef91af8e0c5bce0e3a812434e688e80406a0a65c6d627ab4dae66eca9dd', '[\"*\"]', NULL, NULL, '2024-06-13 03:35:44', '2024-06-13 03:35:44'),
(494, 'App\\Models\\User', 25, 'auth_token', '5cb478ee1ed16802106a3660c672a2742c7453499122cb319ef7bc119c7b7627', '[\"*\"]', NULL, NULL, '2024-06-13 06:39:32', '2024-06-13 06:39:32'),
(495, 'App\\Models\\User', 25, 'auth_token', 'd1b8b958f7e17021b5e1b11cf2f1d41f90a305868acdd44dc06cf6c6cfa02742', '[\"*\"]', '2024-06-13 06:39:47', NULL, '2024-06-13 06:39:46', '2024-06-13 06:39:47'),
(496, 'App\\Models\\User', 1, 'auth_token', 'c0cab3b5754bdc89f0ef516233d1b62c3921ff90cece9a871192a21a8406c954', '[\"*\"]', '2024-06-13 07:30:18', NULL, '2024-06-13 07:30:17', '2024-06-13 07:30:18'),
(497, 'App\\Models\\User', 1, 'auth_token', 'afafed6eee45335cfd5865519453b0ddbf530ad5e918af2feea8f9ecee64695a', '[\"*\"]', '2024-06-13 17:25:24', NULL, '2024-06-13 17:24:39', '2024-06-13 17:25:24'),
(498, 'App\\Models\\Pengelola', 3, 'authToken', '142b763e041b94a9e0ff4b118f025ba94e1d700637203d0edbdd60c1e7b62033', '[\"*\"]', NULL, NULL, '2024-06-13 19:21:01', '2024-06-13 19:21:01');

-- --------------------------------------------------------

--
-- Struktur dari tabel `posttest`
--

CREATE TABLE `posttest` (
  `id_posttest` int NOT NULL,
  `id_unit` int NOT NULL,
  `deskripsi` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `posttest`
--

INSERT INTO `posttest` (`id_posttest`, `id_unit`, `deskripsi`) VALUES
(9, 11, 'Posttest Pengurangan Tingkat 1'),
(10, 12, 'Penjumlahan satu angka'),
(13, 15, 'Posttest Pembagiaan Tingkat 1');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pretest`
--

CREATE TABLE `pretest` (
  `id_pretest` int NOT NULL,
  `id_unit` int NOT NULL,
  `deskripsi` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `pretest`
--

INSERT INTO `pretest` (`id_pretest`, `id_unit`, `deskripsi`) VALUES
(13, 11, 'Pretest Pengurangan Tingkat 1'),
(14, 12, 'Penjumlahan satu angka'),
(17, 15, 'Pretest Pembagian 1');

-- --------------------------------------------------------

--
-- Struktur dari tabel `question_level_bonus`
--

CREATE TABLE `question_level_bonus` (
  `id_question_level_bonus` int NOT NULL,
  `id_level_bonus` int NOT NULL,
  `question` varchar(225) NOT NULL,
  `option_1` varchar(225) NOT NULL,
  `option_2` varchar(255) NOT NULL,
  `option_3` varchar(255) NOT NULL,
  `option_4` varchar(255) NOT NULL,
  `correct_index` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `question_level_bonus`
--

INSERT INTO `question_level_bonus` (`id_question_level_bonus`, `id_level_bonus`, `question`, `option_1`, `option_2`, `option_3`, `option_4`, `correct_index`) VALUES
(3, 5, '10 + 5', '15', '23', '20', '19', 15),
(4, 5, '10 + 2 + 8', '15', '23', '20', '19', 20),
(5, 5, '9 + 8 + 7', '24', '23', '27', '21', 24),
(6, 5, '14 + 5 + 3', '24', '22', '20', '19', 22),
(7, 5, '12 + 8 + 9', '39', '27', '17', '29', 29),
(9, 7, '40 - 20 -10', '20', '10', '40', '30', 10),
(10, 7, '50 - 25 -5', '30', '35', '20', '25', 20),
(11, 8, '15 : 3', '5', '4', '2', '1', 5);

-- --------------------------------------------------------

--
-- Struktur dari tabel `question_posttest`
--

CREATE TABLE `question_posttest` (
  `id_question_posttest` int NOT NULL,
  `question` varchar(225) NOT NULL,
  `posttest_option_1` varchar(225) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `posttest_option_2` varchar(225) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `posttest_option_3` varchar(225) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `posttest_option_4` varchar(225) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `posttest_correct_index` int NOT NULL,
  `id_posttest` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `question_posttest`
--

INSERT INTO `question_posttest` (`id_question_posttest`, `question`, `posttest_option_1`, `posttest_option_2`, `posttest_option_3`, `posttest_option_4`, `posttest_correct_index`, `id_posttest`) VALUES
(5, '10 - 4', '3', '6', '5', '7', 6, 9),
(6, '5 + 3 + 2', '8', '5', '10', '11', 10, 10),
(7, '1 + 5 + 6', '12', '11', '13', '14', 12, 10),
(8, '4 + 2', '8', '5', '10', '6', 6, 10),
(9, '5 + 3', '8', '11', '10', '14', 8, 10),
(10, '6 + 4 + 4', '8', '11', '14', '15', 14, 10),
(11, '9 + 4', '11', '5', '10', '6', 11, 10),
(12, '3 + 1', '8', '5', '4', '6', 4, 10),
(13, '4 + 2 + 1', '8', '7', '6', '5', 7, 10),
(14, '8 + 4 + 3', '12', '15', '16', '17', 15, 10),
(15, '9 + 4', '13', '12', '11', '10', 13, 10),
(18, '10 : 5', '2', '4', '6', '3', 2, 13),
(19, '56-20', '30', '38', '36', '46', 36, 9);

-- --------------------------------------------------------

--
-- Struktur dari tabel `question_pretest`
--

CREATE TABLE `question_pretest` (
  `id_question_pretest` int NOT NULL,
  `question` varchar(225) NOT NULL,
  `pretest_option_1` varchar(225) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `pretest_option_2` varchar(225) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `pretest_option_3` varchar(225) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `pretest_option_4` varchar(225) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `pretest_correct_index` varchar(225) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `id_pretest` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `question_pretest`
--

INSERT INTO `question_pretest` (`id_question_pretest`, `question`, `pretest_option_1`, `pretest_option_2`, `pretest_option_3`, `pretest_option_4`, `pretest_correct_index`, `id_pretest`) VALUES
(5, '2 - 1', '3', '-1', '0', '1', '1', 13),
(6, '5 + 5', '10', '9', '15', '25', '10', 14),
(7, '8 + 4', '10', '12', '16', '4', '12', 14),
(8, '4 + 2', '7', '5', '8', '6', '6', 14),
(9, '5 + 3', '2', '8', '6', '9', '8', 14),
(10, '6 + 8', '12', '10', '14', '9', '14', 14),
(11, '5 + 6', '10', '13', '11', '5', '11', 14),
(12, '3 + 1', '2', '4', '3', '5', '4', 14),
(13, '2 + 5', '12', '11', '15', '7', '7', 14),
(14, '7 + 8', '12', '9', '15', '25', '15', 14),
(15, '9 + 4', '12', '10', '11', '13', '13', 14),
(18, '8 : 4', '3', '2', '6', '7', '2', 17);

-- --------------------------------------------------------

--
-- Struktur dari tabel `score_level_bonus`
--

CREATE TABLE `score_level_bonus` (
  `id_ScoreLevelBonus` int NOT NULL,
  `id_user` int NOT NULL,
  `id_unit` int NOT NULL,
  `id_level_bonus` int NOT NULL,
  `score` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `score_posttest`
--

CREATE TABLE `score_posttest` (
  `id_ScorePostTest` int NOT NULL,
  `id_user` int NOT NULL,
  `id_posttest` int NOT NULL,
  `id_unit` int NOT NULL,
  `score` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `score_posttest`
--

INSERT INTO `score_posttest` (`id_ScorePostTest`, `id_user`, `id_posttest`, `id_unit`, `score`) VALUES
(75, 2, 9, 11, 100),
(76, 2, 9, 11, 100),
(77, 2, 9, 11, 100),
(78, 2, 9, 11, 100),
(79, 3, 9, 11, 100),
(80, 4, 9, 11, 100),
(81, 3, 9, 11, 100),
(82, 6, 10, 12, 100),
(83, 6, 10, 12, 100),
(84, 6, 10, 12, 100),
(85, 5, 9, 11, 100),
(86, 4, 10, 12, 40),
(87, 4, 9, 11, 0),
(88, 11, 9, 11, 100),
(89, 11, 13, 15, 100),
(90, 13, 9, 11, 100),
(91, 14, 9, 11, 0),
(92, 14, 9, 11, 100),
(93, 15, 9, 11, 100),
(94, 4, 9, 11, 50),
(95, 4, 9, 11, 50),
(96, 15, 9, 11, 50),
(97, 4, 10, 12, 90),
(98, 4, 10, 12, 90),
(99, 4, 9, 11, 50),
(100, 6, 10, 12, 70),
(101, 6, 10, 12, 40);

-- --------------------------------------------------------

--
-- Struktur dari tabel `score_pretest`
--

CREATE TABLE `score_pretest` (
  `id_ScorePreTest` int NOT NULL,
  `id_user` int NOT NULL,
  `id_pretest` int NOT NULL,
  `id_unit` int NOT NULL,
  `score` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `score_pretest`
--

INSERT INTO `score_pretest` (`id_ScorePreTest`, `id_user`, `id_pretest`, `id_unit`, `score`) VALUES
(59, 2, 13, 11, 100),
(60, 3, 13, 11, 100),
(61, 4, 13, 11, 100),
(62, 6, 14, 12, 100),
(63, 4, 14, 12, 60),
(64, 4, 14, 12, 60),
(65, 5, 13, 11, 100),
(66, 4, 17, 15, 100),
(67, 4, 17, 15, 100),
(68, 1, 13, 11, 100),
(69, 9, 14, 12, 100),
(70, 9, 14, 12, 100),
(71, 11, 13, 11, 100),
(72, 11, 17, 15, 100),
(73, 12, 14, 12, 100),
(74, 13, 13, 11, 100),
(75, 14, 13, 11, 100),
(76, 14, 14, 12, 100),
(77, 14, 13, 11, 0),
(78, 14, 13, 11, 0),
(79, 14, 13, 11, 100),
(80, 14, 13, 11, 100),
(81, 15, 13, 11, 100),
(82, 6, 13, 11, 0),
(83, 6, 13, 11, 0),
(84, 6, 13, 11, 0),
(85, 13, 13, 11, 100),
(86, 13, 13, 11, 100),
(87, 13, 13, 11, 0),
(88, 13, 14, 12, 100),
(89, 13, 14, 12, 100),
(90, 13, 13, 11, 0),
(91, 17, 13, 11, 100),
(92, 17, 13, 11, 100),
(93, 17, 13, 11, 100),
(94, 17, 13, 11, 0),
(95, 18, 14, 12, 90),
(96, 18, 13, 11, 100),
(97, 18, 13, 11, 0),
(98, 18, 13, 11, 0),
(99, 18, 13, 11, 100),
(100, 18, 13, 11, 100),
(101, 18, 17, 15, 100),
(102, 20, 13, 11, 100),
(103, 20, 13, 11, 100),
(104, 18, 13, 11, 0),
(105, 18, 13, 11, 100),
(106, 18, 13, 11, 100),
(107, 6, 13, 11, 100),
(108, 6, 13, 11, 100),
(109, 6, 13, 11, 100),
(110, 6, 13, 11, 100),
(111, 6, 13, 11, 100),
(112, 6, 13, 11, 100),
(113, 6, 13, 11, 100),
(114, 6, 14, 12, 60),
(115, 6, 14, 12, 80),
(116, 6, 14, 12, 80),
(117, 6, 14, 12, 30),
(118, 6, 14, 12, 60),
(119, 6, 14, 12, 60),
(120, 6, 13, 11, 100),
(121, 6, 13, 11, 100),
(122, 6, 13, 11, 100),
(123, 6, 13, 11, 0),
(124, 6, 13, 11, 100),
(125, 6, 13, 11, 100),
(126, 6, 14, 12, 90),
(127, 6, 13, 11, 100),
(128, 6, 14, 12, 60),
(129, 6, 14, 12, 60),
(130, 21, 13, 11, 100),
(131, 21, 13, 11, 100),
(132, 21, 13, 11, 100),
(133, 21, 13, 11, 100),
(134, 21, 17, 15, 0),
(135, 21, 13, 11, 100),
(136, 21, 13, 11, 100),
(137, 21, 13, 11, 100),
(138, 21, 13, 11, 100),
(139, 21, 13, 11, 100),
(140, 6, 13, 11, 100),
(141, 22, 13, 11, 100),
(142, 1, 13, 11, 0),
(143, 1, 13, 11, 0),
(144, 1, 13, 11, 0),
(145, 9, 13, 11, 100),
(146, 9, 13, 11, 100),
(147, 4, 13, 11, 100),
(148, 4, 13, 11, 100),
(149, 6, 17, 15, 0),
(150, 4, 14, 12, 50),
(151, 4, 14, 12, 50),
(152, 6, 14, 12, 40),
(153, 6, 13, 11, 100),
(154, 6, 13, 11, 0),
(155, 15, 14, 12, 100),
(156, 15, 14, 12, 100),
(157, 6, 13, 11, 100),
(158, 4, 14, 12, 90),
(159, 4, 13, 11, 100),
(160, 4, 13, 11, 0),
(161, 4, 13, 11, 0),
(162, 6, 14, 12, 90),
(163, 6, 14, 12, 90),
(164, 6, 14, 12, 100),
(165, 23, 13, 11, 0),
(166, 23, 13, 11, 0),
(167, 23, 13, 11, 0),
(168, 23, 13, 11, 0),
(169, 4, 17, 15, 100);

-- --------------------------------------------------------

--
-- Struktur dari tabel `statistic`
--

CREATE TABLE `statistic` (
  `id_statistic` int NOT NULL,
  `id_user` int NOT NULL,
  `id_materi` int NOT NULL,
  `id_unit` int NOT NULL,
  `id_level` int NOT NULL,
  `score_pretest` int NOT NULL,
  `score_posttest` int NOT NULL,
  `imageStatistic` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `unit`
--

CREATE TABLE `unit` (
  `id_unit` int NOT NULL,
  `explanation` text NOT NULL,
  `id_materi` int NOT NULL,
  `title` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `unit`
--

INSERT INTO `unit` (`id_unit`, `explanation`, `id_materi`, `title`) VALUES
(11, 'Pengurangan Dasar', 1, 'Pengurangan Tingkat 01'),
(12, 'Penjumlahan satu angka sangat cocok untuk siswa SD kelas 1 sebagai dasar penjumalahan besar', 2, 'Penjumlahan Satu Angka'),
(15, 'Pembagian Dasar', 4, 'Pembagian Tingkat 1'),
(17, 'Penjumlahan dua angka dengan metode GASING', 2, 'Penjumlahan Dua Angka'),
(18, 'Penjumlahan dua angka dengan metode GASING', 2, 'Penjumlahan Dua Angka'),
(19, 'Penjumlahan dua angka dengan metode GASING', 2, 'Penjumlahan Dua Angka');

-- --------------------------------------------------------

--
-- Struktur dari tabel `unit_bonus`
--

CREATE TABLE `unit_bonus` (
  `id_unit_Bonus` int NOT NULL,
  `title` varchar(225) NOT NULL,
  `explanation` text NOT NULL,
  `id_materi` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `unit_bonus`
--

INSERT INTO `unit_bonus` (`id_unit_Bonus`, `title`, `explanation`, `id_materi`) VALUES
(7, 'Penjumlahan', 'Ayok berlatih lebih banyak tentang penjumlahan', 2),
(9, 'Level Bonus Pengurangan TIngkat 1', 'Pengurangan Dasar', 1),
(10, 'Level Bonus Pembagian 1', 'Pembagian Dasar', 4);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id_user` int NOT NULL,
  `name` varchar(225) NOT NULL,
  `email` varchar(225) NOT NULL,
  `password` varchar(225) NOT NULL,
  `gender` enum('laki-laki','perempuan') NOT NULL,
  `is_active` enum('1','2') NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `lives` int NOT NULL DEFAULT '3'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id_user`, `name`, `email`, `password`, `gender`, `is_active`, `created_at`, `updated_at`, `lives`) VALUES
(1, 'Ray', 'raysiagian17@gmail.com', '$2y$12$nfPdECa3nq1BP/ErRaLI8O7piDU0F6ZwOi2pv2Ia6AWQthOUvr8q.', 'laki-laki', '1', '2024-05-31 00:10:03', '2024-06-13 07:30:04', 3),
(2, 'Joji', 'joji@gmail.com', '$2y$12$J2AEKzboMxgYZXjfuHncf.bLi2kIyT/P5V2h3/jL13ItDUJNvlBO.', 'laki-laki', '2', '2024-05-31 00:37:25', '2024-06-12 20:57:09', 3),
(3, 'Baldwin', 'baldwin@gmail.com', '$2y$12$MCzio3A.vYvpywbwC8dH.eq3lb3NgZfrtd0Uejk6NUTO1rwmbh.Hu', 'laki-laki', '1', '2024-05-31 00:44:32', '2024-06-02 15:21:35', 3),
(4, 'Hans Agung', 'hansagung19@gmail.com', '$2y$12$TMtB3cdP6JQcIO0meJ5yHec5yrLAClc1Nv13u6hAiGROkFfCg9YMi', 'laki-laki', '1', '2024-05-31 00:59:04', '2024-06-02 17:58:27', 2),
(5, 'Rendi', 'rendi@gmail.com', '$2y$12$JzhJz6kMm.rNMV46ItUN7e53D1IABZK0iM08PAZ4uk10h6aDy/RSe', 'laki-laki', '2', '2024-05-31 03:47:56', '2024-06-02 02:08:08', 3),
(6, 'Theresia', 'theresia81@gmail.com', '$2y$12$dJoNajvAHXP/JpKHDnFoHOIqkBsMJfTK2agm3ClplD5YjgS8PYkfm', 'perempuan', '1', '2024-06-01 04:46:21', '2024-06-12 00:38:31', 2),
(7, 'jens', 'jens@gmail.com', '$2y$12$3Jh1m3076x34Mcj0UW2vkOLtnoszAJ9GxcSqrLDjVHjO5A3N3P6NK', 'perempuan', '2', '2024-06-02 05:16:49', '2024-06-02 06:33:21', 3),
(8, 'era', 'era@gmail.com', '$2y$12$RDXOVMCx8O/Chmd.0yLVYeDiO9rVctaVASFiSBtAqWPPkjlGB/RaS', 'perempuan', '1', '2024-06-03 02:52:53', '2024-06-03 02:52:53', 3),
(9, 'Ray Siagian', 'raysiagian7@gmail.com', '$2y$12$w3tr57DspiBpujNJtJo0VOmuYLmnRKYqY9mEa86ke6uDZI6uSv6Lu', 'laki-laki', '1', '2024-06-05 20:52:35', '2024-06-05 20:52:35', 3),
(10, 'Ray Siagian', 'raysiagian7@gmail.com', '$2y$12$OefAHFrjLyp3fr2Y/qqfS.lm1pAJym/OvgSbz4GvdLdqN5fUzvoeW', 'laki-laki', '1', '2024-06-05 20:52:35', '2024-06-05 20:52:35', 3),
(11, 'Dini', 'dinisipahutar2017@gmail.com', '$2y$12$NHbubzubH5MQ8X12E/U8SOspqH7PK4Uc/83pswzXMlNU0ntX0ebg6', 'perempuan', '1', '2024-06-06 23:32:17', '2024-06-09 19:56:02', 2),
(12, 'Nolan', 'nolan@gmail.com', '$2y$12$T1DCeQyftfRj2B/3N7sYUOtZwjA9aCWCtP1EMfh2B.5rGJ1XAr.fy', 'laki-laki', '1', '2024-06-11 01:17:21', '2024-06-11 01:17:21', 3),
(13, 'Josua Oloan', 'josua@gmail.com', '$2y$12$kKsjYMor.AnlNviuYrRHHu6nnp6me5PLqXWlrPO06Qj3BgFx4HF6m', 'laki-laki', '1', '2024-06-11 01:24:01', '2024-06-11 01:24:01', 3),
(14, 'irene', 'irene@gmail.com', '$2y$12$2iIwK9Xe1qz9oT6BaEt9R.kqak0hJ6woIOGHOWevtZXzCqeArkwoe', 'perempuan', '1', '2024-06-11 01:51:31', '2024-06-11 02:14:17', 2),
(15, 'sri', 'sri@gmail.com', '$2y$12$ArzgD/W4Bo9ZjRUuBgbpVOytM4ItNRaMHaoaKIZ5nHtnNSddCxFoa', 'perempuan', '1', '2024-06-11 17:57:46', '2024-06-11 18:00:23', 1),
(16, 'Esticka', 'Estickas@gmail.com', '$2y$12$RntsAhAtw6lTEWVSTB3WzOK7MgtOisj7M87vl2nxszJmfuMhho8Ei', 'perempuan', '1', '2024-06-11 19:35:19', '2024-06-11 19:35:19', 3),
(17, 'ripandi', 'gamalielwahyudi@gmail.com', '$2y$12$6HFwQ85Sv77my.1zKRii6OjAhuctTn7VTK0C1v6h9L/eJpdMEPhIK', 'laki-laki', '1', '2024-06-11 19:39:11', '2024-06-11 19:39:11', 3),
(18, 'ruthhel', 'ruthsinambela4@gmail.com', '$2y$12$wlwRsyyfT930dAfxSfdXc.qzC/qyX6MqxgcRp3n6F/3PIKrcs6hRW', 'perempuan', '1', '2024-06-11 19:52:01', '2024-06-11 19:52:01', 3),
(19, 'ruthhel', 'ruthsinambela4@gmail.com', '$2y$12$ckHoLMYum2ulcuPRzG.H/.lPBbnQWFgv9nmO.W4WSD1BiOTrOEhqi', 'perempuan', '1', '2024-06-11 19:52:02', '2024-06-11 19:52:02', 3),
(20, 'Boas Turnip', 'boasrayhanturnip@gmail.com', '$2y$12$425JQ4/UzCm5w43kwMGBx.IqW/uRvE0gWRXXJbQE8gbYOcRj4pUtG', 'laki-laki', '1', '2024-06-11 20:04:24', '2024-06-11 20:04:24', 3),
(21, 'Grace Yosheva', 'graceyosheva0@gmail.com', '$2y$12$8lieGLGqQQxeJnN9m8XWdeK9WArxH2wRmrqf4Nd7QQyUlyJAe38Se', 'perempuan', '1', '2024-06-11 20:38:33', '2024-06-11 20:38:33', 3),
(22, 'there', 'theresia2@gmail.com', '$2y$12$RsdF/.8jCvtElqn1ccsV9ebsinicM8bg/w7ij6pCZ2Kcr1ZG.1nB.', 'perempuan', '1', '2024-06-11 21:05:32', '2024-06-11 21:05:32', 3),
(23, 'rachel', 'ririsrachel@gmail.com', '$2y$12$3DJSVEbZjJPLy2c2dwlBT.XpidFyf2JMBIN42cIGVUBBpLh9yT74O', 'perempuan', '1', '2024-06-12 01:19:13', '2024-06-12 01:21:42', 1),
(24, 'jensrijoice', 'jensrijoicejjs29@gmail.com', '$2y$12$.OYL29w/Zui5tBONeT2hMegtLQ1klvIa0i0mhyaY2Ydy7WtTkAapS', 'perempuan', '1', '2024-06-12 19:52:12', '2024-06-12 19:52:12', 3),
(25, 'syaloom', 'syaloom@gmail.com', '$2y$12$KwJzLcnuVFndzKWJ1n2aEuiWibi3kx8im.F2xPSVsyyJXSs3AUzQu', 'perempuan', '1', '2024-06-13 06:39:32', '2024-06-13 13:40:27', 3);

-- --------------------------------------------------------

--
-- Struktur dari tabel `watch_material_video`
--

CREATE TABLE `watch_material_video` (
  `id_unit` int NOT NULL,
  `id_WatchMaterialVideo` int NOT NULL,
  `id_user` int NOT NULL,
  `id_material_video` int NOT NULL,
  `is_completed` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `watch_material_video`
--

INSERT INTO `watch_material_video` (`id_unit`, `id_WatchMaterialVideo`, `id_user`, `id_material_video`, `is_completed`) VALUES
(11, 1, 2, 12, 1),
(11, 2, 3, 12, 1),
(11, 3, 3, 12, 1),
(11, 4, 4, 12, 1),
(12, 5, 6, 13, 1),
(12, 6, 6, 13, 1),
(11, 7, 5, 12, 1),
(12, 8, 4, 13, 1),
(11, 9, 4, 12, 1),
(11, 10, 11, 12, 1),
(15, 11, 11, 15, 1),
(11, 12, 13, 12, 1),
(11, 13, 14, 12, 1),
(11, 14, 15, 12, 1),
(12, 15, 6, 13, 1);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `badge`
--
ALTER TABLE `badge`
  ADD PRIMARY KEY (`id_bagde`),
  ADD KEY `fromMateri` (`id_materi`),
  ADD KEY `fromPenggunaWeb` (`id_penggunaWeb`),
  ADD KEY `fromPostTest3` (`id_posttest`);

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indeks untuk tabel `lencana_pengguna`
--
ALTER TABLE `lencana_pengguna`
  ADD PRIMARY KEY (`id_LencanaPengguna`),
  ADD KEY `fromUser` (`id_user`),
  ADD KEY `fromBadge` (`id_bagde`);

--
-- Indeks untuk tabel `level`
--
ALTER TABLE `level`
  ADD PRIMARY KEY (`id_level`),
  ADD KEY `id_unit` (`id_unit`),
  ADD KEY `fromMateri5` (`id_materi`);

--
-- Indeks untuk tabel `level_bonus`
--
ALTER TABLE `level_bonus`
  ADD PRIMARY KEY (`id_level_bonus`),
  ADD KEY `id_unit_Bonus` (`id_unit_Bonus`);

--
-- Indeks untuk tabel `materi`
--
ALTER TABLE `materi`
  ADD PRIMARY KEY (`id_materi`),
  ADD KEY `fromPenggunaWeb2` (`id_penggunaWeb`);

--
-- Indeks untuk tabel `material_video`
--
ALTER TABLE `material_video`
  ADD PRIMARY KEY (`id_material_video`),
  ADD KEY `id_level` (`id_unit`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indeks untuk tabel `penggunaweb`
--
ALTER TABLE `penggunaweb`
  ADD PRIMARY KEY (`id_penggunaWeb`);

--
-- Indeks untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indeks untuk tabel `posttest`
--
ALTER TABLE `posttest`
  ADD PRIMARY KEY (`id_posttest`),
  ADD KEY `fromUnit4` (`id_unit`);

--
-- Indeks untuk tabel `pretest`
--
ALTER TABLE `pretest`
  ADD PRIMARY KEY (`id_pretest`),
  ADD KEY `fromUnit1` (`id_unit`);

--
-- Indeks untuk tabel `question_level_bonus`
--
ALTER TABLE `question_level_bonus`
  ADD PRIMARY KEY (`id_question_level_bonus`),
  ADD KEY `fromlevelBonus` (`id_level_bonus`);

--
-- Indeks untuk tabel `question_posttest`
--
ALTER TABLE `question_posttest`
  ADD PRIMARY KEY (`id_question_posttest`),
  ADD KEY `fromPostTest` (`id_posttest`);

--
-- Indeks untuk tabel `question_pretest`
--
ALTER TABLE `question_pretest`
  ADD PRIMARY KEY (`id_question_pretest`),
  ADD KEY `fromPreTest` (`id_pretest`);

--
-- Indeks untuk tabel `score_level_bonus`
--
ALTER TABLE `score_level_bonus`
  ADD PRIMARY KEY (`id_ScoreLevelBonus`),
  ADD KEY `toUser3` (`id_level_bonus`),
  ADD KEY `fromUnit7` (`id_unit`);

--
-- Indeks untuk tabel `score_posttest`
--
ALTER TABLE `score_posttest`
  ADD PRIMARY KEY (`id_ScorePostTest`),
  ADD KEY `FromUser3` (`id_user`),
  ADD KEY `fromUnit3` (`id_unit`),
  ADD KEY `fromPostTest2` (`id_posttest`);

--
-- Indeks untuk tabel `score_pretest`
--
ALTER TABLE `score_pretest`
  ADD PRIMARY KEY (`id_ScorePreTest`),
  ADD KEY `FromUser2` (`id_user`),
  ADD KEY `FromPreTest3` (`id_pretest`),
  ADD KEY `fromUnit2` (`id_unit`);

--
-- Indeks untuk tabel `statistic`
--
ALTER TABLE `statistic`
  ADD PRIMARY KEY (`id_statistic`),
  ADD KEY `fromUserStat` (`id_user`),
  ADD KEY `fromMateri2` (`id_materi`);

--
-- Indeks untuk tabel `unit`
--
ALTER TABLE `unit`
  ADD PRIMARY KEY (`id_unit`),
  ADD KEY `fromMateri3` (`id_materi`);

--
-- Indeks untuk tabel `unit_bonus`
--
ALTER TABLE `unit_bonus`
  ADD PRIMARY KEY (`id_unit_Bonus`),
  ADD KEY `fromMateri4` (`id_materi`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- Indeks untuk tabel `watch_material_video`
--
ALTER TABLE `watch_material_video`
  ADD PRIMARY KEY (`id_WatchMaterialVideo`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_unit` (`id_unit`),
  ADD KEY `id_material_video` (`id_material_video`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `badge`
--
ALTER TABLE `badge`
  MODIFY `id_bagde` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `lencana_pengguna`
--
ALTER TABLE `lencana_pengguna`
  MODIFY `id_LencanaPengguna` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT untuk tabel `level`
--
ALTER TABLE `level`
  MODIFY `id_level` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `level_bonus`
--
ALTER TABLE `level_bonus`
  MODIFY `id_level_bonus` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `materi`
--
ALTER TABLE `materi`
  MODIFY `id_materi` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `material_video`
--
ALTER TABLE `material_video`
  MODIFY `id_material_video` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT untuk tabel `penggunaweb`
--
ALTER TABLE `penggunaweb`
  MODIFY `id_penggunaWeb` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=499;

--
-- AUTO_INCREMENT untuk tabel `posttest`
--
ALTER TABLE `posttest`
  MODIFY `id_posttest` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT untuk tabel `pretest`
--
ALTER TABLE `pretest`
  MODIFY `id_pretest` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT untuk tabel `question_level_bonus`
--
ALTER TABLE `question_level_bonus`
  MODIFY `id_question_level_bonus` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `question_posttest`
--
ALTER TABLE `question_posttest`
  MODIFY `id_question_posttest` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT untuk tabel `question_pretest`
--
ALTER TABLE `question_pretest`
  MODIFY `id_question_pretest` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT untuk tabel `score_level_bonus`
--
ALTER TABLE `score_level_bonus`
  MODIFY `id_ScoreLevelBonus` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `score_posttest`
--
ALTER TABLE `score_posttest`
  MODIFY `id_ScorePostTest` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=102;

--
-- AUTO_INCREMENT untuk tabel `score_pretest`
--
ALTER TABLE `score_pretest`
  MODIFY `id_ScorePreTest` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=170;

--
-- AUTO_INCREMENT untuk tabel `statistic`
--
ALTER TABLE `statistic`
  MODIFY `id_statistic` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `unit`
--
ALTER TABLE `unit`
  MODIFY `id_unit` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT untuk tabel `unit_bonus`
--
ALTER TABLE `unit_bonus`
  MODIFY `id_unit_Bonus` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT untuk tabel `watch_material_video`
--
ALTER TABLE `watch_material_video`
  MODIFY `id_WatchMaterialVideo` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `badge`
--
ALTER TABLE `badge`
  ADD CONSTRAINT `fromMateri` FOREIGN KEY (`id_materi`) REFERENCES `materi` (`id_materi`),
  ADD CONSTRAINT `fromPenggunaWeb` FOREIGN KEY (`id_penggunaWeb`) REFERENCES `penggunaweb` (`id_penggunaWeb`),
  ADD CONSTRAINT `fromPostTest3` FOREIGN KEY (`id_posttest`) REFERENCES `posttest` (`id_posttest`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `lencana_pengguna`
--
ALTER TABLE `lencana_pengguna`
  ADD CONSTRAINT `fromBadge` FOREIGN KEY (`id_bagde`) REFERENCES `badge` (`id_bagde`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fromUser` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`);

--
-- Ketidakleluasaan untuk tabel `level_bonus`
--
ALTER TABLE `level_bonus`
  ADD CONSTRAINT `fromUnitBonus` FOREIGN KEY (`id_unit_Bonus`) REFERENCES `unit_bonus` (`id_unit_Bonus`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `materi`
--
ALTER TABLE `materi`
  ADD CONSTRAINT `fromPenggunaWeb2` FOREIGN KEY (`id_penggunaWeb`) REFERENCES `penggunaweb` (`id_penggunaWeb`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `material_video`
--
ALTER TABLE `material_video`
  ADD CONSTRAINT `fromUnit5` FOREIGN KEY (`id_unit`) REFERENCES `unit` (`id_unit`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `posttest`
--
ALTER TABLE `posttest`
  ADD CONSTRAINT `fromUnit4` FOREIGN KEY (`id_unit`) REFERENCES `unit` (`id_unit`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `pretest`
--
ALTER TABLE `pretest`
  ADD CONSTRAINT `fromUnit1` FOREIGN KEY (`id_unit`) REFERENCES `unit` (`id_unit`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `question_level_bonus`
--
ALTER TABLE `question_level_bonus`
  ADD CONSTRAINT `fromlevelBonus` FOREIGN KEY (`id_level_bonus`) REFERENCES `level_bonus` (`id_level_bonus`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `question_posttest`
--
ALTER TABLE `question_posttest`
  ADD CONSTRAINT `fromPostTest` FOREIGN KEY (`id_posttest`) REFERENCES `posttest` (`id_posttest`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `question_pretest`
--
ALTER TABLE `question_pretest`
  ADD CONSTRAINT `fromPreTest` FOREIGN KEY (`id_pretest`) REFERENCES `pretest` (`id_pretest`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `score_level_bonus`
--
ALTER TABLE `score_level_bonus`
  ADD CONSTRAINT `fromUnit7` FOREIGN KEY (`id_unit`) REFERENCES `unit_bonus` (`id_unit_Bonus`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `toUser3` FOREIGN KEY (`id_level_bonus`) REFERENCES `level_bonus` (`id_level_bonus`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `score_posttest`
--
ALTER TABLE `score_posttest`
  ADD CONSTRAINT `fromPostTest2` FOREIGN KEY (`id_posttest`) REFERENCES `posttest` (`id_posttest`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fromUnit3` FOREIGN KEY (`id_unit`) REFERENCES `unit` (`id_unit`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FromUser3` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `score_pretest`
--
ALTER TABLE `score_pretest`
  ADD CONSTRAINT `FromPreTest3` FOREIGN KEY (`id_pretest`) REFERENCES `pretest` (`id_pretest`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fromUnit2` FOREIGN KEY (`id_unit`) REFERENCES `unit` (`id_unit`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FromUser2` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `statistic`
--
ALTER TABLE `statistic`
  ADD CONSTRAINT `fromMateri2` FOREIGN KEY (`id_materi`) REFERENCES `materi` (`id_materi`),
  ADD CONSTRAINT `fromUserStat` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`);

--
-- Ketidakleluasaan untuk tabel `unit`
--
ALTER TABLE `unit`
  ADD CONSTRAINT `fromMateri3` FOREIGN KEY (`id_materi`) REFERENCES `materi` (`id_materi`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `unit_bonus`
--
ALTER TABLE `unit_bonus`
  ADD CONSTRAINT `fromMateri4` FOREIGN KEY (`id_materi`) REFERENCES `materi` (`id_materi`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `watch_material_video`
--
ALTER TABLE `watch_material_video`
  ADD CONSTRAINT `fromUser10` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `watch_material_video_ibfk_2` FOREIGN KEY (`id_unit`) REFERENCES `unit` (`id_unit`),
  ADD CONSTRAINT `watch_material_video_ibfk_3` FOREIGN KEY (`id_material_video`) REFERENCES `material_video` (`id_material_video`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
