<?php
$app->get('/disegni-relazioni',function() use($app,$connect){

	require 'nome.php';
	require 'menu.php';
	$qid=check($_GET['n']);
	require 'query_strumenti.php';
	$app->view()->setData('pagetitle','Disegni & Relazioni');
	$app->view()->setData("titleofpage",'Disegni & Relazioni');
	$app->render("disegni&relazioni.html");

});
?>