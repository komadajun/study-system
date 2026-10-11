<?php
session_start();
if (isset($_POST["login"])) {
        $_SESSION["state"] = 'logout';
        header("Location: ../index.php");
}
?>
<form id="loginForm" name="loginForm" action="" method="POST">
	<fieldset>
		<legend>ログアウトフォーム</legend>
		 <input
			type="submit" id="login" name="login" value="ログアウト">
	</fieldset>
</form>