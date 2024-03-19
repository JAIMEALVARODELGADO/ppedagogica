<?php
session_start();
?>
<!DOCTYPE html>
<html lang="es">
    <head>        
        <meta charset="UTF-8"/>
        <meta description="Registro y cotrol de las prácticas pedagógicas de la Universidad de Nariño"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <link rel="stylesheet" type="text/css" href="css/estilos.css">
        <link rel="stylesheet" type="text/css" href="fonts/style.css">
        <title>Pr�ctica Pedag&oacute;gica Integral Investigativa</title>
    </head>
    <script language="JavaScript">
        function validar(){
            error='';
            if(document.form1.nombre.value==''){error="El nombre del departamento no debe estar vacio";}
            if(error!=''){alert(error)}
            else{document.form1.submit();}
        }
    </script>
<body>

<?php
require("pp_funciones.php");
require("pp_menu.php");
require("pp_menu_departamento.php");
?>

<form name='form1' method="post" action="pp_departamento11.php">
<?php
    require("pp_datos_programa.php");
?>
</form>
</body>
</html>