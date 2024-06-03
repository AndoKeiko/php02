<?php
session_start();
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width">
  <link rel="stylesheet" href="css/style.css" />
  <link rel="stylesheet" href="css/output.css" />
  <style>
    div {
      padding: 10px;
      font-size: 16px;
    }
  </style>
  <title>ログイン</title>
</head>

<body>
  <main class="main">
    <header>
      <nav class="h1">LOGIN</nav>
    </header>

    <!-- lLOGINogin_act.php は認証処理用のPHPです。 -->
    <form name="form_login" action="login_act.php" method="post">
      <fieldset>
        <div class="input_text_box w25 mx-auto">
          <label class="input_text_lbl">ID：</label>
          <div class="">
            <input type="text" name="lid" class="input_text">
            <p class="error"></p>
          </div>
        </div>
        <div class="input_text_box w25 mx-auto">
          <label class="input_text_lbl">PASS：</label>
          <div class="">
            <input type="password" name="lpw" class="input_text">
            <p class="error"></p>
          </div>
        </div>
      </fieldset>
      <button type="submit">送信</button>
    </form>
    <p><a href="user.php">新規登録はこちら</a></p>
  </main>
</body>

</html>