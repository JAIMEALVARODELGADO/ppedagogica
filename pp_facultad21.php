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
        function validar(){
            var error='';
            if(document.form1.nombre.value==''){error+="El nombre no debe estar vacio\n";}
            if(error!=''){
                alert(error);
            }
            else{
                document.form1.submit();
            }
        }
    </script>

<body>

<?php
require("pp_funciones.php");
require("pp_menu.php");
require("pp_menu_facultad.php");
$link=conectarbd();
$nombre='';
$consulta="SELECT id_facultad,nombre FROM facultad WHERE id_facultad='$_GET[id_facultad]'";
//echo "<br>".$consulta;
$consulta=$link->query($consulta);
if($consulta->num_rows > 0){
    $row=$consulta->fetch_array();
    $nombre=$row['nombre'];
}
?>
<form name='form1' method="post" action="pp_facultad211.php">    
    <?php
    require("pp_datos_facultad.php");
    echo "<input type='hidden' name='id_facultad' value='$_GET[id_facultad]'/>";
    ?>
    <script language="JavaScript">
        document.form1.nombre.value='<?php echo $nombre;?>';
    </script>
</form>
</body>
</html>
