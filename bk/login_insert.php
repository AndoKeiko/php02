<?php
session_start();
//エラー表示
include "funcs.php";
sschk();

$name = $_POST["name"];
// $name      = filter_input( INPUT_POST, "name" );
$lid       = filter_input( INPUT_POST, "lid" );
$lpw       = filter_input( INPUT_POST, "lpw" );
$kanri_flg = filter_input( INPUT_POST, "kanri_flg" );
var_dump($name.$lid.$lpw.$kanri_flg );
$lpw = password_hash($lpw, PASSWORD_DEFAULT);

$pdo = db_conn();

$sql = "INSERT INTO gs_user_table(name,lid,lpw,kanri_flg,life_flg)VALUES(:name,:lid,:lpw,:kanri_flg,0)";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':name', $name, PDO::PARAM_STR); //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':lid', $lid, PDO::PARAM_INT); //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':lpw', $lpw, PDO::PARAM_INT); //Integer（数値の場合 PDO::PARAM_INT)::PARAM_STR); //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':kanri_flg', $kanri_flg, PDO::PARAM_INT); //Integer（数値の場合 PDO::PARAM_INT)
$status = $stmt->execute();

if ($status == false) {
  sql_error($stmt);
}else{
  redirect("login_insert.php");
}

