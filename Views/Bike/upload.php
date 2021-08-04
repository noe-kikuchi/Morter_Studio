<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Morteer_Studio</title>
  <!-- <link rel="stylesheet" type="text/css" href="index.css"> -->
  <link rel="stylesheet" href="../css/upload.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  <!-- <script src="validate-config.js"></script> -->
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
</head>
<body>
<?php
  require_once(ROOT_PATH .'Controllers/UserController.php');
  $user = new UserController();
  $params = $user->login_user();
  // echo $user['role'];
?>

<section class="info__section">
  <h2 class="upload_title">バイクのカスタムを投稿する</h2>
  <form action="complete.php" method="post" id="upload" enctype="multipart/form-data">
  <p class="up_text">下記の項目をご記入の上、投稿ボタンを押してください</p>
  <!-- <p  class="up_text"><span class="required">*</span>は必須項目となります</p> -->
  <dl class="up_form">
    <div class="up__title">
      <dt><label for="title">タイトル</label><span class="required">（必須）</span></dt>
      <dd><input type="text" name='title' id="title" class="up__title_input" placeholder="例）GPZ900Rマフラー改造" onblur="blank_alert()"></dd>
    </div>
    <div class="up__modelect">
      <div class="up__mos">
        <div class="model">
          <dt><label for="model">車種</label><span class="required">（必須）</span></dt>
          <dd><input type="text" name='model' id="model" class="up__model_input" placeholder="例）GPZ900R" onblur="blank_alert()"></dd>
        </div>
        <div class="model_year">
          <dt><label for="model_year">年式</label></dt>
          <dd>
              <select name="model_year" class="up_model_year_input">
                <option value="不明">不明</option>
                <option value="1960以前">1960以前</option>
                <?php
                for ($y=1960;$y<date("Y")+1;$y++){
                echo "<option value=\"$y\">" . $y . "</option>\n";
                }
                ?>
              </select>    
          </dd>
        </div>
      </div>

      <div class="up__mes">
        <div class="manufacturer">
          <dt><label for="manufacturer">メーカー</label><span class="required">（必須）</span></dt>
          <dd>
            <select name= "manufacturer" class="up_manufacturer_input">
              <option value = "ホンダ">ホンダ</option>
              <option value = "ヤマハ">ヤマハ</option>
              <option value = "カワサキ">カワサキ</option>
              <option value = "スズキ">スズキ</option>
              <option value = "Harley-Davidson">Harley-Davidson</option>
              <option value = "Ducati">Ducati</option>
              <option value = "BMW">BMW</option>
              <option value = "KTM">KTM</option>
              <option value = "Triumph">Triumph</option>
              <option value = "その他">その他</option>
            </select>
          </dd>
        </div>  

        <div class="custom">
          <dt><label for="custom">カスタム</label><span class="required">（必須）</span></dt>
          <dd>
            <select name= "custom" class="up_custom_input">
              <option value = "マフラー">マフラー</option>
              <option value = "外装">外装</option>
              <option value = "ハンドル">ハンドル</option>
              <option value = "ブレーキ">ブレーキ</option>
              <option value = "エンジン">エンジン</option>
              <option value = "電装系">電装系</option>
              <option value = "足回り">足回り</option>
              <option value = "駆動系">駆動系</option>
              <option value = "フレーム">フレーム</option>
              <option value = "その他">その他</option>
            </select>
          </dd>
        </div> 
      </div>

      <dt><label for="url">購入先URL</label></dt>
      <dd><input type="text" name='url' id="url" class="up__url_input"></dd>

      <dt><label for="image">画像</label><span class="required">（必須）</span></dt>
      <dd>
        <!-- <input type="file" name="image" id="image" multiple> -->
        <input type="file" name="image" class="image_btn" onchange="previewImage(this);">
        <!-- <div id="preview"></div> -->
        <img id="preview" src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" style="max-width:200px;">
      </dd>
  </dl>
  </div>  


  
  

  <h3><label for="introduction">カスタムの紹介文を記入してください<span class="required">（必須）</span></label></h3>
  <dl class="introduction">
    <dd>
      <textarea name="introduction" id="introduction" class="up_introduction_text"></textarea>
    </dd>

    <dd class="upping_btn">
      <div class="sub_btn">
      <button type="submit" class="up_sb_btn">投　稿</button>
      </div>
    </dd>
  </dl>
  </form>
</section>




</body>
</html>

<script type="text/javascript">
function previewImage(obj)
{
	var fileReader = new FileReader();
	fileReader.onload = (function() {
		document.getElementById('preview').src = fileReader.result;
	});
	fileReader.readAsDataURL(obj.files[0]);
}


// function previewFile(file) {
//   // プレビュー画像を追加する要素
//   const preview = document.getElementById('preview');

//   // FileReaderオブジェクトを作成
//   const reader = new FileReader();

//   // ファイルが読み込まれたときに実行する
//   reader.onload = function (e) {
//     const imageUrl = e.target.result; // 画像のURLはevent.target.resultで呼び出せる
//     const img = document.createElement("img"); // img要素を作成
//     img.src = imageUrl; // 画像のURLをimg要素にセット
//     preview.appendChild(img); // #previewの中に追加
//   }

//   // いざファイルを読み込む
//   reader.readAsDataURL(file);
// }

// // <input>でファイルが選択されたときの処理
// const fileInput = document.getElementById('example');
// const handleFileSelect = () => {
//   const files = fileInput.files;
//   for (let i = 0; i < files.length; i++) {
//     previewFile(files[i]);
//   }
// }
// fileInput.addEventListener('change', handleFileSelect);
</script>




