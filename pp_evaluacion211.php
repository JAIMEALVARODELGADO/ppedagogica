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

$sql_="UPDATE evaluacion SET fecha_eval='$_POST[fecha_eval]',observacion_eval='$_POST[observacion_eval]' WHERE id_evaluacion='$_POST[id_evaluacion]'";
//echo "<br>".$sql_;
$link->query($sql_);
if($link->affected_rows > 0){
    $msg="Registro guardado con exito";
}
else{$msg="Registro no guardado";}
for($cont_=0;$cont_<$_POST['cont'];$cont_++){
        $var_="id_evaluacion_aspecto".$cont_;
        //echo "<br>".$var_;
        $id_evaluacion_aspecto="$_POST[$var_]";
        //echo "<br>id: ".$id_aspecto;

        $var_="calificacion".$cont_;
        $calificacion="$_POST[$var_]";
        //echo "<br>cal: ".$calificacion;

        $sql_="UPDATE evaluacion_aspecto SET calificacion='$calificacion' WHERE id_evaluacion_aspecto='$id_evaluacion_aspecto'";
        //echo "<br>".$sql_;
        $link->query($sql_);
}
?>
<body onload="continuar('<?php echo $msg;?>')">
<form name='form1' method="post" action="pp_evaluacion2.php">
    <?php echo "<br>".$msg;?>
    <input type='hidden' name='id_evaluacion' value="<?php echo $_POST['id_evaluacion'];?>"/>
</form>
</body>
</html>
