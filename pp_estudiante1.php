<?php
session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html lang="es-ES" dir="ltr" xmlns="http://www.w3.org/1999/xhtml">
    <head>        
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <meta description="Registro y cotrol de las pr�cticas pedag�gicas de la Universidad de Nari�o"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <link rel="stylesheet" type="text/css" href="css/estilos.css">
        <link rel="stylesheet" type="text/css" href="fonts/style.css">
        <title>Pr�ctica Pedag&oacute;gica Integral Investigativa</title>
    </head>
    <script language="JavaScript">
        function validar(){
            var error='';
            if(document.form1.codigo.value==''){error+="C�digo\n";}
            if(document.form1.tipo_ident.value==''){error+="Tipo de Identificaci�n\n";}
            if(document.form1.numero_ident.value==''){error+="N�mero de Identificaci�n\n";}
            if(document.form1.apellidos.value==''){error+="Apellidos\n";}
            if(document.form1.nombres.value==''){error+="Nombres\n";}
            if(document.form1.telefono.value==''){error+="Tel�fono\n";}
            if(document.form1.email.value==''){error+="Correo Electr�nico\n";}
            if(error!=''){
                alert("Es necesario complementar la siguiente informaci�n:\n"+error);
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
?>
<form name='form1' method="post" action="pp_estudiante11.php">
    <?php
    require("pp_datos_estudiante.php");
    ?>
    <button type="button" onclick='validar()'><span class="icon-save"></span> Guardar</button>
</form>
</body>
</html>
