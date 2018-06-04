<?php

$app->get('/calcoli',function() use($app,$connect){
	require 'menu.php';
	require 'nome.php';

	$app->render('calcoli.html');

});


?>
