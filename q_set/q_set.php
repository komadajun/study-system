<?php
include '../includes/session_check.php';
?>
<!DOCTYPE html>
<html>
<head>
<title>問題集</title>
<!-- ここもデータベースから可能か -->
<?php
include '../includes/head.php';
?>
<?php include '../includes/meta.php';?>
<style>
p {
	padding: 5px;
	margin-left: 50px;
	background: #999;
}

div.content {
	/* border-top: 1px dashed #555;
	margin-top: 10px; */

}

div.comment {
	margin-top: 10px;
	padding: 5px;
	/* margin-left: 50px; */
	background: #ddd;
	padding: 5px;
}
</style>
</head>
<body>
	<div class='outer_header'>
		<div class='inner_header'>

<?php
include '../header/header.php';
?></div>
	</div>
	<div class='outer_menu'>
		<div class='menu'>
<?php
include '../includes/q_list_menu.php';
?>
</div>
	</div>
	<div class='outer_main'>
		<div class='main'>
<?php
$post = $_POST["auto_id"];
$post_q_length = $_POST["q_length"];
$post_make_time = $_POST["make_time"];
$post_q_make_user_id = $_POST["q_make_user_id"];
$q_str = null;
$a_str = null;
for ($i = 1; $i < $post_q_length + 1; $i ++) {
    $q_str = $q_str . 'q' . $i;
    $a_str = $a_str . 'a' . $i;
    if ($i != $post_q_length) {
        $q_str = $q_str . ',';
        $a_str = $a_str . ',';
    }
}
include '../includes/database_connect.php';
$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$sql = 'SELECT ' . $q_str . ' FROM question WHERE auto_id=' . $post;
$stmt = $dbh->prepare($sql);
$stmt->execute();
$rec = $stmt->fetch(PDO::FETCH_ASSOC);
include '../includes/database_connect.php';
$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$sql = null;
$stmt = null;
$sql = 'SELECT ' . $a_str . ' FROM answer WHERE make_time=' . $post_make_time . ' AND make_user_id=' . $post_q_make_user_id;
$stmt = $dbh->prepare($sql);
$stmt->execute();
$rec_ans = $stmt->fetch(PDO::FETCH_ASSOC);
?>
	問題を追加する
	<br> <br>
			<form method="post" action="scheduling_algorithm.php">
				何日から何日まで？<br> <input type="date" name="date_from" value="" /> から <br>
				<input type="date" name="date_to" value="" />まで <br>
				この問題はX問あるけど、何問ずつやる？<br> <input name="once_q_original"
					value="10" size="24"> <br> <input type="submit" name="OK"><br> <input
					type="hidden" name="auto_id" value="<?php print $post;?>">
			</form>
			<h2>問題集</h2>
			<?php
for ($i = 1; $i < $post_q_length + 1; $i ++) {
    print '問' . $i .':'. $rec['q' . $i] . '<br>';
    print '答' . $i .':'. $rec_ans['a' . $i] . '<br>';
}
?>
<br>
			<!-- <h2>使い方</h2>
<span class="step"><img border="1" src="../img/step1.png" alt="step1"></span>
<span class="step"><img border="1" src="../img/step2.png" alt="step2"></span>
<span class="step"><img border="1" src="../img/step3.png" alt="step3"></span> -->
		</div>
	</div>
</body>
</html>