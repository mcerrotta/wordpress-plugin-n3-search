<?php

class N3_Search_Search
{
    private $columns_types = [];
    private $select = [];
    private $where = [];
    private $limit = 20;
    private $offset = 0;

    function __construct()
    {
        $this->columns_types = [
            'id' => N3_Search_Column_Type::TypeInt,
            'anio' => N3_Search_Column_Type::TypeInt,
            'id_regimen' => N3_Search_Column_Type::TypeVarchar,
            'regimen' => N3_Search_Column_Type::TypeVarchar,
            'id_universidad' => N3_Search_Column_Type::TypeInt,
            'universidad' => N3_Search_Column_Type::TypeVarchar,
            'id_unidad_academica' => N3_Search_Column_Type::TypeInt,
            'unidad_academica' => N3_Search_Column_Type::TypeVarchar,
            'telefono' => N3_Search_Column_Type::TypeVarchar,
            'email' => N3_Search_Column_Type::TypeVarchar,
            'web' => N3_Search_Column_Type::TypeVarchar,
            'id_titulo' => N3_Search_Column_Type::TypeInt,
            'titulo' => N3_Search_Column_Type::TypeVarchar,
            'nivel_de_estudio' => N3_Search_Column_Type::TypeVarchar,
            'id_tipo_de_oferta' => N3_Search_Column_Type::TypeVarchar,
            'tipo_de_oferta' => N3_Search_Column_Type::TypeVarchar,
            'tipo_norma' => N3_Search_Column_Type::TypeVarchar,
            'fecha_norma' => N3_Search_Column_Type::TypeDate,
            'numero_norma' => N3_Search_Column_Type::TypeInt,
            'tipo_ingreso' => N3_Search_Column_Type::TypeVarchar,
            'duracion' => N3_Search_Column_Type::TypeVarchar,
            'vigencia' => N3_Search_Column_Type::TypeVarchar,
            'modalidad' => N3_Search_Column_Type::TypeVarchar,
            'domicilio' => N3_Search_Column_Type::TypeVarchar,
            'codigo_postal' => N3_Search_Column_Type::TypeVarchar,
            'localidad' => N3_Search_Column_Type::TypeVarchar,
            'id_provincia' => N3_Search_Column_Type::TypeVarchar,
            'provincia' => N3_Search_Column_Type::TypeVarchar,
            'id_pais' => N3_Search_Column_Type::TypeVarchar,
            'pais' => N3_Search_Column_Type::TypeVarchar,
            'id_rama' => N3_Search_Column_Type::TypeVarchar,
            'rama' => N3_Search_Column_Type::TypeVarchar,
            'id_disciplina' => N3_Search_Column_Type::TypeVarchar,
            'disciplina' => N3_Search_Column_Type::TypeVarchar,
            'id_area' => N3_Search_Column_Type::TypeVarchar,
            'area' => N3_Search_Column_Type::TypeVarchar,
        ];
    }

    /**
     * @param array $filters array of filters. Could be in several formats:
     *  Format:          ['name_of_column', 456]
     *  Where condition: name_of_column = 456
     *
     *  Format:          ['name_of_column', [123, 456]]
     *  Where condition: name_of_column IN [123, 456]
     *
     *  Format:          ['name_of_column', 'string_value']
     *  Where condition: name_of_column LIKE '%string_value%'
     *
     *  Format:          ['name_of_column', ['string_value1', 'string_value2']]
     *  Where condition: name_of_column LIKE '%string_value1%' OR name_of_column LIKE '%string_value2%'
     *
     *  Format:          ['OR', 'name_of_column', 'string_value']
     *  Where condition: .. OR name_of_column LIKE '%string_value%' ..
     *
     */
    function where($filters)
    {
        $this->where = [];

        foreach ($filters as $filter) {
            if (count($filter) == 2) {
                $this->addWhere($filter[0], $filter[1]);
            }
            if (count($filter) == 3) {
                $this->addWhere($filter[1], $filter[2], $filters[0]);
            }
        }
    }

    /**
     * @param string column
     * @param mixed value
     * @param string conector
     */
    function addWhere($column, $value, $conector = 'AND')
    {
        if (!array_key_exists($column, $this->columns_types)) {
            // TODO: do nothing if column doesn't exists
            return;
        }
        $this->where[] = [$conector, $column, $value];
    }

    /**
     * @param array $columns Array of column names.
     */
    function select($columns)
    {
        $this->select = $columns;
    }

    /**
     * @param int $limit.
     */
    function limit($limit)
    {
        // TODO assert > 0
        $this->limit = $limit;
    }

    /**
     * @param int $columns Array of column names.
     */
    function offset($offset)
    {
        // TODO assert > 0
        $this->offset = $offset;
    }

    /**
     * @return array array of Maps
     */
    function execute()
    {
        $query = $this->parseSelect() . $this->parseFrom() . $this->parseWhere() . $this->parseOrderBy() . $this->parseOffset() .  $this->parseLimit();

        global $wpdb;
        $r = $wpdb->get_results( $query, ARRAY_A );
        if ($r === false || $wpdb->last_error !== '') {
            throw new \Exception();
        }
        return $r;
    }

    private function parseSelect()
    {
        if (empty($this->select)) {
            return "SELECT * ";
        }

        $r = "SELECT ";
        $first = true;
        foreach ($this->select as $column) {
            if (!$first) {
                $r .= ", ";
            }
            $r .= $column;
        }
        return $r;
    }

    private function parseFrom()
    {
        return " FROM cursos ";
    }

    private function parseWhere()
    {

        $r = "WHERE 1 = 1 ";
        foreach ($this->where as $w) {
            if (count($w) != 3) {
                // TODO: do nothing if where's condition has wrong format
                continue;
            }

            $conector = $w[0];
            $column_name = $w[1];
            $value = $w[2];
            $column_type = $this->columns_types[$column_name];

            if ($column_type == N3_Search_Column_Type::TypeInt) {
                if (is_array($value)) {
                    $r .= " " . $conector . " " . $column_name . " IN (";
                    $first = true;
                    foreach ($value as $v) {
                        if (!$first) {
                            $r .= ",";
                        }
                        $first = false;
                        $r .= $v;
                    }
                    $r .= ")";
                } else {
                    $r .= " " . $conector . " " . $column_name . " = " . $value;
                }
            }

            if ($column_type == N3_Search_Column_Type::TypeVarchar) {
                if (is_array($value)) {
                    $r .= " " . $conector . " (";
                    $first = true;
                    foreach ($value as $v) {
                        if (!$first) {
                            $r .= " OR ";
                        }
                        $first = false;
                        $r .= $column_name . " = '" . $v . "'";
                    }
                    $r .= ")";
                } else {
                    $r .= " " . $conector . " " . $column_name . " = '" . $value . "'";
                }

            }
        }
        return $r;
    }

    private function parseOrderBy()
    {
        return " ORDER BY id ";
    }

    private function parseLimit()
    {
        if ($this->offset === false || $this->limit === false) {
            return '';
        }
        return " FETCH NEXT " . $this->limit . " ROWS ONLY ";
    }

    private function parseOffset()
    {
        if ($this->offset === false || $this->limit === false) {
            return '';
        }
        return " OFFSET " . $this->offset . " ROWS ";
    }
}

?>
