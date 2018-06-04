<?php
$sql="SELECT `id`,`label` FROM ".CAT_PRODOTTI." WHERE attivo=1 and id>1 and parent_id<=0 ORDER BY label DESC";
$exec=mysqli_query($connect,$sql);
$menu='';
$macrocategorie='';
$i=0;
while ( $row[$i]=mysqli_fetch_array($exec)) {
$array[$i]=$row[$i];
$p[$i]=$row[$i];
$i ++ ;
}
$max=$i;
for ($c=0; $c < $i ; $c++) {
  $macros_id[$c]= $p[$c]['id'];
  $id=base64_encode($p[$c]['id']);
  $macrocategorie[$c]['id']=$id;
  $macrocategorie[$c]['label']=$p[$c]['label'];
  $menu.='	<li class="menu-item"><a href="/lineeprodotti?cat='.$id.'">'.$p[$c]['label'].'</a></li>';
  $o=0;
    }

          $app->view()->setData('menu',$menu);
          $app->view()->setData('macrocategorie',$macrocategorie);
          $app->view()->setData('macros_id',$macros_id);
 ?>
