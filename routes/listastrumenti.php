<?php
$app->get('/listastrumenti',function() use($app,$connect){

	if(isset($_SESSION['nome'])){
		$app->view()->setData('nome',$_SESSION['nome']);
		require 'menu.php';
		$qid =check($_GET['nn']);
		require 'query_strumenti.php';
		$app->view()->setData('pagetitle','Voci di capitolato');
		$app->view()->setData("titleofpage",'Lista Strumenti');	
		$app->render("listastrumenti.html");
		}else{

			if ($_SERVER['REDIRECT_URL'] == '/listastrumenti' )
			{
			$app->redirect("/accedi");
			}
	}

});
?>
