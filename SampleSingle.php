<?php
require ("FirebaseUtil.class.php");

$token = "dsmGwJoxOkaXg92CSs8W_N:APA91bEbhuniiwooewIV0ZKzS2Ce7Yaiy5IpIKCfq6t5NIcs9wFgevFLvLMTe20WGF_5e53BvFrdcId30vJYcsxAEejhmeNDpdnaMgLDhaP6C8s47LH1NT9kYm2eS_W-HYSLY3MEHTv0";

$date = new DateTime ();
$title = "DEMO " . $date-> format ("Y-m-d H:i:s #u");
$body = "DEMO Some message here!";
$link = "https://github.com/cafewill?" . $date-> format ("YmdHisu");

$response = FirebaseUtil:: exec ($token, $title, $body);
// $response = FirebaseUtil:: send ($token, $title, $body);
// $response = FirebaseUtil:: exec ($token, $title, $body, $link);
// $response = FirebaseUtil:: send ($token, $title, $body, $link);

echo ("title : {$title}" . PHP_EOL);
echo ("body : {$body}" . PHP_EOL);
echo ("link : {$link}" . PHP_EOL);
echo ("response : {$response}" . PHP_EOL);
?>

