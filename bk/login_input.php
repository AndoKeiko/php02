<?php
session_start();
include "funcs.php";
sschk();
?>
<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="./css/output.css">
  <link rel="stylesheet" href="./css/map.css">
</head>

<body>
  <main class="main login">
    <div class="login_box">
      <div class="login_btn_box"></div>
      <form method="post" action="login_insert.php">
          <fieldset>
            <legend>ログインユーザー登録</legend>
            <label>名前：</label><input type="text" name="name" class="input_text" required><br>
            <!-- <label>メール：</label><input type="text" name="email" class="input_text" required><br> -->
            <label>ID</label><input type="text" name="lid" class="input_text" required><br>
            <label>パスワード：</label><input type="password" name="lpw" class="input_text" required >
            <label>管理FLG：
              一般<input type="radio" name="kanri_flg" value="0">
              管理者<input type="radio" name="kanri_flg" value="1">
            </label>
            <button type="submit" class="transition ease-in-out delay-150 w-72 h-14 text-white bg-gradient-to-r from-sky-500 to-indigo-500 shadow-lg hover:text-white hover:-translate-y-1 hover:scale-110 hover:bg-cyan-900 duration-150">そうしん</button>
            <!-- <label><input type="password" name="lpw2" class="input_text"></label> -->
            <!-- <button id="login" type="submit" class="transition ease-in-out delay-150 w-72 h-14 text-white bg-gradient-to-r from-sky-500 to-indigo-500 shadow-lg hover:text-white hover:-translate-y-1 hover:scale-110 hover:bg-cyan-900 duration-150">送信</button> -->
            <!-- <input type="submit" class="transition ease-in-out delay-150 w-72 h-14 text-white bg-gradient-to-r from-sky-500 to-indigo-500 shadow-lg hover:text-white hover:-translate-y-1 hover:scale-110 hover:bg-cyan-900 duration-150" value="送信"> -->
          </fieldset>
      </form>
      
    </div>
    </div>
  </main>


</body>

</html>