2<?php
$app->get('/caratteristiche-produttore',function() use($app,$connect){

	$arrayIntestazione = array();

	if (isset($_GET['n'],$_GET['np']) or isset($_GET['n'],$_GET['np'],$_GET['ordine'])){

	//***************controllo valori in get e acqusizione*************************** 
		$id=check($_GET['n']);
		$idprod=check($_GET['np']);
		$ordine=(!isset($_GET['ordine'])) ? '2' : check($_GET['ordine']);

	//********************inizializzo tabella****************************************
		$righe='<thead>';
		$select_value='';
		$n_rows=0;

	//************************condizione della query*****************************
		$where='WHERE pr.parent_id='.$id.' AND pr.produttore='.$idprod.' AND pr.attivo=1 AND pr.id>1';

	//query dei valori settati *************************************************

		$label='SELECT value1,value2,value3,value4,value5,value6,value7,value8,value9,value10,value11 FROM '.CAT_PRODOTTI.'
		cp JOIN '.LINEE_PRODOTTI.' lp ON cp.id=lp.categoria_prodotto JOIN '.PRODOTTI.' p ON p.prodotto_id=lp.id WHERE p.id='.$id;

		$query_label=mysqli_query($connect,$label);
		$assoc=mysqli_fetch_assoc($query_label);

	//conto i valori pieni **************************************************
		$MAX=count($assoc);

	//inizializzo la prima riga *********************************************  
		$righe.='<tr id="values">';

	//setto i valori della prossima query ***********************************
		for ($i=2; $i <=$MAX ; $i++) {

			//controlllo se la virgola serve ***********************************
			$virgola=($i == 11 ) ? $v='' : $v=',' ;

			//mi dice tutti i valori che devo cercare nelle referenze **********
			if ($assoc["value$i"] != '') {
				$select_value.="value$i";
				$n_rows ++;
				array_push($arrayIntestazione, $assoc["value$i"]);

			}else{
				$select_value.='' ;
			}

			//riempio le righe della tabella ***********************************
			$retVal1 = ($assoc["value$i"] != '') ? $righe.="<th ><button class='order' style='background: none;'  data-rel='/caratteristiche-produttore?n=".$id."&np=".$idprod."&ordine=".$i."'>".$assoc["value$i"]."</button></th>" : $righe.='';
			//per capire se aggiungere o meno la virgola nella query
			$k = $i + 1;
			$prox= (empty($assoc["value$k"])) ? $select_value.='' : $select_value.=$v;

		}
	//fine riga d'intestazione della tabella **********************************	
		$righe.='</tr>';
		$righe.='</thead><tbody>';

	//recupero tutte le referenze *********************************************
		$sql="SELECT $select_value FROM ".REF_PRODOTTI." pr  $where ORDER BY cast(value$ordine as unsigned) ASC ";
		$query=mysqli_query($connect,$sql);
		$indice=explode(',',$select_value);
		
	//riempio le righe della tabella con le referenze***************************	

		while($row=mysqli_fetch_assoc($query))
		{

			$righe.='<tr>';

			for ($i=1; $i <=$n_rows ; $i++)
			{
				$righe.="<td class='number'";
				$val=(!isset($indice[$i - 1])) ? '' : $indice[$i - 1];
				$return = (!isset($row[$val])) ? '' : $row[$val] ;
				$righe.=" data-title='".$arrayIntestazione[$i - 1]."'>";
				if($i ==$n_rows){
					$righe .= '<a target="_blank" href="/consulenza-online?id='.$id.'">Richiedi Informazioni</a>';
				}else{
					$righe.=$return;
				}
				$righe.='</td>';
			}

			$righe.='</tr>';
		}
		//fine tabella ***************************************************
		$righe.='</tbody>';
		//mostro la tabella **********************************************
		echo $righe;
		if (mysqli_error($connect)){
			$app->redirect('/');
		}
	}
});
?>
