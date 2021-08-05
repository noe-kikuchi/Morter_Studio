-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- ホスト: localhost:3306
-- 生成日時: 2021 年 8 月 05 日 22:40
-- サーバのバージョン： 5.7.32
-- PHP のバージョン: 7.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- データベース: `morterstudio`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `bikes`
--

CREATE TABLE `bikes` (
  `id` int(11) NOT NULL COMMENT 'バイクid',
  `title` varchar(800) NOT NULL COMMENT 'タイトル',
  `model` char(60) DEFAULT NULL COMMENT '車種',
  `model_year` varchar(10) NOT NULL COMMENT '年式',
  `manufacturer` char(60) DEFAULT NULL COMMENT 'メーカー',
  `custom` char(60) DEFAULT NULL COMMENT 'カスタム',
  `introduction` varchar(2000) DEFAULT NULL COMMENT '説明文',
  `image` varchar(100) DEFAULT NULL COMMENT '画像',
  `url` varchar(1000) NOT NULL COMMENT 'URL',
  `user_id` int(11) DEFAULT NULL COMMENT 'ユーザーID'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- テーブルのデータのダンプ `bikes`
--

INSERT INTO `bikes` (`id`, `title`, `model`, `model_year`, `manufacturer`, `custom`, `introduction`, `image`, `url`, `user_id`) VALUES
(15, 'エアクリの掃除', 'XL1200X', '2014', 'Harley-Davidson', 'エンジン', 'エアクリの掃除にはK＆Nのクリーナーと新しく乾式エアクリを装着。\r\n結構汚れていました。', 'IMG_0146.jpg', 'https://www.google.com', 9),
(19, 'タイヤ装飾', 'XL1200X', '2014', 'Harley-Davidson', '足回り', 'オレンジのタイヤペンでハーレーのロゴを塗り、ホイールにシールを装着しました。\r\nいい感じです。', 'DSC_0047.jpg', 'https://www.google.com', 9),
(26, 'テックサーフマフラー', 'GPZ900R', '1996', 'カワサキ', 'マフラー', 'テックサーフのカーボンマフラーを装着しています。バッフルが六角レンチで着脱可能になっており、外すと音がよくなります。\r\nバッフルを装着した状態では、車検が通ります。', '1627362213810.jpg', 'https://www.google.com', 8),
(27, 'アップハンド', 'GPZ900R', '1996', 'カワサキ', 'ハンドル', 'アップハンドにしています。ライディングポジションが楽になりました。長距離でも首や腰も疲れなくていいです。', 'IMG_2238-1.jpg', 'https://www.google.com', 8),
(28, 'テールランプ変更', 'XL1200X', '2014', 'Harley-Davidson', '電装系', 'テールランプを変更しました。粘着テープで装着しているタイプのものになるので、夏場は落ちてしまいますが、スマートでかっこいいと思います。', 'IMG_0045.jpg', 'https://www.google.com', 9),
(29, 'キャリア装着', 'KLX１２５', '2014', 'カワサキ', '外装', 'キャリアをつけました。１.７kg程度ほどしか積載できませんが、これでキャンプの荷物を積もうと思います。', 'IMG_4416.jpg', 'https://www.google.com', 11),
(30, 'GPZ900R シートあんこ抜き', 'GPZ900R', '1996', 'カワサキ', '外装', 'シートのあんこを抜きました。足つきがだいぶ良くなりました。\r\n', 'DSC_0559.jpg', 'https://www.google.com', 8),
(31, 'ホイール装飾　', 'KLX１２５', '2014', 'カワサキ', '足回り', 'ホイールにチューブをはめています。', 'IMG_2320.jpg', 'https://www.google.com', 11),
(57, 'ZRX1200 DAEG ビートマフラー装着', 'ZRX1200 DAEG', '2016', 'カワサキ', 'マフラー', 'ビートのマフラー装着。音がいいです。タンデムステップの位置を変えなければ装着できません。', '57.jpg', 'https://www.google.com', 13);

-- --------------------------------------------------------

--
-- テーブルの構造 `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL COMMENT 'コメントID',
  `comment` varchar(1600) DEFAULT NULL COMMENT 'コメント',
  `created_at` datetime DEFAULT NULL COMMENT '投稿日時',
  `bike_id` int(11) DEFAULT NULL COMMENT 'バイクID',
  `user_id` int(11) DEFAULT NULL COMMENT 'ユーザーID'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- テーブルの構造 `likes`
--

CREATE TABLE `likes` (
  `id` int(11) NOT NULL COMMENT 'いいねid',
  `bike_id` int(11) DEFAULT NULL COMMENT 'バイクid',
  `user_id` int(11) DEFAULT NULL COMMENT 'ユーザーid'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- テーブルのデータのダンプ `likes`
--

INSERT INTO `likes` (`id`, `bike_id`, `user_id`) VALUES
(63, 26, 11),
(78, 15, 11),
(80, 27, 11),
(81, 20, 11),
(82, 25, 11),
(86, 19, 9),
(87, 28, 13),
(88, 19, 13),
(89, 31, 11),
(90, 31, 13),
(91, 30, 13),
(92, 33, 13),
(93, 30, 11);

-- --------------------------------------------------------

--
-- テーブルの構造 `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL COMMENT 'ユーザーid',
  `name` char(11) DEFAULT NULL COMMENT 'ユーザー名',
  `email` char(100) DEFAULT NULL COMMENT 'Eメール',
  `password` char(100) DEFAULT NULL,
  `my_bike` char(100) DEFAULT NULL,
  `role` int(11) DEFAULT '0',
  `pass_reset_token` varchar(50) NOT NULL DEFAULT 'no' COMMENT 'パスリセットトークン',
  `reset_date` datetime DEFAULT NULL COMMENT 'リセット日時'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- テーブルのデータのダンプ `user`
--

INSERT INTO `user` (`id`, `name`, `email`, `password`, `my_bike`, `role`, `pass_reset_token`, `reset_date`) VALUES
(1, 'admin', 'admin@admin.com', '$2y$10$edkdDUILg3LVbi0Rmaz9VuT2kjnEUBA0ls2RfjgHeJt19rHc4roM6', '', 0, '0', NULL),
(6, 'めめ', 'test@test4.com', '$2y$10$qC5B9qFWVMkVSJCyHMbnJe7BAbccKZ/HArCDLz2cPy4gujanpSDSm', 'a', 1, '0', NULL),
(8, 'もうすけ', 'test@test1.com', '$2y$10$vaE8BE2tEWlTbQi4n8FB3OAqFmmtVfKDFgJVMUQXI68n3oINTkXV2', 'GPZ900R', 1, '0', NULL),
(9, 'みいすけ', 'test@test2.com', '$2y$10$otflR4Iz3ZnSCoXrePX7CevZwRrXGRtYouPmPUycNo5zE48RBxx5K', 'ハーレー　XL1200X', 1, '0', NULL),
(11, 'ムゥこ', 'test@test3.com', '$2y$10$YL90uiZiTvseY/jOF4evZ.2QZN98T0msyRXJYy24iJoQMrlnye4Wm', 'カワサキKLX125', 1, 'a705e59ac6cb47d7fea8bd978bc55c76', '2021-07-24 21:56:41'),
(15, 'まぁ', 'test@test5.com', '$2y$10$dNS.K6SNPMiv6SNi3xzYmOAKmytYiZd5nFjbbBiI/FseUOs962m82', '', 1, 'no', NULL);

--
-- ダンプしたテーブルのインデックス
--

--
-- テーブルのインデックス `bikes`
--
ALTER TABLE `bikes`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `likes`
--
ALTER TABLE `likes`
  ADD UNIQUE KEY `id` (`id`);

--
-- テーブルのインデックス `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- ダンプしたテーブルの AUTO_INCREMENT
--

--
-- テーブルの AUTO_INCREMENT `bikes`
--
ALTER TABLE `bikes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'バイクid', AUTO_INCREMENT=59;

--
-- テーブルの AUTO_INCREMENT `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'コメントID';

--
-- テーブルの AUTO_INCREMENT `likes`
--
ALTER TABLE `likes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'いいねid', AUTO_INCREMENT=94;

--
-- テーブルの AUTO_INCREMENT `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ユーザーid', AUTO_INCREMENT=19;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
