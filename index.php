<?php require_once('function.php'); ?>
<?php require_once('generateid.php'); ?>

<?php

$generateid = generateid(); //自作関数ランダムアルファベットid

date_default_timezone_set("Asia/Tokyo"); //東京に時刻をセット

$comment_array = array();    //書き込んだ内容を入れて行くための箱
$pdo = null;
$stmt = null;
$error_message = array();    //書き込んだ内容のエラーの内容を入れるための箱

//DB接続
try {
    $pdo = new PDO('mysql:host=localhost;dbname=bbs-yt2;charset=utf8', 'root', '');
} catch (PDOException $e) {
    //接続エラーのときエラー内容を取得する
    $error_message[] = $e->getMessage();
}


if(!empty($_POST["submitButton"])){     //ボタンを押したときにnameとcommentがしっかりと埋まっているときの処理(これをしないとエラーが起こる)

    //名前のチェック
    if(empty($_POST["username"])){          //もしusername欄に何も書かれていなかったらの処理
        $_POST["username"] = generateid();  //username自動生成      
    }
    //コメントのチェック
    if(empty($_POST["comment"])){       //もしcomment欄に何も書かれていなかったらの処理
        echo "コメントを入力してください";
        $error_message["comment"] = "コメントを入力してください";
    }
    
   
    if(empty($error_message)){
   
        $postDate = date("Y-m-d H:i:s");   //現在時刻表示 Y は何年, m は何月, d は何日, H は時間, i は分, s は秒 


        try{        //try catch文　プログラマが想像できなかったバグを検知するために必要
            $username = h( $_POST["username"]);
            $comment = h($_POST["comment"]);
            $IDname = $_REQUEST["IDname"];

                //insert idはAutoだからidいらない
                //selectで取り出せばいい
            $stmt = $pdo->prepare("INSERT INTO `bbs-table2` (`username`, `comment`, `postDate`, `IDname`) VALUES (:username, :comment, :postDate, :IDname)"); //データベース上に書き込んでいくためのもの
            $stmt->bindParam(':username', $username,PDO::PARAM_STR);    // $stmt 実行後にSQLの実行結果に関する情報を得たい場合
            $stmt->bindParam(':comment', $comment,PDO::PARAM_STR);      //bindは1つ以上の機能を結合し,その間に渡される記号を解決することで実行可能なプログラムを作成するプロセス
            $stmt->bindParam(':postDate', $postDate,PDO::PARAM_STR);    
            $stmt->bindParam(':IDname', $IDname,PDO::PARAM_STR);


        
            $stmt->execute();    //bindParam()関数は、値の参照を受け取るという点と、execute()関数を使用した際にバインドが確定,execute配列を必要としているから()いる
        } catch (PDOException $e) { //catch (PDOException) 例外が渡ってくるとこ 
        //接続エラーのときエラー内容を取得する
        $error_message[] = $e->getMessage();    //->アロー演算子右にアクセス , Exception::getMessage()例外文字列を画面に出力するためのもの 
        }
        header('Location: index.php');
        //更新の二重送信を防ぐ(PRGパターン)
        //get　URLを用いたデータ送受信(URLにデータが表示されている)
        //post サイトの裏側でデータ送受信
    }
}




//class設計図
//インスタンス家を立てる

//DBからコメントデータを取得
$sql = 'SELECT id, username, comment, postDate, IDname FROM `bbs-table2`';   //データべースからデータを選択して取得
$comment_array = $pdo->query($sql); //SQLを実行するだけであれば$db->query($sql);



//DBの接続を閉じる
$pdo = null;

?>


<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP掲示板</title>
    <link rel="stylesheet" href="style.css">

</head>
<body>
    <h1 class="title">PHP掲示板アプリ</h1>
    <hr>
    <div class="boardWrapper">
        <section>
            <?php foreach($comment_array as $comment): ?><!--- ↓ここでテキストをデータベース上から取り出しHPに繰り返し書きこまれていく↓--->
            <article>
                <div class="wrapper">
                    <div class="nameArea">
                        <span><?php echo $comment["id"]; ?>:</span>
                        <p class="username"><?php echo $comment["username"]; ?></p>
                        <time>:<?php echo $comment["postDate"]; ?></time>
                        <p>&nbsp;ID:<?php echo $comment["IDname"]; ?></p>
                    </div>
                    <p class="comment"><?php echo $comment["comment"]; ?></p>
                </div>
            </article>
            <?php endforeach; ?>                         <!------------------------------------------------ ↑ここまで↑--------------------->
        </section>
        <form class="fromWrapper" method="POST"><!--------------- ↓入力エリア↓--------------------->    
            <div>                                       
                <input type="submit" value="書き込む" name="submitButton">  
                <label for="">名前:</label>
                <input type="text" name="username">
                <label for="" >ID:<?php echo "{$generateid}";?></label>
                <input type="hidden" name="IDname" value="<?= $generateid ?>">
            </div>
            <div>
                <textarea class="commentTextArea" name="comment"></textarea>
            </div>
        </form><!------------------------------------------------ ↑ここまで↑--------------------->
    </div>
    
</body>
</html>