<?php

namespace core;
/**
 * 
 */
class Controller 
{

    public $view = null;
   
    
    public function __construct() {
        $this->view = new View();
       // \DebugPrinter::debug($this->template);
    }
    
    
    
}

