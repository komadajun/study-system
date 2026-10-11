<?php
$receive_date = null;
if (isset($_POST['date'])) {
    $receive_date = $_POST['date'];
    $_SESSION['date']=$receive_date;
}
if ($receive_date == null&&$_SESSION['date']==null) {
    $date = strtotime(date("Y/m/d"));
    $date = $date - 25200 + 86400;
} else {
    $date=$_SESSION['date'];
    /* $date = $receive_date; */
}

$post_date = $date + 86400;
$post_date_b = $date - 86400;

?>
<span class="header_content">
	<div style='display: inline-flex'>
		<form action="index.php" method="post">
			<input type="hidden" name="date" value="<?php print $post_date_b;?>">
			<button type="submit"><<</button>
		</form>
	</div>

<?php
print ' ' . date("m/d", $date) . ' ';
?>
<div style='display: inline-flex'>
		<form action="index.php" method="post">
			<input type="hidden" name="date" value="<?php print $post_date;?>">
			<button type="submit">>></button>
		</form>
	</div>
</span>