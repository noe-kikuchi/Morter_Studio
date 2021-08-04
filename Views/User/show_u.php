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
      try {
        // データベースに接続
        $dsn = 'mysql:dbname=morterstudio;host=localhost';
        $user = 'root';
        $password = 'root';      
        $pdo = new PDO($dsn, $user, $password);
        $pdo->query('SET NAMES utf8');      

        // $stmt = $pdo->prepare('SELECT * FROM user WHERE id = :id');
        $stmt = $pdo->prepare('SELECT
        *
        FROM user u
        LEFT JOIN bikes b ON b.user_id = u.id
        WHERE u.id = :id');

        $stmt->execute(array(':id' => $_GET["id"]));
        $result = 0;
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

      } catch (Exception $e) {
        echo 'エラーが発生しました。:' . $e->getMessage();
      }
?>
<?php
  require_once(ROOT_PATH .'Controllers/UserController.php');
  $user = new UserController();
  $params = $user->login_user();
?>


<div class="my_page">
  <div class="my_show">
    <h2 class="show_u_title"><?= $result['name'] ?>さんの投稿一覧</h2>    


    所有バイク: <?= $result['my_bike']; ?><br>
    <!-- <a href=edit_form.php>編集</a> -->
    <?php foreach((array)$params as $user): ?>

    <?php 
      if($user['id']==$_GET['id']){
        echo '<a href=edit_form.php?id=' . $_GET['id'] . ' class="user_edit_btn">編集</a><br>';
      }
    ?>
    <?php endforeach; ?>
  </div>  


<div class="show_bikes"> 
  <?php
    require_once(ROOT_PATH .'Controllers/BikeController.php');
    $bike = new BikeController();
    $params = $bike->show();
  ?>

  <?php foreach($params['bikes'] as $bike): ?>
    <div class="bike__looks">
      <div class="bike__mm">
        <?=$bike['manufacturer'] ?>
        <?=$bike['model'] ?>
      </div>
  

    <a href=../Bike/bike_show.php?id=<?= $bike['id']; ?> class="bike__title"><?=$bike['title'] ?></a>
      <a href=../Bike/bike_show.php?id=<?= $bike['id']; ?>>
      <?php 
        echo '<img src="../img/' . $bike['image'] . '" width="300" height="200" class="bike_img">';
        ?>
      </a>
      <?php echo '<a href=../Bike/bike_show.php?id='. $bike['id']. ' class="bike_show_btn">詳細</a>'; ?>
    </div>
  
  <?php endforeach; ?>


</div>


  <div class="footer__bun">
  <a href=top.php class="top_btn">トップへ戻る</a>
  </div>




</body>
</html>