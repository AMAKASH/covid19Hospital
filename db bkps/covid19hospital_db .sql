-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 16, 2023 at 03:45 PM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `covid19hospital_db`
--

--
-- Dumping data for table `appointments`
--

INSERT INTO `appointments` (`id`, `user_id`, `hospital_id`, `doctor_id`, `patient_name`, `blood_group`, `gender`, `weight`, `dob`, `status`, `comments`, `created_at`, `updated_at`) VALUES
(1, 2, 2, 1, 'Patient name 13', 'B+', 'Male', 72, '2023-02-24', 'Canceled', 'Patient Did not Recieve Call', '2023-02-04 10:46:56', '2023-02-13 10:33:54'),
(2, 8, 2, 4, 'random name', 'B+', 'Female', 72, '2022-11-16', 'Missed', 'Patient did not come', '2023-02-16 14:29:53', '2023-02-16 14:35:56');

--
-- Dumping data for table `areas`
--

INSERT INTO `areas` (`id`, `area_name`, `created_at`, `updated_at`) VALUES
(1, 'area1', '2023-02-01 09:06:10', '2023-02-01 09:06:10'),
(2, 'area2', '2023-02-01 09:06:10', '2023-02-01 09:06:10'),
(3, 'area3', '2023-02-01 09:06:10', '2023-02-01 09:06:10'),
(4, 'area4', '2023-02-01 09:06:10', '2023-02-01 09:06:10'),
(5, 'area5', '2023-02-01 09:06:10', '2023-02-01 09:06:10');

--
-- Dumping data for table `doctors`
--

INSERT INTO `doctors` (`id`, `name`, `specialty`, `qualification`, `created_at`, `updated_at`) VALUES
(1, 'Doctor One', 'ENT (Ear, Nose, Throat) Specialist & Head Neck Surgeon', 'MBBS, BCS (Health), DLO (ENT)', '2023-02-02 20:25:46', '2023-02-02 20:25:46'),
(2, 'Doctor Two', 'Dermatology (Skin, Allergy, Leprosy, Hair) & Medicine Specialist', 'MBBS, BCS (Health), DDV (BSMMU), DMU, CCD (BIRDEM)', '2023-02-02 20:25:46', '2023-02-02 20:25:46'),
(3, 'Doctor Three', 'CC-CD (National Heart Foundation), Diabetic Footcare Training (CMC Vellore, India)', 'MBBS (Dhaka), CCD (Diabetes, BIRDEM)', '2023-02-02 20:27:32', '2023-02-02 20:27:32'),
(4, 'Doctor Four', 'Chest Diseases, Asthma, Allergy, TB & Respiratory Medicine Specialist', 'MBBS (DMC), BCS (Health), MD (Chest), MCPS (Medicine), DTCD (Chest), FCCP (USA)', '2023-02-02 20:27:32', '2023-02-02 20:27:32');

--
-- Dumping data for table `doctor_hospital`
--

INSERT INTO `doctor_hospital` (`id`, `hospital_id`, `doctor_id`, `created_at`, `updated_at`) VALUES
(3, 3, 1, NULL, NULL),
(4, 3, 3, NULL, NULL),
(5, 3, 4, NULL, NULL),
(6, 2, 4, NULL, NULL),
(8, 2, 1, NULL, NULL),
(11, 5, 1, NULL, NULL),
(12, 5, 3, NULL, NULL),
(13, 2, 2, NULL, NULL),
(14, 6, 4, NULL, NULL),
(15, 6, 1, NULL, NULL),
(16, 6, 3, NULL, NULL),
(17, 6, 2, NULL, NULL);

--
-- Dumping data for table `hospitals`
--

INSERT INTO `hospitals` (`id`, `user_id`, `name`, `license_number`, `address`, `area_id`, `general_bed`, `icu_bed`, `oxygen_suppply_availability`, `covid_vaccine_availability`, `created_at`, `updated_at`) VALUES
(2, 3, 'Hospital One', '12345678910', 'Mehnaz Mansur Tower 11/A, Ground Floor Road No: 130, Gulshan 1. Dhaka, 1212', 1, 52, 20, 'No', 'Yes', '2023-02-01 15:14:44', '2023-02-16 14:33:17'),
(3, 4, 'Hospital Two', '12345678910', 'Mehnaz Mansur Tower 11/A, Ground Floor Road No: 130, Gulshan 1. Dhaka, 1212', 1, 75, 20, 'Yes', 'No', '2023-02-01 15:14:44', '2023-02-01 15:14:44'),
(5, 7, 'Hospital 3', '12345678', 'dummy address 1', 2, 45, 30, 'Yes', 'Yes', '2023-02-13 13:39:48', '2023-02-13 13:39:48'),
(6, 9, 'Hospital Test', '12345678654', 'Random address sometuing s', 4, 25, 10, 'Yes', 'No', '2023-02-16 14:39:36', '2023-02-16 14:39:36');

--
-- Dumping data for table `hospital_test_name`
--

