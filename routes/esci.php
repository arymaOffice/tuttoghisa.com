<?php 

$app->get('/esci',function() use ($app,$connect){
	session_destroy();
	$app->redirect("/");
	
});

?>