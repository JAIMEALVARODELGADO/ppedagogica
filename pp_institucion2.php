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
            //if(document.form1.nombre.value=='' && document.form1.municipio.value==''&& document.form1.director.value==''){
            //    alert("Para la busqueda, al menos se debe digitar el valor de un campon"+error);
            //}
            //else{
                document.form1.submit();
            //}
        }

        function eliminar(id_){
            if(confirm("Desea eliminar la institucion\n"+id_)){
                window.open("pp_institucion22.php?id_institucion="+id_,"_self");
            }
        }

        function editar(id_){
            window.open("pp_institucion21.php?id_institucion="+id_,"_self");
        }
    </script>

<body>

<?php
require("pp_funciones.php");
require("pp_menu.php");
require("pp_menu_institucion.php");
$link=conectarbd();
$nombre='';
$municipio='';
$director='';
$orden='';
if(isset($_POST['nombre'])){$nombre=$_POST['nombre'];}
if(isset($_POST['municipio'])){$municipio=$_POST['municipio'];}
if(isset($_POST['director'])){$director=$_POST['director'];}
if(isset($_POST['orden'])){$orden=$_POST['orden'];}
?>
<form name='form1' method="post" action="pp_institucion2.php">
    <span class="form-el"><input type='text' id='nombre' name='nombre' maxlength='80' size='40' placeholder='Nombre' value="<?php echo $nombre;?>"/></span>
    <span class="form-el"><input type='text' id='municipio' name='municipio' maxlength='30' size='30' placeholder='Municipio' value="<?php echo $municipio;?>"/></span>
    <span class="form-el"><input type='text' id='director' name='director' maxlength='30' size='30' placeholder='Director' value="<?php echo $director;?>"/></span>
    <span class="form-el">
        Orden:<select id='orden' name='orden' value="<?php echo $orden;?>">
            <option value='nombre'>Nombre</option>
            <option value='nombre_mun'>Municipio</option>
            <option value='director'>Director</option>
        </select>
    </span>
    <a href="#" onclick='validar();' title='Buscar'><span class="icon-magnifying-glass"></span> </a>
<?php
$condicion='';
if(!empty($nombre)){$condicion=$condicion."nombre LIKE '%$nombre%' AND ";}
if(!empty($municipio)){$condicion=$condicion."nombre_mun LIKE'%$municipio%' AND ";}
if(!empty($director)){$condicion=$condicion."director LIKE '%$director%' AND ";}
if(!empty($condicion)){
    $condicion=substr($condicion,0,-5);
    //echo "<br>".$condicion;
}
    if(empty($orden)){$orden='nombre';}
    $consins="SELECT id_institucion,nombre,naturaleza,direccion,telefono,director,nombre_mun FROM vw_institucion";
    if(!empty($condicion)){$consins=$consins." WHERE ".$condicion;}
    $consins=$consins." ORDER BY ".$orden;
    //echo "<br>".$consins;
    $consins=$link->query($consins);
    if($consins->num_rows<>0){
        echo "<br><br><table width='100%'>";
        echo "<th colspan='2'>Opciones</th>".
            "<th>Nombre</th>".
            "<th>naturaleza</th>".
            "<th>Direccion</th>".
            "<th>Teléfono</th>".
            "<th>Director</th>".
            "<th>Municipio</th>";
        while($row=$consins->fetch_array()){
            //echo "<br>".$row['nombre'];
            $nombre=$row['nombre'];
            echo "<tr>";
            echo "<td width='5%'><a href='#' onclick=editar($row[id_institucion]) title='Editar' class='btnhref'><span class='icon-edit'></span></a></td>";
            echo "<td width='5%'><a href='#' onclick=eliminar('$row[id_institucion]') title='Eliminar' class='btnhref'><span class='icon-trash Eliminar'></span></a></td>";
            echo "<td>$row[id_institucion] - $row[nombre]</td>";
            echo "<td>$row[naturaleza]</td>";
            echo "<td>$row[direccion]</td>";
            echo "<td>$row[telefono]</td>";
            echo "<td>$row[director]</td>";
            echo "<td>$row[nombre_mun]</td>";
            echo "</tr>";
        }
    }
    echo "</table>";
//}
?>
</form>
</body>
</html>
