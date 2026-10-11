<?php
session_start();
include 'includes/database_connect.php';
include 'includes/get_user_id_from_session.php';
?>

<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<link rel="stylesheet" type="text/css" href="css/index.css">
<title>研究用システム</title>
<meta name="viewport" content="width=device-width,initial-scale=1">
<meta http-equiv="content-language" content="ja">
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="js/menu.js"></script>
<link rel="stylesheet"
	href="https://use.fontawesome.com/releases/v5.2.0/css/solid.css"
	integrity="sha384-wnAC7ln+XN0UKdcPvJvtqIH3jOjs9pnKnq9qX68ImXvOGz2JuFoEiCjT8jyZQX2z"
	crossorigin="anonymous">
<link rel="stylesheet"
	href="https://use.fontawesome.com/releases/v5.2.0/css/fontawesome.css"
	integrity="sha384-HbmWTHay9psM8qyzEKPc8odH4DsOuzdejtnr+OFtDmOcIVnhgReQ4GZBH7uwcjf6"
	crossorigin="anonymous">
</head>
<body>
	<div class='outer_header'>
		<div class='inner_header'>

<?php
include 'header/index_header.php';
?></div>
	</div>
	<div class='outer_menu'>
		<div class='menu'>
<?php
include 'includes/indexmenu.php';
?>
</div>
	</div>
	<div class='outer_main'>
		<div class='main'>
			<!-- <div class='top_comment'> -->
		<?php /* include 'includes/top.php'; */?>
		<!-- </div> -->
			<div class="q_box">
<?php
include 'task/today_q_list.php';
?></div>
			<br>
			<div class="a_box"><?php
include 'task/today_a_list.php';
?></div>
<?php
include 'calender/calender.php';
?>
		</div>
	</div>
</body>
</html>