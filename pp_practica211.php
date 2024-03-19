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
        function continuar(msg_,id_){
            window.open("pp_practica2.php?id_practica="+id_,"_self");
        }
    </script>
<?php
require("pp_funciones.php");
//require("pp_menu.php");
$link=conectarbd();

$sql_="UPDATE practica SET 
tipo_practica='$_POST[tipo_practica]',
id_facultad='$_POST[id_facultad]',
id_departamento='$_POST[id_departamento]',
id_programa='$_POST[id_programa]',
semestre='$_POST[semestre]',
nombre_acompa='$_POST[nombre_acompa]',
vinculacion='$_POST[vinculacion]',
email_acompa='$_POST[email_acompa]',
telefono_acompa='$_POST[telefono_acompa]',
id_institucion='$_POST[id_institucion]',
sede='$_POST[sede]',
nombre_titular='$_POST[nombre_titular]',
email_titular='$_POST[email_titular]',
telefono_titular='$_POST[telefono_titular]'
WHERE id_practica='$_POST[id_practica]'";
//echo "<br>".$sql_;
$id_practica=$_POST[id_practica];
$link->query($sql_);
if($link->affected_rows > 0){
    $msg="";
}
else{$msg="Registro no guardado";}

?>
<body onload="continuar('<?php echo $msg;?>','<?php echo $id_practica;?>')">
<form name='form1' method="post" action="pp_practica2.php">
    <?php echo "<br>".$msg;?>
    <!--<input type='text' name='codigo' value="<?php echo $_POST['codigo'];?>"/>-->
</form>
</body>
</html>
