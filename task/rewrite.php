<?php
$type = $_POST['type'];
$schedule_database_auto_id = $_POST['schedule_database_auto_id'];

include '../includes/database_connect.php';
if ($type == 4) {
    $sql = 'UPDATE schedule_database SET type=2 WHERE auto_id='.$schedule_database_auto_id;
}else if($type==1){
    $sql = 'DELETE FROM schedule_database WHERE auto_id='.$schedule_database_auto_id;
}else if($type==3){
    $sql = 'DELETE FROM schedule_database WHERE auto_id='.$schedule_database_auto_id;
}
$stmt = $dbh->prepare($sql);
$stmt->execute();

header( "Location: ../index.php" ) ;
?>