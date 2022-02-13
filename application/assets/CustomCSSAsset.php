<?php

namespace application\assets;
use ItForFree\SimpleAsset\SimpleAsset;
use application\assets\BootstrapAsset;

/* 
 * Класс ассетов для CSS стилей. Пользовательский
 * 
 */

class CustomCSSAsset extends SimpleAsset {
    
    public $basePath = '/';
    
    public $css = [
        'CSS/style.css'
    ];
    
    public $needs = [    
       BootstrapAsset::class         
    ];     
    
}

