<?php
$app->get('/',function() use($app,$connect){
	if (isset($_SESSION['msg_richiesta'])){

		$app->view()->setData("msg_richiesta", $_SESSION['msg_richiesta']);
		unset($_SESSION['msg_richiesta']);

	}
	require 'menu.php';
	require 'nome.php';
	$qid= 42 ;
	require 'query_news.php';
	require 'single-prod-home.php';
	$app->view()->setData("titleofpage",'Home');	
	$app->render("index.html");

});
?>
