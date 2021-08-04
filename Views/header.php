<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Morteer_Studio</title>
  <!-- <link rel="stylesheet" type="text/css" href="index.css"> -->
  <link rel="stylesheet" href="../css/base.css">
  <link href="https://fonts.googleapis.com/css?family=Alegreya+Sans+SC:300 rel="stylesheet">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  <!-- <script src="validate-config.js"></script> -->
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
</head>
<body> 
  <div class="header_border">
    <div class="header">
      <div class="top_left">
        <a href="../User/top.php" class="top_logo">Morteer_Studio</a>
      </div>
      <div class="top_right">
        <?php
          if (isset($_SESSION['EMAIL'])) {
            // echo $user['id'];
            echo '<a href="../User/show_u.php?id=' . $user['id']. '" class="mypage_btn">' . $user['name']. 'さんのページ</a>';
            // echo '<a href=show.php?id='. $user['id']. '詳細</a>';
            echo '<a href="../Bike/upload.php" class="upload_btn">投稿</a>';
            echo '<a href="../User/logout.php" class="logout_btn">log_out</a>';
          } else {//ログインしていない時
            echo '<a href="../User/login_form.php" class="login_btn">log_in  </a>';
            echo '<a href="../User/signin_form.php" class="signin_btn">sign_in</a>';
          }

        ?>
        
      </div>  
    </div>
  </div>  
</body>
</html>
