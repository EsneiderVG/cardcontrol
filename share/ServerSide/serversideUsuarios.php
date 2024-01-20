<?php
require 'serverside.php';

session_start();
session_regenerate_id(true);



$tabla_registros = 'colegios';

$table_data->get(''.$tabla_registros.'','id',array('id', 'nombre_colegio'));

?>