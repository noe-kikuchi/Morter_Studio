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


<div class="bike__top">
<?php       
  // session_start();
  // echo $_SESSION['EMAIL'];
  //ログイン済みの場合
if (isset($_SESSION['EMAIL'])) : ?>
          <?php // データベースに接続
            $dsn = 'mysql:dbname=morterstudio;host=localhost';
            $sqluser = 'root';
            $password = 'root';      
            $pdo = new PDO($dsn, $sqluser, $password);
            $pdo->query('SET NAMES utf8');      
    
        $stmt = $pdo->prepare('SELECT email, role FROM user WHERE email = :email');  
        $stmt->execute(array(':email' => $_SESSION['EMAIL']));
        $user = 0;
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        // return $user;
        // echo $user['role'];
        ?>

  <?php if($user['role'] == 0): ?>
      <div class="search__top">
        <form action="search.php" method="post">
          <input type="text" name="name" class="search__t" placeholder="名前で検索">
          <input type="submit" name="submit" class="search__btn" value="検索">
        </form>
      </div>


      <?php
      require_once(ROOT_PATH .'Controllers/UserController.php');
      $user = new UserController();
      $params = $user->index();
     ?> 
    <h2 class="u__all_title">ユーザー一覧</h2>
      <div class="users">
      <?php foreach($params['users'] as $user): ?>
          <?php if($user['role'] != 0): ?>
            <!-- <?php echo $user['id']; ?> -->
            <?php echo $user['name']; ?>
            <?php echo '<a href=show_u.php?id='. $user['id']. ' class="color">詳細</a>'; ?>
            <?php echo '<a href=delete.php?id='. $user['id']. ' class="color">削除</a><br>'; ?>
          <?php endif; ?>
      <?php endforeach; ?>
      </div>
  <?php else: ?>
    <div class="top_imgs">
      <img src="../img/logo_img/top_img.jpeg" class="top_img">
      <p class="top_comment">自分のバイクを紹介しよう</p>
    </div>  


          <?php 
          require_once(ROOT_PATH .'Controllers/BikeController.php');
          $bike = new BikeController();
          $params = $bike->index();
          // header('Content-type:  image/jpg');
          ?>
          <div class="bikes__show">
            <?php foreach($params['bikes'] as $bike): ?>
              <div class="bike__looks">
                <div class="bike__mm">
                  <?=$bike['manufacturer'] ?>
                  <?=$bike['model'] ?>
                </div>
                
                <a href=../Bike/bike_show.php?id=<?= $bike['bike_id']; ?> class="bike__title"><?=$bike['title'] ?></a>
                <a href=../Bike/bike_show.php?id=<?= $bike['bike_id']; ?>>
                <?php 
                  echo '<img src="../img/' . $bike['image'] . '" width="300" height="200" class="bike_img">';
                ?>
                </a>

                <?php echo '<a href=show_u.php?id='. $bike['user_id']. ' class="bike__user">'. $bike['user_name']. '</a>'; ?>
              </div>
            <?php endforeach; ?>

          </div>

  <?php endif; ?>


<?php endif;?>
</div>

</body>
</html>
