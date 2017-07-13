<?php

class DebugPrinter
{
    /**
     * Вывод строки/массива/объекта на экран в удобном виде с целью отладки
     * @param mixed
     */
    static public function debug($obj)
    {
        echo "<pre> Тест: ";
        print_r($obj);
        echo "</pre>";
    }
}
    
