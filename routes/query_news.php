<?php
$start = (isset($_GET['start'])) ? check($_GET['start']) : 0;
$step = 6;

$sql="SELECT a.id,`data_pubblicazione`, `titolo`, `articolo`, `tags`, `upfile`, `video`, `sorgente_esterna`, (SELECT count(*) FROM ".COMMENTI." WHERE parent_id = a.id) as 'countCommenti' FROM ".ARTICOLI." a
WHERE a.status_contenuto>=1 and a.categoria_id='$qid' ORDER BY data_pubblicazione DESC LIMIT $start,$step ";
$exec=mysqli_query($connect,$sql);
$app->view()->setData('news',$exec);
$paginazione = pagination($connect,ARTICOLI.' a',"WHERE a.status_contenuto>=1 and a.categoria_id=$qid",'data_pubblicazione DESC','6');
$app->view()->setData('pagine',$paginazione['pagine']);

if (mysqli_error($connect)){
  $app->redirect('/');
}
 ?>
