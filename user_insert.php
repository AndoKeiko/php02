<?php
ini_set( 'display_errors', 1 );
session_start();
//$_SESSION使うよ！
include "funcs.php";
// sschk();

//※htdocsと同じ階層に「includes」を作成してfuncs.phpを入れましょう！
//include "../../includes/funcs.php";

//1. POSTデータ取得
if (isset($_POST['name'])) {
  $name = filter_input(INPUT_POST, "name");
} else {
  $name = null; // または適切なデフォルト値
}
$name = filter_input( INPUT_POST, "name" );
$email = filter_input( INPUT_POST, "email" );
$lid = filter_input( INPUT_POST, "lid" );
$lpw = filter_input( INPUT_POST, "lpw" );
// $kanri_flg = $_POST['kanri_flg'];//filter_input( INPUT_POST, "kanri_flg" );
$lpw = password_hash($lpw, PASSWORD_DEFAULT);   //パスワードハッシュ化

//2. DB接続します
$pdo = db_conn();

//３．データ登録SQL作成
$sql = "INSERT INTO user_table(name,email,lid,lpw,life_flg,indate)VALUES(:name,:email,:lid,:lpw,0,sysdate())";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':name', $name, PDO::PARAM_STR); //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':email', $lid, PDO::PARAM_STR); //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':lid', $lid, PDO::PARAM_STR); //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':lpw', $lpw, PDO::PARAM_STR); //Integer（数値の場合 PDO::PARAM_INT)::PARAM_STR); //Integer（数値の場合 PDO::PARAM_INT)
// $stmt->bindValue(':kanri_flg', $kanri_flg, PDO::PARAM_INT); //Integer（数値の場合 PDO::PARAM_INT)
$status = $stmt->execute();
$_SESSION['first_time'] = true;
//４．データ登録処理後
if ($status == false) {
    sql_error($stmt);
} else {
    redirect("login.php");
}
