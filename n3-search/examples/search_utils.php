<?php


/* ************************************************************************* */

// Get Niveles de estudio

global $N3_Search_Utils;
$N3_Search_Result = $N3_Search_Utils->getNivelDeEstudio();

/* ************************************************************************* */

// Get Areas

global $N3_Search_Utils;
$N3_Search_Result = $N3_Search_Utils->getAreas();


/* ************************************************************************* */

// Get Disciplina

global $N3_Search_Utils;
$N3_Search_Result = $N3_Search_Utils->getDisciplina();

/* ************************************************************************* */

// Get Modalidad

global $N3_Search_Utils;
$N3_Search_Result = $N3_Search_Utils->getModalidad();

/* ************************************************************************* */

// Get Instituciones

global $N3_Search_Utils;
$N3_Search_Result = $N3_Search_Utils->getInstituciones();

/* ************************************************************************* */

// Get UnidadAcademica

global $N3_Search_Utils;
$N3_Search_Result = $N3_Search_Utils->getUnidadAcademica();

// Get UnidadAcademica filtering by id_universidad

global $N3_Search_Utils;
$N3_Search_Result = $N3_Search_Utils->getUnidadAcademica([32, 33]);

/* ************************************************************************* */

// Get Provincia

global $N3_Search_Utils;
$N3_Search_Result = $N3_Search_Utils->getProvincia();

/* ************************************************************************* */

// Get Localidad

global $N3_Search_Utils;
$N3_Search_Result = $N3_Search_Utils->getLocalidad();

// Get Provincia filtering by id_provincia

global $N3_Search_Utils;
$N3_Search_Result = $N3_Search_Utils->getLocalidad(['L', 'U']);


/* ************************************************************************* */

?>
