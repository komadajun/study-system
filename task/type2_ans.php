<style>
div.q_content {
	border-top: 1px dashed #555;
	margin-top: 10px;
}

div.q_text {
	margin-top: 10px;
	padding: 5px;
	/* margin-left: 50px; */
	background: #ddd;
	padding: 5px;
}
</style>
<?php
$auto_id = $_POST['auto_id'];
$q_id = $_POST['q_id'];
$user_id = $_POST['user_id'];
$type = $_POST['type'];
$how_times = $_POST['how_times'];
$schedule_database_auto_id = $_POST['schedule_database_auto_id'];
include '../includes/database_connect.php';
$sql = null;
$stmt = null;
$sql = 'SELECT once_q,how_times,type,add_q FROM schedule_database WHERE auto_id=' . $schedule_database_auto_id;
$stmt = $dbh->prepare($sql);
$stmt->execute();
$rec_sd = $stmt->fetch(PDO::FETCH_ASSOC);
$how_times = $rec_sd['how_times'];
$add_q = $rec_sd['add_q'];
$skip_q = $add_q * ($how_times - 1);
$type = $rec_sd['type'];
$str_q = null;
for ($i = 0, $j = $skip_q + 1; $i < $rec_sd['once_q']; $i ++, $j ++) {
    $str_q = $str_q . 'q' . $j;
    if ($i != $rec_sd['once_q'] - 1) {
        $str_q = $str_q . ',';
    }
}
include '../includes/database_connect.php';
$sql = 'SELECT auto_id,q_title,q_category,q_length,make_time,q_make_user_id,q_description,time_limit_per_ten_q,' . $str_q . ' FROM question WHERE auto_id=' . $q_id;
$stmt = $dbh->prepare($sql);
$stmt->execute();
$rec = $stmt->fetch(PDO::FETCH_ASSOC);

$sql = null;
$stmt = null;
$str1 = null;
for ($i = 1; $i < 101; $i ++) {
    $str1 = $str1 . 'a' . $i;
    if ($i == 100) {
        break;
    }
    $str1 = $str1 . ',';
}
$sql = 'SELECT ' . $str1 . ' FROM ans_save WHERE schedule_database_auto_id=' . $schedule_database_auto_id;
$stmt = $dbh->prepare($sql);
$stmt->execute();
$rec_as = $stmt->fetch(PDO::FETCH_ASSOC);
$sql = null;
$stmt = null;
$sql = 'SELECT ' . $str1 . ' FROM answer WHERE make_user_id=' . $rec["q_make_user_id"] . ' AND make_time=' . $rec["make_time"];
$stmt = $dbh->prepare($sql);
$stmt->execute();
$rec_ans = $stmt->fetch(PDO::FETCH_ASSOC);
$score = 0;
for ($i = 0, $j = 1 + $skip_q; $i < $rec_sd['once_q']; $i ++, $j ++) {
    ?><div class="q_content">
	<div class="q_text"><?php
    print '問' . $j . ':' . $rec['q' . $j].'<br>';
    print '答' . $j . ':' . $rec_ans['a' . $j].'<br>';
    print 'あなたの解答' . $j . ':' . $rec_as['a' . $j].'<br>';
    if ($rec_ans['a' . $j] === $rec_as['a' . $j]) {
        print '正解　';
        $once_q = $rec_sd['once_q'];
        $score = $score + (100 / $once_q);
        print '得点:'.(100/$once_q);
    } else {
        print '不正解　';
        print '得点:0';
    }
    print '<br>';
    ?></div>
</div><?php
}
$sql = null;
$stmt = null;
if ($score < 70) {
    print '点数:' . $score.'<br>';
    print '70点以下なので不合格' . '<br>';
    $schedule_database_auto_id2 = $schedule_database_auto_id + 1;
    $sql = 'UPDATE schedule_database SET review=1 WHERE auto_id=' . $schedule_database_auto_id2;
} else if ($score >= 70) {
    print '点数:' . $score.'<br>';
    print '70点以上なので合格' . '<br>';
    $schedule_database_auto_id2 = $schedule_database_auto_id + 1;
    $sql = 'DELETE FROM schedule_database WHERE schedule_database_auto_id=' . $schedule_database_auto_id2;
    $stmt = $dbh->prepare($sql);
    $stmt->execute();
    $sql = null;
    $stmt = null;
    $sql = 'DELETE FROM ans_save WHERE schedule_database_auto_id=' . $schedule_database_auto_id;
}
$stmt = $dbh->prepare($sql);
$stmt->execute();
$sql = null;
$stmt = null;
if ($type == 7) {
    $sql = 'DELETE FROM schedule_database WHERE auto_id=' . $schedule_database_auto_id;
} else if ($type == 6) {
    $sql = 'UPDATE schedule_database SET type=3 WHERE auto_id=' . $schedule_database_auto_id;
}
$stmt = $dbh->prepare($sql);
$stmt->execute();
$sql = null;
$stmt = null;
$sql = 'UPDATE ans_save SET for_review=1 WHERE schedule_database_auto_id=' . $schedule_database_auto_id;
$stmt = $dbh->prepare($sql);
$stmt->execute();
?>
<div class="bottom">
	<a href="../index.php">解答を終了する</a>
</div>