<?php
session_start();
//1. POSTデータ取得
$input_date = $_POST["input_date"];
$weight = $_POST["weight"];
$fat = $_POST["fat"];
$step = $_POST["step"];
$stamp = isset($_POST["stamp"]) ? implode(',', $_POST["stamp"]) : '';
$memo = $_POST["memo"];
$did = $_POST['did'];
var_dump($did);

//2. DB接続します
//*** function化する！  *****************
include("funcs.php");
$pdo = db_conn();

//３．データ登録SQL作成
$sql = "UPDATE diet_table SET input_date=:input_date,weight=:weight,fat=:fat,step=:step,stamp=:stamp,memo=:memo WHERE did=:did";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':did',  $did,  PDO::PARAM_INT); 
$stmt->bindValue(':input_date',   $input_date,   PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':weight',  $weight,  PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':fat',    $fat,    PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':step', $step, PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':stamp',$stamp,PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':memo',$memo,PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$status = $stmt->execute(); //実行

//４．データ登録処理後
if($status==false){
  $error = $stmt->errorInfo();
  echo "SQLエラー: " . $error[2];
    sql_error($stmt);
}else{
    redirect("index.php");
}

