<?php
  require_once(ROOT_PATH .'/Models/Db.php');

  class User extends Db {
    public function __construct($dbh = null) {
      parent::__construct($dbh);
    }


    public function validation() {   
      $sql = "SELECT email FROM user WHERE email = :email";
      $stmt = $this->dbh->prepare($sql);
      $stmt->execute(array(':email' => $_POST["email"]));
      $user = 0;
      $user = $stmt->fetch(PDO::FETCH_ASSOC);

      // echo $user['email'];
      if(empty($_POST['name'])){
        echo 'ユーザー名は必須です。';          
        echo '<a href="javascript:history.back();" class="color">戻　る</button></a><br>';
      }

      // //POSTのValidate。
      if(empty($_POST['email'])){
        echo 'メールアドレスは必須です。';
        if (!$email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
          echo '入力された値が不正です。';
          $hostname = $_SERVER['HTTP_HOST'];//ドメインを取得
          if (!empty($_SERVER['HTTP_REFERER']) && (strpos($_SERVER['HTTP_REFERER'],$hostname) !== false)) {
            echo '<a href="javascript:history.back();" class="color">戻　る</button></a><br>';
          }
          return false;
        }else if (!empty($user['email'])){
          if($user['email'] === $email) {
            echo '同じメールアドレスが存在します。';
            echo '<a href="javascript:history.back();" class="color">戻　る</button></a><br>';
          }
          return false;
        }
      }  
      //パスワードの正規表現
      if(empty($_POST['password'])){
        echo 'パスワードは必須です。';
        if (preg_match('/\A(?=.*?[a-z])(?=.*?\d)[a-z\d]{5,100}+\z/i', $_POST['password'])) {
          $password = password_hash($_POST['password'], PASSWORD_DEFAULT);  
        } else {
          echo 'パスワードは半角英数字をそれぞれ1文字以上含んだ5文字以上で設定してください。';
          $hostname = $_SERVER['HTTP_HOST'];//ドメインを取得
          if (!empty($_SERVER['HTTP_REFERER']) && (strpos($_SERVER['HTTP_REFERER'],$hostname) !== false)) {
            echo '<a href="javascript:history.back();" class="color">戻　る</button></a><br>';
          }  
          return false;
        }
      }  
      echo ' <div class="sign_sb_btn">
              <dd>
                <button type="submit" class="sub_btn">登　録</button>
              </dd>
            </div>
';
    
    }

    public function sign_in(){
      $name = $_POST['name'];
      $email = $_POST['email'];
      $password = $_POST['password'];
      $my_bike = $_POST['my_bike'];
      $role=1;

      $stmt = $this->dbh->prepare("INSERT INTO user(name, email, password, my_bike, role) VALUES(?, ?, ?, ?, ?)");
      $this->dbh->beginTransaction();
      try{
        $stmt->execute([$name, $email, $password, $my_bike, $role]);
        // print_r($stmt -> errorInfo());
        $this->dbh->commit();
        echo '登録完了';
      }catch(PDOException $e){
        $this->dbh->rollback();
        throw $e;
      }
    }

    public function log_in(){
      session_start();
      $sql = "SELECT email, password FROM user WHERE email = :email";
      $stmt = $this->dbh->prepare($sql);
      $stmt->execute(array(':email' => $_POST["email"]));
      $user = 0;
      $user = $stmt->fetch(PDO::FETCH_ASSOC);
      if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        echo '入力された値が不正です。';
        return false;
      }
      //emailがDB内に存在しているか確認
      if (!isset($user['email'])) {
        echo 'メールアドレスが間違っています。';
        echo '<br>';
        $hostname = $_SERVER['HTTP_HOST'];//ドメインを取得
        if (!empty($_SERVER['HTTP_REFERER']) && (strpos($_SERVER['HTTP_REFERER'],$hostname) !== false)) {
          echo '<a href="' . $_SERVER['HTTP_REFERER'] . '">戻る</a>';
        }  
        return false;
      }

      //パスワード確認後sessionにメールアドレスを渡す
      if (password_verify($_POST['password'], $user['password'])) {
        session_regenerate_id(true); //session_idを新しく生成し、置き換える
        $_SESSION['EMAIL'] = $user['email'];
        echo 'ログインしました';
        echo '<br>';
        echo '<a href="../User/top.php">トップへ</a><br>';

      } else {
        echo 'パスワードが間違っています。';
        echo '<br>';
        $hostname = $_SERVER['HTTP_HOST'];//ドメインを取得
        if (!empty($_SERVER['HTTP_REFERER']) && (strpos($_SERVER['HTTP_REFERER'],$hostname) !== false)) {
          echo '<a href="' . $_SERVER['HTTP_REFERER'] . '">戻る</a>';
        }  
        return false;
      }
    }

    public function login_user(){
      session_start();
      // echo $_SESSION['EMAIL'];
          //ログイン済みの場合
      if (isset($_SESSION['EMAIL'])) {
        $stmt = $this->dbh->prepare('SELECT id, name, email, role FROM user WHERE email = :email');  
        $stmt->execute(array(':email' => $_SESSION['EMAIL']));
        $user = 0;
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        // echo $user['role'];
        if($user['role'] == 0){
          include('../Views/header_admin.php');
          return $user;
        }else{
          include('../Views/header.php');      
          // echo $user['id'] .'ログインID';
          // echo '<br>';
          return $user;
        }
  
  
      } else {//ログインしていない時
        include('../Views/header.php');      
        echo '<p class="color">ログインしてください。アカウントのない方はアカウントを作成してください。</p><br>';
        echo '<a href="login_form.php" class="color">ログイン</a>';
        echo '<br><a href="signin_form.php" class="color">アカウント作成</a>';
        exit;
      }
    }

    public function reset_select(){
      $email = $_POST['email'];
      $stmt = $this->dbh->prepare('SELECT * FROM user WHERE email = :email');  
      $stmt->execute(array(':email' => $email));
      $user = 0;
      $user = $stmt->fetch(PDO::FETCH_ASSOC);
      return $user;
    }

    public function my_show(){
      if (isset($_SESSION['EMAIL'])) {
        $stmt = $this->dbh->prepare('SELECT * FROM user WHERE email = :email');  
        $stmt->execute(array(':email' => $_SESSION['EMAIL']));
        $user = 0;
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        echo '<h1>'. $user['name'] .'さんのマイページ<h1>';
        // $name = $user['name'];
        // return $user;
        $name = $user['name'];
        echo '<h1>所有バイク：'. $user['my_bike'] .'<h1>';
        echo $user['id'];
        return $user;
      } 
    }

    // public function findAll($page = 0):Array {
    public function findAll():Array {
      // $sql = 'SELECT name FROM user';
      $sql = 'SELECT * FROM user';
      // $sql .= ' LIMIT 20 OFFSET '.(20 * $page);
      $sth = $this->dbh->prepare($sql);
      $sth->execute();
      $result = $sth->fetchAll(PDO::FETCH_ASSOC);
      // $result = $sth->fetch(PDO::FETCH_ASSOC);
      return $result;
    }

    // public function countAll():Int {
    //   // $sql = 'SELECT count(*) as count FROM user';
    //   $sql = 'SELECT * FROM user';
    //   $sth = $this->dbh->prepare($sql);
    //   $sth->execute();
    //   $count = $sth->fetchColumn();
    //   return $count;
    // }
    
    // public function show_u($id = 0):Array {
    //   $sql = 'SELECT * FROM user';
    //   $sql .= ' WHERE id = :id';
    //   $sth = $this->dbh->prepare($sql);
    //   $sth->bindParam(':id', $id, PDO::PARAM_INT);
    //   $sth->execute();
    //   $user = $sth->fetch(PDO::FETCH_ASSOC);
    //   return $user;

    public function show_u(){
      $sql = 'SELECT * FROM user WHERE id = :id';
      $sth = $this->dbh->prepare($sql);
      $sth->execute(array(':id' => $_GET['id']));
      $user = 0;
      $user = $sth->fetch(PDO::FETCH_ASSOC);
      return $user;
    }

    public function edit_validation() {   
      // echo $user['email'];

      if(empty($_POST['name'])){
        echo 'ユーザー名は必須です。';
        echo '<a href="javascript:history.back();" class="color">戻　る</a>';
        return false;
      }

      echo '<div class="edit__sub__btn"><dd><button type="submit" class="e__btn">登　録</button></dd></div>';
    }

    public function user_edit(){
      $name = $_POST['name'];
      $my_bike = $_POST['my_bike'];
      $id = $_POST['id'];
      $sth = $this->dbh->prepare("UPDATE user SET name='$name', my_bike='$my_bike' WHERE id = $id");
      $this->dbh->beginTransaction();
      try {
        $sth->bindValue(':name', $_POST['name']); 
        $sth->bindValue(':my_bike', $_POST['my_bike']); 
        $sth->execute(array($name, $my_bike));
        $this->dbh->commit();
        echo '登録完了';
      }catch(PDOException $e){
        $this->dbh->rollback();
        throw $e;
      }
    }

    public function delete(){
      $id = $_GET['id'];
      $sql = "DELETE FROM user WHERE id=:id";
      $sth = $this->dbh->prepare($sql);
      $this->dbh->beginTransaction();
      try {
        $sth->execute(array(':id' => $_GET["id"]));
        $this->dbh->commit();
        echo "削除しました。<br>";
      }catch(PDOException $e){
        $this->dbh->rollback();
        throw $e;
      }  
    }

    public function search(){
      $name = $_POST['name'];
      // echo $name;
      // $sql = "SELECT * FROM user WHERE name = $name";
      $sql = "SELECT * FROM user WHERE name LIKE '%" . $name . "%'";
      $sth = $this->dbh->prepare($sql);
      $search = $sth->execute(array(':name' => $name));
      $user = 0;
      $user = $sth->fetch(PDO::FETCH_ASSOC);
      return $user;
    }

    public function token_save(){
      $email = $_POST['email'];
      $passResetToken = md5(uniqid(rand(),true));
      $now = date("Y/m/d H:i:s");

      $sql = "UPDATE user SET pass_reset_token='$passResetToken', reset_date='$now' WHERE email = '$email'";
      $sth = $this->dbh->prepare($sql);
      $this->dbh->beginTransaction();
      try {
        $sth->bindValue(':pass_reset_token', $passResetToken); 
        $sth->bindValue(':reset_date', $now); 
        $sth->execute(array($passResetToken, $now));
        // print_r($sth -> errorInfo());
        $this->dbh->commit();
        echo '登録完了';
      }catch(PDOException $e){
        $this->dbh->rollback();
        throw $e;
      }
    }

    public function token_mail(){
      $sql = 'SELECT * FROM user WHERE email = :email';
      $sth = $this->dbh->prepare($sql);
      $sth->execute(array(':email' => $_POST['email']));
      $user = 0;
      $user = $sth->fetch(PDO::FETCH_ASSOC);
      return $user;
    }


    public function token(){
      $token = $_GET['pass_reset_token'];
      $stmt = $this->dbh->prepare('SELECT * FROM user WHERE pass_reset_token = :pass_reset_token');  
      $stmt->execute(array(':pass_reset_token' => $token));
      $user = 0;
      $user = $stmt->fetch(PDO::FETCH_ASSOC);
      return $user;
    }

    public function pass_save(){
      $id = $_POST['id'];
      $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
      $sql = "UPDATE user SET password='$password' WHERE id = '$id'";
      $sth = $this->dbh->prepare($sql);
      $this->dbh->beginTransaction();
      try {
        $sth->bindValue(':password', $password); 
        $sth->execute(array($password));
        // print_r($sth -> errorInfo());
        $this->dbh->commit();
        echo '登録完了';
      }catch(PDOException $e){
        $this->dbh->rollback();
        throw $e;
      }
    }


  }

?>