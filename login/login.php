<?php
session_start();
// エラーメッセージの初期化
$errorMessage = "";

if (isset($_POST["login"])) {
    $userid = $_POST["userid"];
    $dbh = null;
    $sql = null;
    $stmt = null;
    include '../includes/database_connect.php';
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = 'SELECT * FROM userdata WHERE name="'.$userid.'"';
    $stmt = $dbh->prepare($sql);
    $stmt->execute();
    $rec = $stmt->fetch(PDO::FETCH_ASSOC);
    $password=null;
    $password = $_POST["password"];
    $password_2 = $rec["password"] ?? null;
    $isHashed = is_string($password_2) && password_get_info($password_2)["algo"] !== null;
    $verified = $isHashed
        ? password_verify($password, $password_2)
        : (is_string($password_2) && hash_equals($password_2, $password));
    if ($verified) {
        // Upgrade legacy plaintext passwords on successful login.
        if (!$isHashed) {
            $newHash = password_hash($password, PASSWORD_DEFAULT);
            $update = $dbh->prepare('UPDATE userdata SET password = :password WHERE name = :name AND password = :old_password');
            $update->execute([':password' => $newHash, ':name' => $userid, ':old_password' => $password_2]);
        }
        $_SESSION["ID"] = $userid;
        header("Location: ../index.php");
    }
}
?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>ログイン</title>
<?php
include '../includes/head.php';
include '../includes/meta.php';
?>

</head>
<body>
	<div class='outer_header'>
		<div class='inner_header'>
<?php
include '../header/header.php';
?></div>
	</div>
	<div class='outer_menu'>
		<div class='menu'>
<?php
include '../includes/menu.php';
?>
</div>
	</div>
	<div class='outer_main'>
		<div class='main'>

	<h1>ログイン画面</h1>
			<form id="loginForm" name="loginForm" action="" method="POST">
				<fieldset>
					<legend>ログインフォーム</legend>
					<div>
						<font color="#ff0000"><?php echo htmlspecialchars($errorMessage, ENT_QUOTES); ?></font>
					</div>
					<label for="userid">ユーザーID</label><input type="text" id="userid"
						name="userid" placeholder="ユーザーIDを入力"
						value="<?php if (!empty($_POST["userid"])) {echo htmlspecialchars($_POST["userid"], ENT_QUOTES);} ?>">
					<br> <label for="password">パスワード</label><input type="password"
						id="password" name="password" value="" placeholder="パスワードを入力"> <br>
					<input type="submit" id="login" name="login" value="ログイン">
				</fieldset>
			</form>
			<br>
			<form action="signup.php">
				<fieldset>
					<legend>新規登録フォーム</legend>
					<input type="submit" value="新規登録">
				</fieldset>
			</form>
		</div>
	</div>
</body>
</html>