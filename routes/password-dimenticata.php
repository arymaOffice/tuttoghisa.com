<?php

$app->get('/password-dimenticata',function() use ($app){
	if(isset($_SESSION['nome'])){
		$app->view()->setData("nome", $_SESSION['nome']);

	}
	if(isset($_SESSION['msg_richiesta'])){
		$app->view()->setData("cambio", $_SESSION['msg_richiesta']);
		unset($_SESSION['msg_richiesta']);
	}
	if(isset($_SESSION['msg_nonesiste'])){
		$app->view()->setData("msg_nonesiste", $_SESSION['msg_nonesiste']);
		unset($_SESSION['msg_nonesiste']);
	}
	$app->view()->setData("titleofpage",'Password Dimenticata');
		$app->render("/password-dimenticata.html");

});

$app->post('/password-dimenticata',function() use ($app,$connect,$mail){
	$dati=$app->request()->post();//recupero tutti i dati del form
	$email=check($dati['email']);
	$sql = "SELECT count(id) as num_users FROM fl_utenti WHERE email='$email'";
	$result = mysqli_query($connect,$sql);
	$tot=mysqli_fetch_array($result);
	$num_users=$tot['num_users'];
	if($num_users != 0){
		$sel = "SELECT nome,stringa_attivazione  FROM fl_utenti WHERE email='$email'";
		$query= mysqli_query($connect,$sel);
		$risultato=mysqli_fetch_array($query);
		$nome=$risultato['nome'];
		$stringa=$risultato['stringa_attivazione'];
		$Subject = 'Richiesta nuova password Tuttoghisa';
		$Body    = "<html><body><br><br>Ciao ".$nome.",<br><br> ti inviamo questa mail dal Team di Tuttoghisa in seguito alla tua richiesta di <br>reimpostazione della password.<br><br>
		 Per cambiare la password del tuo account clicca sul link qui sotto : <br> <a href=\"http://www.tuttoghisa.it/new-pass?s=".$stringa."\">http://www.tuttoghisa.it/new-pass?s=".$stringa."</a><br> Ciao e grazie per la tua collaborazione.<br>Il team di Tuttoghisa.<br><br>NB: Se non sei stato tu a richiedere il cambio della password segnalacelo all'indirizzo: info@tuttoghisa.it .</html></body> ";
		$esito=smail($email,$Subject,$Body);
		if($esito == 1){$_SESSION['msg_richiesta'] = " Controlla la tua casella di posta elettronica, riceverai una mail per resettare la password.";}
		else{$_SESSION['msg_richiesta'] = " La tua mail arriverà nelle prossime 24 ore, se non sarà così riprova.";}

			$app->redirect("/password-dimenticata");
		}else{
			$_SESSION['msg_nonesiste'] = " Impossibile cambiare la password ! La tua mail non è registrata!";
			$app->redirect("/password-dimenticata");
		}
	});
?>
