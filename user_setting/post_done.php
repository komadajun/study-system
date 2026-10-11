<!-- //p114 p073 p044 -->

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>データ送信</title>
</head>
<body>
<?php
include '../includes/session_check.php';
include '../includes/database_connect.php';
include '../includes/get_user_id_from_session.php';
?>
<?php
// user_id day_from day_to random_sort how_cycle how_many_questions_per_once how_many_new_questions question_id
// user_question_id
try {
    $rest = $_POST['rest'];
    $once_q = $_POST['once_q'];
    $random_sort = $_POST['random_sort'];
    $time_limit = $_POST['time_limit'];
    print '$rest=' . $rest . '<br>' . '$once_q=' . $once_q . '<br>' . '$random_sort=' . $random_sort . '<br>' . '$time_limit=' . $time_limit . '<br>';

    include '../includes/database_connect.php';
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    print $id . $rest . $once_q . $random_sort . $time_limit;
    $sql = 'INSERT INTO user_study_config(user_id,rest,once_q,random_sort,time_limit) VALUES(?,?,?,?,?)';
    $stmt = $dbh->prepare($sql);
    $data[] = $id;
    $data[] = $rest;
    $data[] = $once_q;
    $data[] = $random_sort;
    $data[] = $time_limit;
    $stmt->execute($data);

    $dbh = null;

    /*
     * print $user_id;
     * print 'さんの設定を追加しました。<br>';
     */
} catch (Exception $e) {
    print 'miss';
    exit();
}

?>

<a href="../index.php">戻る</a>
</body>
</html>