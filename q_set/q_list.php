<!DOCTYPE html>
<html>
<head>
<title>問題集</title>
<!-- ここもデータベースから可能か -->
<?php
include '../includes/head.php';
?>
<?php
include '../includes/meta.php';
?>
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
/* スラスラわかるPHPより around p283 */
include '../includes/database_connect.php';
$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$q_category = '"' . $_POST['q_category'] . '"'; /* あとでリライト */
print $q_category;
$sql = 'SELECT auto_id,q_title,q_category,q_length,q_make_user_id,q_description,time_limit_per_ten_q FROM question WHERE q_category=' . $q_category;
$stmt = $dbh->prepare($sql);
$stmt->execute();
$count = 0;
while (true) {
    $rec = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($rec == false) {
        break;
    }
    $count ++;
}

$sql = 'SELECT auto_id,q_title,q_category,q_length,make_time,q_make_user_id,q_description,time_limit_per_ten_q FROM question WHERE q_category=' . $q_category;
$stmt = $dbh->prepare($sql);
$stmt->execute();
$i = 0;
while (true) {
    $rec = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($rec == false) {
        break;
    }
    ?>
    <div class="content">
				<div class="comment">
					<form method="post" name="form1" action="q_set.php">
						<input type="hidden" name="auto_id"
							value="<?php print $rec['auto_id'] ?>"> <input type="hidden"
							name="q_length" value="<?php print $rec["q_length"];?>"><input type="hidden"
							name="make_time" value="<?php print $rec["make_time"];?>"><input type="hidden"
							name="q_make_user_id" value="<?php print $rec["q_make_user_id"];?>"><a
							href="javascript:form1<?php if($count!=1){print '['.$i.']';} ?>.submit()"><?php print $rec['q_title'] ?></a>
					</form>

		<?php
    /* print $rec['auto_id'] . "<br>"; */
    /* print 'タイトル:'.$rec['q_title'] . "<br>"; */
    print '問題数:' . $rec['q_length'] . "<br>";
    /* print '問題製作者'.$rec['q_make_user_id'] . "<br>"; */
    print '説明:' . $rec['q_description'] . "<br>";
    /* print $rec['time_limit_per_ten_q'] . "<br>"; */
    ?>
    </div>
			</div>
<?php
    $i ++;
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