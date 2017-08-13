<?php
//входные данные - строка
$str = 'abcdabcd abcd abcdabcdabcdabcd';
//образуем массив из 3 элементов, разбивая исходную строку с помощью пробела
list($x, $y, $z) = explode(' ', $str);
//находим НОД из 3 чисел - из длин слов: находим НОД от НОДа первых двух чисел и третьего числа
$gcd = gmp_gcd(gmp_gcd(strlen($x), strlen($y)), strlen($y));
//из первого слова получаем подстроку длиной gcd от начала слова  
$v = substr($x, 0, strval($gcd));
//проверяем равно ли кол-во вхождений слова v длине каждого слова / нод 
if (substr_count($x, $v) == strlen($x) / $gcd && 
	substr_count($y, $v) == strlen($y) / $gcd && 
	substr_count($z, $v) == strlen($z) / $gcd)
  echo $v;
else
  echo 'Not found';