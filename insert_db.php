<!DOCTYPE html>
<html lang="ja">
 
<?php include("header.php"); ?>

<body>

<?php
  try {
    //DB名、ユーザー名、パスワード
    //$dsn = 'mysql:dbname=shizuya_control;host=localhost';
    //$user = 'root';
    //$password = 'password';
    //require_once("config_db.php");
    //$PDO = new PDO($dsn, $user, $password); //MySQLのデータベースに接続
    //$PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); //PDOのエラーレポートを表示
    include("connect_db.php");

    //フォームの値を取得
    $content = $_POST['content'];
    $reserved_date = $_POST['date'];
    $start_time = $_POST['start-time'];
    $end_time = $_POST['end-time'];
    $username = $_POST['name'];
    $email = $_POST['email'];
    $remarks = $_POST['remarks'];

    // メール送信
    //$headers = "From: bubbler018@gmail.com";
    //$email_content = "{$username} さん，予約を承りました.
    //コンテンツは{$content}
    //日付は{$reserved_date}
    //開始時間は{$start_time}
    //終了時間は{$end_time}
    //となります．
    //キャンセルの場合は2日前までに連絡してください．
    //無断でキャンセルされた場合は，僕からの印象が悪くなる可能性があります．";
//
    //if(mb_send_mail($email, $username, $email_content, $headers))
    //{
    //    $message = "予約内容をメールで送信しました．ご確認下さい";
    //}
    //else
    //{
    //    $message = "メール送信が失敗しました．正しいメールアドレスを入力してください．";
    //}

    $sql = "INSERT INTO reservation (content, reserved_date, start_time,end_time,username,email,remarks) VALUES (:content, :reserved_date, :start_time,:end_time,:username,:email,:remarks)"; // INSERT文を変数に格納。:nameや:categoryはプレースホルダという、値を入れるための単なる空箱
    $stmt = $PDO->prepare($sql); //挿入する値は空のまま、SQL実行の準備をする
    //トランザクション処理
    $PDO->beginTransaction();
    $stmt->bindParam(':content', $content);
    $stmt->bindParam(':reserved_date', $reserved_date);
    $stmt->bindParam(':start_time', $start_time);
    $stmt->bindParam(':end_time', $end_time);
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':remarks', $remarks);
    $stmt->execute();

    //コミット
    $PDO->commit();
    //$params = array(':content' => $content, ':reserved_date' => $reserved_date, ':start_time' => $start_time, ':end_time' => $end_time, ':username' => $username, ':email' => $email, ':remarks' => $remarks,':id' => 1); // 挿入する値を配列に格納する
    //$stmt->execute($params); //挿入する値が入った変数をexecuteにセットしてSQLを実行
    //echo '登録完了しました'; // 登録完了のメッセージ
  } catch (PDOException $e) {
  exit('データベースに接続できませんでした。' . $e->getMessage());
  }
?>
<div class="container">
    <br>
    <h1>靜谷予約管理システム</h1>
    <br>
    <div class="row">
        <div class="col-2">
        </div>
        <div class="border col-8">
            <p>以下の内容で予約が登録されました．<?php echo $username?>さんとお会いできる日を楽しみにしています．<br>
            <label>コンテンツ：</label>
            <p class="alert alert-secondary" role="alert"><?php echo $content?></p>
            <label>日付：</label>
            <p class="alert alert-secondary" role="alert"><?php echo $reserved_date?></p>
            <label>開始時間：</label>
            <p class="alert alert-secondary" role="alert"><?php echo $start_time?></p>
            <label>終了時間：</label>
            <p class="alert alert-secondary" role="alert"><?php echo $end_time?></p>
            <label>名前：</label>
            <p class="alert alert-secondary" role="alert"><?php echo $username?></p>
            <label>メールアドレス：</label>
            <p class="alert alert-secondary" role="alert"><?php echo $email?></p>
            <label>備考：</label>
            <p class="alert alert-secondary" role="alert"><?php echo $remarks?></p>
            
            <p> <?php echo $message?> </p>

            <div class="row center-block text-center">
              <div class="col-3">
              </div>
              <div class="col-5">
                  <!--<button type="submit" class="btn btn-outline-primary btn-block">最初の画面に</button>-->
                  <input type="button" class="btn btn-outline-secondary btn-block" onclick="location.href='./index_test.php'" value="最初の画面に戻る">
              </div>
              <div class="col-3">
              </div>
            </div>
    </div>
</div>
</body>
</html>