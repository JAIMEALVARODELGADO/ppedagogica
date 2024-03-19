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
            if(document.form1.codigo.value==''){error+="Código\n";}
            if(document.form1.tipo_ident.value==''){error+="Tipo de Identificación\n";}
            if(document.form1.numero_ident.value==''){error+="Número de Identificación\n";}
            if(document.form1.apellidos.value==''){error+="Apellidos\n";}
            if(document.form1.nombres.value==''){error+="Nombres\n";}
            if(document.form1.telefono.value==''){error+="Teléfono\n";}
            if(document.form1.email.value==''){error+="Correo Electrónico\n";}
            if(error!=''){
                alert("Es necesario complementar la siguiente información:\n"+error);
            }
            else{
                document.form1.submit();
            }
        }
        function recargar(opc_){
            document.form1.opcion.value=opc_;
            document.form1.action='pp_estudiante1.php';
            document.form1.submit();
        }
        
    </script>

<body>

<?php
require("pp_funciones.php");
require("pp_menu.php");
require("pp_menu_estudiante.php");
$link=conectarbd();
$consulta="SELECT codigo,tipo_ident,numero_ident,apellidos,nombres,telefono,email FROM estudiante WHERE id_estudiante='$_GET[id_estudiante]'";
//echo "<br>".$consulta;
$consulta=$link->query($consulta);
if($consulta->num_rows > 0){
    while($row=$consulta->fetch_array()){
        $codigo=$row['codigo'];
        $tipo_ident=$row['tipo_ident'];
        $numero_ident=$row['numero_ident'];
        $apellidos=$row['apellidos'];
        $nombres=$row['nombres'];
        $telefono=$row['telefono'];
        $email=$row['email'];
    }
}
?>
<form name='form1' method="post" action="pp_estudiante211.php">
    <?php
    require("pp_datos_estudiante.php");
    echo "<input type='hidden' name='id_estudiante' value='$_GET[id_estudiante]'/>";
    ?>
    <button type="button" onclick='validar()'><span class="icon-save"></span> Guardar</button>
    
    <script language="JavaScript">
        document.form1.codigo.value='<?php echo $codigo;?>';
        document.form1.tipo_ident.value='<?php echo $tipo_ident;?>';
        document.form1.numero_ident.value='<?php echo $numero_ident;?>';
        document.form1.apellidos.value='<?php echo $apellidos;?>';
        document.form1.nombres.value='<?php echo $nombres;?>';
        document.form1.telefono.value='<?php echo $telefono;?>';
        document.form1.email.value='<?php echo $email;?>';
    </script>
</form>
</body>
</html>
