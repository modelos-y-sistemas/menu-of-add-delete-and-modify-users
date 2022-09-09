<?php


validate();

function get_users_keys_selected(){
    
  $search = $_POST['search'];
  $i = 0;

  $users = user::find($search);
  $users_keys = array();

  foreach($users as $user){
    
    $ID = $user['ID'];
    
    if(isset($_POST['user' . $ID])){ // cada check tiene como 'name' -> "user + <UserKey>"
      $users_keys[$i] = $ID;
      $i++;
    }
  }
  foreach($users_keys as $key){
    // echo $key . "<br>";
  }

  return $users_keys;
}

function validate(){
  if($_POST){

    $pathname=$_POST["pathname"];
    $pathname=strval($pathname);

    if(strpos($pathname,'Agregar')){

      $name = $_POST["name"];
      $codcurso = $_POST["codcurso"];
      $email = $_POST["email"];

      if($name!=""&&$codcurso!=""&&$email!=""){
        $o_user = new user($name, $codcurso, $email);
        $o_user->add();
        $resp=$o_user->to_string();
        echo json_encode($resp);
      }
    }
    
    else if($pathname=="Buscar"){
      $search = $_POST['search'];
      $users;

      $users = user::find($search);

      echo json_encode($users); // codigo de capa logica no interactua con la capa interfaz, <echo> no va.
    }

    else if($pathname=="Modificar"){
      $query='UPDATE t_alumnos_del_curso SET  WHERE ID=:id';
    }

    else{

      try{
        $users_key_selected = get_users_keys_selected();
        
        foreach($users_key_selected as $user_key_selected){
          $user_selected = user::get_user($user_key_selected);
          if(user::delete($user_selected)){
            $message = "el(los) usuario(s) fueron eliminados";
          } else{
            $message = "el(los) usuario(s) no fueron eliminados";
          }
        }
      }
      catch(PDOException $e){
        $message = "ERROR: No se puede eliminar el(los) usuario(s)";
      }
    }

  }
}

class user{
  
  private $name;
  private $codcurso;
  private $email;
  
  public function __construct($name = "n/n", $codcurso = "n/n", $email = "nn@nn.com"){
    $this->name = $name;
    $this->email = $email;
    $this->codcurso = $codcurso;
  }
  public function add(){
    
    include '../database/database.php';
    $message = '';
    
    $query = 'INSERT INTO t_alumnos_del_curso (NombreDelUsuario, Codigo_Curso, Mail) VALUES (:name, :codcurso, :email)';
    
    $stmt = $connection->prepare($query);
    $stmt->bindParam(':name', $this->name);
    $stmt->bindParam(':codcurso', $this->codcurso);
    $stmt->bindParam(':email', $this->email);
    
    return $stmt->execute() ? true : null;
  }
  public static function delete($user){
    
    include '../database/database.php';

    $query = 'DELETE FROM t_alumnos_del_curso WHERE t_alumnos_del_curso.ID = :user_key';
    
    $stmt = $connection->prepare($query);
    $stmt->bindParam(':user_key', $user['ID']);
    
    return $stmt->execute() ? true : null;
  }
  public static function find($search){

    include '../database/database.php';
    
    $search = "%" . $search . "%";
    $query = "SELECT * FROM t_alumnos_del_curso WHERE ID LIKE '$search' OR NombreDelUsuario LIKE '$search' OR Codigo_Curso LIKE '$search' OR Mail LIKE '$search' ";
    $stmt = $connection->prepare($query);
    
    return ($stmt->execute()) ? $stmt->fetchAll(PDO::FETCH_ASSOC) : null;
  }
  public function get_user($user_key){
    
    include '../database/database.php';

    $query = "SELECT * FROM t_alumnos_del_curso WHERE ID = $user_key";
    $stmt = $connection->prepare($query);
    
    return $stmt->execute() ? $stmt->fetch() : null;
  }
  public function to_string(){
    
    return 
      "<p>" . "Nombre: "   . $this->name    . "</p>" . 
      "<p>" . "Email: " . $this->email . "</p>" . 
      "<p>" . "Codigo de curso: "    . $this->codcurso   . "</p>";
  }
  public static function to_string_record($user){
    
    return
      "<p>" . "Nombre: " .   $user['Name']    . "</p>" . 
      "<p>" . "Email: " . $user['Email'] . "</p>" . 
      "<p>" . "Codigo de curso: " .    $user['codcurso']   . "</p>" . 
      "<p>" . "ID: " .       $user['UserKey'] . "</p>";
  }
}
