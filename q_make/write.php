<?php
header("location: ../index.php");
include '../includes/session_check.php';
include '../includes/database_connect.php';
$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
include '../includes/get_user_id_from_session.php';

$q_category=null;
$q_title = $_POST["q_title"];
$q_category_0 = $_POST["q_category-0"];
if($q_category_0!='default'){
    $q_category=$q_category_0;
}
$q_category_6 = $_POST["q_category-6"];
if($q_category_6!='default'){
    $q_category=$q_category_6;
}
$q_category_7 = $_POST["q_category-7"];
if($q_category_7!='default'){
    $q_category=$q_category_7;
}
$q_category_1 = $_POST["q_category-1"];
if($q_category_1!='default'){
    $q_category=$q_category_1;
}
$q_category_2 = $_POST["q_category-2"];
if($q_category_2!='default'){
    $q_category=$q_category_2;
}
$q_category_3 = $_POST["q_category-3"];
if($q_category_3!='default'){
    $q_category=$q_category_3;
}
$q_category_4 = $_POST["q_category-4"];
print $q_category_4;
if($q_category_4!='default'){
    $q_category=$q_category_4;
}
$q_category_5 = $_POST["q_category-5"];
if($q_category_5!='default'){
    $q_category=$q_category_5;
}
include '../includes/database_connect.php';
$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$sql=null; $stmt=null;
$sql="UPDATE q_category SET volume=volume+1 WHERE subject='".$q_category."'";
$stmt=$dbh->prepare($sql);
$stmt->execute();
$q_length = 0;
$make_time = time();
$q_make_user_id = $user_id;
$q_description = $_POST["q_description"];
$time_limit_per_ten_q = $_POST["time_limit_per_ten_q"];
$q_data[0] = $q_title;
$q_data[1] = $q_category;
$q_data[2] = $q_length;
$q_data[3] = $make_time;
$q_data[4] = $q_make_user_id;
$q_data[5] = $q_description;
$q_data[6] = $time_limit_per_ten_q;
$a_data[0] = $make_time;
$a_data[1] = $q_make_user_id;
for ($i = 0; $i < 7; $i ++) {
    print '$q_data=' . $q_data[$i];
}
for ($i = 0; $i < 100; $i ++) {
    $i2 = $i + 1;
    $i4 = $i + 2;
    $i3 = $i + 7;
    $q_id = 'q' . $i2;
    $a_id = 'a' . $i2;
    if ($_POST["$q_id"] == '') {
        break;
    }
    $q_data[$i3] = $_POST["$q_id"];
    $a_data[$i4] = $_POST["$a_id"];
    print $q_data[$i3] . '<br>';
    print $a_data[$i4] . '<br>';
}
$q_data[2] = count($q_data) - 7;
print count($q_data) . '<br>';
$str1 = null;
$str2 = null;
$str3 = null;
for ($i = 0; $i < count($q_data) - 7; $i ++) {
    $i2 = $i + 1;
    $str1 = $str1 . 'q' . $i2;
    $str2 = $str2 . 'a' . $i2;
    $str3 = $str3 . '?';
    if (count($q_data) - 8 == $i) {
        break;
    }
    $str1 = $str1 . ',';
    $str2 = $str2 . ',';
    $str3 = $str3 . ',';
}
print $str1 . '<br>' . $str2 . '<br>' . $str3 . '<br>';

$str1 = 'q_title,q_category,q_length,make_time,q_make_user_id,q_description,time_limit_per_ten_q,' . $str1;
$str4 = $str3;
$str3 = $str3 . ',?,?,?,?,?,?,?';
include '../includes/database_connect.php';
$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$sql = 'INSERT INTO question(' . $str1 . ') VALUES(' . $str3 . ')';
print $sql;
print "1";
$stmt = $dbh->prepare($sql);
for ($i = 0; $i < count($q_data); $i ++) {
    print $q_data[$i];
}
$stmt->execute($q_data);
print "1";
$dbh = null;
print "1";
include '../includes/database_connect.php';
print "1";
$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
print "1";
$sql = 'INSERT INTO answer(make_time,make_user_id,' . $str2 . ') VALUES(?,?,' . $str4 . ')';
print "1";
print $sql;
$stmt = $dbh->prepare($sql);
$stmt->execute($a_data);

?>

<!DOCTYPE html>
<html>
<head>
<title>問題作成</title>
<meta charset="utf8">
</head>
<body>
	設定が完了しました。
	<br>
	<a href='../index.php'>index.phpへ</a>
	<br>
</body>
</html>