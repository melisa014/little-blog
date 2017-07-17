<?php

namespace core;
/**
 * Базовый класс для работы с конроллерами
 */
class Controller 
{

    public $view = null;
   
    
    public function __construct() {
        $this->view = new View();
       // \DebugPrinter::debug($this->view);
    }
    
    
    
}

