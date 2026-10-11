<a href='../q_make/q_make.php'>問題集を作る</a>
<br><br>
<?php
$q_category1 = [
    /* 'メンタリストDaiGo',
    'パレオな男',
    'つっしーの料理講座', */
    '国語',
    '算数',
    '理科',
    '社会',
    '英語'
];
$q_category2 = [
    '国語',
    '数学',
    '理科',
    '社会',
    '英語'
];
$q_category4 = [
    '数学',
    '統計学',
    '物理学',
    '宇宙科学',
    '地球惑星科学',
    '化学',
    '生物学',
    '政治学',
    '法学',
    '経済学',
    '経営学',
    '社会学',
    '教育学',
    '哲学',
    '宗教学',
    '言語学',
    '人類学',
    '歴史学',
    '地理学',
    '文学',
    '芸術',
    '心理学',
    '計算機科学',
    '工学',
    '農学',
    '医学',
    '歯学',
    '薬学',
    '医学・歯学・薬学以外の健康科学'
];
$q_category5 = [
    '法律・会計',
    '医療・福祉・教育',
    '語学',
    '乗り物',
    '通信',
    '技能・サービス',
    '服飾',
    '食品',
    '心理学',
    '建設',
    '不動産',
    '労働',
    '環境',
    '造園',
    '工業',
    '農業',
    '動物',
    '情報',
    'スポーツ',
    '美術',
    '音楽',
];

include '../includes/database_connect.php';
$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$sql = null;
$stmt = null;
$sql = "SELECT `subject`, `volume` FROM `q_category` WHERE 1";
$stmt = $dbh->prepare($sql);
$stmt->execute();
?>
<!-- <div>メンタリストDaiGo<br>
	<form method="post" name="q_category" action="../q_set/q_list.php">
		<input type="hidden" name="q_category" value="メンタリストDaiGo"> <a
			href="javascript:q_category[0].submit()"><img
			border="0" src="../img/daigo2.png" width=100% alt="mentalist_daigo">
		</a>
	</form>
</div>
<div>
	パレオな男<br>
	<form method="post" name="q_category" action="../q_set/q_list.php">
		<input type="hidden" name="q_category" value="パレオな男"> <a
			href="javascript:q_category[1].submit()"><img border="0"
			src="../img/paleo.png" width=100% alt="paleo_man"> </a>
	</form>
</div>
<div>
	つっしーの料理講座<br>
	<form method="post" name="q_category" action="../q_set/q_list.php">
		<input type="hidden" name="q_category" value="つっしーの料理講座"> <a
			href="javascript:q_category[2].submit()"><img border="0"
			src="../img/tussy.png" width=100% alt="tussy"> </a>
	</form>
</div> -->
<div>
	小学校<br>
<?php
$other=0;
for ($i = 0; $i < 5; $i ++) {
    $rec = $stmt->fetch(PDO::FETCH_ASSOC);
    ?>
<div style='display: inline-flex'>
		<form method="post" name="q_category" action="../q_set/q_list.php">
			<input type="hidden" name="q_category"
				value="<?php print '小学校'.$q_category1[$i];?>"> <a
				href="javascript:q_category[<?php print $i;?>].submit()"><?php print $q_category1[$i].'('.$rec['volume'].')';?></a>
		</form>
	</div>
<?php }?></div>
<div>
	中学校<br>
<?php

for ($i = 0; $i < 5; $i ++) {
    $rec = $stmt->fetch(PDO::FETCH_ASSOC);
    ?>
<div style='display: inline-flex'>
		<form method="post" name="q_category" action="../q_set/q_list.php">
			<input type="hidden" name="q_category"
				value="<?php print '中学校'.$q_category2[$i];?>"> <a
				href="javascript:q_category[<?php print $i+$other+3;?>].submit()"><?php print $q_category2[$i].'('.$rec['volume'].')';?></a>
		</form>
	</div>
<?php }?></div>
<div>
	高校 <br>
<?php

for ($i = 0; $i < 5; $i ++) {
    $rec = $stmt->fetch(PDO::FETCH_ASSOC);
    ?>
<div style='display: inline-flex'>
		<form method="post" name="q_category" action="../q_set/q_list.php">
			<input type="hidden" name="q_category"
				value="<?php print '高校'.$q_category2[$i];?>"> <a
				href="javascript:q_category[<?php print $i+$other+10;?>].submit()"><?php print $q_category2[$i].'('.$rec['volume'].')';?></a>
		</form>
	</div>
<?php }?></div>
<div>
	大学 <br>
<?php

for ($i = 0; $i < 29; $i ++) {
    $rec = $stmt->fetch(PDO::FETCH_ASSOC);
    ?>
<div style='display: inline-flex'>
		<form method="post" name="q_category" action="../q_set/q_list.php">
			<input type="hidden" name="q_category"
				value="<?php print $q_category4[$i];?>"> <a
				href="javascript:q_category[<?php print $i+$other+15;?>].submit()"><?php print $q_category4[$i].'('.$rec['volume'].')';?></a>
		</form>
	</div>
<?php }?></div>
<div>
	資格 <br>
<?php

for ($i = 0; $i < 21; $i ++) {
    $rec = $stmt->fetch(PDO::FETCH_ASSOC);
    ?>
<div style='display: inline-flex'>
		<form method="post" name="q_category" action="../q_set/q_list.php">
			<input type="hidden" name="q_category"
				value="<?php print $q_category5[$i];?>"> <a
				href="javascript:q_category[<?php print $i+$other+44;?>].submit()"><?php print $q_category5[$i].'('.$rec['volume'].')';?></a>
		</form>
	</div>
<?php }?></div>