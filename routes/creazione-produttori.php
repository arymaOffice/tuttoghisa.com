<?php
$produttori="SELECT p.produttore FROM ".PRODOTTI." p WHERE p.id='$id' ";
$query_produttori=mysqli_query($connect,$produttori);
$assoc=mysqli_fetch_array($query_produttori);
$pos=strpos($assoc['produttore'],',');
$retVal = ($pos === false ) ? $prod[0]=$assoc['produttore'] : $prod=explode(',',$assoc['produttore']) ;
$num=count($prod);
$bottoni='';
$Prodottoda='';
for ($i=1; $i <=$num ; $i++) {
	$N=$prod[$i-1];
	$sql_p="SELECT label FROM ".ITEMS." WHERE id=$N";
	$query_p=mysqli_query($connect,$sql_p);
	$ar=mysqli_fetch_assoc($query_p);
	$bottoni.='<button style="min-width: 285px;margin-bottom:5px;margin-right:5px;display:none;" class="btn  btn-secondary" id="'.$N.'" data-rel="'.$id.'">'.$ar['label'].'</button>';
	$bottoni .= ($i % 4 == 0 ) ? '<br>' : ''; 
	$retVal = ($i < $num) ? $Prodottoda.=$ar['label'].',' : $Prodottoda.=$ar['label'].'.' ;
}
$app->view()->setData('bottoni',$bottoni);
//$app->view()->setData('Prodottoda',$Prodottoda);

 ?>
