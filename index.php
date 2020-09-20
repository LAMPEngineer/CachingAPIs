<?php
/**
 *  
 */

$start=microtime(true);

//autoload 
include __DIR__ . '/autoload.php';


$url_elements = explode('/', $_SERVER['PATH_INFO']);

if(!empty($url_elements[1])){	

	$page_name = $url_elements[1];
		
	$contrller_name = 'cacheController';
	if(class_exists($contrller_name)){
		$controller = new $contrller_name();
		
		$response = $controller->pageCache($page_name);
		echo $response;
	}
}


$end=microtime(true);
echo "Time taken = ".round($end-$start,4);