<?php
session_start();
if(!isset($_SESSION['gid_usuario'])){
    ?>
        <script type="text/javascript">
            alert("La sesion ha finalizado. \nIngrese nuevamente");
            window.open('blanco.html','_self',''); 
            window.close(); 
        </script>
    <?php
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="es-ES" dir="ltr" xmlns="http://www.w3.org/1999/xhtml">
    <head>        
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <meta description="Registro y cotrol de las prácticas pedagógicas de la Universidad de Nariño"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <link rel="stylesheet" type="text/css" href="css/estilos.css">
        <link rel="stylesheet" type="text/css" href="fonts/style.css">
        <title>Práctica Pedag&oacute;gica Integral Investigativa</title>
    </head>
    <script language="JavaScript">
        function continuar(msg_){
            alert(msg_);
            document.form1.submit();
        }
    </script>
<?php
require("pp_funciones.php");
//require("pp_menu.php");
$link=conectarbd();
$hoy=cambiafecha(hoy());
$hora=date("H:i:s");
$hoy=$hoy.' '.$hora;
$conprac="SELECT id_practica FROM evaluacion WHERE id_practica='$_POST[id_practica]'";
//echo $conprac;
$conprac=$link->query($conprac);
if($conprac->num_rows > 0){
    $msg="La práctica ya tiene evalucación registrada";
}
else{
    $sql_="INSERT INTO evaluacion(id_evaluacion,fecha_eval,id_practica,observacion_eval,fecha_reg,usuario_reg) VALUES(0,'$_POST[fecha_eval]','$_POST[id_practica]','$_POST[observacion_eval]','$hoy','$_SESSION[gid_usuario]')";
    //echo "<br>".$sql_;
    $link->query($sql_);
    if($link->affected_rows > 0){
        $msg="Registro guardado con exito";
    }
    else{$msg="Registro no guardado";}
    $id_evaluacion=$link->insert_id;
    //echo "<br>".$id_evaluacion;
    for($cont_=0;$cont_<$_POST['cont'];$cont_++){
        $var_="id_aspecto".$cont_;
        $id_aspecto="$_POST[$var_]";
        //echo "<br>id: ".$id_aspecto;

        $var_="calificacion".$cont_;
        $calificacion="$_POST[$var_]";
        //echo "<br>cal: ".$calificacion;

        $sql_="INSERT INTO evaluacion_aspecto(id_evaluacion_aspecto,id_evaluacion,id_aspecto,calificacion) VALUES(0,'$id_evaluacion','$id_aspecto','$calificacion')";
        //echo "<br>".$sql_;
        $link->query($sql_);
    }
}


?>
<body onload="continuar('<?php echo $msg;?>')">
<form name='form1' method="post" action="pp_evaluacion2.php">
    <?php echo "<br>".$msg;?>
</form>
</body>
</html>
