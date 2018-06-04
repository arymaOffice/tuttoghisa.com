<?php
$app->post('/invia-commento',function() use ($app,$connect){
	if(isset($_SESSION['id'])){
		$user=$_SESSION['id'];
		$dati_form = $app->request()->post();
		$id=check($dati_form['valore']);
    $type=check($dati_form['type']);
		$commento=check($dati_form['commento']);

		$invia="INSERT INTO ".COMMENTI." (`id`, `anagrafica_id`, `workflow_id`, `parent_id`, `user_id`, `commento`, `data_creazione`)
    VALUES (NULL,0,0,'$id','$user','$commento',NOW())";
		$ins_query=mysqli_query($connect,$invia);

		$app->redirect("/single-news?n=$id&type=$type");

	}else{

		$dati_form = $app->request()->post();
    	$id=check($dati_form['valore']);
    	$type=check($dati_form['type']);

		$_SESSION['commento']="<p style='background-color:#de3030;color:#fff'> Per inviare un commento devi effetuare l'accesso fallo adesso <a style='color:rgb(198, 194, 194)' href='/accedi'><strong> Accedi</strong></a> oppure <a style='color:rgb(198, 194, 194)'href='/registrati'> <strong>Registrati</strong></a></p>";
		$app->redirect("/single-news?n=$id&type=$type");
	}


});
?>
