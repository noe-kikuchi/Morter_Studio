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


<br><br>
<!-- <script type="text/javascript"></script> -->
<h1>コメント</h1>

<div>
  <!-- <input id="name" type="text" /><br> -->
  <input id="name" type="hidden" value="<?php if (!empty($login_user)) echo(htmlspecialchars($login_user, ENT_QUOTES, 'UTF-8'));?>" /><br>
<input id="body" type="text" />
    <button id="postBtn">コメントする</button>
</div>
     
<h2>コメント一覧</h2>
<div>
<ul id="logList"></ul>
</div>


</body>
</html>


<script>


// 初期化処理
window.onload = function() {
    // ボタンが押されたイベントハンドラを設定
    $("postBtn").onclick = writeLog;
    // ログを読み込む
    console.log('ok');
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
