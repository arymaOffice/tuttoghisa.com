<?php
$app->get('/registrati',function() use($app,$connect){
	require 'menu.php';
	require 'nome.php';
	$app->view()->setData("titleofpage",'Registrati');
	$app->render("registrati.html");
});
$app->post('/registrati',function() use($app,$connect){
	$dati=$app->request()->post();
	$nome=check($dati['nome']);
	$cognome=check($dati['cognome']);
	$telefono=check($dati['telefono']);
	$professione=check($dati['professione']);
	$localita=check($dati['localita']);
	$email=check($dati['email']);
	$psw=check($dati['password']);
	$sql = "SELECT count(id) as num_users FROM fl_utenti WHERE email= '".$email."'";
	$result = mysqli_query($connect,$sql);
	$tot=mysqli_fetch_array($result);
	$num_users=$tot['num_users'];
	if($num_users != 0){
		$_SESSION['msg_presente'] = '<div style="color: #fff;background-color: #de9527;">
		
		 La tua email risulta gia\' registrata, accedi con le tue info! <a href="/accedi" class="close" data-dismiss="alert" aria-label="close"> &times;</a> 
		</div>';
		$app->redirect("/accedi");
	}else{
		$crypt=md5($psw);
		$stringa_attivazione=base64_encode($nome.$email);
		$ins= "INSERT INTO `fl_utenti`(`id`, `uid`, `nome`, `cognome`, `telefono`, `professione`, `localita`, `email`, `password`, `stringa_attivazione`, `attivo`) VALUES
		(NULL,'0','$nome','$cognome','$telefono','$professione','$localita','$email','$crypt','$stringa_attivazione','0')";
		$inserimento=mysqli_query($connect,$ins);
		mysqli_close($connect);

		$Subject = 'Richiesta attivazione account Tuttoghisa';
		$Body    = "<html><body><br><br>Ciao ".$nome.",<br><br> ti inviamo questa mail dal Team di Tuttoghisa per attivare il tuo account clicca sul link qui sotto : <br> <a href=\"http://www.tuttoghisa.it/new-account?s=".$stringa_attivazione."\">http://www.tuttoghisa.it/new-account?s=".$stringa_attivazione." </a><br><br> Ciao e grazie per la tua collaborazione.<br>Il team di Tuttoghisa.<br><br>NB: Se non sei stato tu a richiedere il cambio della password segnalacelo all'indirizzo: info@tuttoghisa.it .</html></body> ";
		$esito=smail($email,$Subject,$Body);
		if( $esito== 1){$_SESSION['msg_richiesta'] = " Controlla la tua casella di posta elettronica, riceverai una mail per Attivare l'account.";}
		else{$_SESSION['msg_richiesta'] = " Se non ricevi una mail entro le 24 ore ,riprova a registrarti.";}
		
		$app->redirect("/");
	}
});
?>
