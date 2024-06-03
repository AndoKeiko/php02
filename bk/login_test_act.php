<?php
ini_set( 'display_errors', 1 );
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // データベース接続設定
    $dsn = 'mysql:host=localhost;dbname=gs_db2;charset=utf8';
    $db_user = 'root';  // データベースのユーザー名
    $db_password = '';  // データベースのパスワード

    try {
        $pdo = new PDO($dsn, $db_user, $db_password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // フォームデータの取得
        $username = $_POST['username'];
        $password = $_POST['password'];

        // ユーザーの情報をデータベースから取得
        $stmt = $pdo->prepare("SELECT * FROM users WHERE username = :username");
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        // パスワードの確認
        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            echo "ログイン成功！";
        } else {
            echo "ユーザー名またはパスワードが間違っています。";
        }
    } catch (PDOException $e) {
        echo 'エラー: ' . $e->getMessage();
    }
}
?>
