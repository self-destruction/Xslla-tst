<?php
$file = '/' . trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_QUERY), 'file=');
$path = __DIR__ . $file;
if (file_exists($path))
{
  switch($_SERVER['REQUEST_METHOD'])
  {
    case 'HEAD':
    {
      header('Content-length: '.filesize($path));
      break;
    }
    case 'GET':
    {
      echo nl2br(file_get_contents($path));
      break;
    }
    case 'POST':
    {
      file_put_contents($path, file_get_contents("php://input"));
      break;
    }
    case 'DELETE':
    {
      unlink($path);
      break;
    }
    case 'PATCH':
    {
      file_put_contents($path, file_get_contents("php://input"), FILE_APPEND);
      break;
    }
  }
}
else
  exit('File is not found.');
