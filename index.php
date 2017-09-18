<?php 
	
	include("vendor/autoload.php");

	use \Twitter\Search\Search;


	$search = new Search();

	$search->setToken("CONSUMER_KEY", "CONSUMER_ACCESS_TOKEN" );

	$value = ["q" => "UpliftHub"];


	$search_res = $search->search($value);

	// var_dump($search_res);
	
	foreach ($search_res as $key => $value) {
		foreach ($value as $vKey => $vValue) {
			if(isset($vValue->text)){
				echo "<pre>"; 
				print_r($vValue->text);
				echo "</pre>";
			}else{
				// echo "<pre>"; 
				// print_r($vValue);
				// echo "</pre>";
			}
			
	}
	}
 ?>