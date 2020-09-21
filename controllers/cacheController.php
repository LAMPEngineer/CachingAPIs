<?php
/**
 * cache controller to handle caches
 */
class CacheController
{

	/**
	 * function to handel page cache
	 * @param  string $page_name    name of page to be cached
	 * @return string               view response
	 */
	public function pageCache($page_name): string
	{
		$cache_directory = env('CACHE_DIR');
		$page_cache_duration = env('CACHE_PAGE_DURATION');

		$cache_file = $cache_directory .'/'. $page_name.'.cache.php';

		/**
		 *  for new cache - duration will be taken from config
		 */
		if(file_exists($cache_file) && filemtime($cache_file) > time()-$page_cache_duration){
			$response = "From Cache...<br/>";
			$response .= include($cache_file);

			return $response;
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
					$view_name =  'indexView';
					if(class_exists($view_name)){
						$view = new $view_name();
						$response = $view->render($result);
					}

					$handle=fopen($cache_file,'w');
					fwrite($handle,$response);
					fclose($handle);
					$response .= "<br/>Cache Created...<br/>";
					return $response;
				}

			}
		}
	}
	

	/**
	 * function to handle mamcache
	 * 
	 * @return string    response
	 */
	public function memcacheCache()
	{
		 $memcache = new Memcache;
		 $memcache->connect("localhost",11211); # might need to set "localhost" to "127.0.0.1"
		 echo "Server's version: " . $memcache->getVersion() . "<br />\n";
		 $tmp_object = new stdClass;
		 $tmp_object->str_attr = "test";
		 $tmp_object->int_attr = 123;
		 $memcache->set("key",$tmp_object,false,10);
		 echo "Store data in the cache (data will expire in 10 seconds)<br />\n";
		 echo "Data from the cache:<br />\n";
		 var_dump($memcache->get("key"));
	}
}