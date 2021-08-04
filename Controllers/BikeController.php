<?php 
  require_once(ROOT_PATH .'/Models/Bike.php');

  class BikeController {
    private $Bike;

    public function __construct(){
      $this->Bike = new Bike();
    }

    public function save(){
      $bikes = $this->Bike->save();
      $params = ['bikes' => $bikes]; 
      return $params;  
    }

    public function index(){
      $bikes = $this->Bike->findAll();
      $params = ['bikes' => $bikes]; 
      // return $params;  
      // $params = ['test' => 'pp'];
      return $params;
    }
    
    public function show(){
      $bikes = $this->Bike->show();
      $params = ['bikes' => $bikes]; 
      return $params;
    }

    public function bike__show(){
      $bikes = $this->Bike->bike__show();
      $params = ['bikes' => $bikes]; 
      return $params;  
    }
  
    public function bike_edit(){
      $bikes = $this->Bike->bike_edit();
      $params = ['bikes' => $bikes]; 
      return $params;  
    }

    public function bike_delete(){
      $bikes = $this->Bike->bike_delete();
      $params = ['bikes' => $bikes]; 
      return $params;  
    }

  


  }
?>