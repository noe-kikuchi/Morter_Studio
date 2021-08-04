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

  <section class="sign_in">
    <h2 class="signin_title">サインイン</h2>
        <form action="signin_confirm.php" method="post" id="form">
          <!-- <form action="confirm.php" method="post"> -->
            <p class="signin_text">登録することで詳細を閲覧したり、いいねをしたり、自分のバイクを紹介することができます。</p>
          <dl>
            <dt><label for="name">ユーザー名</label><span class="required">（必須）</span></dt>
              <dd>
              <input type="text" name='name' id="name" class="signin__input" placeholder="川崎次郎"></dd>

            <dt><label for="email">メールアドレス</label><span class="required">（必須）</span></dt>
              <dd>
                <input type="text" name="email" class="signin__input" id="email" placeholder="test@test.co.jp"></dd>
            </dl>

            <dt><label for="password">パスワード</label><span class="required">（必須）</span></dt>
              <dd>
                <input type="password" name="password" id="password" class="signin__input" placeholder="半角英数字"></dd>
            </dl>

            <dt><label for="my_bike">所有バイク</label></dt>
              <dd>
                <input type="text" name="my_bike" id="my_bike" class="signin__input" placeholder="ホンダ　スーパーカブ"></dd>
            </dl>

            <div class="sign_sb_btn">
              <dd>
                <button type="submit" class="sub_btn">送　信</button>
              </dd>
            </div>
          </dl>

        </form>
  </section>


<div class="backs__btns">
  <p class="login__go_btn">すでに登録済みの方は <a href="login_form.php" class="login__go_btn">こちら</a></p>
  <a href="top.php" class="login__go_btn">トップへ戻る</a>
</div>


</body>
</html>
