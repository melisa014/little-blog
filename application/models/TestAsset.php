<?php

/**
 * Временная модель для тестирования
 */
namespace application\models;

use ItForFree\SimpleMVC\components\SimpleAsset\SimpleAsset;

/**
 * Description of TestAsset
 *
 * @author qwe
 */
class TestAsset extends SimpleAsset
{
    public $js = [
        'myjs/test1.js',
        'myjs/test2222.js'
    ];
}
