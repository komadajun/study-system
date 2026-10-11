<?php
$question_str = array(
    '秘密鍵Dを公開鍵のN=33とE=3から求める式は？',
    '公開鍵暗号で暗号化する際には(1)者の(2)鍵が必要である. 1は？',
    '公開鍵暗号で暗号化する際には(1)者の(2)鍵が必要である.2は？',
    '公開鍵暗号で暗号化された暗号文を(3)化するためには，公開鍵暗号の(4)鍵が必要である. 3は？',
    '公開鍵暗号で暗号化された暗号文を(3)化するためには，公開鍵暗号の(4)鍵が必要である.4は？',
    'ハイブリッド暗号システムでは，(7)を用いてメッセージを暗号化する． ',
    'ハイブリッド暗号システムでは，(8)の(9)鍵を使って(10)の(11)鍵を暗号化する．8は？',
    'ハイブリッド暗号システムでは，(8)の(9)鍵を使って(10)の(11)鍵を暗号化する．9は？',
    'ハイブリッド暗号システムでは，(8)の(9)鍵を使って(10)の(11)鍵を暗号化する．10は？',
    'ハイブリッド暗号システムでは，(8)の(9)鍵を使って(10)の(11)鍵を暗号化する．11は？',
    'ファイアウォールの定義は？',
    'パケットフィルタリング型FWの定義は？',
    'パケットフィルタリング型FWの利点は？',
    'パケットフィルタリング型FWの欠点は？',
    'アプリケーションレベルゲートウェイ型FWの定義は？',
    'アプリケーションレベルゲートウェイ型FWの利点は？',
    'アプリケーションレベルゲートウェイ型FWの欠点は？',
    '「証明書は，利用者の公開鍵を認証局が暗号化したものである」の誤っている箇所を修正せよ ',
    ')証明書に含まれている公開鍵が正しいかどうかを確認するために必要なものは何か？ ',
    '自分の秘密鍵が漏洩していることを知った利用者のとるべき行動は？ ',
    '「利用者はディジタル署名がついたメールを受け取るたびに，認証局にデジタル署名の検証を受ける必要がある」',
    'ディジタル署名を検証するためには，署名した人の秘密鍵が必要となる ',
    'RSAは，ディジタル署名のアルゴリズムとして使用できる ',
    'ディジタル署名を使うとメッセージの機密性を保つことができるので盗聴される心配がない． '
);
$answer_str = array(
    'D=(L*n+1)/E',
    '送信者',
    '公開鍵',
    '復号',
    '復号',
    '共通鍵暗号方式',
    '受信者',
    '公開',
    '送信者',
    'セッション',
    '不正アクセスを防ぐ防火壁',
    'インターネット上のパケットの検査',
    '高速処理',
    'アプリケーション固有への攻撃を防げない',
    'ファイアウォールが外部サーバにアクセスする',
    'パケットを全て参照するので細かい設定が可能',
    '処理が遅い',
    '暗号化ではなくディジタル署名',
    '認証局の公開鍵',
    '早く認証局に伝える',
    '二度目以降は不必要',
    '公開鍵が必要',
    '〇',
    '機密性を高めるものではない'
);
$insert_q = '';
$insert_a = '';
$question_str2 = "";
$answer_str2 = "";
$j = 0;
$timestamp = time();
/* print $timestamp; */
for ($i = 0; $i < count($question_str); $i ++) {
    $question_str2 = $question_str2 . '"' . $question_str[$i] . '"';
    $answer_str2 = $answer_str2 . '"' . $answer_str[$i] . '"';
    $j = $i + 1;
    $insert_q = $insert_q . 'q' . $j;
    $insert_a = $insert_a . 'a' . $j;
    if ($i != count($question_str)-1) {
        $question_str2 = $question_str2 . ',';
        $answer_str2 = $answer_str2 . ',';
        $insert_q = $insert_q . ',';
        $insert_a = $insert_a . ',';
    }
    print '$insert_q'.$j.':'.$question_str[$i].'<br>';
    print '$insert_a'.$j.':'.$answer_str[$i].'<br>';
}
/* print $question_str2;
print $insert_q;
print $answer_str2; */
include '../includes/database_connect.php';
$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$sql = "INSERT INTO question (q_title,q_category,q_length,q_make_user_id,make_time,
	" . $insert_q . ") VALUES ('経済システム入門の試験','経済学',".count($question_str).",16," . $timestamp . "," . $question_str2 . ")";
$stmt = $dbh->prepare($sql);
$stmt->execute();

$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$sql = "INSERT INTO answer (make_user_id,make_time,
	" . $insert_a . ") VALUES (16," . $timestamp . "," . $answer_str2 . ")";
$stmt = $dbh->prepare($sql);
$stmt->execute();
?>