<?php
try {
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $id = null;
    $login_state = null;
    $user_id = null;
    if (isset($_COOKIE["ID"])) {
        $id = $_COOKIE["ID"];
        $login_state = 1;
    } else {
        if (isset($_SESSION["ID"])) {
            $id = $_SESSION["ID"];
            $login_state = 1;
            setcookie("ID", $id, time() + 60 * 60 * 24 * 7);
        }
    }
    $sql = "SELECT * FROM userdata WHERE name='" . $id."'";
    $stmt = $dbh->prepare($sql);
    $stmt->execute();

    $dbh = null;

    /* print 'ユーザーID'; */

    while (true) {
        $rec = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($rec == false) {
            break;
        }
        /* $rec['id'] = $rec['id']; */
        $user_id = $rec['id'];
        /*
         * print $user_id;
         * print 'on';
         * print '<br>';
         */
    }
    /* if(isset($_SESSION["state"])){
        $_COOKIE["ID"]="";
        $user_id="";
    } */
} catch (Exception $e) {
    /* print 'miss'; */
    /* exit(); */
}
?>