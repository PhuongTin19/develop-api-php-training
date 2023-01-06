<?php
require 'Config/Dispatcher.php';
require_once 'Controller/ExceptionController.php';

class BookStoreApplication{
    public function runApp(){
        $this->configRestHeader();
        try {
            $dispatcher = new Dispatcher();
            $dispatcher->dispatch();
        } catch (Exception $exception) {
            $exceptionController = new ExceptionController();
            $exceptionController->handleGlobalException($exception);
        }
    }
    
    private function configRestHeader(){
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Methods: GET, POST");
        header("Access-Control-Max-Age: 3600");
        header("Content-Type: application/json; charset=UTF-8");
        header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization");
    }
}
?>