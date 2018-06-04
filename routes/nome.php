<?php
if(isset($_SESSION['nome'])){
	$app->view()->setData('nome',$_SESSION['nome']);
}
 ?>
