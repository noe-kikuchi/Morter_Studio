<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Morteer_Studio</title>
  <!-- <link rel="stylesheet" type="text/css" href="index.css"> -->
  <link rel="stylesheet" href="../css/index.css">
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
      <div class="search__top">
        <form action="search.php" method="post">
          <input type="text" name="name" class="search__t" placeholder="名前で検索">
          <input type="submit" name="submit" class="search__btn" value="検索">
        </form>
      </div>



<h2 class="u__all_title">検索結果</h2>



        <?php
          require_once(ROOT_PATH .'Controllers/UserController.php');
          $user = new UserController();
          $params = $user->search()
        ?>

          <?php foreach((array)$params as $user): ?>
            <?php if( empty($user['name']) ): ?>
              <div class="search__users">
                <p class="search__no">該当なし</p>
            </div>  

            <?php else: ?>  
              <div class="search__users">
                <?php echo $user['name']; ?>
                <?php echo '<a href=show_u.php?id='. $user['id']. ' class="color">詳細</a>'; ?>
                <?php echo '<a href=delete.php?id='. $user['id']. ' class="color">削除</a><br>'; ?>
              </div>
              <?php endif; ?>
          <?php endforeach; ?>

</body>
</html>
