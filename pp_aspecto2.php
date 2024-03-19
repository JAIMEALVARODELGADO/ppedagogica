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
        function eliminar(id_){
            //if(confirm("Desea eliminar la institucion\n"+id_)){
                //window.open("pp_institucion22.php?id_institucion="+id_,"_self");
            //}
        }

        function editar(id_){
            window.open("pp_aspecto21.php?id_aspecto="+id_,"_self");
        }
    </script>
<body>

<?php
require("pp_funciones.php");
require("pp_menu.php");
require("pp_menu_aspecto.php");
$link=conectarbd();
?>
<form name='form1' method="post" action="pp_aspecto2.php">
<?php
    $consulta="SELECT id_aspecto,codigo,descripcion,tipo,estado FROM aspecto ORDER BY codigo";
    //echo "<br>".$consulta;
    $consulta=$link->query($consulta);
    if($consulta->num_rows<>0){
        echo "<br><br><table width='100%'>";
        echo "<th colspan='2'>Opciones</th>".
            "<th>Código</th>".
            "<th>Descripción</th>".
            "<th>Tipo</th>".
            "<th>Estado</th>";
        while($row=$consulta->fetch_array()){
            //echo "<br>".$row['nombre'];
            echo "<tr>";
            echo "<td width='5%'><a href='#' onclick=editar($row[id_aspecto]) title='Editar' class='btnhref'><span class='icon-edit'></span></a></td>";
            echo "<td width='5%'><a href='#' onclick=eliminar('$row[id_aspecto]') title='Eliminar' class='btnhref'><span class='icon-trash Eliminar'></span></a></td>";
            echo "<td>$row[codigo]</td>";
            echo "<td>$row[descripcion]</td>";
            echo "<td>$row[tipo]</td>";
            echo "<td>$row[estado]</td>";
            echo "</tr>";
        }
    }
    echo "</table>";
//}
?>
</form>
</body>
</html>
