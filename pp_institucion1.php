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
        <link rel="stylesheet" type="text/css" href="css/jquery.autocomplete.css">
        <script type="text/javascript" src="js/jquery.js"></script>
        <script type='text/javascript' src='js/jquery.autocomplete.js'></script>
        <script type="text/javascript">
            $().ready(function() {	
                $("#course").autocomplete("autocomp_muni.php", {
                    width: 460,
                    matchContains: false,
                    mustMatch: false,
                    selectFirst: false
                });
	
                $("#course").result(function(event, data, formatted) {
                    $("#course_val").val(data[1]);
                });
            });
        </script>
        <title>Práctica Pedag&oacute;gica Integral Investigativa</title>
    </head>
    <script language="JavaScript">
        function validar(){
            var error='';
            if(document.form1.nombre.value==''){error+="Nombre \n";}
            if(document.form1.naturaleza.value==''){error+="Naturaleza \n";}
            if(document.form1.cod_municipio.value==''){error+="Municipio\n";}
            if(document.form1.direccion.value==''){error+="Dirección\n";}
            if(document.form1.telefono.value==''){error+="Teléfono\n";}
            if(document.form1.director.value==''){error+="Director\n";}
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
require("pp_menu_institucion.php");
?>
<form name='form1' method="post" action="pp_institucion11.php">
    <?php
    require("pp_datos_institucion.php");
    ?>
    <button type="button" onclick='validar()'><span class="icon-save"></span> Guardar</button>
</form>
</body>
</html>
