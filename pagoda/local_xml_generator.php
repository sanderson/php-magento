<?php

$xmlContents = file_get_contents('pagoda/local.xml.template');
if(!$xmlContents){
    throw new Exception('template file not found: pagoda/local.xml.template');
}
$xmlContents = str_replace(array(
    '{date}',
    '{crypt_key}',
    '{username}',
    '{password}',
    '{db_name}',
    '{host}',
    '{app_name}',
    '{cache_host}',
    '{cache_port}',
    '{session_host}',
    '{session_port}'
),array(
    date('r'),
    hash('md5', $_SERVER['APP_NAME']),
    $_SERVER['DB1_USER'],
    $_SERVER['DB1_PASS'],
    $_SERVER['DB1_NAME'],
    $_SERVER['DB1_HOST'],
    $_SERVER['APP_NAME'],
    $_SERVER['CACHE1_HOST'],
    $_SERVER['CACHE1_PORT'],
    $_SERVER['CACHE2_HOST'],
    $_SERVER['CACHE2_PORT']
),$xmlContents);

$handle = fopen('app/etc/local.xml', 'w');
fwrite($handle, $xmlContents);
fclose($handle);
