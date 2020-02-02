<?php

namespace app;

use app\model\User;
use PDO;

class App
{
    private $title;
    
    private static $app = null;
    
    private $user = null;
    
    private  $pdo = null;

    private $controller;
    
    public function setTitle($title) 
    {
        $this->title = $title;
    }
    
    public function db(): PDO
    {        
        if ($this->pdo === null) {
            $params = require self::webRoot() . '/src/connection.php';
            extract($params);
            $this->pdo = new PDO($connection, $username, $password,[
                \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC, 
                \PDO::ATTR_EMULATE_PREPARES => false, 
                \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION
            ]); 
        }
        return $this->pdo;
    }
    
    protected function __construct() 
    {
        if (!empty($_SESSION['userId'])) {
            $this->user = User::findById($_SESSION['userId']);
        }
    }
    
    public static function get(): App
    {
        if (self::$app === null) {
            self::$app = new static();
        }
        return self::$app;
    }
    
    public function getTitle($encode = false) 
    {
        if (empty($this->title)) {
            $this->title = 'Vesti iz sveta video igara';
        }
        if ($encode) {
            return htmlspecialchars($this->title);
        }
        return $this->title;
    }
    
    
    public function webRoot()
    {
        return dirname(__DIR__);
    }
    
    public function resource($resource)
    {
        return 'resource/'.$resource;
    }
    
    public function logoutUser()
    {
        session_destroy();
        $this->user = null;
    }
    
    public function loginUser($user)
    {
        if (!is_object($user)) {
            $id = $user;
            $user = User::findById($id);
            if (empty($user)) {
                throw new \Exception('Nespotojeci korisnik!');
            }
        }
        $_SESSION['userId'] = $user->id;
        $this->user = $user;
    }
    
    public function getUser(): ?User
    {
        return $this->user;
    }
    
    public function getPostData($className)
    {
        if (empty($_POST[$className])) {
            return null;
        }
        return $_POST[$className];
    }
    
    public function run()
    {
        session_start();
        $run = $_GET['run'] ?? 'site/index';
        $params = explode('/', $run);
        if (count($params) !== 2) {
            throw new \Exception('Nepostojeca adresa!');
        }
        $controllerId = $params[0];
        $methodId = $params[1];
        $controllerClass = '\\app\\controller\\' . ucfirst($controllerId) .'Controller';
        $method = 'action' . ucfirst($methodId);
        $controller = new $controllerClass();
        $this->controller = $controller;
        try {   
            if (!empty($_SESSION['userId'])) {
                $this->user = User::findById($_SESSION['userId']);
            }
            $content = $controller->$method();
            $layout = $controller->layout;
        } catch (\Exception $e) {
            $content = $e->getMessage();
            $layout = 'layout/error';
        }
        return $controller->render($layout, $content);
        
    }
    
}

