<?php

/* 
 * Класс ассет для библиотеки Джиквери
 * 
 */

namespace application\assets;
use ItForFree\SimpleAsset\SimpleAsset;
use application\assets\BootstrapAsset;

class JqueryAsset extends SimpleAsset {
            
    public $basePath = '/';
    
    public $js = [
        'JS/jquery-3.2.1.js'
    ];
    

     
}