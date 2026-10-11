<?php
/* header("location: ../index.php"); */
include '../includes/session_check.php';
include '../includes/database_connect.php';
$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
include '../includes/get_user_id_from_session.php';

include '../includes/database_connect.php';
$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$sql = 'SELECT rest FROM user_study_config WHERE auto_id=7 && user_id=' . $user_id;
/* 基本的にuser_idにつき１つなので、あとあとデータ書き換えのページを作ったらここの条件式を変える(user_idだけに) */
$stmt = $dbh->prepare($sql);
$stmt->execute();
$dbh = null;
$rest = $stmt->fetch(PDO::FETCH_ASSOC);
$rest = $rest['rest'];

include '../includes/database_connect.php';
$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$sql = 'SELECT once_q FROM user_study_config WHERE auto_id=7 && user_id=' . $user_id;
/* 基本的にuser_idにつき１つなので、あとあとデータ書き換えのページを作ったらここの条件式を変える(user_idだけに) */
$stmt = $dbh->prepare($sql);
$stmt->execute();
$dbh = null;
$once_q = $stmt->fetch(PDO::FETCH_ASSOC);
$once_q = $once_q['once_q'];
$auto_id = $_POST["auto_id"];
include '../includes/database_connect.php';
$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$sql = 'SELECT auto_id FROM question WHERE auto_id=' . $auto_id;
/* 親ページからポストされたauto_idにあとあと切り替える */
$stmt = $dbh->prepare($sql);
$stmt->execute();
$dbh = null;
/* $auto_id = $stmt->fetch(PDO::FETCH_ASSOC); */
/* $auto_id = $auto_id['auto_id']; */

include '../includes/database_connect.php';
$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$sql = 'SELECT q_length FROM question WHERE auto_id=' . $auto_id;
/* 親ページからポストされたauto_idにあとあと切り替える */
$stmt = $dbh->prepare($sql);
$stmt->execute();
$dbh = null;
$q_length = $stmt->fetch(PDO::FETCH_ASSOC);
$q_length = $q_length['q_length'];

$once_q_original = $_POST["once_q_original"];
if ($once_q_original != null) {
    $once_q = $once_q_original;
}
print "1";
/* ここからscheduling_algorithmのコピペ */

// 必要回数生成アルゴリズムの引数
$data[] = null;
print "1";
$number = 0;
print "1";
/* $q_length = 30; */
/* コピペ前で実装済み */
/* $once_q = 10; */
/* コピペ前で実装済み */

$add_q = floor($once_q / 3);
/* $add_q=7; */
/* $add_q = 7; */
print $add_q;

// スケジュール生成アルゴリズムの引数

print '$_POST["date_to"]' . $_POST["date_to"] . '$auto_id=' . $auto_id;
$strtotime_date_from = strtotime($_POST['date_from']);
$strtotime_date_to = strtotime($_POST['date_to']);
$strtotime_date_interval = ($strtotime_date_to - $strtotime_date_from) / 86400;
print '$strtotime_date_to=' . $strtotime_date_to . '$strtotime_date_from=' . $strtotime_date_from . '$strtotime_date_interval=' . $strtotime_date_interval;
$day_length = $strtotime_date_interval;
$interval = 0;

// 配列にする
$schedule[] = null;
$re_schedule[] = null;
for ($i = 0; $i < 1000; $i ++) {
    $re_schedule[$i] = null;
}
$how_times[] = null;
$type[] = null;
$schedule_date[] = null;
$review = 0;
$week = [
    '日', // 0
    '月', // 1
    '火', // 2
    '水', // 3
    '木', // 4
    '金', // 5
    '土' // 6
];
$sun_rest = 0;
$mon_rest = 0;
$tue_rest = 0;
$wed_rest = 0;
$thu_rest = 0;
$fri_rest = 0;
$sat_rest = 0;
print "1";
if ($rest['rest'] == sun) {
    $sun_rest = 1;
} else if ($rest['rest'] == mon) {
    $mon_rest = 1;
} else if ($rest['rest'] == tue) {
    $rest_tue == 1;
} else if ($rest['rest'] == wed) {
    $rest_wed == 1;
} else if ($rest['rest'] == thu) {
    $rest_thu == 1;
} else if ($rest['rest'] == fri) {
    $rest_fri == 1;
} else if ($rest['rest'] == sat) {
    $rest_sat == 1;
}
print "1";

$rest_week = [
    $sun_rest,
    $mon_rest,
    $tue_rest,
    $wed_rest,
    $thu_rest,
    $fri_rest,
    $sat_rest
]; // 0000001
$today_rest = 0;
print 'q_length=' . $q_length . 'once_q=' . $once_q . 'add_q' . $add_q;
$number = ($q_length - $once_q + $add_q) / $add_q;
$number = ceil($number);
print '必要回数は<b>' . $number . '回</b>(ノートの必要回数アルゴリズムより)' . '<br>';

$interval = ($day_length - $number) / ($number - 1);
print 'intervalは' . $interval . '<br>';
$interval = floor($interval); // 小数点以下切り捨て //これにより日にちを超えない
print '小数点以下四捨五入したintervalは' . $interval . '<br>';

