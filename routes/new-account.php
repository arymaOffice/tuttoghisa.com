<?php
$app->get('/new-account',function() use ($app,$connect){
	if(isset($_GET['s'])){
		$app->view()->setData("titleofpage",'New Account');	
		$stringa=check($_GET['s']);
		$sql="SELECT count(id) as num_user,id FROM fl_utenti WHERE stringa_attivazione='$stringa' ";
		$query=mysqli_query($connect,$sql);
		$result=mysqli_fetch_array($query);
		$id=$result['id'];
		if ($result['num_user'] == 1 ){
			$sql="UPDATE fl_utenti SET attivo=1 WHERE id=$id";
			$result=$connect->query($sql);
			unset($_SESSION['email']);
			$_SESSION['msg_acc']="Il tuo account è attivo procedi con il Login !";
			$app->redirect("/accedi");
		}else{
			$_SESSION['msg_acc']="Il tuo account è già attivo procedi con il Login !";
			$app->redirect("/accedi");
		}

		
	}
});
?>