<?php
//XSS対応（ echoする場所で使用！それ以外はNG ）
function h($str){
    return htmlspecialchars($str, ENT_QUOTES);
}

//DB接続
function db_conn(){
  try {
      $db_name = "gajumaro_gs_kadai";    //データベース名
      $db_id   = "gajumaro"; //"root";      //アカウント名
      $db_pw   = "y2_RKegUzKcM-5C";      //パスワード：XAMPPはパスワード無しに修正してください。
      $db_host = "mysql57.gajumaro.sakura.ne.jp";//"localhost"; //DBホスト
      return new PDO('mysql:dbname='.$db_name.';charset=utf8;host='.$db_host, $db_id, $db_pw);
  } catch (PDOException $e) {
    exit('DB Connection Error:'.$e->getMessage());
  }
}

//SQLエラー
function sql_error($stmt){
    //execute（SQL実行時にエラーがある場合）
    $error = $stmt->errorInfo();
    exit("SQLError:".$error[2]);
}

//リダイレクト
function redirect($file_name){
    header("Location: ".$file_name);
    exit();
}

//SessionCheck(スケルトン)
function sschk(){
  if(!isset($_SESSION["chk_ssid"]) || $_SESSION["chk_ssid"] != session_id()){
    exit("LOGIN ERROR");
  } else {
    session_regenerate_id(true);
    $_SESSION["chk_ssid"] = session_id();
  }
}