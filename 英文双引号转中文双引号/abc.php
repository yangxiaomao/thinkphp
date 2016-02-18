<?php
$test_string = 'this is a "test as" string juventus vs "napoli" is  b a bing match';

echo preg_replace('/"([^"]*)"/', '“${1}”', $test_string);
?>