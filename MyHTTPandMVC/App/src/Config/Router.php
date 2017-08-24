<?php
namespace App\Config;

use App\Controllers\HomeController;
use \Silex\Application;

class Router
{
    private $home;
    private $connection;
    private $app;

    public function __construct(Application $app, MySQLConnector $conn)
    {
        $this->connection = $conn;
        $this->home = new HomeController($this->connection->getPdo());
        $this->app = $app;
    }

    public function home()
    {
        $homeCont = $this->app['controllers_factory'];
        $homeCont->get('/', function () {
            return $this->home->getAll();
        });
        $homeCont->get('/{offset}', function ($offset) {
            return $this->home->getByOffset($offset);
        });
        $homeCont->post('/', function () {
            return $this->home->post(file_get_contents('php://input'));
        });
        $homeCont->put('/{offset}', function ($offset) {
            return $this->home->updateByOffset($offset, file_get_contents('php://input'));
        });
        $homeCont->delete('/{offset}', function ($offset) {
            return $this->home->deleteByOffset($offset);
        });
        return $homeCont;
    }
}