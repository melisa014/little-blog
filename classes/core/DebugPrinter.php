<?php
namespace core;

class DebugPrinter
{
    /**
     * Вывод строки/массива/объекта на экран в удобном виде с целью отладки
     * @param mixed
     */
    static public function debug($obj, $comment = 'Тест')
    {
        echo "<pre> $comment: ";
        print_r($obj);
        echo "</pre>";
    }
}
    
