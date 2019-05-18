<?php

class N3_Search_Search_Utils
{
    /**
     * @return array Map with id and descriptions order by description
     *      [
     *          'Posgrado' => 'Posgrado',
     *          'Grado' => 'Grado',
     *          ...
     *      ]
     */
    public function getNivelDeEstudio()
    {
        global $wpdb;
        $r = $wpdb->get_results( 'SELECT DISTINCT nivel_de_estudio FROM cursos ORDER BY nivel_de_estudio', ARRAY_A );
        if ($r === false || $wpdb->last_error !== '') {
            throw new \Exception();
        }
        $output = [];
        foreach ($r as $r_item) {
            $output[$r_item['nivel_de_estudio']] = $r_item['nivel_de_estudio'];
        }
        return $output;
    }

    /**
     * @return array Map with id and descriptions order by description
     *      [
     *          'GEOG' => 'Geografía',
     *          'TECN' => 'Tecnología',
     *          ...
     *      ]
     */
    public function getAreas()
    {
        global $wpdb;
        $r = $wpdb->get_results( 'SELECT DISTINCT id_area, area FROM cursos ORDER BY area', ARRAY_A );
        if ($r === false || $wpdb->last_error !== '') {
            throw new \Exception();
        }
        $output = [];
        foreach ($r as $r_item) {
            $output[$r_item['id_area']] = $r_item['area'];
        }
        return $output;
    }

    /**
     * @return array Map with id and descriptions order by description
     *      [
     *          'EDUC' => 'Educación',
     *          'INGE' => 'Ingeniería',
     *          ...
     *      ]
     */
    public function getDisciplina()
    {
        global $wpdb;
        $r = $wpdb->get_results( 'SELECT DISTINCT id_disciplina, disciplina FROM cursos ORDER BY disciplina', ARRAY_A );
        if ($r === false || $wpdb->last_error !== '') {
            throw new \Exception();
        }
        $output = [];
        foreach ($r as $r_item) {
            $output[$r_item['id_disciplina']] = $r_item['disciplina'];
        }
        return $output;
    }

    /**
     * @return array Map with id and descriptions order by description
     *      [
     *          'Presencial' => 'Presencial',
     *          'A Distancia' => 'A Distancia',
     *          ...
     *      ]
     */
    public function getModalidad()
    {
        global $wpdb;
        $r = $wpdb->get_results( 'SELECT DISTINCT modalidad FROM cursos ORDER BY modalidad', ARRAY_A );
        if ($r === false || $wpdb->last_error !== '') {
            throw new \Exception();
        }
        $output = [];
        foreach ($r as $r_item) {
            $output[$r_item['modalidad']] = $r_item['modalidad'];
        }
        return $output;
    }

    /**
     * @return array Map with id and descriptions order by description
     *      [
     *          32 => 'Pontificia....',
     *          33 => 'Universidad de Buenos Aires',
     *          ...
     *      ]
     */
    public function getInstituciones()
    {
        global $wpdb;
        $r = $wpdb->get_results( 'SELECT DISTINCT id_universidad, universidad FROM cursos ORDER BY universidad', ARRAY_A );
        if ($r === false || $wpdb->last_error !== '') {
            throw new \Exception();
        }
        $output = [];
        foreach ($r as $r_item) {
            $output[$r_item['id_universidad']] = $r_item['universidad'];
        }
        return $output;
    }

    /**
     * @param array of id_universidad
     * @return array Map with id and descriptions order by description
     *      [
     *          '253' => 'Rectorado',
     *          '869' => 'Facultad de Ingenieria...',
     *      ]
     */
    public function getUnidadAcademica($universidades = [])
    {
        $where = "";
        if (!empty($universidades)) {
            $where = "WHERE id_universidad IN (";
            $first = true;
            foreach ($universidades as $u) {
                if (!$first) {
                    $where .= ",";
                }
                $first = false;
                $where .= $u;
            }
            $where .= ")";
        }
        global $wpdb;
        $r = $wpdb->get_results( "SELECT DISTINCT id_unidad_academica, unidad_academica FROM cursos " . $where . " ORDER BY unidad_academica", ARRAY_A );
        if ($r === false || $wpdb->last_error !== '') {
            throw new \Exception();
        }
        $output = [];
        foreach ($r as $r_item) {
            $output[$r_item['id_unidad_academica']] = $r_item['unidad_academica'];
        }
        return $output;
    }

    /**
     * @return array Map with id and descriptions order by description
     *      [
     *          'L' => 'La Pampa',
     *          'U' => 'Chubut',
     *      ]
     */
    public function getProvincia()
    {
        global $wpdb;
        $r = $wpdb->get_results( 'SELECT DISTINCT id_provincia, provincia FROM cursos ORDER BY provincia', ARRAY_A );
        if ($r === false || $wpdb->last_error !== '') {
            throw new \Exception();
        }
        $output = [];
        foreach ($r as $r_item) {
            $output[$r_item['id_provincia']] = $r_item['provincia'];
        }
        return $output;
    }

    /**
     * @param array of id_provincia
     * @return array Map with id and descriptions order by description
     *      [
     *          'La Plata' => 'La Plata',
     *          'Ensenada' => 'Ensenada',
     *      ]
     */
    public function getLocalidad($provincias = [])
    {
        $where = "";
        if (!empty($provincias)) {
            $where = "WHERE id_provincia IN (";
            $first = true;
            foreach ($provincias as $p) {
                if (!$first) {
                    $where .= ",";
                }
                $first = false;
                $where .= "'" . $p . "'";
            }
            $where .= ")";
        }
        global $wpdb;
        $r = $wpdb->get_results( "SELECT DISTINCT localidad FROM cursos " . $where . " ORDER BY localidad", ARRAY_A );
        if ($r === false || $wpdb->last_error !== '') {
            throw new \Exception();
        }
        $output = [];
        foreach ($r as $r_item) {
            $output[$r_item['localidad']] = $r_item['localidad'];
        }
        return $output;
    }
}

?>
