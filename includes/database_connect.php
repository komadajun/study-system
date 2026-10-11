<?php

$dsn = 'mysql:host=YOUR_DB_HOST;dbname=YOUR_DB_NAME;charset=utf8mb4';
$user = 'YOUR_DB_USER';
$password = 'YOUR_DB_PASSWORD';
$dbh = new PDO($dsn, $user, $password);

$db['host'] = "YOUR_DB_HOST";  // DBサーバのURL
$db['user'] = "YOUR_DB_USER";  // ユーザー名
$db['pass'] = "YOUR_DB_PASSWORD";  // ユーザー名のパスワード
$db['dbname'] = "YOUR_DB_NAME";  // データベース名

?>