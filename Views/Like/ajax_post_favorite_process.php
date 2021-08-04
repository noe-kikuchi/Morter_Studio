<script src=" https://code.jquery.com/jquery-3.4.1.min.js "></script>
<!-- <script src="../js/user_page.js"></script> -->
<?php
// session_start();
// session_regenerate_id(true);
// require_once('config.php');

function check_favolite_duplicate($user_id,$bike_id){
  $dsn = 'mysql:dbname=morterstudio;host=localhost';
  $user='root';
  $password='root';
  $dbh=new PDO($dsn,$user,$password);
    $sql = "SELECT *
            FROM likes
            WHERE user_id = :user_id AND bike_id = :bike_id";
    $stmt = $dbh->prepare($sql);
    $stmt->execute(array(':user_id' => $user_id ,
                         ':bike_id' => $bike_id));
    $favorite = $stmt->fetch();
    return $favorite;
}

if(isset($_POST)){

  require_once(ROOT_PATH .'Controllers/UserController.php');
  $user = new UserController();
  $params = $user->login_user();
  // echo $user['role'];
  foreach((array)$params as $user){
    echo  $user['id'];
    $current_user = $user['id'];
  }
  echo $current_user;
  echo $_GET['id'];
  $user_id = $current_user;
  $bike_id = $_GET['id'];

  $profile_user_id = $user_id ?: $bike_id;

  //既に登録されているか確認
  if(check_favolite_duplicate($user_id,$bike_id)){
    $action = '解除';
    $sql = "DELETE
            FROM likes
            WHERE :user_id = user_id AND :bike_id = bike_id";
  }else{
    $action = '登録';
    $sql = "INSERT INTO likes(user_id, bike_id)
            VALUES(:user_id, :bike_id)";
  }

  try{
    $dsn = 'mysql:dbname=morterstudio;host=localhost';
    $user='root';
    $password='root';
      $dbh=new PDO($dsn,$user,$password);
    $stmt = $dbh->prepare($sql);
    $stmt->execute(array(':user_id' => $user_id , ':bike_id' => $bike_id));

  } catch (\Exception $e) {
    error_log('エラー発生:' . $e->getMessage());
    // set_flash('error',ERR_MSG1);
    echo json_encode("error");
  }
}

?>





