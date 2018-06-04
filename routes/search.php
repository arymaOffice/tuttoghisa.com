<?php
$app->get('/search',function() use($app,$connect){
	require 'menu.php';
	require 'nome.php';
	$app->view()->setData("titleofpage",'Ricerca');	
	$app->render("our-projects.html");

});
?>
