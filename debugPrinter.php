<?php

/**
 * Вывод строки/массива/объекта на экран в удобном виде с целью отладки
 * @param mixed
 */
function debug($obj)
{
    echo "<pre>";
    print_r($obj);
    echo "</pre>";
}

