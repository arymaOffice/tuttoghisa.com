<?php
$app->get('/download',function() use($app,$connect){

	if(isset($_GET['n'])){
		$pdf=check($_GET['n']);
		$sql = "SELECT file FROM fl_dms WHERE workflow_id = 108 AND record_id=$pdf ";
		$query=mysqli_query($connect,$sql);
		$riga =mysqli_fetch_assoc($query);
		$file = $riga['file'];
		download_pdf($file);
	}
	if (isset($_GET['name'])) {
		if(isset($_SESSION['nome'])){
			$app->view()->setData('nome',$_SESSION['nome']);
			$excel=check($_GET['name']);
			download_excel($excel);
		}else {
			$app->redirect('/accedi');
		}
	}
	if (isset($_GET['nn'])) {
		if(isset($_SESSION['nome'])){
			$app->view()->setData('nome',$_SESSION['nome']);
			$generic=check($_GET['nn']);
			$sql = "SELECT file FROM fl_dms WHERE workflow_id = 108 AND record_id=$generic ";
			$query=mysqli_query($connect,$sql);
			$riga =mysqli_fetch_assoc($query);
			$file = $riga['file'];
			download_generic($file);
		}else {
			$app->redirect('/accedi');
		}
	}
	
	
});
?>
