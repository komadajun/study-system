<script type="text/javascript">
$(function() {
	countDown();
 });
 function countDown() {
 	var startTime = new Date();
 	//カウントダウンの終了期日を記入↓

 	var endTime = new Date(<?php date_default_timezone_set('Asia/Tokyo');$g=date("G");$i=date("i")+10; if($i<10){$g=date("G")+1;} print "'".date("F").' '.date("d").','.date("Y").', '.$g.':'.$i.':'.date("s")."'"?>);
    var diff  = endTime - startTime;
    var times = 24 * 60 * 60 * 1000;
    var day   = Math.floor(diff / times)
    var hour  = Math.floor(diff % times / (60 * 60 * 1000))
    var min   = Math.floor(diff % times / (60 * 1000)) % 60
    var sec   = Math.floor(diff % times / 1000) % 60 % 60
    var ms    = Math.floor(diff % times / 10) % 100
    if(diff > 0){
    	$("#Timer").text('制限時間:'+ min + '分' + sec +'秒' + ms);
    	setTimeout('countDown()', 10);
    } else {
    	//終了した時のテキスト
    	$("#Timer").text('終了しました！');
    }
 }
</script>