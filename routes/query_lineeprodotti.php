<?php
check($_GET['cat']);
$id=base64_decode($_GET['cat']);
$where="WHERE cp.id=$id or cp.parent_id=$id";
$sql="SELECT lp.label as lplabel,lp.id as lid,cp.label as clabel,cp.id as cid,lp.codice as codice FROM ".CAT_PRODOTTI." cp JOIN ".LINEE_PRODOTTI." lp ON lp.categoria_prodotto=cp.id   WHERE  lp.categoria_prodotto in (SELECT id FROM ".CAT_PRODOTTI." $where)";
$query=mysqli_query($connect,$sql);
$app->view()->setData('prodotti',$query);
$sql_cat="SELECT cp.label as clabel ,cp.id as cid FROM ".CAT_PRODOTTI." cp WHERE cp.id=$id or cp.parent_id=$id ORDER BY cp.parent_id ASC ";
$query_cat=mysqli_query($connect,$sql_cat);
$app->view()->setData('categorie',$query_cat);
if (mysqli_error($connect)){
  $app->redirect('/');
}
$assoc=mysqli_fetch_assoc($query_cat);
$app->view()->setData("titleofpage",$assoc['clabel']);
$app->view()->setData('prima',$assoc);

 ?>
