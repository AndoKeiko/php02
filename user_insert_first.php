<?php
//$_SESSION使うよ！
session_start();
//※htdocsと同じ階層に「includes」を作成してfuncs.phpを入れましょう！
//include "../../includes/funcs.php";
include "funcs.php";
// sschk();
$uid = $_SESSION['id'];
//1. POSTデータ取得
$height = filter_input( INPUT_POST, "height" );
$goal = filter_input( INPUT_POST, "goal" );

//2. DB接続します
$pdo = db_conn();

//３．データ登録SQL作成
$sql = "INSERT INTO goal_table (height, goal, uid, indate) 
        VALUES (:height, :goal, :uid, sysdate()) 
        ON DUPLICATE KEY UPDATE 
        height = VALUES(height), 
        goal = VALUES(goal), 
        indate = VALUES(indate)";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':height', $height, PDO::PARAM_STR); //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':goal', $goal, PDO::PARAM_STR); //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':uid', $uid, PDO::PARAM_INT); //Integer（数値の場合 PDO::PARAM_INT)
// $stmt->bindValue(':kanri_flg', $kanri_flg, PDO::PARAM_INT); //Integer（数値の場合 PDO::PARAM_INT)
$status = $stmt->execute();
//４．データ登録処理後
if ($status == false) {
    sql_error($stmt);
} else {
    redirect("index.php");
}
