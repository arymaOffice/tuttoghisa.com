<?php
$app->get('/consulenza-online',function() use($app,$connect){
	require 'menu.php';
	require 'nome.php';
	$id = check(@$_GET['id']);
	$app->view()->setData("id_prodotto",$id);	
	$app->view()->setData("titleofpage",'Consulenza');	
	$app->render("consulenza-online.html");
});

$app->post('/consulenza-online',function() use($app){

	$data=$app->request()->post();
	
	$rag_sociale=check($data['rsociale']);
	$nome=check($data['nome']);
	$cognome=check($data['cognome']);
	$email=check($data['email']);
	$telefono=check($data['telefono']);
	$interesse=check($data['interesse']);
	$messaggio=check($data['messaggio']);
	$referenza_prodotto=check($data['referenza_prodotto']);
	$linkProd = '';
	//function smail($destinatario,$soggetto,$messaggio,$from='',$nameFrom='')
	if($referenza_prodotto != ''){
		$linkProd = "<p><b>Prodotto  : <a target='_blank' href='http://www.tuttoghisa.com/single-product?n=$referenza_prodotto' >Visualizza nel sito</a></b></p>";
	}
	$destinatario="ing.loconsole@gmail.com";//ing.loconsole@gmail.com
	$soggetto ="Consulenza online Tuttoghisa";
	$messaggio = "<html><body>
	<p>
	Richiesta di consulenza da $rag_sociale
	</p>
	<p>Da parte del/lla sig. $nome cognome </p>
	<p>Email di contatto $email</p>
	<p>Recapito telefonico $telefono</p>
	<p><b>Interesse : $interesse</b></p>
	$linkProd
	<p>$messaggio</p>
	</body></html>";
	
	$esito = smail($destinatario,$soggetto,$messaggio);
	smail("info@tuttoghisa.com",$soggetto,$messaggio);//info@tuttoghisa.com

	$_SESSION['msg_richiesta'] = ($esito == 1) ? 'Consulenza inviata' : 'La tua richiesta di consulenza verrà inoltrata entro le 24 ore';
	$app->redirect('/');

});
?>
