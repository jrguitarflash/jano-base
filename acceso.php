<?php
include('include/comun.php');
$ope = operador::acceso();

$perfil=operador::get_perfil($ope['perfil_id'],$_POST['empresa_id']);

if(is_array($perfil)){
    $SIS[1] = $ope['trab_usuario'];
    $SIS[2] = $ope['trabajador_id'];
    $SIS[3] = $ope['perfil_id'];
    $SIS[4] = $ope['trab_clave'];
    $SIS[5] = $perfil['empresa_id'];
    $SIS[6] = $perfil['emp_nombre'];
    $SIS[7] = 0; // mi empresa
    $SIS[8] = $perfil['emp_logo'];
    $SIS[9]= $ope['trab_funcion_id'];
    $SIS[10]= $ope['persona_id'];
    
    operador::log('I',$ope['trabajador_id']);
    
    session_start();   
    //session_destroy();
    //session_register('SIS');

    $_SESSION['SIS']=$SIS;

    header("location:index.php?menu=home");    
    exit();
}else{
    header("location:index.php?menu=login&err=1");
}

?>