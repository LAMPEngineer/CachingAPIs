
<?php
  $variables = [
      'APP_NAME'     => 'CachingAPIs',
      'DB_HOST'      => 'localhost',
      'DB_USERNAME'  => 'root',
      'DB_PASSWORD'  => '',
      'DB_NAME'      => 'php_cache',
      'CACHE_FILE'   => 'cache/index.cache.php'
  ];

  foreach ($variables as $key => $value) {
      putenv("$key=$value");
  }