<?php
if (isset($_POST["signUp"])) {
header("Location: ../index.php"); // メイン画面へ遷移
}
?>
<!DOCTYPE html>
<html>
<head>
<title>新規登録</title>
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
			<h1>新規登録画面</h1>
			<form id="loginForm" name="loginForm" action="" method="POST">
				<fieldset>
					<legend>新規登録フォーム</legend>

					<label for="username">ユーザー名</label><input type="text" id="username"
						name="username" placeholder="ユーザー名を入力"
						value="<?php if (!empty($_POST["username"])) {echo htmlspecialchars($_POST["username"], ENT_QUOTES);} ?>">
					<br> <label for="password">パスワード</label><input type="password"
						id="password" name="password" value="" placeholder="パスワードを入力"> <br>
					<label for="password2">パスワード(確認用)</label><input type="password"
						id="password2" name="password2" value="" placeholder="再度パスワードを入力">
					<br> <input type="submit" id="signUp" name="signUp" value="新規登録">
				</fieldset>
			</form>
			<br>
			<form action="Login.php">
				<input type="submit" value="戻る">
			</form>
		</div>
	</div>
</body>
</html>

<?php
if (isset($_POST["signUp"])) {
    // 1. ユーザIDの入力チェック

    if (! empty($_POST["username"]) && ! empty($_POST["password"])) {
        // 入力したユーザIDを格納
        $userid = $_POST["username"];

        // 2. ユーザIDとパスワードが入力されていたら認証する
        $sql=null;$stmt=null;
        include '../includes/database_connect.php';
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $password2 = password_hash($_POST["password"], PASSWORD_DEFAULT);
        $sql = "INSERT INTO userdata(name,password) VALUES(:name,:password)";
        $stmt = $dbh->prepare($sql);
        $stmt->execute([":name" => $userid, ":password" => $password2]);

        /* if ($rec['password'] == $password) { */
            $_SESSION["NAME"] = $userid;
        /* } */
    }
}

?>