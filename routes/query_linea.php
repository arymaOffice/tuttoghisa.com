<?php
if(isset($_GET['l'])){

  $linea_id=check($_GET['l']);
  
  $sql="SELECT p.id as pid,p.label as plabel, p.codice as codice,lp.descrizione as descrizione,lp.id as lid,i.label as ilabel FROM ".PRODOTTI." p JOIN ".LINEE_PRODOTTI." lp on lp.id=prodotto_id JOIN ".ITEMS." i ON  i.id=p.produttore WHERE lp.id=$linea_id ";
  $query=mysqli_query($connect,$sql);
  $app->view()->setData('lineaprodotti',$query);
  $sql_cat="SELECT cp.label as clabel,c.parent_id FROM ".LINEE_PRODOTTI." cp JOIN ".CAT_PRODOTTI." as c ON c.id=cp.categoria_prodotto WHERE cp.id=$linea_id ";
  $query_cat=mysqli_query($connect,$sql_cat);
  //se c'è un solo elemento nell a linea
  if($query->num_rows == 1){
    $assoc = mysqli_fetch_assoc($query);
    $app->redirect('single-product?n='.$assoc['pid']); 
  }
    //se cisono errori sql
    if (mysqli_error($connect)){

      $app->redirect('/');
    }
    $assoc=mysqli_fetch_assoc($query_cat);
    $cat_encoded=base64_encode($assoc['parent_id']);
    $app->view()->setData('cat_id',$cat_encoded);
    $app->view()->setData('prima',$assoc);
    $app->view()->setData("titleofpage",$assoc['clabel']);

  }
  ?>
