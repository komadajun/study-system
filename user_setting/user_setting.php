<!DOCTYPE html>
<html>
<head>
<title>ユーザー設定</title>
<?php
include '../includes/head.php';
include '../includes/meta.php';
?>
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
include '../includes/menu.php';
?>
</div>
	</div>
	<div class='outer_main'>
		<div class='main'>
	問題を追加する
	<br>
	<br>
	<form method="post" action="post_check.php">
		<!-- //user_id day_from day_to random_sort how_cycle how_many_questions_per_once how_many_new_questions question_id
//user_question_id -->
		勉強しない曜日を決めよう。<br>
		<input type="radio" name="rest" value="sun" />日
		<input type="radio" name="rest" value="mon" />月
		<input type="radio" name="rest" value="tue" />火
		<input type="radio" name="rest" value="wed" />水
		<input type="radio" name="rest" value="thu" />木
		<input type="radio" name="rest" value="fri" />金
		<input type="radio" name="rest" value="sat" />土<br>
		一回に何問解く？<br>
		<input type="radio" name="once_q" value="10" />10問<br>
		<input type="radio" name="once_q" value="15" />15問<br>
		<input type="radio" name="once_q" value="20" />20問<br>
		問題をランダムにする？<br>
		<input type="radio" name="random_sort" value="no" />いいえ <input type="radio"
			name="random_sort" value="yes" />はい<br>
		制限時間を短くする？<br>
		<input type="radio" name="time_limit" value="x1.0" />そのまま<br>
		<input type="radio" name="time_limit" value="x0.8" />80%に減らす<br>
		<input type="radio" name="time_limit" value="x0.5" />半分に減らす<br>
			 <input type="submit" name="OK"><br>
	</form>
</div>
	</div>
</body>
</html>