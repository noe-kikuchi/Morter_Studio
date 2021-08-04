<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Morteer_Studio</title>
  <!-- <link rel="stylesheet" type="text/css" href="index.css"> -->
  <link rel="stylesheet" href="../css/index.css">
  <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script> -->
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
</head>
<body>
<?php
  require_once(ROOT_PATH .'Controllers/UserController.php');
  $user = new UserController();
  $params = $user->login_user();
  // echo $user['role'];
?>

<!-- <?php echo $_GET['id']; ?> -->


<?php foreach((array)$params as $user): ?>
    <?php 
    // echo $user['id'];
    $user_id = $user['id'];
    $login_user = $user['name'];
    // if($user['id']==$bike['user_id']){
    //   echo '<a href=../Bike/upload_edit.php?id='. $bike['id']. '>編集</a>'; 
    // }
    ?>



<?php
  require_once(ROOT_PATH .'Controllers/BikeController.php');
  $user = new BikeController();
  $params = $user->bike__show();
  // echo $user['role'];
?>





<?php foreach((array)$params as $bike): ?>

  <div class="bike__look">
    <div class="bike__look__left">
      <?=$bike['custom'] ?>
      <?php 
          echo '<img src="../img/' . $bike['image'] . '" width="500" height="350">';
      ?>
      <div class="bike__img_bottom">
        <div class="bike__img_bottom_left">
          投稿者：
          <?php echo '<a href=../User/show_u.php?id='. $bike['user_id']. ' class="bike__user">'. $bike['user_name']. '</a>';
          ?>
        </div>
        <div class="bike__img_bottom_right">
          <?php 
            // echo $bike['user_id'];
            // echo $user_id;
            if($user_id==$bike['user_id']){
              echo '<a href=../Bike/upload_edit.php?id='. $_GET['id']. ' class="bike__show__edit__btn">編集　</a>'; 
              echo '<a href=../Bike/delete.php?id='. $_GET['id']. ' class="bike__show__delete__btn">削除　</a>'; 
            }  
          ?>
        </div>  
        <div class="iines">
          <?php $bike_id = $bike['id']; ?>

          <?php
            function check_favolite_duplicate($user_id,$bike_id){
              $dsn = 'mysql:dbname=morterstudio;host=localhost';
              $user='root';
              $password='root';
              $dbh=new PDO($dsn,$user,$password);
                $sql = "SELECT *
                        FROM likes
                        WHERE user_id = :user_id AND bike_id = :bike_id";
                $stmt = $dbh->prepare($sql);
                $stmt->execute(array(':user_id' => $user_id ,
                                    ':bike_id' => $_GET['id']));
                $favorite = $stmt->fetch();
                return $favorite;
            }
          ?>
          <?php
            $dsn = 'mysql:dbname=morterstudio;host=localhost';
            $user='root';
            $password='root';
            $dbh=new PDO($dsn,$user,$password);
            $sql = "SELECT * FROM likes WHERE bike_id = :bike_id";
            $stmt = $dbh->prepare($sql);
            $stmt->execute(array(':bike_id' => $_GET['id']));
            $count = $stmt->rowCount();
          ?>

          <form method="POST" id="form" target="fuga" action="../Like/iine.php">
            <!-- <button id="l1" type="button" class="iine" name="callPhone" onclick="calliine(<?=$_GET['id']?>);"> -->
            <button id="l1" type="button" class="iine" name="callPhone" onclick="calliine(<?=$_GET['id']?>);">
            <?php if (!check_favolite_duplicate($user_id,$bike_id)): ?>
                      ♡ <?= $count ?>
                    <?php else: ?>
                      ♡いいね済 <?= $count ?>

                    <?php endif; ?>
            </button>
            <input type="hidden" value="<?=$_GET['id']?>" name="bike_id">
          </form>

          <iframe name="fuga" scrolling="no" style="display:none"></iframe>
        </div>
      </div>    

    </div>  
    <div class="bike__look__right">
      <div class="back__btn__box">
        <a href="javascript:history.back();" class="back_btn">戻　る</button></a>
      </div>
      <h2 class="bike__show__title"><?=$bike['title'] ?></h2>
      <div class="bike__show__int">
        <?=$bike['introduction'] ?>
      </div>
      <div class="bike__show__spec">
        <div><?=$bike['manufacturer'] ?> </div>
        <div><?=$bike['model'] ?> </div>
        <div><?=$bike['model_year'] ?>年式</div>
      </div>  



      <br>購入先URL：<a href="<?=$bike['url'] ?>" class="bike__show__url"><?=$bike['url'] ?></a>

    </div>
  </div>

  <?php $count1 = $count + 1 ?>
  <!-- <?php echo $count1 ?> -->


<script>

  function calliine(bike_id) {
    console.log('ok');
  var elem = document.getElementById("l1");
//     // 新しいHTML要素を作成
    elem.innerHTML = "<span>♡いいね済" + <?php echo $count1 ?> + "</span>"; 
    document.getElementById("form").submit();
    // $.post("../Like/iine.php?",{'bike_id' : bike_id});
    //任意の実行したい処理
    return false;}

</script>


<div class="comments">
  <h1 class="comment__title">コメント</h1>

  <div class="comment__submit_erea">
    <!-- <input id="name" type="text" /><br> -->
    <input id="name" type="hidden" value="<?php if (!empty($login_user)) echo(htmlspecialchars($login_user, ENT_QUOTES, 'UTF-8'));?>" /><br>
    <input id="body" class="comment_input" type="text" />
      <button id="postBtn" class="comment__btn">コメントする</button>
  </div>
      
  <div>
  <ul id="logList" class="log__list"></ul>
  </div>
</div>  


</body>
</html>


<script>

// 初期化処理
window.onload = function() {
    // ボタンが押されたイベントハンドラを設定
    $("postBtn").onclick = writeLog;
    // ログを読み込む
    showLog();
};
 
// ログの表示
function showLog() {
    // Ajaxでログを取得
    ajaxGet(
      "../Comment/comment_up.php?id=<?= $_GET['id'] ?>&type=getLog",
      function (xhr, text) {
            var logs = JSON.parse(text);
            renderLog(logs);
        });
};
 
// ログデータに基づき描画
function renderLog(logs) {
    var html = "";
    for(var i in logs) {
        var m = logs[i];
        var date = m["date"];
        var name = m["name"];
        var body = m["body"];
        html += "<li>" + date + "：" + name + "<br>「" + body + "」</li>";
    }
    $("logList").innerHTML = html;
}
 
// 書き込みを投稿する
function writeLog() {
    var name = $("name").value;
    var body = $("body").value;
    var params = "type=writeLog&" + "name=" + encodeURI(name) + "&" + "body=" + encodeURI(body);
  ajaxGet("../Comment/comment_up.php?id=<?= $_GET['id'] ?>&" + params, function(xhr, text) {
        // テキストフィールドを初期化                                 
        $("body").value = "";
        // 書き込みを反映
        showLog();
    });
}
 
 
// Ajax用
function ajaxGet(url, callback) {
    // XMLHttpRequestのオブジェクトを作成
    var xhr = new XMLHttpRequest();
    // 非同期通信でURLをセット
    xhr.open('GET', url, true);
    // 通信状態が変化したときのイベント
    xhr.onreadystatechange = function() {
        if(xhr.readyState == 4) {
            if(xhr.status == 200) {
                callback(xhr, xhr.responseText);
            }
        }
    };
    xhr.send('');
    return xhr;
}
 
 
// 任意のIDを得る
function $(id) {
    return document.getElementById(id);
}

</script>



</body>
</html>
<?php endforeach; ?>
<?php endforeach; ?>


