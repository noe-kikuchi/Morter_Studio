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

  <section class="reset">
    <h2 class="reset__title">パスワードを忘れた方へ</h2>
        <form action="reset.php" method="post" id="form">
          <!-- <form action="confirm.php" method="post"> -->
          <p class="reset__text">パスワードの再設定が必要です。</p>
          <p class="reset__text">ご登録のメールアドレスを入力していただき、受診されたメールの案内に従ってパスワードの再設定をお願いいたします。</p>

          <dl class="reset__dl">
            <dt><label for="email" class="reset__label">登録しているメールアドレス</label></dt>
              <dd>
                <input type="text" name="email" id="email" class="reset__input" placeholder="test@test.co.jp"></dd>
            </dl>
            <div class="reset_sb_btn">
              <dd>
                <button type="submit" class="sub_btn">メールを送る</button>
              </dd>
            </div>
          </dl>

        </form>
  </section>
  <div class="backs__btns">
  <a href="top.php" class="color">トップへ戻る</a>
</div>

</body>
</html>
