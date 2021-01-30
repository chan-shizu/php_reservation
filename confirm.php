<!DOCTYPE html>
<html lang="ja">
 
<?php include("header.php"); ?>

<body>

<?php

    //フォームの値を取得
    $content = $_POST['content'];
    $reserved_date = $_POST['date'];
    $start_time = $_POST['start-time'];
    $end_time = $_POST['end-time'];
    $username = $_POST['name'];
    $email = $_POST['email'];
    $remarks = $_POST['remarks'];
   
?>

<div class="container">
    <br>
    <h1>靜谷予約管理システム</h1>
    <br>
    <div class="row">
        <div class="col-2">
        </div>
        <div class="border col-8">
            <p>記載内容に間違いが無ければ，登録をお願いします．<br>
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
            <form action="./insert_db.php" method="post">
                <input type="hidden" name="content" value="<?php echo $content;?>" >
                <input type="hidden" name="date" value="<?php echo $reserved_date;?>" >
                <input type="hidden" name="start-time" value="<?php echo $start_time;?>" >
                <input type="hidden" name="end-time" value="<?php echo $end_time;?>" >
                <input type="hidden" name="name" value="<?php echo $username;?>" >
                <input type="hidden" name="email" value="<?php echo $email;?>" >
                <input type="hidden" name="remarks" value="<?php echo $remarks;?>" >
                <div class="row center-block text-center">
                    <div class="col-1">
                    </div>
                    <div class="col-5">
                        <button type="button" class="btn btn-outline-secondary btn-block">閉じる</button>
                    </div>
                    <div class="col-5">
                        <button type="submit" class="btn btn-outline-primary btn-block">新規登録</button>
                    </div>
                    <div class="col-1">
                </div>
            </form>
            <?php
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
            //    echo "メール送信成功です";
            //}
            //else
            //{
            //echo "メール送信失敗です";
            //}
            ?>
    </div>
</div>
</body>
</html>