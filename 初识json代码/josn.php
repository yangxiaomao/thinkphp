<?php
/*
用json_encode，把数组转换成json字符串
*/
$arr = array(
    'Name'=>'安广隶',
	'Age'=>20
);
$jsonencode = json_encode($arr);
echo $jsonencode;

/**************************************************************
03
 *   在json_encode之前，把所有数组内所有内容都用urlencode()处理一下，然用json_encode()转换成json字符串，最后再用urldecode()将编码过的中文转回来。
04
 *  使用特定function对数组中所有元素做处理
05
 *  @param  string  &$array     要处理的字符串
06
 *  @param  string  $function   要执行的函数
07
 *  @return boolean $apply_to_keys_also     是否也应用到key上
08
 *  @access public
09
 *
10
 *************************************************************/
 function arrayRecursive(&$array,$function,$apply_to_keys_also = false){
	  static $recursive_counter = 0;
	  if(++$recursive_counter > 1000){
		  die('possible deep recursion attack');
	  }
	 
	  foreach ($array as $key =>$value){
		  if(is_array($value)){
			  arrayRecursive($array[$key],$function, $apply_to_keys_also);
		  }else{
			  $array[$key] = $function($value);
		  }
		  if($apply_to_keys_also && is_string($key)){
			  $new_key = $function($key);
			  if($new_key != $key){
				  $array[$new_key] = $array[$key];
				  unset($array[$key]);
			  }
		  }
	  }
	  $recursive_counter--;
 }

/**************************************************************
36
 *
37
 *  将数组转换为JSON字符串（兼容中文）
38
 *  @param  array   $array      要转换的数组
39
 *  @return string      转换得到的json字符串
40
 *  @access public
41
 *
42
 *************************************************************/
function JSON($array){
	arrayRecursive($array,'urlencode', true);
	$json = json_encode($array);
	return urldecode($json);
}
$array = array(
  'Name'=>'安广隶',
  'Age'=>25
);
echo JSON($array);

?>