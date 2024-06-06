<?php
session_start();
$id = $_GET["id"];
$did = $_GET["did"]; 
$uid = $_GET['id'];

// var_dump($did);

include "funcs.php";
sschk();
$pdo = db_conn();

$sql = "SELECT * FROM diet_table WHERE did=:did";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(":did", $did, PDO::PARAM_INT);
$status = $stmt->execute();

if($status==false){
  sql_error($stmt);
}
$row = $stmt->fetch();
// var_dump($row);
?>
<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <title>データ更新</title>
  <link href="https://use.fontawesome.com/releases/v6.2.0/css/all.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
  <link rel="stylesheet" href="./css/output.css">
  <link rel="stylesheet" href="./css/style.css">
</head>

<body>
  <main class="main">
    <a href="./logout.php" class="text-right block text-2xl"><i class="bi bi-box-arrow-right"></i></a>
      <!-- Main[Start] -->
      
      <!-- Main[End] -->

    <?php
    ?>

      <!-- Main[Start] -->
      <form method="post" action="update.php">
        <div class="login_box w-[70%] mx-auto">
          <fieldset>
            <legend>
              <h1 class="h1">記録</h1>
            </legend>
            <div class="flex items-center"><label class="label">日付：</label><input type="date" name="input_date" class="input_text" value="<?= date('Y-m-d') ?>"></div>
            <!-- <div class="flex items-center"><label class="label">食事：</label><div id="calorie_btn" class="p-3 px-0">お食事入力</div></div>-->
            <div class="flex items-center"><label class="label">体重：</label><input type="text" name="weight" class="input_text short_box" value="<?= $row["weight"] ?>"> kg</div>
            <div class="flex items-center"><label class="label">体脂肪率：</label><input type="text" name="fat" class="input_text short_box" value="<?= $row["fat"] ?>"></div>
            <div class="flex items-center"><label class="label">歩数：</label><input type="text" name="step" class="input_text short_box" value="<?= $row["step"] ?>">歩</div>
            <div class="flex items-center"><label class="label">スタンプ：</label>
            <div class="chk_box">
            <?php
              $filename = './data/stamp.json';
              $jsonContent = file_get_contents($filename);
              // $array = json_encode(json_decode($jsonContent));
              $array = json_decode($jsonContent, true);

              $selectedStamps = explode(',', $row["stamp"]);
              // var_dump($selectedStamps);
              ?>
                <?php foreach ($array as $a) {
                  //  var_dump($a);
                  foreach ($a as $a2) {
                    $isChecked = in_array($a2["id"],$selectedStamps)? "checked": ""; ?>
                    <!-- var_dump($a2["id"]);
                    var_dump($isChecked); -->
                    <input type="checkbox" name="stamp[]" id="st[<?=$a2['id']?>]" value="<?=$a2['id']?>" <?=$isChecked?>/>
                    <label for="st[<?=$a2['id']?>]" class="chk_box-icon"><?=$a2['icon']?></label>
                  </label>
                <?php } } ?>
            </div>
            </div>
        <div class="flex"><label class="label">メモ：</label><textarea name="memo" id="" class="text_memo input_text"><?=$row['memo']?></textarea></div>
        <input type="hidden" name="id" value="<?= $id ?>">
        <input type="hidden" name="did" value="<?= $did ?>">
        <button type="submit">送信</button>
        </fieldset>
        </div>

      <!-- Main[End] -->

      </form>

  </main>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  
</body>

</html>