
<?php
include 'includes/database_connect.php';
$sql = 'SELECT schedule_database_auto_id,auto_id,q_id,for_review FROM ans_save WHERE user_id=' . $user_id;
$stmt = $dbh->prepare($sql);
$stmt->execute();
$how_many_datas_a = 0;
while (true) {
    $rec = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($rec == false) {
        break;
    }
    if ($rec['for_review'] == 0) {
        $how_many_datas_a ++;
    }
}
/* print 'how_many_datas_a=' . $how_many_datas_a; */
$sql = null;
$stmt = null;
$rec = null;
$dbh = null;
include 'includes/database_connect.php';
$sql = 'SELECT schedule_database_auto_id,user_id,auto_id,q_id,type,how_times,for_review FROM ans_save WHERE user_id=' . $user_id;
$stmt = $dbh->prepare($sql);
$stmt->execute();
$i = 0;
while (true) {
    $rec = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($rec == false) {
        break;
    }
    $sql = null;
    $sql = 'SELECT
auto_id,q_title,q_category,q_length,q_make_user_id,q_description,time_limit_per_ten_q
FROM question WHERE auto_id=' . $rec['q_id'];
    $stmt_q = $dbh->prepare($sql);
    $stmt_q->execute();
    $rec_q = $stmt_q->fetch(PDO::FETCH_ASSOC);
    if ($rec['for_review'] == 0) {
        ?><div class='content'>
	<div class='a_data'><?php
	print $rec_q['q_title'].' ';
	print $rec['how_times'] . '回目<br>';
	   print $rec_q['q_description'];

        /* print 'for_review:' . $rec['for_review'] . '<br>';
        print 'how_many_datas_a:' . $how_many_datas_a . '<br>';
        print '$i:' . $i; */
        ?>

    <form method="post" name="form2" action="task/type2_ans.php">
			<input type="hidden" name="auto_id"
				value="<?php print $rec['auto_id'] ?>"> <input type="hidden"
				name="schedule_database_auto_id"
				value="<?php print $rec['schedule_database_auto_id'];?>"> <input
				type="hidden" name="q_id" value="<?php print $rec['q_id']?>"> <input
				type="hidden" name="type" value="<?php print $rec['type']?>"> <input
				type="hidden" name="user_id" value="<?php print $rec['user_id'] ?>">
			<input type="hidden" name="how_times"
				value="<?php print $rec['how_times']?>"> <a
				href="javascript:form2<?php if($how_many_datas_a>1){print '['.$i.']';} ?>.submit()"><?php print '解答' ?></a>
		</form>
	</div>
</div><?php
        $i ++;
    }
}
?>