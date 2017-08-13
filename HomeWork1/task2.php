<?php
//4 11:10-11:40
//$str = '10:00-12:00 10:30-11:20 11:00-11:40 12:00-13:00 12:00-13:30 12:30-13:00 11:10-12:00 11:20-11:40 12:30-12:50';
$str='10:30-11:30 11:00-16:30 11:00-11:20 11:20-12:30';
//преобразовываем строку в массив с временем каждого посетителя
$times_array = explode(' ', $str);
//объявляем ассоциативный массив для учёта времени и посетителей
$times = array();

foreach($times_array as $time) {
  //разбиваем время посетителя на время его прихода и ухода
  list($time_in, $time_out) = explode('-', $time);
  //если значение в массиве по ключу ещё нет, то приравниваем его к нулю
  if (!isset($times[strtotime($time_in)]))
  	$times[strtotime($time_in)] = 0;
  //и прибавляем 1, так как посетитель пришёл в это время и общее кол-во посетителей увеичилось на 1
  $times[strtotime($time_in)] += 1;
  if(!isset($times[strtotime($time_out)]))
  	$times[strtotime($time_out)] = 0;
  $times[strtotime($time_out)] -= 1;
}

//сортируем по ключу
ksort($times);


$temp = 0;
$max = 0;
$botTime = 0;
$topTime = 0;
$flag = false;

foreach ($times as $key => $value) {
  //в переменной temp текущее кол-во посетителей
  $temp += $value;
  //запоминаем верхнее время, когда число посетителей перестало быть максимальным
  if($flag == true && $temp<$max) {
  	$topTime = $key;
  	$flag = false;
  }

  if($temp > $max) {
  	$max = $temp;
  	$botTime = $key;
    $flag = true;
  }
}

echo $max.' '.date('H:i', $botTime)."-".date('H:i', $topTime)."</br>";