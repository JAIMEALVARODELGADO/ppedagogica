<?php
session_start();
$id_practica=$_GET['id_practica'];
?>
<html lang="es-ES" dir="ltr" xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <!--<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />-->
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <meta description="Registro y cotrol de las prácticas pedagógicas de la Universidad de Nariño"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <link rel="stylesheet" type="text/css" href="css/estilos.css">
        <link rel="stylesheet" type="text/css" href="fonts/style.css">
        <title>Práctica Pedag&oacute;gica Integral Investigativa</title>
    </head>
    <script language="JavaScript">
        function eliminar(id_hor_,id_prac_){
            if(confirm("Desea eliminar el horario?")){
                window.open("pp_horariopractica22.php?id_horario="+id_hor_+"&id_practica="+id_prac_,"_self");
            }
        }
        function editar(id_hor_,id_prac_){
            window.open("pp_horariopractica21.php?id_horario="+id_hor_+"&id_practica="+id_prac_,"_self");
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
    <form method="post" action="pp_estudiante11.php">
    <!--<div class="caja2">--> 
         <?php
            require("pp_datospracticahorario.php");
            $consultahor="SELECT id_horario,id_practica,nombre_dia,hora,nombre_asig,grado,grupo,jornada,nivel FROM vw_horario WHERE id_practica='$id_practica'";
            //echo "<br>".$consultahor;
            $consultahor=$link->Query($consultahor);
            if($consultahor->num_rows<>0){
                echo "<fieldset><legend>Horario</legend>";
                echo "<table>";
                echo "<th colspan='2'>Opciones</th>";
                echo "<th>Día</th>";
                echo "<th>Hora</th>";
                echo "<th>Asignatura</th>";
                echo "<th>Grado</th>";
                echo "<th>Grupo</th>";
                echo "<th>Jornada</th>";
                echo "<th>Nivel</th>";
                
                while($rowhor=$consultahor->fetch_array()){
                    echo "<tr>";
                    echo "<td width='5%'><a href='#' onclick='editar($rowhor[id_horario],$id_practica)' title='Editar' class='btnhref'><span class='icon-edit'></span></a></td>";
                    echo "<td width='5%'><a href='#' onclick='eliminar($rowhor[id_horario],$id_practica)' title='Eliminar' class='btnhref'><span class='icon-trash Eliminar'></span></a></td>";
                    echo "<td>$rowhor[nombre_dia]</td>";
                    echo "<td>$rowhor[hora]</td>";
                    echo "<td>$rowhor[nombre_asig]</td>";
                    echo "<td>$rowhor[grado]</td>";
                    echo "<td>$rowhor[grupo]</td>";
                    echo "<td>$rowhor[jornada]</td>";
                    echo "<td>$rowhor[nivel]</td>";
                    echo "</tr>";
                }
                echo "</table>";
                echo "</fieldset>";
            }

        ?>
</form>
</body>
</html>