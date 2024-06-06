<?php
session_start();
// echo $_SESSION['first_time'];
include "funcs.php";
sschk();
if (!isset($_SESSION['id'])) {
echo $_SESSION['id'];
}
$pdo = db_conn(); ?>
<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <title>データ登録</title>
  <link href="https://use.fontawesome.com/releases/v6.2.0/css/all.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
  <link rel="stylesheet" href="./css/output.css">
  <link rel="stylesheet" href="./css/style.css">
</head>

<body>
  <main class="main">
    <a href="./logout.php" class="text-right block text-2xl"><i class="bi bi-box-arrow-right"></i></a>
    <?php
    if (isset($_SESSION['first_time']) && $_SESSION['first_time'] === true) {
      $uid = $_SESSION['id']; ?>
      <!-- Main[Start] -->
      <form name="form_user" method="post" action="user_insert_first.php">
        <fieldset>
          <div class="input_text_box w-full mx-auto flex-col whitespace-nowrap">
            <label class="input_text_lbl">身長：</label>
            <div class="w-full">
              <input type="text" name="height" class="input_text">
              <p class="error"></p>
            </div>
            <label class="input_text_lbl">目標の体重：</label>
            <div class="w-full">
              <input type="text" name="goal" class="input_text"></label>
              <p class="error"></p>
            </div>
          </div>
          <button type="submit">送信</button>
        </fieldset>
      </form>
      <!-- Main[End] -->

    <?php
      unset($_SESSION['first_time']);
    } else {
      // try {
      //   $pdo = new PDO('mysql:dbname=gs_kadai;charset=utf8;host=localhost', 'root', '');
      // } catch (PDOException $e) {
      //   exit('DBConnection Error:' . $e->getMessage());
      // }
      // $sql = "SELECT * FROM diet_table ORDER BY input_date ASC;";
      $uid = $_SESSION['id'];
      // var_dump($uid);
      $sql = "SELECT user_table.*, diet_table.*,goal_table.* FROM diet_table
              INNER JOIN user_table ON diet_table.uid = user_table.id
              INNER JOIN goal_table ON goal_table.uid = user_table.id
              WHERE user_table.id = :id
              ORDER BY diet_table.input_date ASC";

      $stmt = $pdo->prepare($sql);
      $stmt->bindParam(':id', $_SESSION['id'], PDO::PARAM_INT);
      $status = $stmt->execute();

      $values = "";
      if ($status == false) {
        $error = $stmt->errorInfo();
        exit("SQLError:" . $error[2]);
      }

      $values = $stmt->fetchAll(PDO::FETCH_ASSOC);

      foreach ($values as $value) {
        $lid = $value["lid"];
      }
      // $json = json_encode($values,JSON_UNESCAPED_UNICODE);

    ?>

      <!-- Main[Start] -->
      <form method="post" name="form_list" action="insert_diet.php">
        <div class="login_box w-[70%] mx-auto">
          <fieldset>
            <legend>
              <h1 class="h1">記録</h1>
            </legend>
            <div class="flex items-center"><label class="label">日付：</label><input type="date" name="input_date" class="input_text" value="<?= date('Y-m-d') ?>"></div>
            <!-- <div class="flex items-center"><label class="label">食事：</label><div id="calorie_btn" class="p-3 px-0">お食事入力</div></div>-->
            <div class="flex items-center"><label class="label">体重：</label><input type="text" name="weight" class="input_text short_box">kg</div>
            <div class="flex items-center"><label class="label">体脂肪率：</label><input type="text" name="fat" class="input_text short_box"></div>
            <div class="flex items-center"><label class="label">歩数：</label><input type="text" name="step" class="input_text short_box">歩</div>
            <div class="flex items-center"><label class="label">スタンプ：</label>
            <div class="chk_box">
            <?php
              $filename = './data/stamp.json';
              $jsonContent = file_get_contents($filename);
              // $array = json_encode(json_decode($jsonContent));
              $array = json_decode($jsonContent, true);
              // var_dump($array);
              ?>
                <?php foreach ($array as $a) {
                  //  var_dump($a);
                  foreach ($a as $a2) {
                    // var_dump($a2["id"]); ?>
                    <input type="checkbox" name="stamp[]" id="st[<?=$a2['id']?>]" value="<?=$a2['id']?>" />
                    <label for="st[<?=$a2['id']?>]" class="chk_box-icon"><?=$a2['icon']?></label>
                  </label>
                <?php } } ?>
            </div>
            </div>
        <div class="flex"><label class="label">メモ：</label><textarea name="memo" id="" class="text_memo input_text"></textarea></div>
        <input type="hidden" name="" value="<?= $_SESSION['id'] ?>">
        <button type="submit">送信</button>
        </fieldset>
        </div>
      </form>
      <!-- Main[End] -->
      <?php
      if ($values) {
        // var_dump($values);
      ?>
        <div class="diet_record_table w-[100%] mx-auto">
          <form action="delete.php" id="delete_list" method="post">
          <table class="table-auto w-full">
            <thead className="sticky top-0 z-10 ">
              <tr>
                <th>&nbsp;&nbsp;</th>
                <th><a id="select_delete_btn"><i class="bi bi-trash3"></i></a></th>
                <th class="px-4 py-2 border bg-red-300">日付</th>
                <!-- <th class="px-4 py-2 border bg-red-300">総カロリー</th> -->
                <th class="px-4 py-2 border bg-red-300">体重</th>
                <th class="px-4 py-2 border bg-red-300">歩数</th>
                <th class="px-4 py-2 border bg-red-300">体脂肪</th>
                <th class="px-4 py-2 border bg-red-300">スタンプ</th>
                <th class="px-4 py-2 border bg-red-300">メモ</th>
                <th>更新</th>
              </tr>
            </thead>
            <?php
            $c = ",";
            $input_date = "";
            $weight = "";
            $step = "";
            // var_dump($values);
            foreach ($values as $index => $v) { ?>
              <tr>
                <td><a href="delete.php?id=<?=$v["id"]?>&did=<?=$v["did"]?>?>"><i class="bi bi-trash3"></i></a></td>
                <td><input type="checkbox" name="trash[]" id="<?=$v["did"]?>" value="<?= $v['did'] ?>" class="trash_chk text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"></td>
                <td class="px-4 py-2 border"><?= $v["input_date"] ?></td>
                <td class="px-4 py-2 border"><?= $v["weight"] ?></td>
                <td class="px-4 py-2 border"><?= $v["step"] ?> 歩</td>
                <td class="px-4 py-2 border"><?= $v["fat"] ?></td>
                <td class="px-4 py-2 border stamp_box">
                <?php
                $stamps = explode(',', $v['stamp']);
                foreach ($array as $a) {
                   foreach ($a as $a2) {
                    if (in_array($a2['id'], $stamps)) {
                      echo $a2['icon'];
                    }
                  }
                }
                ?>
                </td>
                <td class="px-4 py-2 border memo"><?= $v["memo"] ?></td>
                <td class="px-4 py-2 border"><a href="detail.php?id=<?=$v["id"]?>&did=<?=$v["did"]?>"><i class="bi bi-arrow-counterclockwise"></i></a></td>
              </tr>
            <?php if ($index == 0) {
                $input_date .= '"' . $v["input_date"] . '"';
                $weight .= '"' . $v["weight"] . '"';
                $step .= '"' . $v["step"] . '"';
              } else {
                $input_date .= $c . '"' . $v["input_date"] . '"';
                $weight .= $c . '"' . $v["weight"] . '"';
                $step .= $c . '"' . $v["step"] . '"';
              }
              $goal = $v["goal"];
              // echo $goal;
            }
            ?>
          </table>
          </form>
        </div>
        <div class="mt-16">
          <h2 class="text-center mb-8 text-[18px]">目標体重まで：
          <?php
            $weight_array = explode(',', $weight);
            // var_dump($weight_array);
            $new_weight = end($weight_array);
            $new_weight = (int)trim($new_weight,'"');
            $goal = (int)$goal;
            echo $goal - $new_weight . "キロです";
            // var_dump($goal);
            // var_dump($weight);
            // ormar_dump($new_weight);          
          ?></h2>
          <canvas id="myChart"></canvas>
        </div>

  </main>
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
  <script src="./js/app.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script>
    const weight = [<?= $weight ?>];
    const step = [<?= $step ?>];
    const input_date = [<?= $input_date ?>];
    const goal = <?= $goal ?>;
    const allWeights = [...weight, goal];
    // console.log(step);
    // console.log(weight);
    const ctx = document.getElementById('myChart').getContext('2d');
    const myChart = new Chart(ctx, {
      type: 'bar', // Primary chart type
      data: {
        labels: [<?= $input_date ?>],
        datasets: [{
            type: 'bar', // Specify this dataset is a bar chart
            label: '歩数',
            data: [<?= $step ?>],
            backgroundColor: 'rgba(75, 192, 192, 0.2)',
            borderColor: 'rgba(75, 192, 192, 1)',
            borderWidth: 1,
            yAxisID: 'y-steps'
          },
          {
            type: 'line', // Specify this dataset is a line chart
            label: '体重',
            data: [<?= $weight ?>],
            backgroundColor: 'rgba(153, 102, 255, 0.2)',
            borderColor: 'rgba(153, 102, 255, 1)',
            borderWidth: 1,
            fill: false,
            yAxisID: 'y-weight'
          },
          {
            type: 'line', // Specify this dataset is a line chart
            label: '目標体重',
            data: Array(input_date.length).fill(goal), // Fill the array with the goal value
            backgroundColor: 'rgba(255, 99, 132, 0.2)',
            borderColor: 'rgba(255, 99, 132, 1)',
            borderWidth: 1,
            fill: false,
            yAxisID: 'y-weight'
          }
        ]
      },
      options: {
        responsive: true,
        scales: {
          // y: {
          //   beginAtZero: true
          // },
          'y-steps': { // Define the steps axis
            type: 'linear',
            position: 'right',
            beginAtZero: true,
            title: {
              display: true,
              text: '歩数'
            }
          },
          'y-weight': { // Define the weight axis
            type: 'linear',
            position: 'left',
            beginAtZero: true,
            min: Math.min(...allWeights) - 5,
            max: Math.max(...allWeights) + 5,
            stepSize: 1,
            title: {
              display: true,
              text: '体重 (kg)'
            },
            grid: {
              drawOnChartArea: false // Only draw grid lines for one axis
            }
          }
        }
      }
    });
  </script>
<?php
      }
    }
?>
</body>

</html>