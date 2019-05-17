<?php
/**
* Plugin Name: N3ctar - Buscador
* Description: Incluye lógica para buscador Posgrado y GradoPregrado
* Version: 1.0
* Author: n3ctar
* Author URI: https://n3ctar.net/
**/


// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

require_once dirname( __FILE__ ) . '/class-n3-search-column-type.php';
require_once dirname( __FILE__ ) . '/class-n3-search-search-utils.php';
require_once dirname( __FILE__ ) . '/class-n3-search-search.php';

$N3_Search = new N3_Search_Search();
global $N3_Search;

$N3_Search_Utils = new N3_Search_Search_Utils();
global $N3_Search_Utils;

?>
