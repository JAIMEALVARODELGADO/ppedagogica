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
$id_practica=$_POST['id_practica'];
$id_horario=$_POST['id_horario'];
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
        function continuar(msg_,id_){
            window.open("pp_horariopractica2.php?id_practica="+id_,"_self");
        }
    </script>
<?php
require("pp_funciones.php");
//require("pp_menu.php");
$link=conectarbd();
$sql_="UPDATE horario SET id_dia='$_POST[id_dia]',hora='$_POST[hora]',id_asignatura='$_POST[id_asignatura]',grado='$_POST[grado]',grupo='$_POST[grupo]',jornada='$_POST[jornada]',nivel='$_POST[nivel]' WHERE id_horario='$id_horario'";
//echo "<br>".$sql_;
$link->query($sql_);
if($link->affected_rows > 0){
    $msg="Registro guardado con exito";
}
else{$msg="Registro no guardado";}
?>
<body onload="continuar('<?php echo $msg;?>','<?php echo $id_practica;?>')">
<form name='form1' method="post" action="pp_horariopractica2.php">
    <?php echo "<br>".$msg;?>
</form>
</body>
</html>
