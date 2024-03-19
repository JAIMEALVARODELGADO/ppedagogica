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
            if(msg_!=''){alert(msg_);}
            document.form1.submit();
        }
    </script>
<?php
require("pp_funciones.php");
//require("pp_menu.php");
$link=conectarbd();
$conest="SELECT id_estudiante FROM estudiante WHERE (codigo='$_POST[codigo]' OR numero_ident='$_POST[numero_ident]') AND id_estudiante<>'$_POST[id_estudiante]'";
echo "<br>".$conest;
$conest=$link->query($conest);
if($conest->num_rows > 0){
    $msg="Existe un estudiante con el mismo código o identificación";
}
else{
    $sql_="UPDATE estudiante SET codigo='$_POST[codigo]',tipo_ident='$_POST[tipo_ident]',numero_ident='$_POST[numero_ident]',apellidos='$_POST[apellidos]',nombres='$_POST[nombres]',telefono='$_POST[telefono]',email='$_POST[email]' WHERE id_estudiante='$_POST[id_estudiante]'";
    //echo "<br>".$sql_;
    $link->query($sql_);
    if($link->affected_rows > 0){
        $msg="";
    }
    else{$msg="Registro no guardado";}
}
?>
<body onload="continuar('<?php echo $msg;?>')">
<form name='form1' method="post" action="pp_estudiante2.php">
    <?php echo "<br>".$msg;?>
    <input type='hidden' name='codigo' value="<?php echo $_POST['codigo'];?>"/>
</form>
</body>
</html>
