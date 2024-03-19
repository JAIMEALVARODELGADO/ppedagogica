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
        function editar(id_){
            window.open("pp_programa21.php?id_programa="+id_,"_self");
        }
    </script>
<body>

<?php
require("pp_funciones.php");
require("pp_menu.php");
require("pp_menu_programa.php");
$link=  conectarbd();
?>

<form name='form1' method="post" action="pp_programa11.php">
    <table width="50%">
        <th colspan="2">Opciones</th>
        <th>Nombre</th>
        <?php
            $consulta="SELECT id_programa,descripcion FROM programa ORDER BY descripcion";
            $res=$link->query($consulta);
            if($res->num_rows<>0){
                while($row=$res->fetch_array()){
                    echo "<tr>";
                    echo "<td width='5%'><a href='#' onclick=editar('$row[id_programa]') title='Editar' class='btnhref'><span class='icon-edit'></span></a></td>";
                    echo "<td width='5%'><a href='#' onclick=eliminar('$row[id_programa]') title='Eliminar' class='btnhref'><span class='icon-trash Eliminar'></span></a></td>";
                    echo "<td>".$row['descripcion']."</td>";
                    echo "</tr>";
                }
            }
        ?>
    </table>
</form>
</body>
</html>