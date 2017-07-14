<?php

namespace core;
/**
 * Элементарный класс для работы с представлениями
 * -- позволят отделить HTML от PHP 
 */
class View 
{
    public $templateBasePath = '/';
    
    private $vars = [];
    
    public $footerFilePath = 'footer.php';
    public $headerFilePath = 'header.php';
   
    
    public function __construct() {
        $this->templateBasepath = $_SERVER['DOCUMENT_ROOT'] 
                . DIRECTORY_SEPARATOR . 'views' . DIRECTORY_SEPARATOR;
    }

    /**
     * Добавить переменную в шаблон
     * 
     * @param type $name
     * @param type $value
     */
    public function addVar($name, $value)
    {
        $this->vars[$name] = $value;
    }

    
    public function render($path)
    {
        extract($this->vars);
        
        include($this->templateBasepath . $this->headerFilePath);
        
        include($this->templateBasepath . $path);
        
        include($this->templateBasepath . $this->footerFilePath);
        
    }
    
    
    
}

