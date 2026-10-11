<?php
$auto_id = $_POST['auto_id'];
$q_id = $_POST['q_id'];
$how_times = $_POST['how_times'];
$add_q = $_POST['add_q'];
$once_q = $_POST['once_q'];
$user_id = $_POST['user_id'];
$type = $_POST['type'];
$str_q = null;
$str_a = null;
$skip_q = ($how_times - 1) * $add_q;
/* print '$skip_q:' . $skip_q . '<br>'; */
for ($i = 0, $j = $skip_q + 1; $i < $once_q; $i ++, $j ++) {
    /* print $j . '<br>'; */
    $str_q = $str_q . 'q' . $j;
    $str_a = $str_a . 'a' . $j;
    if ($i == $once_q - 1) {
        break;
    }
    $str_q = $str_q . ',';
    $str_a = $str_a . ',';
}
include '../includes/database_connect.php';
$sql = 'SELECT make_time,q_make_user_id,' . $str_q . ' FROM question WHERE auto_id=' . $q_id;
$stmt = $dbh->prepare($sql);
$stmt->execute();
$rec = $stmt->fetch(PDO::FETCH_ASSOC);
$make_time = $rec['make_time'];
$q_make_user_id = $rec['q_make_user_id'];
for ($i = 0, $j = $skip_q + 1; $i < $once_q; $i ++, $j ++) {
    /* print $rec['q' . $j]; */
    if ($i == $once_q - 1) {
        break;
    }
}
$sql = null;
$stmt = null;
$sql = 'SELECT ' . $str_a . ' FROM answer WHERE make_time=' . $make_time . ' AND make_user_id=' . $q_make_user_id;
$stmt = $dbh->prepare($sql);
$stmt->execute();
$rec_a = $stmt->fetch(PDO::FETCH_ASSOC);
for ($i = 0, $j = $skip_q + 1; $i < $once_q; $i ++, $j ++) {
    /* print $rec_a['a' . $j]; */
    if ($i == $once_q - 1) {
        break;
    }
}
?>

<!doctype html>
<html>
<head>
<?php
include '../includes/head.php';
include '../includes/meta.php';
?>
<meta charset="UTF-8">
<title>task/type1.php</title>
<style>
div.content {
	border-top: 1px dashed #555;
	margin-top: 10px;
}

div.top_content {
	margin-top: 10px;
	padding: 5px;
	/* margin-left: 50px; */
	background: #aaa;
	padding: 5px;
}

div.q_data {
	margin-top: 10px;
	padding: 5px;
	/* margin-left: 50px; */
	background: #ddd;
	padding: 5px;
}

div.a_data {
	margin-top: 10px;
	padding: 5px;
	/* margin-left: 50px; */
	background: #ddd;
	padding: 5px;
}

div.bottom_content {
	background: #fff;
}
</style>
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script type="text/javascript">
$(function() {
	countDown();
 });
 function countDown() {
 	var startTime = new Date();
 	var endTime = new Date(<?php date_default_timezone_set('Asia/Tokyo');$d=date("d");$g=date("G");$i=date("i")+10; if($i>60){$g=date("G")+1;$i=$i-60;}if($g>24){$g=$g-24; $d=$d+1;} print "'".date("F").' '.$d.','.date("Y").', '.$g.':'.$i.':'.date("s")."'"?>);
    var diff  = endTime - startTime;
    var times = 24 * 60 * 60 * 1000;
    var day   = Math.floor(diff / times)
    var hour  = Math.floor(diff % times / (60 * 60 * 1000))
    var min   = Math.floor(diff % times / (60 * 1000)) % 60
    var sec   = Math.floor(diff % times / 1000) % 60 % 60
    var ms    = Math.floor(diff % times / 10) % 100
    if(diff > 0){
    	$("#Timer").text('制限時間:'+ min + '分' + sec +'秒' + ms);
    	setTimeout('countDown()', 10);
    } else {
    	//終了した時のテキスト
    	$("#Timer").text('終了しました！');
    }
 }
</script>
</head>
<body>
	<div id="Timer"></div>
	<div>ポイント:40%の時間を答えを見ながら覚えて、60%の時間を答えを隠して思い出す練習をすると、最大の定着力になるとされています。</div>
	<?php
for ($i = 0, $j = $skip_q + 1; $i < $once_q; $i ++, $j ++) {
    ?><div class='content'>
		<div class='q_data'><?php
    print '問' . $j . ':' . $rec['q' . $j] . '<br>';
    ?><input type="button" value="解答"
				onclick="clickBtn<?php print 'p'.$j;?>()" /> <span
				id="<?php print 'p'.$j;?>"><?php print $rec_a['a' . $j] . '<br>';?></span>

			<script>
    document.getElementById("<?php print 'p'.$j;?>").style.visibility ="hidden";

    function clickBtn<?php print 'p'.$j;?>(){
        var <?php print 'p'.$j;?> = document.getElementById("<?php print 'p'.$j;?>");

        if(<?php print 'p'.$j;?>.style.visibility=="visible"){
            // hiddenで非表示
            <?php print 'p'.$j;?>.style.visibility ="hidden";
        }else{
            // visibleで表示
           <?php print 'p'.$j;?>.style.visibility ="visible";
        }
    }
    </script>
		</div>
	</div><?php
    if ($i == $once_q - 1) {
        break;
    }
}
?>
<div class='bottom_content'>
		<form method="post" name="form" action="rewrite.php">
			<input type="hidden" name="schedule_database_auto_id"
				value="<?php print $auto_id;?>"> <input type="hidden" name="type"
				value="<?php print $type;?>"> <a href="javascript:form.submit()">終了</a>
		</form>
	</div>
</body>
</html>