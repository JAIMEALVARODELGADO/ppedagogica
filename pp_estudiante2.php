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
            if(document.form1.codigo.value=='' && document.form1.numero_ident.value==''&& document.form1.apellidos.value=='' && document.form1.nombres.value==''){
                alert("Para la busqueda, al menos se debe digitar el valor de un campon"+error);
            }
            else{
                document.form1.submit();
            }
        }
        function eliminar(id_,numiden_){
            if(confirm("Desea eliminar el estudiante con la identifición\n"+numiden_)){
                window.open("pp_estudiante22.php?id_estudiante="+id_,"_self");
            }
        }
        function editar(id_){
            window.open("pp_estudiante21.php?id_estudiante="+id_,"_self");
        }
    </script>

<body>

<?php
require("pp_funciones.php");
require("pp_menu.php");
require("pp_menu_estudiante.php");
$codigo='';
$numero_ident='';
$apellidos='';
$nombres='';
$orden='';
if(isset($_POST['codigo'])){$codigo=$_POST['codigo'];}
if(isset($_POST['numero_ident'])){$numero_ident=$_POST['numero_ident'];}
if(isset($_POST['apellidos'])){$apellidos=$_POST['apellidos'];}
if(isset($_POST['nombres'])){$nombres=$_POST['nombres'];}
if(isset($_POST['orden'])){$orden=$_POST['orden'];}
?>
<form name='form1' method="post" action="pp_estudiante2.php">
    <span class="form-el"><input type='text' id='codigo' name='codigo' maxlength='12' size='12' placeholder='Código' value="<?php echo $codigo;?>"/></span>
    <span class="form-el"><input type='text' id='numero_ident' name='numero_ident' maxlength='20' size='20' placeholder='Identificación' value="<?php echo $numero_ident;?>"/></span>
    <span class="form-el"><input type='text' id='apellidos' name='apellidos' maxlength='30' size='30' placeholder='Apellidos' value="<?php echo $apellidos;?>"/></span>
    <span class="form-el"><input type='text' id='nombres' name='nombres' maxlength='30' size='30' placeholder='Nombres' value="<?php echo $nombres;?>"/></span>
    <span class="form-el">Orden
        <select id='orden' name='orden' value="<?php echo $orden;?>">
            <option value='codigo'>Código</option>
            <option value='numero_ident'>Identificación</option>
            <option value='apellidos'>Apellidos</option>
            <option value='nombres'>Nombres</option>
        </select>
    </span>
    <a href="#" onclick='validar();' title='Buscar'><span class="icon-magnifying-glass"></span> </a>
<?php
$condicion='';
if(!empty($codigo)){$condicion=$condicion."codigo='$codigo' AND ";}
if(!empty($numero_ident)){$condicion=$condicion."numero_ident='$numero_ident' AND ";}
if(!empty($apellidos)){$condicion=$condicion."apellidos LIKE '%$apellidos%' AND ";}
if(!empty($nombres)){$condicion=$condicion."nombres LIKE '%$nombres%' AND ";}
if(!empty($condicion)){
    $condicion=substr($condicion,0,-5);
    //echo "<br>".$condicion;
    if(empty($orden)){$orden='codigo';}
    $consest="SELECT id_estudiante,codigo,tipo_ident,numero_ident,apellidos,nombres,telefono,email FROM estudiante WHERE ".$condicion." ORDER BY ".$orden;
    //echo "<br>".$consest;
    $consest=$link->query($consest);
    if($consest->num_rows<>0){
        echo "<br><br><table width='100%'>";
        echo "<th colspan='2'>Opciones</th>".
            "<th>Código</th>".
            "<th>Tp.Iden.</th>".
            "<th>Identificación.</th>".
            "<th>Apellidos</th>".
            "<th>Nombres</th>".
            "<th>Teléfono</th>".
            "<th>E-mail</th>";
        while($row=$consest->fetch_array()){
            //echo "<br>".$row['id_estudiante'];
            echo "<tr>";
            echo "<td width='5%'><a href='#' onclick=editar($row[id_estudiante]) title='Editar' class='btnhref'><span class='icon-edit'></span></a></td>";
            echo "<td width='5%'><a href='#' onclick=eliminar($row[id_estudiante],$row[numero_ident]) title='Eliminar' class='btnhref'><span class='icon-trash Eliminar'></span></a></td>";
            echo "<td>$row[codigo]</td>";
            echo "<td>$row[tipo_ident]</td>";
            echo "<td>$row[numero_ident]</td>";
            echo "<td>$row[apellidos]</td>";
            echo "<td>$row[nombres]</td>";
            echo "<td>$row[telefono]</td>";
            echo "<td>$row[email]</td>";
            echo "</tr>";
        }
    }
    echo "</table>";
}
?>
</form>
</body>
</html>
