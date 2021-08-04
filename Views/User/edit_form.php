<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Morteer_Studio</title>
  <!-- <link rel="stylesheet" type="text/css" href="index.css"> -->
  <link rel="stylesheet" href="../css/edit_form.css">
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
        try {
          // データベースに接続
          $dsn = 'mysql:dbname=morterstudio;host=localhost';
          $user = 'root';
          $password = 'root';      
          $pdo = new PDO($dsn, $user, $password);
          $pdo->query('SET NAMES utf8');      

          $stmt = $pdo->prepare('SELECT * FROM user WHERE id = :id');
          $stmt->execute(array(':id' => $_GET["id"]));
          $result = 0;
          $result = $stmt->fetch(PDO::FETCH_ASSOC);

        } catch (Exception $e) {
          echo 'エラーが発生しました。:' . $e->getMessage();
        }
  ?>




<section class="edit">
    <h2 class="edit_title">ユーザー情報編集</h2>
        <form action="edit_confirm.php" method="post" id="form">
          <!-- <form action="confirm.php" method="post"> -->
            <p class="edit_text">こちらからユーザー名と所有バイクを変更することができます。</p>
          <dl>
            <dt><label for="name">ユーザー名</label><span class="required">（必須）</span></dt>
              <dd>
              <input type="text" name='name' id="name" class="edit__input" placeholder="川崎次郎" value="<?php echo $result['name']; ?>"></dd>

            <dt><label for="my_bike">所有バイク</label></dt>
              <dd>
                <input type="text" name="my_bike" id="my_bike" class="edit__input" placeholder="ホンダ　スーパーカブ" value="<?php echo $result['my_bike']; ?>"></dd>
            </dl>
            <dd>
                <input type="hidden" name="id" id="id" value="<?php echo $_GET["id"]; ?>">
              </dd>

            <div class="edit__sub__btn">  
              <dd>
                <button type="submit" class="e__btn">送　信</button>
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