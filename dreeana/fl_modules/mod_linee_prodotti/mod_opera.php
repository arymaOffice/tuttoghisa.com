<?php 

require_once('../../fl_core/autentication.php');
include('fl_settings.php'); // Variabili Modulo 


	if(isset($_GET['id1'])) {

		
		$type1 = check($_GET['type1']);
		$type2 = check($_GET['type2']);
		$id1 = check($_GET['id1']);			//equivale a connetti
		$id2 = check($_GET['id2']);
		$remove = check($_GET['remove']);
		$valore = (isset($_GET['valore'])) ? check($_GET['valore']) : 1;
		
		$query = "SELECT * FROM fl_synapsy WHERE type1 = '" . $type1 . "' AND type2 = '" . $type2 . "' AND id1 = '" . $id1 . "' AND id2 = '" . $id2 . "'"; //query per verificare la presenza della portata nel menu
		$risultato = mysql_query($query,CONNECT);
		
		$query = "";
		if($remove == 1){			
			$query = "DELETE FROM fl_synapsy WHERE type1 = '" . $type1 . "' AND type2 = '" . $type2 . "' AND id1 = '" . $id1 . "' AND id2 = '" . $id2 . "'";
		}else{											
			$query = "INSERT INTO `fl_synapsy` (`type1`, `id1`, `type2`, `id2`, `valore`) VALUES ('$type1', '$id1', '$type2', '$id2', '$valore')";
			
		}

		mysql_query($query,CONNECT);
		mysql_close(CONNECT);
		
		//header('Location: '.$_SESSION['POST_BACK_PAGE']);//da errore
		exit;
	}



if(isset($_POST['id'])){

$source = $_FILES['file'];
$id = check($_POST['id']);

/* Check Estensione */
$info = pathinfo($source['name']); 
foreach($info as $key => $valore){ if($key == "extension") $ext = $info["extension"]; }
if(!isset($ext)) error();
if(in_array(strtolower($ext),$formati)){ error(); } 
$file_name = $id.'.'.$ext;


/*Check Dir*/
if(!@is_dir($folder)) {  if(!@mkdir($folder,0777)) { return $esiti[7]; mysql_close(CONNECT);  break; } }
if(!is_writable($folder)) {  return $esiti[9]; mysql_close(CONNECT); break; }


if(is_uploaded_file($source['tmp_name'])){
	if(move_uploaded_file($source['tmp_name'],$folder.'/'.$file_name)){

		mysql_close(CONNECT);
		header( "HTTP/1.1 200 OK" ); 
		exit;
	
	} else {
	error();
	}
	
}}


mysql_close(CONNECT);
header("Location: ".check($_SERVER['HTTP_REFERER'])); 
exit;

?>
