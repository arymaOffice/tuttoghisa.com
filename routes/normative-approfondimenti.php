<?php
$app->get('/normative-approfondimenti',function() use($app,$connect){
	require 'menu.php';
	require 'nome.php';
	$qid = 43 ;
	require 'query_news.php';
	$app->view()->setData('pagetitle','Tecnologia e Ambiente');
	$app->view()->setData('type','43');
	$app->view()->setData("titleofpage",'Tecnologia e Ambiente');
	$app->render("normative-approfondimenti.html");
});
?>
