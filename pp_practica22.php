<?php
session_start();
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
<body>

<?php
require("pp_funciones.php");
//require("pp_menu.php");
//require("pp_menu_estudiante.php");
$link=conectarbd();
//echo $_GET['id_estudiante'];
$sql_elim="DELETE FROM practica WHERE id_practica='$_GET[id_practica]'";
//echo $sql_elim;
$link->query($sql_elim);
$msg='';
if($link->affected_rows > 0){
    $msg="Registro eliminado con exito";
}
else{$msg="Registro no eliminado";}

?>
<form name='form1' method="post" action="pp_practica2.php">
    <?php echo $msg;?>
    <script language="JavaScript">continuar('<?php echo $msg;?>');</script>
</form>
</body>
</html>
