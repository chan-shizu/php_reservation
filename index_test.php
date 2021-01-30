<!doctype html>
<html lang="ja">
 
<?php
include("header.php");
include("connect_db.php");

// 以下，カレンダー表示のための設定
date_default_timezone_set('Asia/Tokyo');

//表示させる年月を設定　↓これは現在の月
$year = date('Y');
$month = date('m');

//月末日を取得
$end_month = date('t', strtotime($year.$month.'01'));
//1日の曜日を取得
$first_week = date('w', strtotime($year.$month.'01'));
//月末日の曜日を取得
$last_week = date('w', strtotime($year.$month.$end_month));

$aryCalendar = [];
$j = 0;

//1日開始曜日までの穴埋め
for($i = 0; $i < $first_week; $i++){
    $aryCalendar[$j][] = '';
}

//1日から月末日までループ
for ($i = 1; $i <= $end_month; $i++){
    //日曜日まで進んだら改行
    if(isset($aryCalendar[$j]) && count($aryCalendar[$j]) === 7){
        $j++;
    }
    $aryCalendar[$j][] = $i; 
}

//月末曜日の穴埋め
for($i = count($aryCalendar[$j]); $i < 7; $i++){
    $aryCalendar[$j][] = '';
}

$aryWeek = ['日', '月', '火', '水', '木', '金', '土'];

// reservationテーブルからすべてのデータを取得
//$sql = "SELECT * FROM reservation";
$today = date("Y-m-d");
//$test = DATE_FORMAT($today, '%y%m');
//echo $test;
$sql ="SELECT * FROM reservation WHERE
  DATE_FORMAT(reserved_date, '%Y%m') = '{$year}{$month}'";//DATE_FORMAT({$today}, '%Y%m')";
$res = $PDO->query($sql);

?>
 
<body>
    <div class="container">
        <br>
        <h1>靜谷予約管理システム</h1>
        <br>
        <div class="row">
            <div class="col-1">
            </div>
            <div class="border col-10">
                <br>
                <h2>今月の予約</h2>
                <br>
                <p>今月の予約です．かぶらないように注意してください．</p>

                <!-- 以下，カレンダー表示-->
                <table class="calendar">
                    <!-- 曜日の表示 -->
                    <tr>
                        <?php foreach($aryWeek as $week){ ?>
                            <th><?php echo $week ?></th>
                        <?php } ?>
                    </tr>
                    <!-- 日数の表示 -->
                    <?php foreach($aryCalendar as $tr){ ?>
                        <tr>
                            <?php foreach($tr as $td){ 
                                if($td != date('j')){ 
                                $sql ="SELECT * FROM reservation WHERE
                                DATE_FORMAT(reserved_date, '%Y%m%d') = '{$year}{$month}{$td}'";//DATE_FORMAT({$today}, '%y%m')";
                                $res = $PDO->query($sql);?>
                                <td><?php echo $td;
                                foreach( $res as $value ) {
                                    echo "<br>$value[username], $value[start_time]";
                                    }
                                $res=null;
                                ?></td>
                            <?php }else{ ?>
                            <!-- 今日の日付 -->
                            <td class="today"><?php echo $td ?></td>
                            <?php } 
                            } ?>
                        </tr>
                    <?php } ?>
                </table>
                <br>
                <br>
                <div class="row">
                    <div class="col-md">
                    <h2>入力事項</h2>
                        <form action="./confirm.php" method="post">
                            <div class="form-group">
                                <label>僕と何をしたいか選択してください．その他の場合は補足に書いてね：</label>
                                <select class="form-control" name="content" id="exampleFormControlSelect1" required>
                                    <option value="music">楽器演奏</option>
                                    <option value="consultant">お悩み相談</option>
                                    <option value="movie">映画鑑賞</option>
                                    <option value="bookoff">BookOff</option>
                                    <option value="bookoff">その他</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label>日付：</label>
                                <input type="date" name="date" class="form-control" placeholder="" required>
                            </div>
                            <div class="form-group">
                                <label>開始時間(30分単位)：</label>

                                <!--<input type="time" list="data1" name="start-time" class="form-control" placeholder="11:00">
                                <datalist id="data1">
                                <option value="01:00"></option>
                                <option value="02:00"></option>
                                <option value="03:00"></option>
                                </datalist>-->

                                <input type="time" name="start-time" class="form-control" step="1800" placeholder="11:00" required>
                            </div>
                            <div class="form-group">
                                <label>終了時間(30分単位)：</label>
                                <input type="time" name="end-time" class="form-control"  step="1800" placeholder="13:00" required>
                            </div>
                            <div class="form-group">
                                <label>名前：</label>
                                <input type="text" name="name" class="form-control" placeholder="田中太郎" required>
                            </div>
                            <div class="form-group">
                                <label>メールアドレス：</label>
                                <input type="mail" name="email" class="form-control" placeholder="aaaaa@gmail.com" required>
                            </div>
                            <div class="form-group">
                                <label>補足：</label>
                                <textarea class="form-control" name="remarks" rows="3"></textarea>
                            </div>
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
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br>
    <br>
    <hr>
    <br>
        <!--<h2>人事データ一覧</h2>
        <div class="row">
            <div class="col-md">
 
                <table class="table">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">氏名</th>
                            <th scope="col">部署</th>
                            <th scope="col">住所</th>
                            <th scope="col">電話番号</th>
                            <th scope="col">補足</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row">1</th>
                            <td>侍1</td>
                            <td>システム開発部</td>
                            <td>神奈川県〇〇市〇〇区〇〇町X-X-X</td>
                            <td>ZZZ-ZZZZ-ZZZZ</td>
                            <td>2013年新卒入社</td>
                        </tr>
                        <tr>
                            <th scope="row">2</th>
                            <td>侍2</td>
                            <td>システム開発部</td>
                            <td>神奈川県〇〇市〇〇区〇〇町X-X-X</td>
                            <td>ZZZ-ZZZZ-ZZZZ</td>
                            <td>2010年新卒入社</td>
                        </tr>
                        <tr>
                            <th scope="row">3</th>
                            <td>侍3</td>
                            <td>システム開発部</td>
                            <td>神奈川県〇〇市〇〇区〇〇町X-X-X</td>
                            <td>ZZZ-ZZZZ-ZZZZ</td>
                            <td>1990年新卒入社</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <br>
    </div>-->
 
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
 
</html>