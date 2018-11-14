<?php

/**
 * Временная модель для тестирования
 */
namespace application\models;

use ItForFree\SimpleAsset\SimpleAsset;
use application\models\BaseAsset;

/**
 *  TestAsset -- пример описания пакета ресурсов (ассета)
 *
 * @author vedro-compota
 */
class TestAsset extends SimpleAsset
{
    public $basePath = 'JS/';
    public $js = [
        'myjs/test1.js',
        'myjs/test2222.js'
    ];
    
    public $css = [
        'myjs/css/my.css'
    ];
    
    public $needs = [BaseAsset::class];
}
