
       <div class="fila">
        <span class="etiqueta"><label>Identificación: </label></span>
        <span class="form-el"><label class="labelmostrar"><?php echo $row['numero_ident'];?></label></span>
        <span class="etiqueta"><label>Nombre: </label></span>
        <span class="form-el"><label class="labelmostrar"><?php echo $row['nombres'];?></label></span>
        </div>
        <div class="fila">
        <span class="etiqueta"><label>Correo Electrónico:</label></span>
        <span class="form-el"><label class="labelmostrar"><?php echo $row['email'];?></label></span>
        <span class="etiqueta"><label>Teléfono:</label></span>
        <span class="form-el"><label class="labelmostrar"><?php echo $row['telefono'];?></label></span>
        </div>
        
        <fieldset><legend>Información de la Práctica</legend>
        <div class="fila">
        <span class="etiqueta"><label>Practica:</label></span>
        <span class="form-el"><label class="labelmostrar"><?php echo $row['tipo_practica'];?></label></span>
        <span class="etiqueta"><label>Programa:</label></span>
        <span class="form-el"><label class="labelmostrar"><?php echo $row['nombre_prog'];?></label></span>
        </div>
        <div class="fila">
        <span class="etiqueta"><label>Semestre:</label></span>
        <span class="form-el"><label class="labelmostrar"><?php echo $row['semestre'];?></label></span>
        <span class="etiqueta"><label>Nombra del Acompañante:</label></span>
        <span class="form-el"><label class="labelmostrar"><?php echo $row['nombre_acompa'];?></label></span>
        </div>
        <div class="fila">
        <span class="etiqueta"><label>Institución:</label></span>
        <span class="form-el"><label class="labelmostrar"><?php echo $row['nombre_ins'];?></label></span>
        </div>
        </fieldset>