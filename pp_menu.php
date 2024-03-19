<?php
//session_start();
//echo "<br>".$_SESSION['gid_usuario'];
//echo "<br>".$_SESSION['gnombre'];
if(!isset($_SESSION['gid_usuario'])){
    ?>
        <script type="text/javascript">
            alert("La sesion ha finalizado. \nIngrese nuevamente");
            window.open('blanco.html','_self',''); 
            window.close(); 
        </script>
    <?php
}
$link=conectarbd();
?>
<nav>
    <ul class="nav">
        <?php
            $consmenu="SELECT id_menu,descripcion,dependencia,nivel,url FROM menu WHERE nivel='1'";
            $consmenu=$link->query($consmenu);
            if($consmenu->num_rows<>0){
                while($row=$consmenu->fetch_array()){
                    echo "<li><a href='$row[url]'>$row[descripcion]</a>";
                    $link2=conectarbd();
                    $consm2="SELECT id_menu,descripcion,dependencia,nivel,url FROM menu WHERE nivel='2' AND dependencia='$row[id_menu]'";
                    //echo "<br>".$consm2;
                    $consm2=$link2->query($consm2);
                    if($consm2->num_rows<>0){
                        echo "<ul>";
                        while($row2=$consm2->fetch_array()){
                            echo "<li><a href='$row2[url]'>$row2[descripcion]</a></li>";
                        }
                        echo "</ul>";
                    }
                    echo "</li>";
                }
            }
        ?>
    </ul>
</nav>

<!--<nav>
    <ul class="nav">
        <li><a href="#">Inicio</a></li>
        <li><a href="#">Creación</a>
            <ul>
                <li><a href="pp_estudiante1.html">Estudiante</a></li>
                <li><a href="pp_practica1.html">Practica</a></li>
                <li><a href="pp_evaluacion1.html">Evaluación</a></li>
                <!--<li><a href="#">Submenu 4</a>
                    <ul>
                        <li><a href="#">Submenu 1</a></li>
                        <li><a href="#">Submenu 2</a></li>
                        <li><a href="#">Submenu 3</a></li>
                        <li><a href="#">Submenu 4</a></li>
                    </ul>
                </li>-->
            <!--</ul>
        </li>
        <li><a href="#">Administración</a>
            <ul>
                <li><a href="pp_horarios1.html">Horario</a></li>
                <li><a href="#">Programas</a></li>
                <li><a href="#">Departamentos</a></li>
                <li><a href="#">Facultades</a></li>
                <!--<li><a href="#">Vinculación</a></li>-->
                <!--<li><a href="#">Instituciones</a></li>
                <li><a href="#">Aspectos</a></li>
                
            </ul>
        </li>
        <li><a href="#">Contacto</a></li>
        <li><a href="#" onclick="window.close()">Salir</a></li>
    </ul>
</nav>-->