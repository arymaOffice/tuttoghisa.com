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
$sql="SELECT p.id as pid,p.produttore,p.label as plabel ,p.codice as cod,p.descrizione,lp.label as llabel,lp.id as lid,i.label as ilabel
      FROM ".PRODOTTI." p JOIN ".LINEE_PRODOTTI." lp ON lp.id=prodotto_id JOIN ".ITEMS." i ON i.id = p.produttore  WHERE p.vetrina=1 $order LIMIT 0,4 ";
$exec=mysqli_query($connect,$sql);
$app->view()->setData('prod_home',$exec);


$sql1="SELECT p.id as pid,p.produttore,p.label as plabel ,p.codice as cod,p.descrizione,lp.label as llabel,lp.id as lid,i.label as ilabel
      FROM ".PRODOTTI." p JOIN ".LINEE_PRODOTTI." lp ON lp.id=prodotto_id JOIN ".ITEMS." i ON i.id = p.produttore  WHERE p.vetrina=1 $order LIMIT 5,4  ";

$exec1=mysqli_query($connect,$sql1);
$app->view()->setData('prod_home1',$exec1);
if (mysqli_error($connect)){
  $app->redirect('/');
}
 ?>
