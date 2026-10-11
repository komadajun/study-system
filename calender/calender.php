<?php

// 現在の年月を取得
$year = date('Y');
$month = date('n');

// 月末日を取得
$last_day = date('j', mktime(0, 0, 0, $month + 1, 0, $year));

$calendar = array();
$j = 0;

// 月末日までループ
for ($i = 1; $i < $last_day + 1; $i ++) {

    // 曜日を取得
    $week = date('w', mktime(0, 0, 0, $month, $i, $year));

    // 1日の場合
    if ($i == 1) {

        // 1日目の曜日までをループ
        for ($s = 1; $s <= $week; $s ++) {

            // 前半に空文字をセット
            $calendar[$j]['day'] = '';
            $j ++;
        }
    }

    // 配列に日付をセット
    $calendar[$j]['day'] = $i;
    $j ++;

    // 月末日の場合
    if ($i == $last_day) {

        // 月末日から残りをループ
        for ($e = 1; $e <= 6 - $week; $e ++) {

            // 後半に空文字をセット
            $calendar[$j]['day'] = '';
            $j ++;
        }
    }
}

?>
<br>
<?php echo $year; ?>年<?php echo $month; ?>月のカレンダー
<br>
<table>
	<tr>
		<th>日</th>
		<th>月</th>
		<th>火</th>
		<th>水</th>
		<th>木</th>
		<th>金</th>
		<th>土</th>
	</tr>

	<tr>
    <?php $cnt = 0; ?>
    <?php

    ?>
    <?php foreach ($calendar as $key => $value): ?>

        <td><nobr>
        <?php $cnt++; ?>
        <?php if($value['day']>0){echo $value['day'].'日<br>';}?>
        <?php /* .'y:'.$year.'m:'.$month.'d:'.$value['day'].'<br>' */?>
        <?php
        $date = $year . '-' . $month . '-' . $value['day'];
        $timestamp = strtotime($date) - 25200+86400;
        /* echo '英' . date("Y/m/d/h", $timestamp) . '<br>';
        print '日' . $timestamp . '<br>'; */
        $dbh = null;
        $sql = null;
        $stmt = null;
        include 'includes/database_connect.php';
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = 'SELECT q_id,type FROM schedule_database WHERE user_id=' . $user_id . ' AND date=' . $timestamp;
        $stmt = $dbh->prepare($sql);
        $stmt->execute();
        while (true) {
            $rec = $stmt->fetch(PDO::FETCH_ASSOC);

            if($rec==false){
                break;
            }
            if($rec['type']==4||$rec['type']==1){
                print '生成:';
            }else if($rec['type']==2){
                print '想起:';
            }else if($rec['type']==3||$rec['type']==5){
                print '再練:';
            }
            $q_id=$rec['q_id'];
            include 'includes/database_connect.php';
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = 'SELECT q_title FROM question WHERE auto_id='.$q_id;
            $stmt2 = $dbh->prepare($sql);
            $stmt2->execute();
            $rec2=$stmt2->fetch(PDO::FETCH_ASSOC);
            print $rec2['q_title'];
            print '<br>';
        }
        ?></nobr>
        </td>

    <?php if ($cnt == 7): ?>
    </tr>
	<tr>
    <?php $cnt = 0; ?>
    <?php endif; ?>

    <?php endforeach; ?>
    </tr>
</table>

<style type="text/css">
table {
	width: 100%;
	table-layout:fixed;
}

table th {
	background: #EEEEEE;
}

table th, table td {
	border: 1px solid #CCCCCC;
	text-align: center;
	padding-top:0px;
	/* padding: 5px; */
}
table td{
    height:50px;
    overflow-x:hidden;

}
</style>