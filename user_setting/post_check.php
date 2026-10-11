<?php
// user_id day_from day_to random_sort how_cycle how_many_questions_per_once how_many_new_questions question_id
// user_question_id
$rest = $_POST['rest'];
$once_q = $_POST['once_q'];
$random_sort = $_POST['random_sort'];
$time_limit = $_POST['time_limit'];
print '$rest='.$rest.'<br>'.'$once_q='.$once_q.'<br>'.'$random_sort='.$random_sort.'<br>'.'$time_limit='.$time_limit.'<br>';

{
    print '設定を入力します。<br>';
    print '<form method="post" action="post_done.php">';
    print '<input type="hidden" name="rest" value="' . $rest . '">';
    print '<input type="hidden" name="once_q" value="' . $once_q . '">';
    print '<input type="hidden" name="random_sort" value="' . $random_sort . '">';
    print '<input type="hidden" name="time_limit" value="' . $time_limit . '">';
    print '<input type="submit" value="OK">';
    print '</form>';
}

?>