INSERT INTO `hospital_test_name` (`id`, `test_name_id`, `hospital_id`) VALUES
(1, 1, 2),
(4, 2, 3),
(5, 4, 3),
(6, 5, 3),
(12, 6, 2),
(13, 1, 5),
(14, 2, 5),
(15, 3, 5),
(16, 4, 2),
(17, 5, 2),
(18, 1, 6),
(19, 2, 6),
(20, 3, 6),
(21, 4, 6),
(22, 5, 6),
(23, 6, 6);

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_100000_create_password_resets_table', 1),
(2, '2019_08_19_000000_create_failed_jobs_table', 1),
(3, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(4, '2023_01_31_000000_create_roles_table', 1),
(5, '2023_01_31_000001_create_test_names_table', 1),
(6, '2023_01_31_000002_create_doctors_table', 1),
(7, '2023_01_31_000003_create_users_table', 1),
(8, '2023_01_31_000004_create_hospitals_table', 1),
(9, '2023_01_31_000006_create_hospital_test_table', 1),
(10, '2023_01_31_000007_create_tests_table', 1),
(11, '2023_01_31_000008_create_doctor_hospital_table', 1),
(12, '2023_01_31_155833_create_appointments_table', 1),
(13, '2023_01_31_183524_create_areas_table', 1);

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Administrator', NULL, NULL),
(2, 'Hospital', NULL, NULL),
(3, 'Patient', NULL, NULL);

--
-- Dumping data for table `tests`
--

INSERT INTO `tests` (`id`, `user_id`, `hospital_id`, `test_name_id`, `patient_name`, `blood_group`, `gender`, `weight`, `dob`, `status`, `comments`, `test_report_path`, `created_at`, `updated_at`) VALUES
(1, 2, 2, 2, 'Patient name 1', 'A+', 'Male', NULL, '2023-03-01', 'Completed', 'collect data', 'reports/THgk34ynB6T5F5zbncx4m05C0hzuRgXwZQTsuuwy.pdf', '2023-02-04 10:15:59', '2023-02-16 14:15:03'),
(3, 8, 2, 2, 'random name', 'A+', 'Male', 75, '2000-02-23', 'Completed', 'Test completed please collect report', 'reports/38CBcweLmRYjnflDCZwWCVVEfGI1ea8wgtN5aMkW.pdf', '2023-02-16 14:27:04', '2023-02-16 14:35:22');

--
-- Dumping data for table `test_names`
--

INSERT INTO `test_names` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Test 1', '2023-02-02 18:16:08', '2023-02-02 18:16:08'),
(2, 'Test 2', '2023-02-02 18:16:08', '2023-02-02 18:16:08'),
(3, 'Test 3', '2023-02-02 18:16:08', '2023-02-02 18:16:08'),
(4, 'Test 4', '2023-02-02 18:16:08', '2023-02-02 18:16:08'),
(5, 'Test 5', '2023-02-02 18:16:08', '2023-02-02 18:16:08'),
(6, 'Test 6', '2023-02-02 18:16:08', '2023-02-02 18:16:08');

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `email`, `verified_at`, `role_id`, `password`, `nid_number`, `phone_number`, `covid_vaccination_status`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin', 'admin@covid19hospital.com', '2023-02-01 15:08:27', 1, '$2y$10$LNAEW/43yBigrGLe4vtpF.BZde1drsks6ak8L.Mwciv6S9HgQEnjK', 'N/A', '010000000000', 1, 'ZC5WWAym4yiNm0uKIxqbFCGUieh4SVXhr3cDD22HrfDcqt4hulw04tJaa7IF', '2023-02-01 15:08:27', '2023-02-06 13:43:18'),
(2, 'Patient1', 'pat001', 'patient1@gmail.com', '2023-02-01 15:08:27', 3, '$2y$10$QHq5LkPQx3agm9RdB2RYJuKn/g.jaFcj1ssKpqRw0S8.qkSZq7GIa', '0123456789520', '01973054376', 1, NULL, '2023-02-01 15:08:27', '2023-02-06 13:08:36'),
(3, 'Hospital One', 'hos001', 'hospital1@gmail.com', '2023-02-02 18:00:00', 2, '$2y$10$H4uAjPh95SMNd7awzTx3IOOsqDG.V1Yce8XkAv1lTDxng2knsLzV2', 'N/A', '019700000', 0, NULL, '2023-02-01 15:12:27', '2023-02-13 00:21:20'),
(4, 'Hospital Two', 'hos002', 'hospital2@gmail.com', '2023-02-02 18:00:00', 2, '$2a$12$N7NwoIKcQJdAPbVOM4V3ZeF9nJu2aitgExqBBYPIEFIN6y/kwO9am', 'N/A', '01970000000', 0, NULL, '2023-02-01 15:12:27', '2023-02-01 15:12:27'),
(7, 'Hospital 3', 'hos005', 'hospital3@gmail.com', '2023-02-13 13:42:27', 2, '$2y$10$kngnzs1BBs3gR8LzUwOL7OONxcP6RS074MxnJI.wtjlcAwjosRN8q', '01923456789745612', '01987654321', 0, NULL, '2023-02-13 13:39:19', '2023-02-13 13:39:19'),
(8, 'Patient 12', 'pat006', 'patient12@gmail.com', NULL, 3, '$2y$10$FyYBFtnbK5xicfqeOLloNeRPMoMQQn6KFnRUdKjahfw.PGHcSfecG', '01923456789745616', '01973054375', 0, NULL, '2023-02-16 14:25:48', '2023-02-16 14:25:48'),
(9, 'Hospital Test', 'hos007', 'hospitaltest@email.com', '2023-02-15 18:00:00', 2, '$2y$10$kkEqcAUbu7d/UzYX/0QdeuMZSqa5gXnpm3xkggxbEphYK61EPI9CK', '01923456789745615', '01790000000', 0, NULL, '2023-02-16 14:37:57', '2023-02-16 14:37:57');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
