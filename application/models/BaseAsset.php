<?php

/**
 * Временная модель для тестирования
 */
namespace application\models;

use ItForFree\SimpleMVC\components\SimpleAsset\SimpleAsset;

/**
 *  TestAsset -- пример описания пакета ресурсов (ассета)
 *
 * @author vedro-compota
 */
class BaseAsset extends SimpleAsset
{
    public $basePath = 'JS/';
    public $js = [
        'myjs/basejs.js'
    ];
    
    public $css = [
        'myjs/css/basecss.css'
    ];
}
