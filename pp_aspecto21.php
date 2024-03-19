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
            if(document.form1.codigo.value==''){error+="Item \n";}
            if(document.form1.descripcion.value==''){error+="Descripción \n";}
            if(document.form1.tipo.value==''){error+="Tipo\n";}
            if(error!=''){
                alert("Es necesario complementar la siguiente información:\n"+error);
            }
            else{
                document.form1.submit();
            }
            return true;
        }
        
    </script>

<body>

<?php
require("pp_funciones.php");
require("pp_menu.php");
require("pp_menu_aspecto.php");
$link=conectarbd();
$consulta="SELECT codigo,descripcion,tipo,estado FROM aspecto WHERE id_aspecto='$_GET[id_aspecto]'";
//echo "<br>".$consulta;
$consulta=$link->query($consulta);
if($consulta->num_rows > 0){
    $row=$consulta->fetch_array();
    $codigo=$row['codigo'];
    $descripcion=$row['descripcion'];
    $tipo=$row['tipo'];
    $estado=$row['estado'];
    
}
?>
<form name='form1' method="post" action="pp_aspecto211.php">
    <?php
    require("pp_datos_aspecto.php");
    echo "<input type='hidden' name='id_aspecto' value='$_GET[id_aspecto]'/>";
    ?>
    <button type="button" onclick='validar()'><span class="icon-save"></span> Guardar</button>
    
    <script language="JavaScript">
        document.form1.codigo.value='<?php echo $codigo;?>';
        document.form1.descripcion.value='<?php echo $descripcion;?>';
        document.form1.tipo.value='<?php echo $tipo;?>';
        <?php
        if($estado=='A'){
            ?>
                document.form1.estado.checked=true;
            <?php
        }
        ?>
    </script>
</form>
</body>
</html>
