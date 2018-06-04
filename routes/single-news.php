<?php
$app->get('/single-news',function() use($app,$connect){

	require 'menu.php';
	require 'nome.php';
	$n=check($_GET['n']);
	$type=check($_GET['type']);

	if(isset($_SESSION['commento'])){
		$app->view()->setData('erroreCommento',$_SESSION['commento']);
		unset($_SESSION['commento']);
	}

	if ($type == '42') {
		$app->view()->setData('pagetitle','News');
		$app->view()->setData('route','news');
		$app->view()->setData('type','42');

	}
	if ($type == '43') {
		$app->view()->setData('pagetitle','Normative ed Approfondimenti');
		$app->view()->setData('route','normative-approfondimenti');
		$app->view()->setData('type','43');
	}

	if ($type == '44') {
		$app->view()->setData('pagetitle','Strumenti');
		$app->view()->setData('route','strumenti');
		$app->view()->setData('type','44');
		$app->view()->setData('strumenti','strumenti');
	}

	if ($type == '72') {
		$app->view()->setData('pagetitle','Appalti');
		$app->view()->setData('route','appalti');
		$app->view()->setData('type','72');

	}

	/*-----------------------seleziono dati della news -----------------------------------------------*/
	$sql="SELECT a.id as id,`data_pubblicazione`, `titolo`, `articolo`, `tags`, `upfile`, `video`, `sorgente_esterna` FROM ".ARTICOLI." a
	WHERE a.status_contenuto>=1 and a.categoria_id='$type' and a.id=$n";
	$exec=mysqli_query($connect,$sql);
	if (mysqli_error($connect)){
		$app->redirect('/');
	}
	$assoc=mysqli_fetch_array($exec);
	/*-----------------------seleziono allegati della news -----------------------------------------------*/
	$sqlAllegati="SELECT file as nameFile FROM ".DMS." WHERE  workflow_id = 108 AND record_id = $n ";
	$esegui=mysqli_query($connect,$sqlAllegati);
	if (mysqli_error($connect)){
		$app->redirect('/');
	}
	/*-----------------------seleziono commenti della news -----------------------------------------------*/
	$sqlCommenti="SELECT u.nome as nome,commento,DATE(data_creazione) as data FROM ".COMMENTI." JOIN ".UTENTI." u ON user_id = u.id WHERE  parent_id = $n ";
	$sqlCommenti=mysqli_query($connect,$sqlCommenti);
	if (mysqli_error($connect)){
		$app->redirect('/');
	}
	/*-----------------------conto commenti della news -----------------------------------------------*/
	$countCommenti="SELECT count(*) as count FROM ".COMMENTI." WHERE  parent_id = $n ";
	$countCommenti=mysqli_query($connect,$countCommenti);
	if (mysqli_error($connect)){
		$app->redirect('/');
	}
	$ConteggioCommenti=mysqli_fetch_array($countCommenti);

	$titleofpage = $assoc['titolo'];
	$app->view()->setData('snews',$assoc);
	$app->view()->setData('files',$esegui);
	$app->view()->setData('commenti',$sqlCommenti);
	$app->view()->setData('ConteggioCommenti',$ConteggioCommenti);
	$app->view()->setData("titleofpage",$titleofpage);
	$app->render("news-single.html");

});
?>
