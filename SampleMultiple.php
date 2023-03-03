<?php
require ("FirebaseUtil.class.php");

$token = array ();
$token [] = "FIREBASE-DEVICE-TOKEN #1";
$token [] = "FIREBASE-DEVICE-TOKEN #2";
$token [] = "FIREBASE-DEVICE-TOKEN #3";

$date = new DateTime ();
$title = "DEMO " . $date-> format ("Y-m-d H:i:s #u");
$body = "DEMO Some message here!";
$link = "https://github.com/cafewill?" . $date-> format ("YmdHisu");

$response = FirebaseUtil:: exec ($token, $title, $body);
// $response = FirebaseUtil:: send ($token, $title, $body);
// $response = FirebaseUtil:: exec ($token, $title, $body, $link);
// $response = FirebaseUtil:: send ($token, $title, $body, $link);

$check = count ($token);
echo ("title : {$title}" . PHP_EOL);
echo ("body : {$body}" . PHP_EOL);
echo ("link : {$link}" . PHP_EOL);
echo ("response : [{$check}] {$response}" . PHP_EOL);
?>

