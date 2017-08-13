<?php
class MaximumUniqueSubstring
{
  public function findMaximumUniqueSubstring($str) 
  {
    //преобразуем строку в массив символов
    $arr = str_split($str);
    $length = count($arr);
    //промежуточный массив для хранения уникальной подстроки
    $temp = array();
    //строка для хранения максимальной уникальной подстроки
    $result = '';
    for($i = 0; $i < $length; ++$i)
    {
      //если символ повторяется
      if(in_array($arr[$i], $temp))
      {
        //если уникальная строка длинне, чем осталось символов, выводим результат
        if(strlen($result) > $length - $i)
          return $result;
        //если новая уникальная последовательность оказалась длиннее, переприсваиваем
        if(strlen($result) <= count($temp))
          $result = implode('',$temp);
        //очищаем промежуточный массив
        $temp = array();
        //и добавляем туда текущий символ
        array_push($temp, $arr[$i]);
      }
      else
        array_push($temp, $arr[$i]);
    }
    if(strlen($result) <= count($temp))
      $result = implode('',$temp);
    return $result;
  }
}
