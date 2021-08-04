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

<section class="edit">
    <h2 class="edit_title">ユーザー情報編集</h2>
        <form action="edit_complete.php" method="post" id="form">
          <!-- <form action="confirm.php" method="post"> -->
          <dl>
            <dt><label for="name">ユーザー名</label><span class="required">（必須）</span></dt>
            <dd>
              <?php echo htmlentities($_POST['name']); ?>
                <input type="hidden" name="name" id="name" value="<?php echo $_POST['name']; ?>">
            </dd>


            <dt><label for="my_bike">所有バイク</label></dt>
            <dd>
              <?php echo htmlentities($_POST['my_bike']); ?>
                <input type="hidden" name="my_bike" id="my_bike" value="<?php echo $_POST['my_bike']; ?>">
            </dd>
            </dl>
            <dd>
                <input type="hidden" name="id" id="id" value="<?php echo $_POST["id"]; ?>">
              </dd>

          </dl>

          <?php 
              require_once(ROOT_PATH .'Controllers/UserController.php');
              $user = new UserController();
              $params = $user->edit_validation();
          ?>

        </form>
  </section>

  <div class="backs__btns">
    <a href="top.php" class="color">トップへ戻る</a>
  </div>




</body>
</html>