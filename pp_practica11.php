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
$sql_="INSERT INTO practica(id_practica,fecha_inscripcion,tipo_practica,id_estudiante,id_facultad,id_departamento,id_programa,semestre,nombre_acompa,vinculacion,email_acompa,telefono_acompa,id_institucion,sede,nombre_titular,email_titular,telefono_titular,estado,fecha_reg,usuario_reg) VALUES(0,'$hoy','$_POST[tipo_practica]','$_POST[id_estudiante]','$_POST[id_facultad]','$_POST[id_departamento]','$_POST[id_programa]','$_POST[semestre]','$_POST[nombre_acompa]','$_POST[vinculacion]','$_POST[email_acompa]','$_POST[telefono_acompa]','$_POST[id_institucion]','$_POST[sede]','$_POST[nombre_titular]','$_POST[email_titular]','$_POST[telefono_titular]','A','$hoy','$_SESSION[gid_usuario]')";   
//echo "<br>".$sql_;
$link->query($sql_);
if($link->affected_rows > 0){
    $msg="Registro guardado con exito";
}
else{$msg="Registro no guardado";}

echo "<br>".$msg;

?>
<body onload="continuar('<?php echo $msg;?>')">
<form name='form1' method="post" action="pp_practica2.php">
    
</form>
</body>
</html>