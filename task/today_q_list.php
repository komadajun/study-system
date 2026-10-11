<?php
if ($login_state == 1) {
    include 'includes/database_connect.php';
    $sql = 'SELECT auto_id,type,review FROM schedule_database WHERE user_id=' . $user_id . ' && date=' . $date;
    $stmt = $dbh->prepare($sql);
    $stmt->execute();
    $how_many_datas = 0;
    while (true) {
        $rec = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($rec == false) {
            break;
        }
        $how_many_datas ++;
        if (($rec['type'] == 6 || $rec['type'] == 7) || ($rec['type'] == 3 && $rec['review'] == 0)) {
            $how_many_datas --;
        }
    }
    /* print 'how_many_datas=' . $how_many_datas; */
    $rec = null;
    $sql = null;
    $stmt = null;
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = 'SELECT
auto_id,user_id,q_id,date,type,how_times,once_q,add_q,review FROM
schedule_database WHERE user_id=' . $user_id . ' && date=' . $date;
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
        if (($rec['type'] != 6 && $rec['type'] != 7 && $rec['type'] != 3) || ($rec['type'] == 3 && $rec['review'] == 1)) {
            ?>
<div class='content'>
	<div class='q_data'>
                <?php
            /*
             * print 'auto_id:' . $rec['auto_id'] . ' ';
             * print 'user_id:' . $rec['user_id'] . ' ';
             * print 'q_id:' . $rec['q_id'] . ' <br>';
             * print 'date:' . $rec['date'] . ' ';
             * print 'type:' . $rec['type'] . ' <br>';
             */
            print $rec_q['q_description'] . '<br>';
            if ($rec['type'] == 4 || $rec['type'] == 1) {
                print '生成練習';
            } else if ($rec['type'] == 2 || $rec['type'] == 5) {
                print '想起練習';
            } else if ($rec['type'] == 3) {
                print '再練習';
            }
            print ' '.$rec['how_times'] . '回目<br>';
            /*print 'once_q:' . $rec['once_q'] . '   ';
            print 'add_q:' . $rec['add_q'] . '   ';
            print 'review:' . $rec['review'] . '   <br><br>';
            print 'q_title:' . $rec_q['q_title']; */
            ?>

        <form method="post" name="form1"
			action="task/<?php if($rec['type']==5||$rec['type']==2){print 'type2.php';}else if($rec['type']==1||$rec['type']==4){print 'type1.php';}else if($rec['type']==3){print 'type3.php';}?>">
			<input type="hidden" name="auto_id"
				value="<?php print $rec['auto_id'] ?>"> <input type="hidden"
				name="q_id" value="<?php print $rec['q_id']?>"> <input type="hidden"
				name="type" value="<?php print $rec['type']?>"> <input type="hidden"
				name="user_id" value="<?php print $rec['user_id'] ?>"> <input
				type="hidden" name="how_times"
				value="<?php print $rec['how_times'] ?>"> <input type="hidden"
				name="once_q" value="<?php print $rec['once_q'] ?>"> <input
				type="hidden" name="add_q" value="<?php print $rec['add_q'] ?>"> <a
				href="javascript:form1<?php if($how_many_datas>1){print '['.$i.']';} ?>.submit()"><?php
				if ($rec['type'] == 4 || $rec['type'] == 1) {
				    print '生成練習をする';
				} else if ($rec['type'] == 2 || $rec['type'] == 5) {
				    print 'テストを受ける';
				} else if ($rec['type'] == 3) {
				    print '前回のテストの解きなおしをする';
				}
				?></a>
		</form>
	</div>
</div>
<?php
        }
        $i ++;
    }
}
?>