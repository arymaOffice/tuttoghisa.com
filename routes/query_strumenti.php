<?php
$start = (isset($_GET['start'])) ? check($_GET['start']) : 0;
$step = 8;


$sql="SELECT a.id,`data_pubblicazione`, `titolo`, `articolo`, `tags`, `upfile`, `video`, `sorgente_esterna` FROM ".ARTICOLI." a
WHERE a.status_contenuto>=1 and a.categoria_id=$qid LIMIT $start,$step";
$exec=mysqli_query($connect,$sql);
$app->view()->setData('news',$exec);

$paginazione = pagination($connect,ARTICOLI.' a',"WHERE a.status_contenuto>=1 and a.categoria_id=$qid",'data_pubblicazione ASC','8');


$app->view()->setData('pagine',$paginazione['pagine']); 

if (mysqli_error($connect)){
  $app->redirect('/');
}
 ?>
