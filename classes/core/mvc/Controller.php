<?php

namespace core\mvc;
/**
 * Базовый класс для работы с конроллерами
 */
class Controller 
{
    use \core\traits\AccessControl;
    
    /**
     * @var object Хранит экземпляр класса View
     */
    public $view = null;
    
    
   
    /**
     * Создаёт экземпляр класса View для работы с представлениями
     */
    public function __construct() {
        $this->view = new view\View();
        // $this->view = new \ItForFree\PhpExamples\MVC\SimpleView();
       // \DebugPrinter::debug($this->view);
    }
    
    public function header($path) { // 302 редирет
        header ("Location: $path");
    }
    
    
    
   
    
}

