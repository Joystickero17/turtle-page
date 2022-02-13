<?php

$field_list = Array(
    "nombres",
    "apellidos",
    "cedula",
    "nacimiento",
    "sexo",
    "ingreso"
);

$db = mysqli_connect("localhost","root","","usuarios");


function verificar_valores($lista){
    for($i=0;$i<count($lista);$i++){
        if (!isset($_POST[$lista[$i]])){
            return false;
        }
    }
    return true;
}

function array_to_str($lista, $include_str){
    $string = "";
    for ($i=0; $i < count($lista); $i++) { 
        
        if (!($lista[$i] == $lista[count($lista) - 1])){
            if ($include_str){

                $string .= "'" .$lista[$i] . "'" . ",";
            }else{
                $string .= $lista[$i] . ",";
            }
            
        }else{
            if ($include_str){

                $string .= "'" .$lista[$i] . "'";
            }else{
                $string .= $lista[$i];
                
            }
        }
    }

    return $string;
}

if (verificar_valores($field_list)){
    $query = "";
    $values = "";
    $query .= array_to_str($field_list, false);
    $values .= array_to_str(array_values($_POST), true);
    echo array_values($_POST)[0];
    mysqli_query($db,"INSERT INTO usuarios(". $query .") values (". $values .")");

    echo "datos insertados" . "INSERT INTO usuarios(". $query .") values (". $values .")";
}else{
    echo json_encode(Array("message" => "datos no validos"));
}

?>