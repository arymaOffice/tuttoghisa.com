<?php
$app->get('/chi-siamo',function() use($app,$connect){
	require 'menu.php';
	require 'nome.php';
	$sql = "SELECT articolo,upfile FROM ".ARTICOLI." WHERE id = 2";
	$query = mysqli_query($connect,$sql);
	$assoc = mysqli_fetch_assoc($query);
	$app->view()->setData("contentofpage", $assoc);	
	$app->view()->setData("titleofpage",'Chi Siamo');	
	$app->render("chi-siamo.html");
	if (mysqli_error($connect)){
		$app->redirect('/');
	}

});
?>
