<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Morteer_Studio</title>
  <!-- <link rel="stylesheet" type="text/css" href="index.css"> -->
  <link rel="stylesheet" href="../css/sign.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  <!-- <script src="validate-config.js"></script> -->
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
</head>
<body>
  <?php
    include('../Views/header.php');
    ?> 

  <section class="log_in">
    <h2 class="signin_title">ログイン</h2>
        <form action="login.php" method="post" id="form">
          <!-- <form action="confirm.php" method="post"> -->
          <dl>
            <dt><label for="email">メールアドレス</label><span class="required">（必須）</span></dt>
              <dd>
                <input type="text" name="email" id="email" class="signin__input" placeholder="test@test.co.jp"></dd>
            </dl>

            <dt><label for="password">パスワード</label><span class="required">（必須）</span></dt>
              <dd>
                <input type="password" name="password" id="password" class="signin__input" placeholder="半角英数字"></dd>
            </dl>


            <div class="sign_sb_btn">
              <dd>
              <button type="submit" class="sub_btn">ログイン</button>
              </dd>
            </div>

        </form>
  </section>



<div class="backs__btns">
  <p class="login__go_btn">パスワードを忘れた方 <a href="reset_form.php" class="login__go_btn">こちら</a></p>
  <a href="top.php" class="login__go_btn">トップへ戻る</a>
</div>



</body>
</html>
