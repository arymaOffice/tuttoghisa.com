<?php
$app->get('/lineeprodotti',function() use($app,$connect){
  	require 'menu.php';
  	require 'nome.php';
	require 'query_lineeprodotti.php';
	$app->render("lineeprodotti.html");
});
?>
