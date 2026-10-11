<!DOCTYPE html>
<html>
<head>
<title>問題作成</title>
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
			<form action="write.php" method="post">
				タイトル<br> <input type="text" name="q_title" value="" size="24"><br>
				分類<br> <!-- メンタリストDaiGo<select name="q_category-0">
					<option value="default"></option>
					<option value="メンタリストDaiGo">メンタリストDaiGo</option>
				</select><br>パレオな男<select name="q_category-6">
					<option value="default"></option>
					<option value="パレオな男">パレオな男</option>
				</select><br>つっしーの料理講座<select name="q_category-7">
					<option value="default"></option>
					<option value="つっしーの料理講座">つっしーの料理講座</option>
				</select><br> -->小学校<select name="q_category-1">
					<option value="default"></option>
					<option value="小学校国語">国語</option>
					<option value="小学校算数">算数</option>
					<option value="小学校理科">理科</option>
					<option value="小学校社会">社会</option>
					<option value="小学校英語">英語</option>
				</select><br> 中学校<select name="q_category-2">
					<option value="default"></option>
					<option value="中学校国語">国語</option>
					<option value="中学校算数">算数</option>
					<option value="中学校理科">理科</option>
					<option value="中学校社会">社会</option>
					<option value="中学校英語">英語</option>
				</select><br> 高校<select name="q_category-3">
					<option value="default"></option>
					<option value="高校国語">国語</option>
					<option value="高校算数">算数</option>
					<option value="高校理科">理科</option>
					<option value="高校社会">社会</option>
					<option value="高校英語">英語</option>
				</select><br> 大学<select name="q_category-4">
					<option value="default"></option>
					<option value="数学">数学</option>
					<option value="統計学">統計学</option>
					<option value="物理学">物理学</option>
					<option value="宇宙科学">宇宙科学</option>
					<option value="地球惑星科学">地球惑星科学</option>
					<option value="化学">化学</option>
					<option value="生物学">生物学</option>
					<option value="政治学">政治学</option>
					<option value="法学">法学</option>
					<option value="経済学">経済学</option>
					<option value="経営学">経営学</option>
					<option value="社会学">社会学</option>
					<option value="教育学">教育学</option>
					<option value="哲学">哲学</option>
					<option value="宗教学">宗教学</option>
					<option value="言語学">言語学</option>
					<option value="人類学">人類学</option>
					<option value="歴史学">歴史学</option>
					<option value="地理学">地理学</option>
					<option value="文学">文学</option>
					<option value="芸術">芸術</option>
					<option value="心理学">心理学</option>
					<option value="計算機科学">計算機科学</option>
					<option value="工学">工学</option>
					<option value="農学">農学</option>
					<option value="医学">医学</option>
					<option value="歯学">歯学</option>
					<option value="薬学">薬学</option>
					<option value="医学・歯学・薬学以外の健康科学">医学・歯学・薬学以外の健康科学</option>
				</select><br> 資格<select name="q_category-5">
					<option value="default"></option>
					<option value="法律・会計">法律・会計</option>
					<option value="医療・福祉・教育">医療・福祉・教育</option>
					<option value="語学">語学</option>
					<option value="乗り物">乗り物</option>
					<option value="通信">通信</option>
					<option value="技能・サービス">技能・サービス</option>
					<option value="服飾">服飾</option>
					<option value="食品">食品</option>
					<option value="心理学">心理学</option>
					<option value="建設">建設</option>
					<option value="不動産">不動産</option>
					<option value="労働">労働</option>
					<option value="環境">環境</option>
					<option value="造園">造園</option>
					<option value="工業">工業</option>
					<option value="農業">農業</option>
					<option value="動物">動物</option>
					<option value="情報">情報</option>
					<option value="スポーツ">スポーツ</option>
					<option value="美術">美術</option>
					<option value="音楽">音楽</option>
				</select> <br> <br> 説明文<br>
				<textarea rows="10" cols="24" name="q_description"></textarea>
				<br> 10問あたりの時間は？<br> <input type="text" name="time_limit_per_ten_q"
					value="" size="24">分<br>
	<?php
for ($i = 0; $i < 100; $i ++) {
    $i2 = $i + 1;
    print 'Q' . $i2 . '<input type="text" name="q' . $i2 . '" value="" size="24"><br>';
    print 'A' . $i2 . '<input type="text" name="a' . $i2 . '" value="" size="24"><br>';
}
?>
		<br> <input type="submit" name="submit" value="書き込み"><br>
			</form>
		</div>
	</div>
</body>
</html>