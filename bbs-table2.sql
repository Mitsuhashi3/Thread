-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- ホスト: 127.0.0.1
-- 生成日時: 2024-03-28 21:57:13
-- サーバのバージョン： 10.4.24-MariaDB
-- PHP のバージョン: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- データベース: `bbs-yt2`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `bbs-table2`
--

CREATE TABLE `bbs-table2` (
  `id` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `comment` text NOT NULL,
  `postDate` datetime NOT NULL,
  `IDname` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- テーブルのデータのダンプ `bbs-table2`
--

INSERT INTO `bbs-table2` (`id`, `username`, `comment`, `postDate`, `IDname`) VALUES
(1, 'cU7IHr8XH', 'おはよう', '2024-03-28 21:52:27', 'mN5lcyq2x'),
(2, 'まー', 'こんにちは', '2024-03-28 21:52:47', 'C6xkX8fFj'),
(3, 'IP0RwgkSg', 'どうも', '2024-03-28 21:53:03', 'AI3hOFpk0'),
(4, 'いぇさーー', 'こんばんは', '2024-03-28 21:53:29', 'ct3ISvwpm');

--
-- ダンプしたテーブルのインデックス
--

--
-- テーブルのインデックス `bbs-table2`
--
ALTER TABLE `bbs-table2`
  ADD PRIMARY KEY (`id`);

--
-- ダンプしたテーブルの AUTO_INCREMENT
--

--
-- テーブルの AUTO_INCREMENT `bbs-table2`
--
ALTER TABLE `bbs-table2`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
