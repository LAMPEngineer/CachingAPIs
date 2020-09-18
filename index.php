<?php
/**
 *  
 */

$start=microtime(true);

//autoload 
include __DIR__ . '/autoload.php';

$cache_file = env('CACHE_FILE');

if(file_exists($cache_file) && filemtime($cache_file) > time()-20){
	echo "From Cache...<br/>";
	include($cache_file);
}else{
	$model_name = 'myModel';

	if(class_exists($model_name)){
		
		// config
		$config = 'databaseConfig';


		if(class_exists($config)){

			// PDO db object
			$db = new $config();
			$conn = $db->connect();

			// model object
			$model = new $model_name($conn);
			
			$result = $model->getAll();

			$str="<table border='1'>";
			$str.="<tr><td>Name</td><td>City</td><td>Game</td><td>Study</td><td>Teacher</td></tr>";

				foreach($result as $list){				
					$list = (object) $list;

					$str.="<tr><td>".$list->name."</td><td>".$list->city."</td><td>".$list->game."</td><td>".$list->study."</td><td>".$list->teacher."</td></tr>";
				}
			$str.="</table>";
			$handle=fopen($cache_file,'w');
			fwrite($handle,$str);
			fclose($handle);
			echo "Cache Created...<br/>";
			echo $str;
		}

	}
}

$end=microtime(true);
echo "Time taken = ".round($end-$start,4);