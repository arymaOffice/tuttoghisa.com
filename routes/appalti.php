<?php
$app->get('/appalti',function() use($app,$connect){
	require 'menu.php';
	require 'nome.php';
	$qid = 72 ;
	require 'query_news.php';
	$app->view()->setData('pagetitle','Appalti');
	$app->view()->setData("titleofpage",'Appalti');	
	$app->view()->setData('type','72');
	$app->render("appalti.html");
});
?>
