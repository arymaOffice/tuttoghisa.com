<?php
$app->get('/strumenti',function() use($app,$connect){

		require 'nome.php';
		require 'menu.php';
		$app->view()->setData('pagetitle','Strumenti');
		$app->view()->setData('strumenti','Strumenti');
		$app->view()->setData("titleofpage",'Strumenti');
		$app->render("strumenti.html");

});
?>
