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
  
        <form action="signin_complete.php" method="post" id="form">
          <!-- <form action="confirm.php" method="post"> -->
          <h2 class="signin_title">  アカウントを登録します</h2>

          <dl>
            <dt><label for="name">ユーザー名</label></dt>
              <dd>
              <input type="hidden" name='name' id="name" value="<?php echo $_POST['name'];?>">
              <?php echo $_POST['name'];?><br>
              </dd>

            <dt><label for="email">メールアドレス</label></dt>
              <dd>
                <input type="hidden" name="email" id="email" value="<?php echo $_POST['email'];?>">
                <?php echo $_POST['email'];?><br>
              </dd>
            </dl>

            <!-- <dt><label for="password">パスワード</label><span class="required">*</span></dt> -->
              <dd>
                <?php $password = password_hash($_POST['password'], PASSWORD_DEFAULT);?>
                <!-- <?php echo $password; ?> -->
                <input type="hidden" name="password" id="password" value="<?php echo $password ?>"></dd>
            <!-- </dl> -->

            <dt><label for="my_bike">所有バイク</label></dt>
              <dd>
                <input type="hidden" name="my_bike" id="my_bike" value="<?php echo $_POST['my_bike']?>">
                <?php echo $_POST['my_bike'];?><br>
              </dd>
            </dl>

            <?php 
              require_once(ROOT_PATH .'Controllers/UserController.php');
              $user = new UserController();
              $params = $user->validation();

            ?>




          </dl>

        </form>
  </section>

  


</body>
</html>