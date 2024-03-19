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
if($_POST['estado']=='on'){$estado='A';}
else{$estado='I';}
$link=conectarbd();
$conest="SELECT codigo FROM aspecto WHERE codigo='$_POST[codigo]'";
$conest=$link->query($conest);
if($conest->num_rows > 0){
    $msg="Existe un aspecto con el mismo código";
}
else{
    $sql_="INSERT INTO aspecto(id_aspecto,codigo,descripcion,tipo,estado) VALUES(0,'$_POST[codigo]','$_POST[descripcion]','$_POST[tipo]','$estado')";
    //echo "<br>".$sql_;
    $link->query($sql_);
    if($link->affected_rows > 0){
        $msg="Registro guardado con exito";
    }
    else{$msg="Registro no guardado";}
}
?>
<body onload="continuar('<?php echo $msg;?>')">
<form name='form1' method="post" action="pp_aspecto2.php">
    <?php echo "<br>".$msg;?>    
</form>
</body>
</html>
