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
        <title>Prácticas Pedag&oacute;gicas</title>
    </head>
<body>
<header>
    <h3>Práctica Pedaógica Integral Investigativa</h3>
    <h5>Universidad de Nari&nacute;o</h5>
    <figure></figure>    
</header>
<script language='JavaScript'>
    function continuar(msg_){
        if(msg_!=''){
            alert(msg_);
            document.form1.submit();
        }
        else{
            document.form1.action='frm_inicio.html';
            document.form1.submit();
        }
    }
</script>
<?PHP
require('pp_funciones.php');
$password=SHA1($_POST['password']);
$link=conectarbd();
$consulta="SELECT id_usuario,nombre FROM usuario WHERE password='$password' AND login='$_POST[login]' AND activo='S'";
//echo "<br>".$consulta;
$consulta=$link->query($consulta);
$msg='';
if($consulta->num_rows == 0){
    $msg="Usuario no registrado";
}
else{
    //$row=$consulta->cubrid_fetch_array($consulta);
    /*$consulta="SELECT id_usuario,nombre FROM usuario WHERE password='$password' AND login='$_POST[login]' AND activo='S'";
    $result = mysqli_query($link, $consulta);
    $row=mysqli_fetch($result)
    echo "<br>".$row[0];*/
    $_SESSION['gid_usuario']='1';
    $_SESSION['gnombre']='Jaime';

}
mysqli_close($link);
?>

<form name='form1' method="post" action="pp_ingreso.html">
<script language="JavaScript">
    continuar('<?php echo $msg;?>');
</script>

</form>
</body>
</html>
