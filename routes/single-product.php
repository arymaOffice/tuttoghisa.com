<?php
$app->get('/single-product',function() use($app,$connect){
  	require 'menu.php';
 	require 'nome.php';
	require 'single-prod.php';
	$app->render("project-single-style-6.html");
});
?>
