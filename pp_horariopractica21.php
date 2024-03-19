<?php
session_start();
$id_practica=$_GET['id_practica'];
$id_horario=$_GET['id_horario'];

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
    <form name="form1" method="post" action="pp_horariopractica211.php">
    <!--<div class="caja2">-->
        <?php
            require("pp_datospracticahorario.php");
            require("pp_datos_horario.php");
            $consultahor="SELECT id_dia,hora,id_asignatura,grado,grupo,jornada,nivel FROM horario WHERE id_horario='$id_horario'";
            //echo $consultahor;
            $consultahor=$link->Query($consultahor);
            if($consultahor->num_rows<>0){
                $rowhor=$consultahor->fetch_array();
                //echo "<br>".$rowhor['id_dia'];
                ?>
                    <script type="text/javascript" language='JavaScript'>
                        document.form1.id_dia.value='<?php echo $rowhor['id_dia'];?>';
                        document.form1.hora.value='<?php echo $rowhor['hora'];?>';
                        document.form1.id_asignatura.value='<?php echo $rowhor['id_asignatura'];?>';
                        document.form1.grado.value='<?php echo $rowhor['grado'];?>';
                        document.form1.grupo.value='<?php echo $rowhor['grupo'];?>';
                        document.form1.jornada.value='<?php echo $rowhor['jornada'];?>';
                        document.form1.nivel.value='<?php echo $rowhor['nivel'];?>';
                    </script>
                <?php
                echo "<input type='hidden' name='id_horario' value='$id_horario'>";
                echo "<input type='hidden' name='id_practica' value='$id_practica'>";
            }

        ?>
    <!--</div>-->
</form>
</body>
</html>