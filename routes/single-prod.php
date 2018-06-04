<?php
$where='';
if (isset($_GET['n'])){
  check($_GET['n']);
  $id=$_GET['n'];
  $where='WHERE p.id='.$id.'';
  $order='';
}else{
  $where='';
  $order="ORDER BY p.data_creazione,lp.label ASC";
}
$sql="SELECT p.id as pid,p.produttore,p.label as plabel ,p.codice as cod,p.descrizione,lp.label as llabel,lp.id as lid
      FROM ".PRODOTTI." p JOIN ".LINEE_PRODOTTI." lp ON lp.id=prodotto_id  $where $order ";
$exec=mysqli_query($connect,$sql);
if (mysqli_error($connect)){
  $app->redirect('/');
}
$app->view()->setData('prod_home',$exec);
$assoc=mysqli_fetch_array($exec);
$app->view()->setData('sprod',$assoc);
$app->view()->setData("titleofpage",$assoc['plabel']);
include_once('creazione-produttori.php');

 ?>
