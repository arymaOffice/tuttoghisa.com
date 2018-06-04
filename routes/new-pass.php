<?php
$app->get('/new-pass',function() use ($app){
	if(isset($_GET['s'])){
		check($_GET['s']);
		$_SESSION['s']=$_GET['s'];

	}
	$app->view()->setData("titleofpage",'New Password');	
	$app->render("new-pass.html");

});

$app->post('/new-pass',function() use ($app,$connect){
	if (isset($_SESSION['s']) && $_SESSION['s']!=''){
		$stringa=$_SESSION['s'];
		$dati=$app->request()->post();//recupero tutti i dati del form
		$psw=check($dati['password']);
		$psw1=check($dati['conferma-password']);
		if ($psw == $psw1) {
			$crypt=md5($psw);
			$update= "UPDATE fl_utenti u SET u.password='$crypt' WHERE stringa_attivazione='$stringa' ";
			$inserimento=mysqli_query($connect,$update);
			$_SESSION['msg_cambio'] = " Cambio password avvenuto con successo! Ora Accedi! ";
			$app->redirect("/accedi");

		}else{
			$app->redirect("/");
		}
	}else{
		$app->redirect("/");
	}

});

?>
