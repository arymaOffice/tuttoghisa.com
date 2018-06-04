<?php

$app->get('/carico',function() use($app){

	$data=$app->request()->get();

	$l=$data['l'];
	$v=$data['v'];
	$D=$data['D'];

	function PerditaCarico($l,$v,$D)
               {
                  $numeratore= $l * ($v*$v);
                  
                  $denominatore = 2 * 9.81 * $D;

                  $risultato = $numeratore / $denominatore;


                  return $risultato;
              }



echo $result =  PerditaCarico($l,$v,$D);


});


?>