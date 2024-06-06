<?php
session_start();
include "funcs.php";
sschk();
$pdo = db_conn();

if (isset($_GET['id'])) {
  $uid = $_GET["id"];
  $did = $_GET["did"];
  $stmt = $pdo->prepare("DELETE FROM diet_table WHERE did=:did");
  $stmt->bindValue(":did", $did, PDO::PARAM_INT);
  $status = $stmt->execute();
}
if (isset($_POST['trash'])) {
  $trash = $_POST['trash'];
  foreach($trash as $t) {
    $did = $t;
    $stmt = $pdo->prepare("DELETE FROM diet_table WHERE did=:did");
    $stmt->bindValue(":did", $did, PDO::PARAM_INT);
    $status = $stmt->execute();
  }
}
if($status==false){
  sql_error($stmt);
}else{
  redirect("index.php");
}

?>