<?php
$app->get('/news',function() use($app,$connect){
	require 'menu.php';
	require 'nome.php';
	$qid = 42 ;
	require 'query_news.php';
	$app->view()->setData('pagetitle','News');
	$app->view()->setData('type','42');
	$app->view()->setData("titleofpage",'News');	
	$app->render("news.html");
});
?>
