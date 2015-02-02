<?php

// Read in sample SQL
$sql = file_get_contents(dirname(__FILE__).'/magento_sample_data_for_1.9.1.0.sql');

// Replace all {%placeholder%} vars with matching $_SERVER[] value.
$output = preg_replace_callback("/\{%([A-Z0-9_]+)%\}/", function ($matches) {
  return $_SERVER[$matches[1]];
}, $sql);

$handle = fopen('/tmp/magento_sample_data_processed.sql', 'w');
fwrite($handle, $output);
fclose($handle);
