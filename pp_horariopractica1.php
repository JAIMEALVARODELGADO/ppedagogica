<?php
session_start();
$id_practica=$_GET['id_practica'];
?>
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
            if(document.form1.id_dia.value==''){error+="Día\n";}
            if(document.form1.hora.value==''){error+="Hora\n";}
            if(document.form1.id_asignatura.value==''){error+="Asignatura\n";}
            if(document.form1.grado.value==''){error+="Grado\n";}
            if(document.form1.grupo.value==''){error+="Grupo\n";}
            if(document.form1.jornada.value==''){error+="Jornada\n";}
            if(document.form1.nivel.value==''){error+="Nivel\n";}

            if(error!=''){
                alert("Para continuar debe complementar la siguiente información:\n"+error);
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
require("pp_menu_horario_practica.php");
$consulta="SELECT numero_ident,CONCAT(nombres,' ',apellidos) AS nombres,email,telefono,tipo_practica,semestre,nombre_prog,nombre_ins,nombre_acompa FROM vw_practica WHERE id_practica='$id_practica'";
//echo "<br>".$consulta;
$consulta=$link->query($consulta);
if($consulta->num_rows<>0){
    $row=$consulta->fetch_array();
    //echo "<br>".$row['numero_ident'];
}

?>
    <form name="form1" method="post" action="pp_horariopractica11.php">
    <!--<div class="caja2">-->
        <?php
            require("pp_datospracticahorario.php");
            require("pp_datos_horario.php");
        ?>
        
        
        
    <!--</div>-->
</form>
</body>
</html>