<?php
session_start();
//※htdocsと同じ階層に「includes」を作成してfuncs.phpを入れましょう！
//include "../../includes/funcs.php";
?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <title>USERデータ登録</title>
  <link rel="stylesheet" href="css/style.css" />
  <link rel="stylesheet" href="css/output.css" />
</head>

<body>
  <main class="main">
    <header>
      <nav class="h1">ユーザー登録</nav>
    </header>

    <!-- Main[Start] -->
    <form name="form_user" method="post" action="user_insert.php">
      <fieldset>
        <div class="input_text_box w-full mx-auto flex-col whitespace-nowrap">
          <div class="input_text_box">
            <label class="input_text_lbl">お名前：</label>
            <input type="text" name="name" class="input_text">
            <p class="error"></p>
          </div>
          <div class="input_text_box">
            <label class="input_text_lbl">email：</label>
            <input type="text" name="email" class="input_text">
            <p class="error"></p>
          </div>

          <div class="input_text_box">
            <label class="input_text_lbl" class="">Login ID：</label>
            <input type="text" name="lid" class="input_text">
            <p class="error"></p>
          </div>

          <div class="input_text_box">
            <label class="input_text_lbl">Login PW：</label>
            <input type="text" name="lpw" class="input_text">
            <p class="error"></p>
          </div>
        </div>
        <button type="submit">送信</button>
      </fieldset>
    </form>
    <!-- Main[End] -->

  </main>
</body>

</html>