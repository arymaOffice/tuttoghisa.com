<?php
$app->get('/note-legali',function() use($app,$connect){
	require 'menu.php';
	require 'nome.php';
	$sql = "SELECT articolo,upfile FROM ".ARTICOLI." WHERE id = 183";
	$query = mysqli_query($connect,$sql);
	$assoc = mysqli_fetch_assoc($query);
	$app->view()->setData("contentofpage", $assoc);	
	$app->view()->setData("titleofpage",'Note Legali');	
	$app->render("pagina-intera.html");
	if (mysqli_error($connect)){
		$app->redirect('/');
	}

});
?>
