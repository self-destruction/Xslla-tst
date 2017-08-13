<?php
class Brackets
{
  public function isBracketSequenceCorrect($str) 
  {
    //преобразовываем строку в массив символов
    $arr = str_split($str);
    //объявляем массив, чтобы исп его как стек
    $stack = array();
    foreach($arr as $char)
    {
      switch($char)
      {
        case '(':
        case '[':
        case '{':
          //если текущий символ - открывающаяся скобка,
          //то кладём её в стек (добавляем в конец массива)
          array_push($stack, $char);
          break;
        case ')':
          //если текущий символ - закрывающаяся скобка и
          //верхний элемент стека - совпадающая открывающаяся скобка,
          if(!empty($stack) && $stack[count($stack)-1] == '(')
          {
            //то происходит извлечение верхнего элемента из стека
            array_pop($stack);
          }
          else
            return false;
          break;
        case ']':
          if(!empty($stack) && $stack[count($stack)-1] == '[')
            array_pop($stack);
          else
            return false;
          break;
        case '}':
          if(!empty($stack) && $stack[count($stack)-1] == '{')
            array_pop($stack);
          else
            return false;
          break;
        default:
          return false;
      }
    }
    if (empty($stack))
      return true;
    else
      return false;
  }
}
