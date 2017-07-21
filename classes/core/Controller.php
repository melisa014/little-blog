<?php

namespace core;
/**
 * Базовый класс для работы с конроллерами
 */
class Controller 
{
    /**
     * @var object Хранит экземпляр класса View
     */
    public $view = null;
   
    /**
     * Создаёт экземпляр класса View для работы с представлениями
     */
    public function __construct() {
        $this->view = new View();
       // \DebugPrinter::debug($this->view);
    }
    
    public function header($path) { // 302 редирет
        header ("Location: $path");
    }
    
}

