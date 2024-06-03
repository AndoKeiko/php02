<?php
ini_set( 'display_errors', 1 );
session_start();

$alert = "<script type='text/javascript'>alert(<?=session_id()?>);</script>";
echo $alert;
$lid = $_POST["lid"];
$lpw = $_POST["lpw"];

include("funcs.php");
$pdo = db_conn();

$stmt = $pdo->prepare("SELECT * FROM gs_user_table WHERE lid=:lid AND life_flg=0");
$stmt->bindValue(':lid', $lid, PDO::PARAM_STR);
$status = $stmt->execute();

if($status==false){
  sql_error($stmt);
}

$val = $stmt->fetch();

$pw = password_verify($lpw, $val["lpw"]);
if($pw){
  $_SESSION["chk_ssid"] = session_id();
  // $_SESSION["kanri_flg"] = $val["kanri_flg"];
  $_SESSION["name"] = $val["name"];
  //うまく行ったとき
  redirect("index.php");
} else {
  redirect("login.php");
}
exit();
