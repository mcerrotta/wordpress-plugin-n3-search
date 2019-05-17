<?php

// Using where, changing limit, changing offset

global $N3_Search;
$N3_Search->where([
	['id_regimen', 'PR'],
	['id_unidad_academica', 32],
]);
$N3_Search->limit(10);
$N3_Search->offset(10);
$N3_Search_Result = $N3_Search->execute();

/* ************************************************************************* */

// Using where

global $N3_Search;
$N3_Search->where([
	['id_regimen', 'PR'],
    ['id_unidad_academica', 448],
    ['id_universidad', 32],
]);
$N3_Search_Result = $N3_Search->execute();


/* ************************************************************************* */

// Using addWhere

global $N3_Search;
$N3_Search->addWhere(['id_regimen', 'PR']);
$N3_Search->addWhere(['id_unidad_academica', 448]);
$N3_Search->addWhere(['id_universidad', 32]);
$N3_Search_Result = $N3_Search->execute();

/* ************************************************************************* */

// Changing limit

global $N3_Search;
$N3_Search->where([
	['id_regimen', 'PR'],
    ['id_unidad_academica', 448],
    ['id_universidad', 32],
]);
$N3_Search->limit(50);
$N3_Search_Result = $N3_Search->execute();

/* ************************************************************************* */

// Changing offset

global $N3_Search;
$N3_Search->where([
	['id_regimen', 'PR'],
    ['id_unidad_academica', 448],
    ['id_universidad', 32],
]);
$N3_Search->limit(50);
$N3_Search->offset(50);
$N3_Search_Result = $N3_Search->execute();

/* ************************************************************************* */

/* ************************************************************************* */

// Todos las posibles keys para usar en el metodo where() son:
// 'id'
// 'anio'
// 'id_regimen'
// 'regimen'
// 'id_universidad'
// 'universidad'
// 'id_unidad_academica'
// 'unidad_academica'
// 'telefono'
// 'email'
// 'web'
// 'id_titulo'
// 'titulo'
// 'nivel_de_estudio'
// 'id_tipo_de_oferta'
// 'tipo_de_oferta'
// 'tipo_norma'
// 'fecha_norma'
// 'numero_norma'
// 'tipo_ingreso'
// 'duracion'
// 'vigencia'
// 'modalidad'
// 'domicilio'
// 'codigo_postal'
// 'localidad'
// 'id_provincia'
// 'provincia'
// 'id_pais'
// 'pais'
// 'id_rama'
// 'rama'
// 'id_disciplina'
// 'disciplina'
// 'id_area'
// 'area'

/* ************************************************************************* */

?>
