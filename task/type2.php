<head>
<?php
include '../includes/head.php';
include '../includes/meta.php';
?>
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
<div id="Timer"></div>
<?php
$auto_id=$_POST['auto_id'];
$q_id = $_POST['q_id'];
$how_times = $_POST['how_times'];
$add_q = $_POST['add_q'];
$once_q = $_POST['once_q'];
$user_id=$_POST['user_id'];
$type=$_POST['type'];
include '../includes/database_connect.php';
$sql = 'SELECT auto_id,q_title,q_category,q_length,q_make_user_id,q_description,time_limit_per_ten_q FROM question WHERE auto_id=' . $q_id;
$stmt = $dbh->prepare($sql);
$stmt->execute();

$rec = $stmt->fetch(PDO::FETCH_ASSOC);
$past_q = $add_q * ($how_times - 1);
$select_q = null;
$i = $past_q;
$i = $i + 1;
$j = 0;
while (true) {
    $select_q = $select_q . 'q' . $i;
    if ($j == $once_q - 1) {
        break;
    }
    $select_q = $select_q . ',';
    $j ++;
    $i ++;
}

$sql = null;
$stmt = null;
$rec = null;
$i = $past_q;
$i = $i + 1;
include '../includes/database_connect.php';
$sql = 'SELECT ' . $select_q . ' FROM question WHERE auto_id=' . $q_id;
$stmt = $dbh->prepare($sql);
$stmt->execute();
$rec = $stmt->fetch(PDO::FETCH_ASSOC);

for ($j = 0, $k = 1; $j < $once_q; $i ++, $j ++, $k ++) {
    ?><form method="post" action="ans_save.php">
	<div class="q_content">
		<div class="q_text"><?php
    print '問題'.$i.':'.$rec['q' . $i] . '<br>';
    print '答え:';
    ?>
    <!-- a1~a_という名前でpostする -->
    <input type="text" name="a<?php print $k;?>" size="10" value="" />
		</div>
	</div>
<?php
}
?>
<br>
<input type="hidden" name="type" value="<?php print $type ?>">
<input type='hidden' name="auto_id" value="<?php print $auto_id?>">
<input type="hidden" name="once_q" value="<?php print $once_q;?>">
<input type="hidden" name="q_id" value="<?php print $q_id;?>">
<input type="hidden" name="user_id" value="<?php print $user_id;?>">
<input type="hidden" name="how_times" value="<?php print $how_times;?>">
<input type="hidden" name="add_q" value="<?php print $add_q;?>">
<!-- <input type="submit" name="submit" value="書き込み"> -->
<input type='submit'  value='送信' onclick='return confirm("よろしいですか？");'/>
</form>