for ($i = 0, $k = 0; $i < $number; $i ++, $k ++) {
    if ($i == 0) {
        $schedule[$k] = 4;
    } else if ($i != 0 && $i != $number - 1) {
        $schedule[$k] = 2;
    } else if ($i == $number - 1) {
        $schedule[$k] = 5;
    }

    if ($i < $number - 1) {
        for ($j = 0; $j < $interval; $j ++) {
            $k ++;
            if ($j == 0) {
                $schedule[$k] = 3;
            } else if ($j != 0 && $j != $interval - 1) {
                $schedule[$k] = 0;
            } else if ($j == $interval - 1) {
                $schedule[$k] = 1;
            }
        }
    }
}

// 今日の0時0分のUNIX TIMESTAMP
$today = strtotime(date("Y/m/d H:i:s"));

// 出力
for ($i = 0, $i2 = 1; $i < count($schedule); $i ++) {
    // 今日の0時0分($today)からi日後のUNIX TIMESTAMPを取得する
    $schedule_date[$i] = strtotime("+$i day", $today);
    print date('Y年n月j日', $schedule_date[$i]) . ' ' . $week[date('w', $schedule_date[$i])] . ' ';
    print '想起練習の存在:' . $schedule[$i] . ' ';
    if ($schedule[$i] != 0) {
        print 'これは' . $i2 . '回目の練習です。';
        if ($schedule[$i] == 3) {
            $i2 ++;
        }
    }
    print '<br>';
}
/* ここから休日対応リスケジュール */
for ($i = 0; $i < count($schedule); $i ++) {
    $schedule_date[$i] = strtotime("+$i day", $today);
    print '$schedule=' . $schedule[$i] . ' $rest_week[date("w",$schedule_date[$i])]=' . $rest_week[date('w', $schedule_date[$i])] . '<br>';
}

for ($i = 0; $i < count($schedule); $i ++) {
    $schedule_date[$i] = strtotime("+$i day", $today);
    if ($interval > 2) {
        if ($schedule[$i] != 0 && $rest_week[date('w', $schedule_date[$i])] == 0) {
            if ($re_schedule[$i] == null) {
                $re_schedule[$i] = $schedule[$i];
                print '[p1](' . $i . '回目)';
            } else if ($re_schedule != null) {
                $re_schedule[$i + 1] = $schedule[$i];
                print '[p2](' . $i . '回目)';
            }
        } else if ($schedule[$i] != 0 && $rest_week[date('w', $schedule_date[$i])] == 1) {
            $re_schedule[$i] = 0;
            $re_schedule[$i + 1] = $schedule[$i];
            print '[p4](' . $i . '回目)';
        } else if ($schedule[$i] == 0) { // つまり$schedule==0のとき
            if ($re_schedule[$i] == null) {
                $re_schedule[$i] = $schedule[$i];
            }
            print '[p3](' . $i . '回目)';
        }
    }
}
print '<br>';
include '../includes/database_connect.php';
$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$data = null;
$strtotime_date = $strtotime_date_from;
$timestamp = time() ;
for ($i = 0, $i2 = 1; $i < count($schedule) + 1; $i ++) {
    /* $schedule_date[$i] = strtotime("+$i day", $today); */
    if ($i > 0) {
        $strtotime_date = $strtotime_date + 86400;
    }
    /* print strtotime("+$i day", $today) . ' ' . date('Y年n月j日', $schedule_date[$i]) . ' ' . $week[date('w', $schedule_date[$i])] . ' '; */
    print 'の練習type=' . $re_schedule[$i] . ' 休みか否か' . $rest_week[date('w', $schedule_date[$i])];
    $data[4] = $i2;
    if ($re_schedule[$i] != 0) {
        print 'これは' . $i2 . '回目の練習 ';
        if ($re_schedule[$i] == 3) {
            $i2 ++;
        }
    }
    $data[0] = $user_id;
    $data[1] = $auto_id;
    if ($i == 0) {
        $strtotime_date = $strtotime_date - 25200;
    } else {
        $strtotime_date = $strtotime_date;
    }
    $data[2] = $strtotime_date+86400;
    $data[3] = $re_schedule[$i];
    $data[5] = $once_q;
    $data[6] = $add_q;
    $data[7] = 0;

    $data[8] = $timestamp;
    for ($j = 0; $j < 6; $j ++) {
        print $data[$j] . ' ';
    }
    if ($re_schedule[$i] != 0) {
        $sql = 'INSERT INTO schedule_database(user_id,q_id,date,type,how_times,once_q,add_q,review,set_time) VALUES(?,?,?,?,?,?,?,?,?)';
        print '1';
        $stmt = $dbh->prepare($sql);
        print '1';
        $stmt->execute($data);
        print '1';
        $sql = null;
        $stmt = null;
        print '1';
        $data = null;
        print 'finish';
    }
    print '<br>';
}


print '<a href="../index.php">index.phpへ</a>';
?>