<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="./css/output.css">
  <link rel="stylesheet" href="./css/map.css">

</head>
<?php

?>
<body>
  <main class="main login">
    <div class="login_box">
        <div class="login_btn_box">
          <h1 class="h1">Login</h1>
          <form action="login_act02.php" method="post">
            <label for="login_id">ID:</label><input type="text" name="lid" class="input_text" />
            <label for="login_pw">PASS:</label><input type="password" name="lpw" class="input_text" />
            <!-- <button id="login" type="submit" class="transition ease-in-out delay-150 w-72 h-14 text-white bg-gradient-to-r from-sky-500 to-indigo-500 shadow-lg hover:text-white hover:-translate-y-1 hover:scale-110 hover:bg-cyan-900 duration-150">LOGIN</button> -->
            <input type="submit" class="transition ease-in-out delay-150 w-72 h-14 text-white bg-gradient-to-r from-sky-500 to-indigo-500 shadow-lg hover:text-white hover:-translate-y-1 hover:scale-110 hover:bg-cyan-900 duration-150" value="送信">
          </form>
          <a href="login_input.php" class="text-xs text-blue-600">パスワードを忘れた方</a>
        </div>    

    </div>
  </main>
</body>

</html>