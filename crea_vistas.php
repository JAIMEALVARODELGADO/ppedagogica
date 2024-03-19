
CREATE OR REPLACE VIEW vw_estudiante AS 
SELECT id_estudiante,CONCAT(numero_ident,' ',nombres,' ',apellidos) AS nombre FROM estudiante ORDER BY nombres;

CREATE OR REPLACE VIEW vw_municipio AS
SELECT codigo_mun,CONCAT(codigo_mun,' ',nombre) AS nombre FROM municipio WHERE codigo_mun LIKE '52%' ORDER BY nombre;

CREATE OR REPLACE VIEW vw_institucion AS
SELECT institucion.id_institucion,institucion.nombre,institucion.naturaleza,institucion.cod_municipio,institucion.direccion,institucion.telefono,institucion.director,municipio.nombre AS nombre_mun
FROM institucion INNER JOIN municipio ON municipio.codigo_mun=institucion.cod_municipio

CREATE OR REPLACE VIEW vw_practica AS
SELECT practica.id_practica,practica.id_estudiante,practica.fecha_inscripcion,practica.tipo_practica,practica.semestre,practica.nombre_acompa,practica.estado, estudiante.numero_ident,estudiante.apellidos,estudiante.nombres,estudiante.telefono,estudiante.email,
institucion.nombre AS nombre_ins,institucion.direccion,institucion.telefono AS telefono_ins,institucion.director,programa.descripcion AS nombre_prog
FROM practica
INNER JOIN estudiante ON estudiante.id_estudiante=practica.id_estudiante
INNER JOIN institucion ON institucion.id_institucion=practica.id_institucion
INNER JOIN programa ON programa.id_programa=practica.id_programa


CREATE OR REPLACE VIEW vw_horario AS
SELECT horario.id_horario,horario.id_practica,horario.id_dia,dia.nombre_dia,horario.hora,asignatura.nombre AS nombre_asig,horario.grado,horario.grupo,horario.jornada,horario.nivel
FROM horario 
INNER JOIN dia ON dia.id_dia=horario.id_dia
INNER JOIN asignatura ON asignatura.id_asignatura=horario.id_asignatura

CREATE OR REPLACE VIEW vw_evaluacion AS
SELECT evaluacion.id_evaluacion,evaluacion.fecha_eval,evaluacion.observacion_eval,
practica.id_practica,practica.fecha_inscripcion,practica.tipo_practica,practica.semestre,
facultad.nombre AS nombre_fac,
estudiante.id_estudiante,estudiante.numero_ident,estudiante.tipo_ident,estudiante.apellidos,estudiante.nombres,estudiante.telefono,estudiante.email,
departamento.nombre AS nombre_dep,
programa.descripcion AS nombre_prog,
institucion.nombre AS nombre_ins
FROM evaluacion 
INNER JOIN practica ON practica.id_practica=evaluacion.id_practica
INNER JOIN facultad ON facultad.id_facultad=practica.id_facultad
INNER JOIN estudiante ON estudiante.id_estudiante=practica.id_estudiante
INNER JOIN departamento ON departamento.id_departamento=practica.id_departamento
INNER JOIN programa ON programa.id_programa=practica.id_programa
INNER JOIN institucion ON institucion.id_institucion=practica.id_institucion

CREATE OR REPLACE VIEW vw_evaluacion_aspecto AS
SELECT evaluacion_aspecto.id_evaluacion_aspecto,evaluacion_aspecto.id_evaluacion,evaluacion_aspecto.id_aspecto,evaluacion_aspecto.calificacion,
aspecto.codigo,aspecto.descripcion,aspecto.tipo
FROM evaluacion_aspecto
INNER JOIN aspecto ON aspecto.id_aspecto=evaluacion_aspecto.id_aspecto