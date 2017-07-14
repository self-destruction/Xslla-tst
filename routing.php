<?php
$file = $_GET['file'];
if (file_exists($file))
{
  switch($_SERVER['REQUEST_METHOD'])
  {
    case 'HEAD':
    {
      header('Content-length: '.filesize($file));
      break;
    }
    case 'GET':
    {
      readfile($file);
      break;
    }
    case 'POST':
    {
      file_put_contents($file, file_get_contents("php://input"));
      break;
    }
    case 'DELETE':
    {
      unlink($file);
      break;
    }
    case 'PATCH':
    {
      file_put_contents($file, file_get_contents("php://input"), FILE_APPEND);
      break;
    }
    default:
    {
      exit('Method undefined.');
      break;
    }
  }
}
else
{
  http_response_code(500);
  echo 'File not found.';
}
