<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Morteer_Studio</title>
  <!-- <link rel="stylesheet" type="text/css" href="index.css"> -->
  <link rel="stylesheet" href="../css/reset.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  <!-- <script src="validate-config.js"></script> -->
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
</head>
<body>
  <?php
    include('../Views/header.php');
    ?> 


<!-- <?php echo $_GET['pass_reset_token']; ?> -->

<?php
  require_once(ROOT_PATH .'Controllers/UserController.php');
  $user = new UserController();
  $params = $user->token();
?>

<?php foreach((array)$params as $user): ?>

  <section class="reset">
    <h2 class="reset__title"><?= $user['name'] ?>さんのパスワードをリセットします</h2>
        <form action="pass_reset.php" method="post" id="form">
               <dd>
                <input type="hidden" name="id" id="id" class="reset__input" value="<?= $user['id']?>">
              </dd>

          <dl class="reset__dl">
            <dt><label for="password" class="reset__label">新しいパスワード</label></dt>
              <p class="err-msg-pass"></p>
              <dd>
                <!-- <input type="text" name="email" id="email" class="reset__input" placeholder="test@test.co.jp"></dd> -->
                <input type="password" name="password" id="password" class="reset__input" placeholder="半角英数字">
              </dd>

            </dl>
            <div class="reset_sb_btn">
              <dd>
                <button type="submit" class="sub_btn">登録</button>
              </dd>
            </div>
          </dl>

        </form>
  </section>


<?php endforeach; ?>
<div class="backs__btns">
  <a href="top.php" class="color">トップへ戻る</a>
</div>

<script>
window.addEventListener('DOMContentLoaded', () => {

// 「送信」ボタンの要素を取得
const submit = document.querySelector('.submit');
// 「送信」ボタンの要素にクリックイベントを設定する
// 「パスワード」入力欄の形式チェック
const pass = document.querySelector('#password');
        const errMsgPass = document.querySelector('.err-msg-pass');
        // パスワードが5文字以上の半角英数字であるかどうかのチェック
        if(!pass.value.match(/^([a-zA-Z0-9]{5,})$/)){
            errMsgPass.classList.add('form-invalid');
            errMsgPass.textContent = '半角英数字5文字以上で入力してください';
            pass.classList.add('input-invalid');
            return;
        }else{
            errMsgPass.textContent ='';
            pass.classList.remove('input-invalid');
        }
      }, false);
</script>

</body>
</html>

