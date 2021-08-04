<?php
  require_once(ROOT_PATH .'/Models/User.php');
  require_once(ROOT_PATH .'/Models/Bike.php');
  require_once(ROOT_PATH .'/Models/Comment.php');



 class UserController {
  private $request;
  private $User;
  private $Bike;
  private $Comment;


   public function __construct(){
    $this->request['get'] = $_GET;
    $this->request['post'] = $_POST;

     $this->User = new User();

     $dbh = $this->User->get_db_handler();
     $this->Bike = new Bike($dbh);
     $this->Comment = new Comment($dbh);
   }

   public function validation(){
    $users = $this->User->Validation();
    $params = ['users' => $users]; 
    return $params;
  }

  public function sign_in(){
    $users = $this->User->sign_in();
    $params = ['users' => $users]; 
    return $params;
  }

  public function log_in(){
    $users = $this->User->log_in();
    $params = ['users' => $users]; 
    return $params;
  }

  public function login_user(){
    $users = $this->User->login_user();
    $params = ['users' => $users]; 
    return $params;
  }

  public function reset_select(){
    $users = $this->User->reset_select();
    $params = ['users' => $users]; 
    return $params;
  }

  public function token_save(){
    $users = $this->User->token_save();
    $params = ['users' => $users]; 
    return $params;
  }


  public function my_show(){
    $users = $this->User->my_show();
    $params = ['users' => $users]; 
    return $params;

    // $user = $this->User->my_show($this->request['get']['email']);
    // $params = ['user' => $user]; 
    // return $params;
  }

  public function index() {
  //   $page = 0;
  //   if(isset($this->request['get']['page'])) {
  //     $page = $this->request['get']['page'];
  //   }

  //   $users = $this->User->findAll($page);
  //   $users_count = $this->User->countAll();
  //   $params = [
  //     'users' => $users,
  //     'pages' => $users_count / 20
  //   ];
  //   return $params;

    $users = $this->User->findAll();
    $params = ['users' => $users];
    return $params;
  }

  public function show_u(){
    if(empty($this->request['get']['id'])) {
      echo '指定のパラメーターは不正です。ページを表示できません。';
      exit;
    }
    $user = $this->User->show_u($this->request['get']['id']);
    $params = ['user' => $user];
    return $params;
  }

  public function edit_validation(){
    $users = $this->User->edit_validation();
    $params = ['users' => $users]; 
    return $params;
  }

  public function user_edit(){
    $users = $this->User->user_edit();
    $params = ['users' => $users]; 
    return $params;
  }

  public function delete(){
    $users = $this->User->delete();
    $params = ['users' => $users]; 
    return $params;
  }

  public function search(){
    $users = $this->User->search();
    $params = ['users' => $users]; 
    return $params;
  }

  public function token_mail(){
    $users = $this->User->token_mail();
    $params = ['users' => $users]; 
    return $params;
  }

  public function token(){
    $users = $this->User->token();
    $params = ['users' => $users]; 
    return $params;
  }

  public function pass_save(){
    $users = $this->User->pass_save();
    $params = ['users' => $users]; 
    return $params;
  }









 }
?>