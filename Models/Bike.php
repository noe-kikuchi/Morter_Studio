<?php
  require_once(ROOT_PATH .'/Models/Db.php');

  class Bike  extends Db {
    public function __construct($dbh = null) {
      parent::__construct($dbh);
    }

    public function save(){
      session_start();
      // echo $_SESSION['EMAIL'];

      $sth = $this->dbh->prepare('SELECT id, email FROM user WHERE email = :email');  
      $sth->execute(array(':email' => $_SESSION['EMAIL']));
      $reslt = 0;
      $reslt = $sth->fetch(PDO::FETCH_ASSOC);
      // return $user;
      echo $reslt['id'];

      $title = $_POST['title'];
      $model = $_POST['model'];
      $model_year = $_POST['model_year'];
      $manufacturer = $_POST['manufacturer'];
      $custom = $_POST['custom'];
      $url = $_POST['url'];
      // $image = $_POST['image'];
      $introduction = $_POST['introduction'];
      $user_id = $reslt['id'];

      //ファイルが送信されていない場合はエラー処理
      // if(!isset($_FILES['image'])){
      //   echo 'ファイルが送信されていません。';
      //   exit;
      // }

      // //ファイル名を使用して保存先ディレクトリを指定 basename()でファイルシステムトラバーサル攻撃を防ぐ

      // $f__name = $_FILES['image']['name'];
      // $save = 'img/' . basename($f__name);

      // //move_uploaded_fileで、一時ファイルを保存先ディレクトリに移動させる
      // if(move_uploaded_file($_FILES['image']['tmp_name'], $save)){
      //   echo 'アップロード成功！';
      // }else{
      //   echo 'アップロード失敗！';
      // }

      // // $img_data = file_get_contents($_FILES['image']['tmp_name']);
      // echo $f__name;
      // $image = $f__name;


    $stmt = $this->dbh->prepare("INSERT INTO bikes (title, model, model_year, manufacturer, custom, url, introduction, user_id) VALUES(?, ?, ?, ?, ?, ?, ?, ?)");
    $this->dbh->beginTransaction();
    try {
      $stmt->execute([$title, $model, $model_year, $manufacturer, $custom, $url, $introduction, $user_id]);
      $bike_id = $this->dbh->lastInsertId();
      $this->dbh->commit();
      echo '登録';
    }catch(PDOException $e){
    
      //ロールバック
      $this->dbh->rollback();
      throw $e;
    }

    echo $bike_id . "<br>";

    if (is_uploaded_file($_FILES["image"]["tmp_name"])) {
      //拡張子判別
      $mimetype  = mime_content_type($_FILES['image']['tmp_name']);
      $extension = array_search($mimetype, [
          'jpg' => 'image/jpeg', 'png' => 'image/png', 'gif' => 'image/gif',
      ]);

      // echo $extension;
      // $f__name = $_FILES['image']['name'];
      // $save = 'img/' . basename($f__name);
  
      if (false !== $extension) {
          $image = $bike_id. '.' .$extension;  //固定アップロードファイル名（拡張子自動補完）
          $uppath = 'img/'.$image;
  
          //アップロードファイル移動、上書き
          if (move_uploaded_file($_FILES["image"]["tmp_name"], $uppath)) {
              chmod($uppath, 0644);
              echo $image . "をアップロードしました。";
          } else {
              echo "ファイルをアップロードできません。";
          }
      } else {
          echo $mimetype.'のファイル形式はアップロードできません。JPEG・PNG・GIFの画像のみアップロードできます。';
      }
  } else {
    echo "ファイルが選択されていません。";
  }

    $sql = "UPDATE bikes SET image='$image' WHERE id = '$bike_id'";
    $sth = $this->dbh->prepare($sql);
    $this->dbh->beginTransaction();
    try {
      $sth->bindValue(':image', $image); 
      $sth->execute(array($image));
      // print_r($sth -> errorInfo());
      $this->dbh->commit();
      echo '登録完了';
    }catch(PDOException $e){
      $this->dbh->rollback();
      throw $e;
    }
      echo '<img src="../img/' . $image . '">';

    }


    public function findAll(){
      // $sql = 'SELECT * FROM bikes';
      $sql = 'SELECT
      b.user_id, b.title, b.model, b.image, b.manufacturer, u.name AS user_name, b.id AS bike_id
      FROM bikes b
      JOIN user u ON u.id = b.user_id
      ORDER BY b.id DESC';
      // -- ORDER BY  ASC

      $sth = $this->dbh->prepare($sql);
      $sth->execute(array());
      $result = $sth->fetchAll(PDO::FETCH_ASSOC);
      return $result;
    }

    public function show(){
      $sql = 'SELECT * FROM bikes WHERE user_id = :user_id ORDER BY id DESC';
      $sth = $this->dbh->prepare($sql);
      $sth->execute(array(':user_id' => $_GET["id"]));
      $result = $sth->fetchAll(PDO::FETCH_ASSOC);
      return $result;
    }
  
    public function bike__show(){
      $sql = 'SELECT * FROM bikes WHERE id = :id';
      $sql = 'SELECT b.user_id, b.title, b.model, b.model_year, b.url, b.image, b.custom, b.introduction, b.manufacturer, u.name AS user_name, b.id AS bike_id, b.user_id AS id FROM bikes b JOIN user u ON u.id = b.user_id WHERE b.id = :id';
      $sth = $this->dbh->prepare($sql);
      $sth->execute(array(':id' => $_GET["id"]));
      $bike = $sth->fetch(PDO::FETCH_ASSOC);
      return $bike;
    }

    public function bike_edit(){
      
      $title = $_POST['title'];
      $model = $_POST['model'];
      $model_year = $_POST['model_year'];
      $manufacturer = $_POST['manufacturer'];
      $custom = $_POST['custom'];
      $introduction = $_POST['introduction'];
      // $image = $_POST['image'];
      $url = $_POST['url'];
      $id = $_POST['id'];

      if (is_uploaded_file($_FILES["image"]["tmp_name"])) {
        //拡張子判別
        $mimetype  = mime_content_type($_FILES['image']['tmp_name']);
        $extension = array_search($mimetype, [
            'jpg' => 'image/jpeg', 'png' => 'image/png', 'gif' => 'image/gif',
        ]);

        echo $extension;
        // $f__name = $_FILES['image']['name'];
        // $save = 'img/' . basename($f__name);
    
        if (false !== $extension) {
            $image = $id. '.' .$extension;  //固定アップロードファイル名（拡張子自動補完）


            $uppath = 'img/'.$image;
    
            //アップロードファイル移動、上書き
            if (move_uploaded_file($_FILES["image"]["tmp_name"], $uppath)) {
                chmod($uppath, 0644);
                echo $image . "をアップロードしました。";
            } else {
                echo "ファイルをアップロードできません。";
            }
        } else {
            echo $mimetype.'のファイル形式はアップロードできません。JPEG・PNG・GIFの画像のみアップロードできます。';
        }
    } else {
      echo "ファイルが選択されていません。";
    }

      

      $sth = $this->dbh->prepare("UPDATE bikes SET title='$title', model='$model', model_year='$model_year', manufacturer='$manufacturer', custom='$custom', introduction='$introduction', image='$image', url='$url' WHERE id = $id");
      $this->dbh->beginTransaction();
      try {
        $sth->bindValue(':title', $_POST['title']); 
        $sth->bindValue(':model', $_POST['model']); 
        $sth->bindValue(':model_year', $_POST['model_year']); 
        $sth->bindValue(':manufacturer', $_POST['manufacturer']); 
        $sth->bindValue(':custom', $_POST['custom']); 
        $sth->bindValue(':introduction', $_POST['introduction']); 
        $sth->bindValue(':image', $image); 
        $sth->bindValue(':url', $_POST['url']); 
        $sth->execute(array($title, $model, $model_year, $manufacturer, $custom, $introduction, $image, $url));
        $this->dbh->commit();
        echo '登録完了';
      }catch(PDOException $e){
        $this->dbh->rollback();
        throw $e;
      }  
    }

    public function bike_delete(){
        $sth = $this->dbh->prepare('DELETE FROM bikes WHERE id = :id');
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

  }



?>