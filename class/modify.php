<?php

$users_key_selected_modify=get_users_keys_selected_modify();

foreach($users_key_selected_modify as $user_key_selected_modify){
    modify($user_key_selected_modify['ID'], $user_key_selected_modify['Name'], $user_key_selected_modify['Mail'], $user_key_selected_modify['Cod'],);
}
header ("location: http://localhost/menu-of-add-delete-and-modify-users/Modificar/");

function get_users_keys_selected_modify(){
    $search = $_POST['search'];
    $i=0;
  
    $users = find($search);
    $users_keys = array(array());

    while($reg=mysqli_fetch_array($users)){
        $ID=$reg['ID'];
        $users_keys[$i]['ID']=$ID;
        $users_keys[$i]['Name']=$_POST["nameuser".$ID];
        $users_keys[$i]['Mail']=$_POST["mailuser".$ID];;
        $users_keys[$i]['Cod']=$_POST["coduser".$ID];;
        $i++;
    }
    return $users_keys;
}

function find($search){

    $conexion=mysqli_connect("localhost","root","","iac") or die("Problemas con la conexión");

    
    $search = "%" . $search . "%";
    $query="SELECT * FROM t_alumnos_del_curso WHERE ID LIKE '$search' OR NombreDelUsuario LIKE '$search' OR Codigo_Curso LIKE '$search' OR Mail LIKE '$search' ";
    
    $stmt=mysqli_query($conexion, $query) or die("Problemas en el select:".mysqli_error($conexion));
    
    mysqli_close($conexion);
    return $stmt;
  }

function modify($ID, $Name, $Mail, $Cod){
    
    $conexion=mysqli_connect("localhost","root","","iac") or
    die("Problemas con la conexión");
    /*$ID=$usertomod['ID'];
    $nombre=$usertomod['Name'];
    $Mail=$usertomod['Mail'];
    $Cod=$usertomod['Cod'];*/


    $query="UPDATE t_alumnos_del_curso SET NombreDelUsuario='$Name', Mail='$Mail', Codigo_Curso='$Cod' WHERE ID=$ID";

    mysqli_query($conexion, $query) or die("Problemas en el update:".mysqli_error($conexion));
    //echo "El registro fue modificado con exito";
    mysqli_close($conexion);


    
}

?>