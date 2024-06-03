<?php
//エラー表示
ini_set("display_errors", 1); //0にするとエラーは表示されない
//最初にSESSIONを開始！！ココ大事！！
session_start();
include "funcs.php";

//1. POSTデータ取得
$input_date = $_POST["input_date"];
$weight = $_POST["weight"];
$step = $_POST["step"];
$fat = $_POST["fat"];
$stamp = isset($_POST["stamp"]) ? implode(',', $_POST['stamp']): '';
$memo = isset($_POST['memo']) ? $_POST['memo']:'';
$uid = $_SESSION['id'];

var_dump($_SESSION['id']);
$id = session_id();

//2. DB接続します
$pdo = db_conn();
// try {
//   //Password:MAMP='root',XAMPP=''
//   $pdo = new PDO('mysql:dbname=gs_kadai;charset=utf8;host=localhost','root','');
// } catch (PDOException $e) {
//   exit('DB_ConnectError!!:'.$e->getMessage());
// }


//３．データ登録SQL作成
$sql = "INSERT INTO diet_table(uid,input_date,weight,step,fat,stamp,memo,indate) VALUES (:uid,:input_date,:weight,:step,:fat,:stamp,:memo,sysdate())";
$stmt = $pdo->prepare($sql);
//バインド変数入れる
// $stmt->bindValue(':id', "", PDO::PARAM_INT);
$stmt->bindValue(':uid', $uid, PDO::PARAM_INT);
$stmt->bindValue(':input_date', $input_date, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT) 
$stmt->bindValue(':weight', $weight, PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':step', $step, PDO::PARAM_INT); //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':fat', $fat, PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':memo', $memo, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':stamp', $stamp, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)

$status = $stmt->execute();//true or false

//４．データ登録処理後
if($status==false){
  //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
  $error = $stmt->errorInfo();
  exit("SQLError!:".$error[2]);
}else{
  //５．index.phpへリダイレクト
 header("Location: index.php");
  exit();
}
?>