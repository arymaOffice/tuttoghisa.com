<?php
$app->get('/accedi',function() use($app,$connect){
	require 'menu.php';
	require 'nome.php';
	if(isset($_SESSION['msg_succ'])){
		$app->view()->setData("msg_succ", $_SESSION['msg_succ']);
		unset($_SESSION['msg_succ']);
	}
	if(isset($_SESSION['msg_acc'])){
		$app->view()->setData("msg_acc", $_SESSION['msg_acc']);
		unset($_SESSION['msg_acc']);
	}

	if(isset($_SESSION['msg_presente'])){
		$app->view()->setData("msg_presente", $_SESSION['msg_presente']);
		unset($_SESSION['msg_presente']);
	}
	if(isset($_SESSION['msg_sbagliato'])){
		$app->view()->setData("msg_sbagliato", $_SESSION['msg_sbagliato']);
		unset($_SESSION['msg_sbagliato']);
	}
	if(isset($_SESSION['msg_cambio'])){
		$app->view()->setData("cambio", $_SESSION['msg_cambio']);
		unset($_SESSION['msg_cambio']);
	}

	$app->view()->setData("titleofpage",'Accedi');
	$app->render("accedi.html");
});
$app->post('/accedi',function() use($app,$connect){
	$dati=$app->request()->post();
	$email=check($dati['email']);
	$psw=check($dati['password']);
	$crypt=md5($psw);
	$sel = "SELECT * FROM fl_utenti WHERE email='$email' and password='$crypt' "; //and attivo=1
	$query=mysqli_query($connect,$sel);
	$user=mysqli_fetch_array($query);

	if(empty($user)){
		$_SESSION['msg_sbagliato'] = "C' e' stato un problema nel login, riprova!";
		$app->redirect("/accedi");
	}else{
		$_SESSION['nome']=$user['nome'];
		$_SESSION['id']=$user['id'];
		$app->redirect("/");
	}

	if (mysqli_error($connect)){
		$app->redirect('/');
	}
});
?>
