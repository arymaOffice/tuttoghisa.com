<?php
$app->get('/linea',function() use($app,$connect){
	require 'menu.php';
	require 'nome.php';
	require 'query_linea.php';
	$app->render("linea.html");
});
?>
