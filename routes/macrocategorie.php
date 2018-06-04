<?php                                                                                          
$app->get('/macrocategorie',function() use($app,$connect){
	require 'menu.php';
	require 'nome.php';
	$app->view()->setData("titleofpage",'Macrocategorie');	
	$app->render("macrocategorie.html");

});
?>