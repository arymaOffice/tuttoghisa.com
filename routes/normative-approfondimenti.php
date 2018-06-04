<?php
$app->get('/normative-approfondimenti',function() use($app,$connect){
	require 'menu.php';
	require 'nome.php';
	$qid = 43 ;
	require 'query_news.php';
	$app->view()->setData('pagetitle','Normative ed Approfondimenti');
	$app->view()->setData('type','43');
	$app->view()->setData("titleofpage",'Normative ed Approfondimenti');
	$app->render("normative-approfondimenti.html");
});
?>
