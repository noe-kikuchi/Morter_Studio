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

<?php
  require_once(ROOT_PATH .'Controllers/BikeController.php');
  $user = new BikeController();
  $params = $user->bike__show();
  // echo $user['role'];
?>



<?php foreach((array)$params as $bike): ?>

<section class="info__section">
  <h2 class="upload_title">投稿を編集する</h2>
  <form action="upload_edit_complete.php" method="post" id="upload" enctype="multipart/form-data">
  <p class="up_text">下記の項目をご記入の上、投稿ボタンを押してください</p>
  <dl class="up_form">

    <input type="hidden" name='id' id="id" value="<?php if (!empty($_GET['id'])) echo(htmlspecialchars($_GET['id'], ENT_QUOTES, 'UTF-8'));?>">

    <div class="up__title">
      <dt><label for="title">タイトル</label><span class="required">（必須）</span></dt>
      <dd><input type="text" name='title' id="title" class="up__title_input" placeholder="例）GPZ900Rマフラー改造" onblur="blank_alert()" value="<?php if (!empty($bike['title'])) echo(htmlspecialchars($bike['title'], ENT_QUOTES, 'UTF-8'));?>"></dd>
    </div>

    <div class="up__modelect">
      <div class="up__mos">
        <div class="model">
          <dt><label for="model">車種</label><span class="required">（必須）</span></dt>
          <dd><input type="text" name='model' id="model" class="up__model_input" placeholder="例）GPZ900R" onblur="blank_alert()"  value="<?php if (!empty($bike['model'])) echo(htmlspecialchars($bike['model'], ENT_QUOTES, 'UTF-8'));?>"></dd>
        </div>
        <div class="model_year">
          <dt><label for="model_year">年式</label></dt>
          <dd>
              <select name="model_year" class="up_model_year_input">
                <option value="不明" <?php if(isset($bike['model_year']) && $bike['model_year'] === "不明") { echo "selected";} ?>>不明</option>
                <option value="1960以前" <?php if(isset($bike['model_year']) && $bike['model_year'] === "1960以前") { echo "selected";} ?>>1960以前</option>
                <?php
                for ($y=1960;$y<date("Y")+1;$y++):?>
                <option value="<?=$y ?>" <?php if(isset($bike['model_year']) && $bike['model_year'] === "$y") { echo "selected";} ?>><?=$y ?></option>
                <?php endfor; ?>
              </select>    
          </dd>
        </div>
      </div>
  
      <div class="up__mes">
        <div class="manufacturer">
          <dt><label for="manufacturer">メーカー</label><span class="required">（必須）</span></dt>
          <dd>
            <select name= "manufacturer" class="up_manufacturer_input">
              <option value = "ホンダ" <?php if(isset($bike['manufacturer']) && $bike['manufacturer'] === "ホンダ") { echo "selected";} ?>>ホンダ</option>
              <option value = "ヤマハ" <?php if(isset($bike['manufacturer']) && $bike['manufacturer'] === "ヤマハ") { echo "selected";} ?>>ヤマハ</option>
              <option value = "カワサキ" <?php if(isset($bike['manufacturer']) && $bike['manufacturer'] === "カワサキ") { echo "selected";} ?>>カワサキ</option>
              <option value = "スズキ" <?php if(isset($bike['manufacturer']) && $bike['manufacturer'] === "スズキ") { echo "selected";} ?>>スズキ</option>
              <option value = "Harley-Davidson" <?php if(isset($bike['manufacturer']) && $bike['manufacturer'] === "Harley-Davidson") { echo "selected";} ?>>Harley-Davidson</option>
              <option value = "Ducati" <?php if(isset($bike['manufacturer']) && $bike['manufacturer'] === "Ducati") { echo "selected";} ?>>Ducati</option>
              <option value = "BMW" <?php if(isset($bike['manufacturer']) && $bike['manufacturer'] === "BMW") { echo "selected";} ?>>BMW</option>
              <option value = "KTM" <?php if(isset($bike['manufacturer']) && $bike['manufacturer'] === "KTM") { echo "selected";} ?>>KTM</option>
              <option value = "Triumph" <?php if(isset($bike['manufacturer']) && $bike['manufacturer'] === "Triumph") { echo "selected";} ?>>Triumph</option>
              <option value = "その他" <?php if(isset($bike['manufacturer']) && $bike['manufacturer'] === "その他") { echo "selected";} ?>>その他</option>
            </select>
          </dd>
        </div>  
  
        <div class="custom">
          <dt><label for="custom">カスタム</label><span class="required">（必須）</span></dt>
          <dd>
            <select name= "custom" class="up_custom_input">
              <option value = "マフラー" <?php if(isset($bike['custom']) && $bike['custom'] === "マフラー") { echo "selected";} ?>>マフラー</option>
              <option value = "外装" <?php if(isset($bike['custom']) && $bike['custom'] === "外装") { echo "selected";} ?>>外装</option>
              <option value = "ハンドル" <?php if(isset($bike['custom']) && $bike['custom'] === "ハンドル") { echo "selected";} ?>>ハンドル</option>
              <option value = "ブレーキ" <?php if(isset($bike['custom']) && $bike['custom'] === "ブレーキ") { echo "selected";} ?>>ブレーキ</option>
              <option value = "エンジン" <?php if(isset($bike['custom']) && $bike['custom'] === "エンジン") { echo "selected";} ?>>エンジン</option>
              <option value = "電装系" <?php if(isset($bike['custom']) && $bike['custom'] === "電装系") { echo "selected";} ?>>電装系</option>
              <option value = "足回り" <?php if(isset($bike['custom']) && $bike['custom'] === "足回り") { echo "selected";} ?>>足回り</option>
              <option value = "駆動系" <?php if(isset($bike['custom']) && $bike['custom'] === "駆動系") { echo "selected";} ?>>駆動系</option>
              <option value = "フレーム" <?php if(isset($bike['custom']) && $bike['custom'] === "フレーム") { echo "selected";} ?>>フレーム</option>
              <option value = "その他" <?php if(isset($bike['custom']) && $bike['custom'] === "その他") { echo "selected";} ?>>その他</option>
            </select>
          </dd>
        </div> 
      </div>
  

    <dt><label for="url">購入先URL</label></dt>
    <dd><input type="text" name='url' id="url" class="up__url_input" value="<?php if (!empty($bike['url'])) echo (htmlspecialchars($bike['url'], ENT_QUOTES, 'UTF-8'));?>"></dd>


    <dt><label for="image">画像</label><span class="required">（必須）</span></dt>
    <dd>
      <!-- <input type="file" name="image" id="image" multiple> -->
      <input type="file" name="image" onchange="previewImage(this);">
      <!-- <div id="preview"></div> -->
      <img id="preview" src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" style="max-width:200px;">
    </dd>

  </dl>
  </div>  

  
  

  <h3><label for="introduction">カスタムの紹介文を記入してください<span class="required">（必須）</span></label></h3>
  <dl class="introduction">
    <dd>
      <textarea name="introduction" id="introduction"  class="up_introduction_text"><?php if (!empty($bike['introduction'])) echo (htmlspecialchars($bike['introduction'], ENT_QUOTES, 'UTF-8'));?></textarea>
    </dd>

    <dd class="upping_btn">
      <div class="sub_btn">
      <button type="submit"  class="up_sb_btn">編　集</button>
      </div>
    </dd>
  </dl>
  </form>
</section>
<?php endforeach; ?>


  <div class="b__btn">
    <a href="javascript:history.back();" class="back__btn_edit">戻　る</button></a>
  </div>

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

</script>
</body>
</html>
