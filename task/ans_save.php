<?php
header("location: ../index.php");
include '../includes/database_connect.php';
$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$once_q = $_POST['once_q'];
$str1 = null;
$str2 = null;
$i = 1;
$j = 5;
$a_data[] = null;
$a_data[0] = $_POST['auto_id'];
$a_data[1] = $_POST['user_id'];
$a_data[2] = $_POST['q_id'];
$a_data[3] = $_POST['how_times'];
$a_data[4] = $_POST['type'];
$str2 = $a_data[0] . ',' . $a_data[1] . ',' . $a_data[2] . ',' . $a_data[3] . ',' . $a_data[4] . ',';
$type = $_POST['type'];
$add_q = $_POST['add_q'];
$skip_q = ($a_data[3] - 1) * $add_q;
for ($i = 1, $j = $skip_q + 1; $i < $once_q + 1; $i ++, $j ++) {
    $str1 = $str1 . 'a' . $j;
    if ($_POST['a' . $i]!='') {
        $str2 = $str2 . "'".$_POST['a' . $i]."'";
    } else {
        $str2 = $str2 . '"未回答"';
    }
    if ($i == $once_q) {
        break;
    }
    $str1 = $str1 . ',';
    $str2 = $str2 . ',';
}
print $str2;
/* for ($i = 0, $j = $skip_q + 1; $i < $once_q; $i ++, $j ++) { */
print '<br>';
$sql = 'INSERT INTO ans_save(schedule_database_auto_id,user_id,q_id,how_times,type,' . $str1 . ') VALUES(' . $str2 . ')';
print '$sql=' . $sql . '<br>';
print 'type=' . $type;
$stmt = $dbh->prepare($sql);
$stmt->execute();
$stmt = null;
$sql = null;
if ($type == 2) {
    $number = 7;
    $sql = 'UPDATE schedule_database SET type=' . $number . ' WHERE auto_id=' . $a_data[0];
}
if ($type == 5) {
    $number = 6;
    $sql = 'UPDATE schedule_database SET type=' . $number . ' WHERE auto_id=' . $a_data[0];
}
$stmt = $dbh->prepare($sql);
$stmt->execute();

/* header( "Location: ../index.php" ) ; */
?>